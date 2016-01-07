<?php

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;

use PEPacketAnalyze\utils\Binary;

class MobEquipmentPacket extends Packet{

	public function getName(){
		return "MobEquipment Packet";
	}

	public function decode(){
		$this->eid = $this->getLong();
		$this->item = $this->getSlot();
		$this->slot = $this->getByte();
		$this->selectedSlot = $this->getByte();
		//print_r($this);
	}

}
