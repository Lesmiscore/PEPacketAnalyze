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

class BatchPacket extends Packet{

	public function getName(){
		return "Batch Packet";
	}

	public function decode(){
		parent::decode();
		$this->buffers = [];
		$size = $this->getInt();
		$this->payload = $this->get($size);
		$str = zlib_decode($this->payload, 1024 * 1024 * 64); //Max 64MB
		$len = strlen($str);
		$offset = 0;
		while($offset < $len){
			$pkLen = Binary::readInt(substr($str, $offset, 4));
			$offset += 4;

			$buf = substr($str, $offset, $pkLen);
			$offset += $pkLen;

			$this->buffers[] = $buf;
		}
		//print_r($this);
	}

}
