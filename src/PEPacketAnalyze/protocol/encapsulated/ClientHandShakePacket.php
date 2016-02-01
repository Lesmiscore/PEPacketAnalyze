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

class ClientHandShakePacket extends Packet{

	public function getName(){
		return "Client HandShake Packet";
	}

	public function decode(){
		$this->getAddress($this->address, $this->port);
		$this->unknown = $this->getShort();
		for($i = 0; $i < 14; $i++){
			$this->getAddress($addr, $port, $version);
			$this->addresses[] = [$addr, $port, $version];
		}
		$this->sendPing = $this->getLong();
		$this->sendPong = $this->getLong();
		//print_r($this);
	}

}
