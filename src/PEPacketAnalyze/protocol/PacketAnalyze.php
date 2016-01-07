<?php

namespace PEPacketAnalyze\protocol;

use PEPacketAnalyze\protocol\raknet\UnconnectedPingPacket;
use PEPacketAnalyze\protocol\raknet\UnconnectedPongPacket;
use PEPacketAnalyze\protocol\raknet\OpenConnectionRequest1Packet;
use PEPacketAnalyze\protocol\raknet\OpenConnectionRequest2Packet;
use PEPacketAnalyze\protocol\raknet\OpenConnectionReply1Packet;
use PEPacketAnalyze\protocol\raknet\OpenConnectionReply2Packet;

use PEPacketAnalyze\protocol\raknet\UnknownPacket;

use PEPacketAnalyze\protocol\raknet\NACK;
use PEPacketAnalyze\protocol\raknet\ACK;

use PEPacketAnalyze\protocol\raknet\CustomPacket;

use PEPacketAnalyze\protocol\raknet\EncapsulatedPacket;

class PacketAnalyze{

	public function __construct($logger){
		$this->logger = $logger;
		$this->datapacketanlyze = new DataPacketAnalyze($logger);
		$this->splitPackets = [];
	}

	public function ReceivePacket($callname, $buffer){
		$id = ord($buffer{0});
		switch($id){
			case 1:
			$packet = new UnconnectedPingPacket($buffer);
			break;
			case 5:
			$packet = new OpenConnectionRequest1Packet($buffer);
			break;
			case 6:
			$packet = new OpenConnectionReply1Packet($buffer);
			break;
			case 7:
			$packet = new OpenConnectionRequest2Packet($buffer);
			break;
			case 8:
			$packet = new OpenConnectionReply2Packet($buffer);
			break;
			case 28:
			$packet = new UnconnectedPongPacket($buffer);
			break;
			case 128:
			case 129:
			case 130:
			case 131:
			case 132:
			case 133:
			case 134:
			case 135:
			case 136:
			case 137:
			case 138:
			case 139:
			case 140:
			case 141:
			case 142:
			case 143:
			$packet = new CustomPacket($buffer);
			$packet->decode();//
			foreach($packet->packets as $num => $enpacket){
				$enpacket = EncapsulatedPacket::fromBinary($enpacket->toBinary(true), true);
				$this->datapacketanlyze->ReceiveDataPacket($enpacket->buffer);
			}
			foreach($packet->splitpackets as $num => $splitpacket){
				if($splitpacket->splitCount >= 128){
					return;
				}
				if(!isset($this->splitPackets[$splitpacket->splitID])){
					$this->splitPackets[$splitpacket->splitID] = [$splitpacket->splitIndex => $splitpacket];
				}else{
					$this->splitPackets[$splitpacket->splitID][$splitpacket->splitIndex] = $splitpacket;
				}

				if(count($this->splitPackets[$splitpacket->splitID]) === $splitpacket->splitCount){
					$pk = new EncapsulatedPacket();
					$pk->buffer = "";
					for($i = 0; $i < $splitpacket->splitCount; ++$i){
						if(isset($this->splitPackets[$splitpacket->splitID][$i])){
							$pk->buffer .= $this->splitPackets[$splitpacket->splitID][$i]->buffer;
						}
					}

					$pk->length = strlen($pk->buffer);
					unset($this->splitPackets[$splitpacket->splitID]);

					$this->datapacketanlyze->ReceiveDataPacket($pk->buffer);
				}
			}
			break;
			case 160:
			$packet = new NACK($buffer);
			break;
			case 192:
			$packet = new ACK($buffer);
			break;
			default:
			$packet = new UnknownPacket();
			break;
		}
		if(!$packet->decoded){
			$packet->decode();
		}
		$this->logger->debug($callname.": ".$id." : ".$packet->getName(), 2);
		unset($packet);
	}

}
