<?php

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;

use PEPacketAnalyze\utils\Binary;

class RemovePlayerPacket extends Packet{

	public function getName(){
		return "Remove Player Packet";
	}

	public function decode(){
		$this->eid = $this->getLong();
		$this->clientId = $this->getUUID();
	}

}
