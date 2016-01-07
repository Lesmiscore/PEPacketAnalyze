<?php

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;

class PingPacket extends Packet{

	public function getName(){
		return "Ping Packet";
	}

	public function decode(){
		$this->pingID = $this->getLong();
		//print_r($this);
	}

}
