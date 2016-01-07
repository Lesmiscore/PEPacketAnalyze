<?php

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;

class ContainerSetSlotPacket extends Packet{

	public function getName(){
		return "ContainerSetSlot Packet";
	}

	public function decode(){
		$this->windowid = $this->getByte();
		$this->slot = $this->getShort();
		$this->hotbarSlot = $this->getShort();
		$this->item = $this->getSlot();
		//print_r($this);
	}

}
