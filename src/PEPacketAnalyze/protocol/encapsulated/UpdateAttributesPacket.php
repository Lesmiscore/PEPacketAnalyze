<?php

/*
 *▪   ▄▄▄·       ▄▄· ▄ •▄ ▄▄▄ .▄▄▄▄▄
 *██ ▐█ ▄█▪     ▐█ ▌▪█▌▄▌▪▀▄.▀·•██
 *▐█· ██▀· ▄█▀▄ ██ ▄▄▐▀▀▄·▐▀▀▪▄ ▐█.▪
 *▐█▌▐█▪·•▐█▌.▐▌▐███▌▐█.█▌▐█▄▄▌ ▐█▌·
 *▀▀▀.▀    ▀█▄▀▪·▀▀▀ ·▀  ▀ ▀▀▀  ▀▀▀
 *
 *This program is free software:
 *and PocketEdition Packet Analyze.
 *
*/

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;

use PEPacketAnalyze\utils\Binary;

class UpdateAttributesPacket extends Packet{

	public function getName(){
		return "UpdateAttributes Packet";
	}

	public function decode(){
		$this->entries = [];
		$this->eid = $this->getLong();
		$count = $this->getShort();
		for($i = 0; $i < $count; $i++){
			$minvalue = $this->getFloat();
			$maxvalue = $this->getFloat();
			$value = $this->getFloat();
			$entryname = $this->getString();
			$this->entries[] = [$minvalue, $maxvalue, $value, $entryname];
		}
		//print_r($this->entries);
	}

}
