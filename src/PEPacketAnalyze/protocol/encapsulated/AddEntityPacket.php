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

class AddEntityPacket extends Packet{

	public function getName(){
		return "Add Entity Packet";
	}

	public function decode(){
		$this->eid = $this->getLong();
		$this->type = $this->getInt();
		$this->x = $this->getFloat();
		$this->y = $this->getFloat();
		$this->z = $this->getFloat();
		$this->speedX = $this->getFloat();
		$this->speedY = $this->getFloat();
		$this->speedZ = $this->getFloat();
		$this->yaw = $this->getFloat();
		$this->pitch = $this->getFloat();
		$this->metadata = Binary::readMetadata($this->get(true), true, $offset);
		$this->offset += $offset;

		if(!$this->feof()){
			$offset = strlen($this->buffer) - $this->offset;
			if($offset === 2){
				$this->offset += 2;
			}
			echo "Type: ".$this->type."\n";
		}

		//$this->links = [];
		//$count = $this->getShort();
		/*for($i = 0; $i < $count; $i++){
			$to = $this->getLong();
			$from = $this->getLong();
			$mode = $this->getByte();
			$this->links[] = [$to, $from, $mode];
		}*/
		//print_r($this);
	}

}
