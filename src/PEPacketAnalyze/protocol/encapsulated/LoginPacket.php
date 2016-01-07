<?php

namespace PEPacketAnalyze\protocol\encapsulated;

use PEPacketAnalyze\protocol\Packet;
use PEPacketAnalyze\utils\Binary;

class LoginPacket extends Packet{

	public function getName(){
		return "Login Packet";
	}

	public function decode(){
		$this->username = $this->getString();
		$this->protocol1 = $this->getInt();
		$this->protocol2 = $this->getInt();

		$this->clientId = $this->getLong();
		$this->clientUUID = $this->getUUID();
		$this->serverAddress = $this->getString();
		$this->clientSecret = $this->getString();

		$extrasize1 = strlen($this->buffer) - ($this->offset + 64 * 32 * 4 + 2);
		$extrasize2 = strlen($this->buffer) - ($this->offset + 64 * 64 * 4 + 2);

		if($extrasize1 > $extrasize2){
			$extrasize1 = $extrasize2;
		}

		if($extrasize1 === 2){
			$this->old = true;
			$this->slim = $this->getByte() > 0;
			$this->transparent = $this->getByte() > 0;
		}else{
			$this->old = false;
			$this->skinname = $this->getString();
			if(strpos($this->skinname, "Slim") !== false or strpos($this->skinname, "Alex") !== false){
				$this->slim = true;
			}else{
				$this->slim = false;
			}
			if($this->skinname === "PvPWarriors_TundraStray"){//TODO:
				$this->transparent = true;
			}else{
				$this->transparent = false;
			}
		}
		$this->skin = $this->getString();
	}

}
