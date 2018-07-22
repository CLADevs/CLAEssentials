<?php

/*
 * CLAEssentials, a public Essentials plugin for PocketMine-MP
 * Copyright (C) 2017-2018 CLADevs
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY;  without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

declare(strict_types=1);

namespace CLAEssentials;

use pocketmine\Server;
use pocketmine\entity\Entity;
use pocketmine\utils\TextFormat;

class API{

	public $vanish = [];

	private static $api;

	public function __construct(){
		self::$api = $this;
	}

	public static function getAPI() : self{
		return self::$api;
	}	

	public static function getMain() : Main{
		return Main::get();
	}

	public static function getServer() : Server{
		return self::getMain()->getServer();
	}

	public function isVanished($player){
		if(!in_array($sender->getName(), $this->getAPI()->vanish)) return;
	}

	public function setVanish($player, bool $bool){
		if($bool == true){
			$this->vanish[] = $player->getName();
			$player->setDataFlag(Entity::DATA_FLAGS, Entity::DATA_FLAG_INVISIBLE, true);
			$player->setNameTagVisible(false);
			$player->sendMessage(TextFormat::YELLOW . $player->getName() . " has vanished!");
		}

		if($bool == false){
			unset($this->vanish[array_search($player->getName(), $this->vanish)]);
			$player->setDataFlag(Entity::DATA_FLAGS, Entity::DATA_FLAG_INVISIBLE, false);
			$player->setNameTagVisible(true);
			$player->sendMessage(TextFormat::YELLOW . $player->getName() . " has unvanished!");
		}
	}
}