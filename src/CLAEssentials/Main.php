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

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

use CLAEssentials\commands\CommandManager;

class Main extends PluginBase{

	private $api;
	
	private static $instance;

	private $txt =
	"
	    ____ _        _    _____                    _   _       _     
	  / ___| |      / \  | ____|___ ___  ___ _ __ | |_(_) __ _| |___ 
	 | |   | |     / _ \ |  _| / __/ __|/ _ \ '_ \| __| |/ _` | / __|
	 | |___| |___ / ___ \| |___\__ \__ \  __/ | | | |_| | (_| | \__ \
	  \____|_____/_/   \_\_____|___/___/\___|_| |_|\__|_|\__,_|_|___/
	";


	public function onEnable() : void{
		self::$instance = $this;
		$this->registerManager();
		$this->getLogger()->info(TextFormat::GREEN . $this->txt . "\n\n                           has been enabled!");
	}

	public static function get() : self{
		return self::$instance;
	}

	public function getAPI() : API{
		return $this->api;
	}

	public function registerManager() : void{
		$this->api = new API();
		new CommandManager();
	}
}