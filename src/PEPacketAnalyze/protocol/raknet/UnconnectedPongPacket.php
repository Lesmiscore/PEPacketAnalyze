<?php

namespace PEPacketAnalyze\protocol\raknet;

use PEPacketAnalyze\protocol\Packet;

class UnconnectedPongPacket extends Packet{

	public function getName(){
		return "Unconnected Pong";
	}

	public function decode(){
		$this->pingID = $this->getLong();
		$this->serverID = $this->getLong();
		$this->magic = $this->getMagic();
		if(!$this->feof()){//Error fix
			$this->servername = $this->getString();
		}
		//print_r($this);
	}

}
