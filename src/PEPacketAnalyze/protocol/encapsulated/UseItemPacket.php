<?php

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;

class UseItemPacket extends Packet{

	public function getName(){
		return "UseItem Packet";
	}

	public function decode(){
		$this->x = $this->getInt();
		$this->y = $this->getInt();
		$this->z = $this->getInt();
		$this->face = $this->getByte();
		$this->fx = $this->getFloat();
		$this->fy = $this->getFloat();
		$this->fz = $this->getFloat();
		$this->posX = $this->getFloat();
		$this->posY = $this->getFloat();
		$this->posZ = $this->getFloat();
		$this->item = $this->getSlot();
		//print_r($this);
	}

}
