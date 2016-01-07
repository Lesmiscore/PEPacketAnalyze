<?php

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;
use PEPacketAnalyze\utils\Binary;

class DisconnectPacket extends Packet{

	public function getName(){
		return "Disconnect Packet";
	}

	public function decode(){
		$this->message = $this->getString();
		//print_r($this);
	}

}
