<?php

namespace PEPacketAnalyze\protocol\raknet;

use PEPacketAnalyze\protocol\Packet;

class UnknownPacket extends Packet{

	public function getName(){
		return "Unknown";
	}

	public function decode(){
	}

}
