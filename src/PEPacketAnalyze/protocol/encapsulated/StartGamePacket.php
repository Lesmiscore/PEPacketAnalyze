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
use PEPacketAnalyze\PEPacketAnalyze;

class StartGamePacket extends Packet{

	public function getName(){
		return "StartGame Packet";
	}

	public function decode(){
		$this->seed = $this->getInt();
		$this->dimension = $this->getByte();
		$this->generator = $this->getInt();
		$this->gamemode = $this->getInt();
		$this->eid = $this->getLong();
		$this->spawnX = $this->getInt();
		$this->spawnY = $this->getInt();
		$this->spawnZ = $this->getInt();
		$this->x = $this->getFloat();
		$this->y = $this->getFloat();
		$this->z = $this->getFloat();
		$this->unknown1 = $this->getByte();
		$this->unknown2 = $this->getInt();// FF FF FF FF
		//print_r($this);
	}

}
