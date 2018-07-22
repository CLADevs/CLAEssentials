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

namespace CLAEssentials\commands;

use pocketmine\Server;
use pocketmine\plugin\Plugin;
use pocketmine\command\{
    Command, PluginIdentifiableCommand
};

use CLAEssentials\API;

abstract class BaseCommand extends Command implements PluginIdentifiableCommand{

    /** @var API $api */
    private $api;

    public function __construct(string $name, API $api){
        parent::__construct($name);
        $this->api = $api;
        $this->usageMessage = "";
    }

    public function getPlugin() : Plugin{
        return API::getMain();
    }

    public function getAPI() : API{
        return $this->api;
    }

    public function getServer() : Server{
        return API::getServer();
    }
}