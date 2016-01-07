<?php

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;

class UpdateBlockPacket extends Packet{

	public function getName(){
		return "UpdateBlock Packet";
	}

	public function decode(){
		$this->records = [];
		$count = $this->getInt();
		for($i = 0; $i < $count; $i++){
			$x = $this->getInt();
			$z = $this->getInt();
			$y = $this->getByte();
			$blockid = $this->getByte();
			$blockdata = $this->getByte();
			$this->records[] = [$x, $z, $y, $blockid, $blockdata];
		}
		//print_r($this);
	}

}
