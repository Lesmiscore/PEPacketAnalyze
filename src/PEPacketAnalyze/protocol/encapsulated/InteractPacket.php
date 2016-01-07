<?php

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;

class InteractPacket extends Packet{

	public function getName(){
		return "Interact Packet";
	}

	public function decode(){
		$this->action = $this->getByte();
		$this->target = $this->getLong();
		//print_r($this);
	}

}
