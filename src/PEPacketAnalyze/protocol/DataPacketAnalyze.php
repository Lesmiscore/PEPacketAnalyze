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

use PEPacketAnalyze\protocol\encapsulated\PingPacket;
use PEPacketAnalyze\protocol\encapsulated\PongPacket;
use PEPacketAnalyze\protocol\encapsulated\ClientConnectionPacket;
use PEPacketAnalyze\protocol\encapsulated\DisconnectionConnectionPacket;
use PEPacketAnalyze\protocol\encapsulated\ClientHandShakePacket;
use PEPacketAnalyze\protocol\encapsulated\ServerHandShakePacket;

use PEPacketAnalyze\protocol\encapsulated\LoginPacket;
use PEPacketAnalyze\protocol\encapsulated\TextPacket;
use PEPacketAnalyze\protocol\encapsulated\AnimatePacket;
use PEPacketAnalyze\protocol\encapsulated\PlayerListPacket;
use PEPacketAnalyze\protocol\encapsulated\BatchPacket;
use PEPacketAnalyze\protocol\encapsulated\StartGamePacket;
use PEPacketAnalyze\protocol\encapsulated\SetTimePacket;
use PEPacketAnalyze\protocol\encapsulated\SetHealthPacket;
use PEPacketAnalyze\protocol\encapsulated\SetDifficultyPacket;
use PEPacketAnalyze\protocol\encapsulated\SetSpawnPositionPacket;
use PEPacketAnalyze\protocol\encapsulated\SetPlayerGameTypePacket;
use PEPacketAnalyze\protocol\encapsulated\DisconnectPacket;
use PEPacketAnalyze\protocol\encapsulated\PlayStatusPacket;
use PEPacketAnalyze\protocol\encapsulated\PlayerActionPacket;
use PEPacketAnalyze\protocol\encapsulated\FullChunkDataPacket;
use PEPacketAnalyze\protocol\encapsulated\RespawnPacket;
use PEPacketAnalyze\protocol\encapsulated\AddPlayerPacket;
use PEPacketAnalyze\protocol\encapsulated\AddEntityPacket;
use PEPacketAnalyze\protocol\encapsulated\RemovePlayerPacket;
use PEPacketAnalyze\protocol\encapsulated\RemoveEntityPacket;
use PEPacketAnalyze\protocol\encapsulated\MovePlayerPacket;
use PEPacketAnalyze\protocol\encapsulated\MoveEntityPacket;
use PEPacketAnalyze\protocol\encapsulated\UpdateAttributesPacket;
use PEPacketAnalyze\protocol\encapsulated\BlockEntityDataPacket;
use PEPacketAnalyze\protocol\encapsulated\BlockEventPacket;
use PEPacketAnalyze\protocol\encapsulated\LevelEventPacket;
use PEPacketAnalyze\protocol\encapsulated\EntityEventPacket;
use PEPacketAnalyze\protocol\encapsulated\MobEquipmentPacket;
use PEPacketAnalyze\protocol\encapsulated\MobArmorEquipmentPacket;
use PEPacketAnalyze\protocol\encapsulated\RemoveBlockPacket;
use PEPacketAnalyze\protocol\encapsulated\UpdateBlockPacket;
use PEPacketAnalyze\protocol\encapsulated\SetEntityMotionPacket;
use PEPacketAnalyze\protocol\encapsulated\SetEntityDataPacket;
use PEPacketAnalyze\protocol\encapsulated\SetEntityLinkPacket;
use PEPacketAnalyze\protocol\encapsulated\AdventureSettingsPacket;
use PEPacketAnalyze\protocol\encapsulated\AddItemEntityPacket;
use PEPacketAnalyze\protocol\encapsulated\TakeItemEntityPacket;
use PEPacketAnalyze\protocol\encapsulated\HurtArmorPacket;
use PEPacketAnalyze\protocol\encapsulated\ContainerOpenPacket;
use PEPacketAnalyze\protocol\encapsulated\ContainerClosePacket;
use PEPacketAnalyze\protocol\encapsulated\ContainerSetContentPacket;
use PEPacketAnalyze\protocol\encapsulated\ContainerSetSlotPacket;
use PEPacketAnalyze\protocol\encapsulated\ContainerSetDataPacket;
use PEPacketAnalyze\protocol\encapsulated\CraftingDataPacket;
use PEPacketAnalyze\protocol\encapsulated\CraftingEventPacket;
use PEPacketAnalyze\protocol\encapsulated\UseItemPacket;
use PEPacketAnalyze\protocol\encapsulated\InteractPacket;
use PEPacketAnalyze\protocol\encapsulated\AddPaintingPacket;
use PEPacketAnalyze\protocol\encapsulated\ExplodePacket;
use PEPacketAnalyze\protocol\encapsulated\MobEffectPacket;
use PEPacketAnalyze\protocol\encapsulated\PlayerInputPacket;
use PEPacketAnalyze\protocol\encapsulated\ChangeDimensionPacket;
use PEPacketAnalyze\protocol\encapsulated\SpawnExperienceOrbPacket;
use PEPacketAnalyze\protocol\encapsulated\TelemetryEventPacket;
use PEPacketAnalyze\protocol\encapsulated\DropItemPacket;
use PEPacketAnalyze\protocol\encapsulated\UnknownDataPacket;

class DataPacketAnalyze{

	public function __construct($logger){
		$this->logger = $logger;
	}

