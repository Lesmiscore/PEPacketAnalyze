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

class AddPlayerPacket extends Packet{

	public function getName(){
		return "Add Player Packet";
	}

	public function decode(){
		$this->uuid = $this->getUUID();
		$this->username = $this->getString();
		$this->eid = $this->getLong();
		$this->x = $this->getFloat();
		$this->y = $this->getFloat();
		$this->z = $this->getFloat();
		$this->speedX = $this->getFloat();
		$this->speedY = $this->getFloat();
		$this->speedZ = $this->getFloat();
		$this->yaw = $this->getFloat();
		$this->headyaw = $this->getFloat();
		$this->pitch = $this->getFloat();
		$this->item = $this->getSlot();
		$this->metadata = Binary::readMetadata($this->get(true), true, $offset);
		$this->offset += $offset;//Buffer解析完了のため
		//print_r($this);
	}

}
