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

namespace PEPacketAnalyze\protocol;

class ProtocolInfo{

	/*
		Rak net Packet
	*/

	const CONNECTED_PING = 0x00;
	const UNCONNECTED_PING = 0x01;
	const CONNECTED_PONG = 0x03;

	const OPEN_CONNECTION_REQUEST_1 = 0x05;
	const OPEN_CONNECTION_REPLY_1 = 0x06;
	const OPEN_CONNECTION_REQUEST_2 = 0x07;
	const OPEN_CONNECTION_REPLY_2 = 0x08;

	const UNCONNECTED_PONG = 0x1c;

	const NACK = 0xa0;
	const ACK = 0xc0;

	/*
		MCPE DataPacket
	*/

	const CURRENT_PROTOCOL = -1;

}
