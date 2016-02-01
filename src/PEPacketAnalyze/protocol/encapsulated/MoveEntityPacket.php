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

class MoveEntityPacket extends Packet{

	public function getName(){
		return "MoveEntity Packet";
	}

	public function decode(){
		$this->entities = [];
		$count = $this->getInt();
		for($i = 0; $i < $count; $i++){
			$eid = $this->getLong();
			$x = $this->getFloat();
			$y = $this->getFloat();
			$z = $this->getFloat();
			$yaw = $this->getFloat();
			$bodyyaw = $this->getFloat();
			$pitch = $this->getFloat();
			$this->entities[] = [$eid, $x, $y, $z, $yaw, $bodyyaw, $pitch];
		}
		//print_r($this);
	}

}
