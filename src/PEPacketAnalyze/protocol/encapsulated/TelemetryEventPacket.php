<?php

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;

class TelemetryEventPacket extends Packet{

	public function getName(){
		return "TelemetryEvent Packet";
	}

	public function decode(){
		$this->unknown1 = $this->getLong();
		$this->unknown2 = $this->getInt();
		$this->unknown3 = $this->getLong();
		switch($this->unknown2){
			case 4:
				$this->unknown4 = $this->getLong();
				$this->unknown5 = $this->getInt();
			break;
		}
		//print_r($this);
	}

}
