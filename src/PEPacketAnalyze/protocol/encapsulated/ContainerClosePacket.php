<?php

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;

class ContainerClosePacket extends Packet{

	public function getName(){
		return "ContainerClose Packet";
	}

	public function decode(){
		$this->windowid = $this->getByte();
		//print_r($this);
	}

}
