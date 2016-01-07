<?php

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;

use PEPacketAnalyze\utils\Binary;

class RemoveEntityPacket extends Packet{

	public function getName(){
		return "Remove Entity Packet";
	}

	public function decode(){
		$this->eid = $this->getLong();
	}

}
