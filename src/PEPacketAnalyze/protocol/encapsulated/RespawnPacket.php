<?php

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;

use PEPacketAnalyze\utils\Binary;

class RespawnPacket extends Packet{

	public function getName(){
		return "Respawn Packet";
	}

	public function decode(){
		$this->x = $this->getFloat();
		$this->y = $this->getFloat();
		$this->z = $this->getFloat();
		//print_r($this);
	}

}
