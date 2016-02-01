<?php

/*
 *▪   ▄▄▄·       ▄▄· ▄ •▄ ▄▄▄ .▄▄▄▄▄
 *██ ▐█ ▄█▪     ▐█ ▌▪█▌▄▌▪▀▄.▀·•██
 *▐█· ██▀· ▄█▀▄ ██ ▄▄▐▀▀▄·▐▀▀▪▄ ▐█.▪
 *▐█▌▐█▪·•▐█▌.▐▌▐███▌▐█.█▌▐█▄▄▌ ▐█▌·
 *▀▀▀.▀    ▀█▄▀▪·▀▀▀ ·▀  ▀ ▀▀▀  ▀▀▀
 *
 *This program is free software:
 *and PocketEdition Packet Analyze.
 *
*/

namespace PEPacketAnalyze\protocol\raknet;

use PEPacketAnalyze\protocol\Packet;

class ACK extends Packet{

	public function getName(){
		return "ACK";
	}

	public function decode(){//TODO
		$count = $this->getShort();
		$this->packets = [];
		$cnt = 0;
		for($i = 0; $i < $count and !$this->feof() and $cnt < 4096; ++$i){
			if($this->getByte() === 0){
				$start = $this->getLTriad();
				$end = $this->getLTriad();
				if(($end - $start) > 512){
					$end = $start + 512;
				}
				for($c = $start; $c <= $end; ++$c){
					$this->packets[$cnt++] = $c;
				}
			}else{
				$this->packets[$cnt++] = $this->getLTriad();
			}
		}
		//print_r($this);
	}

}
