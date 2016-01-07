<?php

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;

use PEPacketAnalyze\utils\Binary;

class ExplodePacket extends Packet{

	public function getName(){
		return "Explode Packet";
	}

	public function decode(){
		$this->x = $this->getFloat();
		$this->y = $this->getFloat();
		$this->z = $this->getFloat();
		$this->radius = $this->getFloat();
		$count = $this->getInt();
		$this->record = [];
		for($i = 0; $i < $count; $i++){
			$x = $this->getByte();
			$y = $this->getByte();
			$z = $this->getByte();
			$this->record[] = [$x, $y, $z];
		}
		//print_r($this);
	}

}
