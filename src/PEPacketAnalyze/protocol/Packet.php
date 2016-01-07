<?php

namespace PEPacketAnalyze\protocol;

use PEPacketAnalyze\utils\Binary;

use PEPacketAnalyze\protocol\raknet\UnconnectedPingPacket;
use PEPacketAnalyze\PEPacketAnalyze;

class Packet{
	public $buffer = null;
	public $offset = 0;
	public $decoded = false;

	public function __construct($buffer = null, $offset = 1){
		$this->buffer = $buffer;
		if($buffer === null){
			echo "Bufferがnullです。\n";
		}
		$this->offset = $offset;
		$this->id = ord($buffer{0});
	}

	public function decode(){
		$this->decoded = true;
	}

	public function check(){
		if(!$this->feof() and $this->getName() !== "UnknownData Packet"){
			$offset = strlen($this->buffer) - $this->offset;
			echo $this->getName().": Bufferの解析し残しています。 ".$offset."\n";
			file_put_contents(PEPacketAnalyze::getInterface()->getPath()."/".$this->getName().".dat", $this->buffer);
			file_put_contents(PEPacketAnalyze::getInterface()->getPath()."/".$this->getName()."1.dat", substr($this->buffer, $this->offset));
		}
	}

	public function get($len = true){
		if($len < 0){
			$this->offset = strlen($this->buffer) - 1;
			return "";
		}elseif($len === true){
			return substr($this->buffer, $this->offset);
		}

		return $len === 1 ? $this->buffer{$this->offset++} : substr($this->buffer, ($this->offset += $len) - $len, $len);
	}

	public function getLong(){
		return Binary::readLong($this->get(8));
	}

	public function getInt(){
		return Binary::readInt($this->get(4));
	}

	public function getUUID(){
		return $this->get(16);
	}

	public function getFloat(){
		return Binary::readFloat($this->get(4));
	}

	public function getTriad(){
		return Binary::readTriad($this->get(3));
	}

	public function getLTriad(){
		return Binary::readLTriad($this->get(3));
	}

	public function getMagic(){
		return bin2hex($this->get(16));
	}

	public function getString(){
		return $this->get($this->getShort());
	}

	public function getByte(){
		return ord($this->get(1));
	}

	public function getShort($signed = true){
		return $signed ? Binary::readSignedShort($this->get(2)) : Binary::readShort($this->get(2));
	}

	public function feof(){
		return !isset($this->buffer{$this->offset});
	}

	public function getAddress(&$addr, &$port, &$version = null){
		$version = $this->getByte();
		if($version === 4){
			$addr = ((~$this->getByte()) & 0xff) .".". ((~$this->getByte()) & 0xff) .".". ((~$this->getByte()) & 0xff) .".". ((~$this->getByte()) & 0xff);
			$port = $this->getShort();
		}else{
			//TODO: IPv6
		}
	}

	public function getSlot(){
		$id = $this->getShort(true);

		if($id <= 0){
			return [
				"id" => 0,
				"itemdata" => 0,
				"count" => 0,
				"nbtdata" => null
			];
		}

		$cnt = $this->getByte();

		$data = $this->getShort();

		$nbtLen = $this->getShort();

		$nbt = "";

		if($nbtLen > 0){
			$nbt = $this->get($nbtLen);
		}

		return [
			"id" => $id,
			"itemdata" => $data,
			"count" => $cnt,
			"nbtdata" => $nbt
		];
	}

}
