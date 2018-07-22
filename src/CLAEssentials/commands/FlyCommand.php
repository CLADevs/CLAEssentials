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

use pocketmine\Player;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

use CLAEssentials\API;

class FlyCommand extends BaseCommand{
    
    public function __construct(API $api){
        parent::__construct("fly", $api);
        $this->setDescription("Turn your flight on/off.");
    }

    /**
     * @param CommandSender $sender
     * @param string        $commandLabel
     * @param array         $args
     * @return bool
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args) : bool{
        if(!$sender->hasPermission("clae.fly")){
            $sender->sendMessage(TextFormat::RED . "You don't have permission to do that.");
            return false;
        }
        if(!isset($args[0])){
            if(!$sender instanceof Player){
                $sender->sendMessage("Usage: /fly <player>");
                return false;
            }

            if($sender->isCreative()) return false;
            $sender->setAllowFlight($sender->getAllowFlight() == false ? true : false);
            $sender->sendMessage($sender->getAllowFlight() == false ? TextFormat::YELLOW . "You have activated your flight." : TextFormat::YELLOW . "You have disabled your flight.");
            return false;
        }

        if(!$this->getServer()->getPlayer($args[0])){
            $sender->sendMessage(TextFormat::RED . $args[0] . TextFormat::YELLOW . " player cannot be found!");
            return false;
        }

        $player = $this->getServer()->getPlayer($args[0]);

        if(isset($args[0])){
            if($player->isCreative()) return false;
            $player->setAllowFlight($player->getAllowFlight() == false ? true : false);
            $player->sendMessage($player->getAllowFlight() == false ? TextFormat::YELLOW . $sender->getName() . " has activated your flight." : TextFormat::YELLOW . $sender->getName() . " has disabled your flight.");
            $sender->sendMessage(TextFormat::GREEN . "Changed " . $player->getName() . "flight!");
            return false;
        }
        return true;
    }
}