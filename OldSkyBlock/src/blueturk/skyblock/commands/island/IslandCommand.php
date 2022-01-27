<?php

namespace blueturk\skyblock\commands\island;

use blueturk\skyblock\forms\island\IslandOptionsForm;
use blueturk\skyblock\forms\island\NoIslandForm;
use blueturk\skyblock\SkyBlock;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class IslandCommand extends Command
{

    public function __construct()
    {
        parent::__construct("ada", "Ada ekranını açar!", "/ada", ["island", "is"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player) {
            $data = SkyBlock::getInstance()->getConfig();
            if ($data->getNested($sender->getName() . "." . "island") !== null) {
                $sender->sendForm(new IslandOptionsForm($sender));
            } else $sender->sendForm(new NoIslandForm());
        }
    }
}