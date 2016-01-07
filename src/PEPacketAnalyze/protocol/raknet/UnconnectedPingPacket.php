<?php

namespace PEPacketAnalyze\protocol\raknet;

use PEPacketAnalyze\protocol\Packet;

class UnconnectedPingPacket extends Packet{

	public function getName(){
		return "Unconnected Ping";
	}

	public function decode(){
		$this->pingID = $this->getLong();
		$this->magic = $this->getMagic();
		//TODO: 8bit === Long?
		//print_r($this);
	}

}
