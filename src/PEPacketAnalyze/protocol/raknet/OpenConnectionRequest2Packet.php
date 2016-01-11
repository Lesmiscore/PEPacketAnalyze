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

namespace PEPacketAnalyze\protocol\raknet;

use PEPacketAnalyze\protocol\Packet;

class OpenConnectionRequest2Packet extends Packet{

	public function getName(){
		return "Open Connection Request 2";
	}

	public function decode(){
		$this->magic = $this->getMagic();
		$this->ServerSecurity = bin2hex($this->get(4));
		$this->ServerPort = $this->getShort();
		$this->MTUSize = $this->getShort();
		$this->clientID = $this->getLong();
		//print_r($this);
	}

}
