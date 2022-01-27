<?php /** @noinspection ALL */

namespace blueturk\skyblock\forms\island\partner;

use blueturk\skyblock\managers\IslandManager;
use blueturk\skyblock\SkyBlock;
use dktapps\pmforms\MenuForm;
use dktapps\pmforms\MenuOption;
use pocketmine\Player;

class PartnerRemoveForm extends MenuForm
{

    public function __construct(Player $player)
    {
        $options = [];
        foreach (SkyBlock::getInstance()->getConfig()->getNested($player->getName() . ".island" . ".this-partners") as $item => $value) {
            $options[] = new MenuOption($value);
        }
        parent::__construct(SkyBlock::BT_TITLE . "Partner Çıkar", "\n",
            $options, function (Player $player, int $option): void {
                $selectedPlayer = $this->getOption($option)->getText();
                IslandManager::partnerRemove($player, $selectedPlayer);
            }
        );
    }
}