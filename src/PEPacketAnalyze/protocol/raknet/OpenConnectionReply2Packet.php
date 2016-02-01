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

namespace PEPacketAnalyze\protocol\raknet;

use PEPacketAnalyze\protocol\Packet;

class OpenConnectionReply2Packet extends Packet{

	public function getName(){
		return "Open Connection Reply 2";
	}

	public function decode(){
		$this->magic = $this->getMagic();
		$this->serverID = $this->getLong();
		$this->ClientPort = $this->getShort();
		$this->MTUSize = $this->getShort();
		$this->Security = $this->getByte();
		//print_r($this);
	}

}
