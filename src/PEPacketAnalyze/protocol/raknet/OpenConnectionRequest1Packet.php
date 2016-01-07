<?php

namespace PEPacketAnalyze\protocol\raknet;

use PEPacketAnalyze\protocol\Packet;

class OpenConnectionRequest1Packet extends Packet{

	public function getName(){
		return "Open Connection Request 1";
	}

	public function decode(){
		$this->magic = $this->getMagic();
		$this->raknetversion = $this->getByte();
		//MTU Data ....
		//print_r($this);
	}

}
