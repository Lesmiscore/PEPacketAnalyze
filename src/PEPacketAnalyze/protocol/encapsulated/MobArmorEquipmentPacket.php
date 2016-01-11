<?php

/*
 *▪   ▄▄▄·       ▄▄· ▄ •▄ ▄▄▄ .▄▄▄▄▄
 *██ ▐█ ▄█▪     ▐█ ▌▪█▌▄▌▪▀▄.▀·•██
 *▐█· ██▀· ▄█▀▄ ██ ▄▄▐▀▀▄·▐▀▀▪▄ ▐█.▪
 *▐█▌▐█▪·•▐█▌.▐▌▐███▌▐█.█▌▐█▄▄▌ ▐█▌·
 *▀▀▀.▀    ▀█▄▀▪·▀▀▀ ·▀  ▀ ▀▀▀  ▀▀▀
 *
 *This program is free software:
 *and PocketEdision Packet Analyze.
 *
*/

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;

use PEPacketAnalyze\utils\Binary;

class MobArmorEquipmentPacket extends Packet{

	public function getName(){
		return "MobArmorEquipment Packet";
	}

	public function decode(){
		$this->slots = [];
		$this->eid = $this->getLong();
		$this->slots[0] = $this->getSlot();
		$this->slots[1] = $this->getSlot();
		$this->slots[2] = $this->getSlot();
		$this->slots[3] = $this->getSlot();
		//print_r($this);
	}

}
