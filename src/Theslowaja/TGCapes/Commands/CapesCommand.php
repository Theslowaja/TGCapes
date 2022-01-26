<?php

namespace Theslowaja\TGCapes\Commands;

use pocketmine\command\{CommandSender, Command};

use pocketmine\command\PluginIdentifiableCommand;

use pocketmine\Server;
use pocketmine\player\Player;

use pocketmine\plugin\Plugin;

use Theslowaja\TGCapes\Main;

use pocketmine\utils\TextFormat;

/**

 * Class CapesCommand

 * @package Theslowaja\TGCapes\Commands

 */

class CapesCommand extends Command implements PluginIdentifiableCommand {

    /**

     * CapesCommand constructor.

     * @param Main $plugin

     */

    public function __construct(Main $plugin) {

        $this->plugin = $plugin;

        parent::__construct("cape", "Capes commands", \null, ["cape"]);

    }

    /**

     * @param CommandSender $sender

     * @param string $commandLabel

     * @param array $args

     * @return bool|mixed|void

     */

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if(!$sender->hasPermission("cape.cmd")){

            $sender->sendMessage($this->plugin->config->get("no-permissions"));

            return false;

        }

        if(!$sender instanceof Player){

            $sender->sendMessage($this->plugin->config->get("ingame"));


             return false;
        }

        $this->plugin->openCapesUI($sender);

        return true;

    }

    public function getPlugin(): Main

    {

        return $this->plugin;

    }

}
