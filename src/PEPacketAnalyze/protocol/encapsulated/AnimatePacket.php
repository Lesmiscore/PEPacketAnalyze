<?php

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;

class AnimatePacket extends Packet{

	public function getName(){
		return "Animate Packet";
	}

	public function decode(){
		$this->action = $this->getByte();
		$this->eid = $this->getLong();
		if(!$this->feof()){
			$this->target = $this->getInt();//?
		}
		//print_r($this);
	}

}
