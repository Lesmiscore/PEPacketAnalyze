<?php

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;

use PEPacketAnalyze\utils\Binary;

class EntityEventPacket extends Packet{

	public function getName(){
		return "EntityEvent Packet";
	}

	public function decode(){
		$this->eid = $this->getLong();
		$this->event = $this->getByte();
		//print_r($this);
	}

}
