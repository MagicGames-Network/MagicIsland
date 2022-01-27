<?php /** @noinspection ALL */

namespace blueturk\skyblock\forms\island\partner;

use blueturk\skyblock\managers\IslandManager;
use blueturk\skyblock\SkyBlock;
use dktapps\pmforms\MenuForm;
use dktapps\pmforms\MenuOption;
use pocketmine\Player;

class PartnerTeleportForm extends MenuForm
{

    public function __construct(Player $player)
    {
        $options = [];
        if (SkyBlock::getInstance()->getConfig()->getNested($player->getName()) != null) {
            if (SkyBlock::getInstance()->getConfig()->getNested($player->getName() . ".island") === null) {
                if (SkyBlock::getInstance()->getConfig()->getNested($player->getName() . ".partners") != null) {
                    foreach (SkyBlock::getInstance()->getConfig()->getNested($player->getName() . ".partners") as $item => $value) {
                        $options[] = new MenuOption($value);
                    }
                }
            } else {
                if (SkyBlock::getInstance()->getConfig()->getNested($player->getName() . ".island" . ".other-partners") != null) {
                    foreach (SkyBlock::getInstance()->getConfig()->getNested($player->getName() . ".island" . ".other-partners") as $item => $value) {
                        $options[] = new MenuOption($value);
                    }
                }
            }
        }
        parent::__construct(SkyBlock::BT_TITLE . "Partner Adasına Işınlan", "§7Işınlanmak istediğin partnerini seç!",
            $options, function (Player $player, int $option): void {
                $selectedPlayer = $this->getOption($option)->getText();
                IslandManager::teleportPartnerIsland($player, $selectedPlayer);
            }
        );
    }
}