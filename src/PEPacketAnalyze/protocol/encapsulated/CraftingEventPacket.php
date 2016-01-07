<?php

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;

class CraftingEventPacket extends Packet{

	public function getName(){
		return "CraftingEvent Packet";
	}

	public function decode(){
		$this->windowid = $this->getByte();
		$this->type = $this->getInt();
		$this->id = $this->getUUID();

		$size = $this->getInt();
		$this->input = [];
		for($i = 0; $i < $size and $i < 129; $i++){
			$this->input[] = $this->getSlot();
		}

		$this->output = [];
		for($i = 0; $i < $size and $i < 129; $i++){
			$this->output[] = $this->getSlot();
		}
		//print_r($this);
	}

}