	public function ReceiveDataPacket($buffer){
		$id = ord($buffer{0});
		switch($id){
			case 0:
				$packet = new PingPacket($buffer);
			break;
			case 3:
				$packet = new PongPacket($buffer);
			break;
			case 9:
				$packet = new ClientConnectionPacket($buffer);
			break;
			case 16:
				$packet = new ServerHandShakePacket($buffer);
			break;
			case 19:
				$packet = new ClientHandShakePacket($buffer);
			break;
			case 21:
				$packet = new DisconnectionConnectionPacket($buffer);
			break;
			case 143:
				$packet = new LoginPacket($buffer);
			break;
			case 144:
				$packet = new PlayStatusPacket($buffer);
			break;
			case 145:
				$packet = new DisconnectPacket($buffer);
			break;
			case 146:
				$packet = new BatchPacket($buffer);
				$packet->decode();
				foreach($packet->buffers as $buffer){
					$this->ReceiveDataPacket($buffer);
				}
			break;
			case 147:
				$packet = new TextPacket($buffer);
			break;
			case 148:
				$packet = new SetTimePacket($buffer);
			break;
			case 149:
				$packet = new StartGamePacket($buffer);
			break;
			case 150:
				$packet = new AddPlayerPacket($buffer);
			break;
			case 151:
				$packet = new RemovePlayerPacket($buffer);
			break;
			case 152:
				$packet = new AddEntityPacket($buffer);
			break;
			case 153:
				$packet = new RemoveEntityPacket($buffer);
			break;
			case 154:
				$packet = new AddItemEntityPacket($buffer);
			break;
			case 155:
				$packet = new TakeItemEntityPacket($buffer);
			break;
			case 156:
				$packet = new MoveEntityPacket($buffer);
			break;
			case 157:
				$packet = new MovePlayerPacket($buffer);
			break;
			case 158:
				$packet = new RemoveBlockPacket($buffer);
			break;
			case 159:
				$packet = new UpdateBlockPacket($buffer);
			break;
			case 160:
				$packet = new AddPaintingPacket($buffer);
			break;
			case 161:
				$packet = new ExplodePacket($buffer);
			break;
			case 162:
				$packet = new LevelEventPacket($buffer);
			break;
			case 163:
				$packet = new BlockEventPacket($buffer);
			break;
			case 164:
				$packet = new EntityEventPacket($buffer);
			break;
			case 165:
				$packet = new MobEffectPacket($buffer);
			break;
			case 166:
				$packet = new UpdateAttributesPacket($buffer);
			break;
			case 167:
				$packet = new MobEquipmentPacket($buffer);
			break;
			case 168:
				$packet = new MobArmorEquipmentPacket($buffer);
			break;
			case 169:
				$packet = new InteractPacket($buffer);
			break;
			case 170:
				$packet = new UseItemPacket($buffer);
			break;
			case 171:
				$packet = new PlayerActionPacket($buffer);
			break;
			case 172:
				$packet = new HurtArmorPacket($buffer);
			break;
			case 173:
				$packet = new SetEntityDataPacket($buffer);
			break;
			case 174:
				$packet = new SetEntityMotionPacket($buffer);
			break;
			case 175:
				$packet = new SetEntityLinkPacket($buffer);
			break;
			case 176:
				$packet = new SetHealthPacket($buffer);
			break;
			case 177:
				$packet = new SetSpawnPositionPacket($buffer);
			break;
			case 178:
				$packet = new AnimatePacket($buffer);
			break;
			case 179:
				$packet = new RespawnPacket($buffer);
			break;
			case 180:
				$packet = new DropItemPacket($buffer);
			break;
			case 181:
				$packet = new ContainerOpenPacket($buffer);
			break;
			case 182:
				$packet = new ContainerClosePacket($buffer);
			break;
			case 183:
				$packet = new ContainerSetSlotPacket($buffer);
			break;
			case 184:
				$packet = new ContainerSetDataPacket($buffer);
			break;
			case 185:
				$packet = new ContainerSetContentPacket($buffer);
			break;
			case 186:
				$packet = new CraftingDataPacket($buffer);
			break;
			case 187:
				$packet = new CraftingEventPacket($buffer);
			break;
			case 188:
				$packet = new AdventureSettingsPacket($buffer);
			break;
			case 189:
				$packet = new BlockEntityDataPacket($buffer);
			break;
			case 190:
				$packet = new PlayerInputPacket($buffer);
			break;
			case 191:
				$packet = new FullChunkDataPacket($buffer);
			break;
			case 192:
				$packet = new SetDifficultyPacket($buffer);
			break;
			case 193:
				$packet = new ChangeDimensionPacket($buffer);
			break;
			case 194:
				$packet = new SetPlayerGameTypePacket($buffer);
			break;
			case 195:
				$packet = new PlayerListPacket($buffer);
			break;
			case 196:
				$packet = new TelemetryEventPacket($buffer);
			break;
			case 197:
				$packet = new SpawnExperienceOrbPacket($buffer);
			break;
			default:
				$name = "Unknown";
			break;
		}
		if(debug_backtrace()[2]["function"] === "receivesocket" or debug_backtrace()[3]["function"] === "receivesocket"){
			$callname = "Server";
		}else{
			$callname = "Client";
		}
		if(!isset($packet)){
			$packet = new UnknownDataPacket($buffer);
		}
		if(!$packet->decoded){
			$packet->decode();
		}
		$packet->check();
		if($id >= 143 and $id !== 146 and $id !== 156 and $id !== 174 and $id !== 173){
			if(!isset($size)){
				$size = strlen($buffer) - 1;
			}
			if(!isset($name)){//
				$name = $packet->getName();
			}
			$this->logger->debug("DataPacket(".$callname."): ".$id." (0x".bin2hex(chr($id)).") : ".$name." ".$size."");
		}
		unset($packet);
	}

}
