<?php

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;

use PEPacketAnalyze\utils\Binary;

class AddItemEntityPacket extends Packet{

	public function getName(){
		return "AddItemEntity Packet";
	}

	public function decode(){
		$this->eid = $this->getLong();
		$this->item = $this->getSlot();
		$this->x = $this->getFloat();
		$this->y = $this->getFloat();
		$this->z = $this->getFloat();
		$this->speedX = $this->getFloat();
		$this->speedY = $this->getFloat();
		$this->speedZ = $this->getFloat();
		//print_r($this);
	}

}
