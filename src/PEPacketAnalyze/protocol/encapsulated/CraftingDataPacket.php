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

class CraftingDataPacket extends Packet{

	public function getName(){
		return "CraftingData Packet";
	}

	public function decode(){
		$count = $this->getInt();
		for($i = 0; $i < $count; $i++){
			$entryType = $this->getInt();
			$size = $this->getInt();
			switch($entryType){
				case -1:
					$this->entries[] = [$entryType, $size, null];
				break;
				default://TODO
					$data = $this->get($size);

					$this->entries[] = [$entryType, $size, $data];//TODO: data解析
				break;
			}
		}
		$this->cleanRecipes = $this->getByte();
		//print_r($this);
	}

}
