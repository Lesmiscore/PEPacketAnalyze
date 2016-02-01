<?php

/*
 *▪   ▄▄▄·       ▄▄· ▄ •▄ ▄▄▄ .▄▄▄▄▄
 *██ ▐█ ▄█▪     ▐█ ▌▪█▌▄▌▪▀▄.▀·•██
 *▐█· ██▀· ▄█▀▄ ██ ▄▄▐▀▀▄·▐▀▀▪▄ ▐█.▪
 *▐█▌▐█▪·•▐█▌.▐▌▐███▌▐█.█▌▐█▄▄▌ ▐█▌·
 *▀▀▀.▀    ▀█▄▀▪·▀▀▀ ·▀  ▀ ▀▀▀  ▀▀▀
 *
 *This program is free software:
 *and PocketEdition Packet Analyze.
 *
*/

namespace PEPacketAnalyze\protocol\raknet;

use PEPacketAnalyze\protocol\Packet;
use PEPacketAnalyze\protocol\raknet\EncapsulatedPacket;

class CustomPacket extends Packet{

	public function getName(){
		return "Custom Packet";
	}

	public function decode(){
		parent::decode();
		$this->splitpackets = [];
		$this->packets = [];
		$this->seqNumber = $this->getLTriad();
		while(!$this->feof()){
			$offset = 0;
			$data = substr($this->buffer, $this->offset);
			$packet = EncapsulatedPacket::fromBinary($data, false, $offset);
			$this->offset += $offset;
			if(strlen($packet->buffer) === 0){
					break;
			}
			if($packet->hasSplit){
				$this->splitpackets[] = $packet;
			}else{
				$this->packets[] = $packet;
			}
		}
	}

}
