<?php

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;

class SetEntityMotionPacket extends Packet{

	public function getName(){
		return "SetEntityMotion Packet";
	}

	public function decode(){
		$this->entities = [];
		$count = $this->getInt();
		for($i = 0; $i < $count; $i++){
			$eid = $this->getLong();
			$motionX = $this->getFloat();
			$motionY = $this->getFloat();
			$motionZ = $this->getFloat();
			$this->entities[] = [$eid, $motionX, $motionY, $motionZ];
		}
		//print_r($this);
	}

}
