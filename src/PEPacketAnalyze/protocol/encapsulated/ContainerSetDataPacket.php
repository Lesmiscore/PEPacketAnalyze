<?php

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;

class ContainerSetDataPacket extends Packet{

	public function getName(){
		return "ContainerSetData Packet";
	}

	public function decode(){
		$this->windowid = $this->getByte();
		$this->property = $this->getShort();
		$this->value = $this->getShort();
		//print_r($this);
	}

}
