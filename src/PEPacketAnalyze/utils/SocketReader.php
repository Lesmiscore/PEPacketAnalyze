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

namespace PEPacketAnalyze\utils;

use PEPacketAnalyze\protocol\PacketAnalyze;

class SocketReader{
	private $working = true;

	public function __construct($logger, $host, $port, $serverip, $serverport){
		$this->logger = $logger;
		$this->host = $host;
		$this->port = $port;
		$this->serverip = gethostbyname($serverip);
		$this->serverport = $serverport;
		$this->sendsocket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
		if(@socket_bind($this->sendsocket, $host, $port) === true){
			$this->logger->debug("socket open (".$host.":".$port.")");
			$this->logger->info("クライアントから受信したものはすべて ".$serverip." : ".$serverport." に送信されます。");
		}else{
			$this->working = false;
			echo "Error\n";
		}
		socket_set_nonblock($this->sendsocket);
		$this->receivesocket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
		if(@socket_bind($this->receivesocket, $host, $port + 1) === true){
			$this->logger->debug("socket open (".$host.":".$port.")");
		}else{
			$this->working = false;
			echo "Error\n";
		}
		socket_set_nonblock($this->receivesocket);
		$this->packetanalyze = new PacketAnalyze($this->logger);
		$this->receiveips = [];
	}

	public function setAddress($ipaddress){
		unset($this->receiveips[$this->receiveip]);
		return $this->receiveip = $ipaddress;
	}

	public function tick(){
		if(!$this->working){
			return;
		}
		$this->sendsocket();
		$this->receivesocket();
	}

	public function receivesocket(){
		$bytes = $this->receivesocket_receive($buffer, $source, $port);
		if($bytes !== false){
			if(!isset($this->receiveip)){
				return;
			}
			$this->packetanalyze->ReceivePacket("Server", $buffer);
			$this->sendsocket_send($buffer);
		}
	}

	public function sendsocket(){
		$bytes = $this->sendsocket_receive($buffer, $source, $port);
		if($bytes !== false){
			if(!isset($this->receiveip) and $this->serverip !== $source){
				echo $source.":".$port." からデータが送られてきました。\n";
				echo "デフォルト受信アドレスに指定しました。\n";
				$this->receiveip = $source;
				$this->receiveport = $port;
			}
			if(isset($this->receiveip) and $this->receiveip !== $source and $this->serverip !== $source){
				if(!isset($this->receiveips[$source])){
					echo $source.":".$port." からデータが送られてきました。\n";
					echo "デフォルト受信アドレスにするには address ".$source." と打ち込んでください。\n";
					$this->receiveips[$source] = true;
				}
			}
			if($this->serverip !== $source){
				$this->packetanalyze->ReceivePacket("Client", $buffer);
				$this->receivesocket_send($buffer);
			}
		}
	}

	public function receivesocket_receive(&$buffer, &$source, &$port){
		return socket_recvfrom($this->receivesocket, $buffer, 65535, 0, $source, $port);
	}

	public function sendsocket_receive(&$buffer, &$source, &$port){
		return socket_recvfrom($this->sendsocket, $buffer, 65535, 0, $source, $port);
	}

	public function receivesocket_send($buffer){
		return socket_sendto($this->receivesocket, $buffer, strlen($buffer), 0, $this->serverip, $this->serverport);
	}

	public function sendsocket_send($buffer){
		return socket_sendto($this->sendsocket, $buffer, strlen($buffer), 0, $this->receiveip, $this->receiveport);
	}

	public function shutdown(){
		$this->working = false;
		socket_close($this->receivesocket);
		socket_close($this->sendsocket);
	}

}
