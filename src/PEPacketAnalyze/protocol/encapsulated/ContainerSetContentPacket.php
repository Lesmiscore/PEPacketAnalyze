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

class ContainerSetContentPacket extends Packet{

	public function getName(){
		return "ContainerSetContent Packet";
	}

	public function decode(){
		$this->windowid = $this->getByte();
		$count = $this->getShort();
		$this->slots = [];
		for($i = 0; $i < $count; $i++){
			$this->slots[$i] = $this->getSlot();
		}
		if($this->windowid === 0 or !$this->feof()){
			$count = $this->getShort();
			$this->hotbar = [];
			for($i = 0; $i < $count; $i++){
				$this->hotbar[$i] = $this->getInt();
			}
		}
		//print_r($this);
	}

}
