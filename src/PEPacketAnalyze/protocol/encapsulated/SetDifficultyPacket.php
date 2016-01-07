<?php

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;

class SetDifficultyPacket extends Packet{

	public function getName(){
		return "SetDifficulty Packet";
	}

	public function decode(){
		$this->difficulty = $this->getInt();
		//print_r($this);
	}

}
