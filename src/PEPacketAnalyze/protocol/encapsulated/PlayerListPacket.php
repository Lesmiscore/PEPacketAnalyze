<?php

/*
 *▪   ▄▄▄·       ▄▄· ▄ •▄ ▄▄▄ .▄▄▄▄▄
 *██ ▐█ ▄█▪     ▐█ ▌▪█▌▄▌▪▀▄.▀·•██
 *▐█· ██▀· ▄█▀▄ ██ ▄▄▐▀▀▄·▐▀▀▪▄ ▐█.▪
 *▐█▌▐█▪·•▐█▌.▐▌▐███▌▐█.█▌▐█▄▄▌ ▐█▌·
 *▀▀▀.▀    ▀█▄▀▪·▀▀▀ ·▀  ▀ ▀▀▀  ▀▀▀
 *
 *This program is free software:
 *and PocketEdision Packet Analyze.
 *
*/

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;

class PlayerListPacket extends Packet{

	public function getName(){
		return "PlayerList Packet";
	}

	public function decode(){
		$this->type = $this->getByte();
		$count = $this->getInt();
		for($i = 0; $i < $count; $i++){
			if($this->type === 0){
				$clientUUID = $this->getUUID();
				$eid = $this->getLong();
				$username = $this->getString();
				$skinname = $this->getString();
				$skin = $this->getString();
				$this->entries[] = [$clientUUID, $eid, $username, $skinname, $skin];
				/*$isslim = $this->getByte();
				$transparent = $this->getByte();
				$this->entries[] = [$clientUUID, $eid, $username, $isslim, $transparent, $skin];*/
			}else{
				$this->entries[] = $this->getUUID();
			}
		}
		//print_r($this);
	}

}
