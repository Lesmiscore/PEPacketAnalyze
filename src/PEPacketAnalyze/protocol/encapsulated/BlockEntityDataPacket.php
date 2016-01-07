<?php

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;

use PEPacketAnalyze\utils\Binary;

class BlockEntityDataPacket extends Packet{

	public function getName(){
		return "BlockEntityData Packet";
	}

	public function decode(){
		$this->x = $this->getInt();
		$this->y = $this->getInt();
		$this->z = $this->getInt();
		$this->namedtag = $this->get(true);
		$this->offset = strlen($this->buffer);//Buffer解析完了のため
		//print_r($this);
	}

}
