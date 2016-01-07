<?php

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;

class TextPacket extends Packet{

	public function getName(){
		return "Text Packet";
	}

	public function decode(){
		$this->type = $this->getByte();
		switch($this->type){
			case 3:
			case 1:
				$this->source = $this->getString();
			case 0:
			case 4:
			case 5:
				$this->message = $this->getString();
			break;
			case 2:
				$this->message = $this->getString();
				$count = $this->getByte();
				for($i = 0; $i < $count; ++$i){
						$this->parameters[] = $this->getString();
				}
			break;
		}
		//print_r($this);
	}

}
