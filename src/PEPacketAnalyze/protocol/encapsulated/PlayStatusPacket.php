<?php

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;
use PEPacketAnalyze\utils\Binary;

class PlayStatusPacket extends Packet{

	public function getName(){
		return "PlayStatus Packet";
	}

	public function decode(){
		$this->status = $this->getInt();
		//print_r($this);
	}

}
