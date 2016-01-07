<?php

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;

class PongPacket extends Packet{

	public function getName(){
		return "Pong Packet";
	}

	public function decode(){
		$this->pingID = $this->getLong();
		if(!$this->feof()){
			$this->pongID = $this->getLong();
		}
		//print_r($this);
	}

}
