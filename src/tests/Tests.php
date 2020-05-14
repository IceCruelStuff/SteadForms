<?php
/**
 * Copyright 2020-2022 LiTEK
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
declare(strict_types=1);
namespace test;


use litek\steadforms\elements\Button;
use litek\steadforms\elements\Dropdown;
use litek\steadforms\elements\Image;
use litek\steadforms\elements\Input;
use litek\steadforms\elements\Label;
use litek\steadforms\elements\Slider;
use litek\steadforms\elements\StepSlider;
use litek\steadforms\elements\Toggle;
use litek\steadforms\forms\CustomForm;
use litek\steadforms\forms\MenuForm;
use litek\steadforms\forms\ModalForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase
{
    public function onCommand(CommandSender $sender, Command $command, $label, array $args)
    {
        if ($sender instanceof Player && $command->getName() === 'form'){
            switch ($args[0]){
                case 'modal':
                    $sender->showModal(new ModalForm('title', 'a question', [
                        new Button('§aYes!'),
                        new Button('§cNo!')
                    ], function (Player $player, $response){
                        if ($response){
                            $player->sendMessage('§aYou sad yes!');
                        } else {
                            $player->sendMessage('§cYou sad no!');
                        }
                    }));
                    break;
                case 'menu':
                    $sender->showModal(new MenuForm('title', 'a question', [
                        new Button('§aURL IMAGE TEST!', new Image('https://i0.pngocean.com/files/692/561/168/minecraft-mods-kbc-void-download-hypixel-logo.jpg', Image::IMAGE_TYPE_URL)),
                        new Button('§aPATH IMAGE TEST!', new Image('textures/ui/fire_resistance_effect', Image::IMAGE_TYPE_PATH))
                    ], function (Player $player, $response){
                        /** @var Button $response */
                        $player->sendMessage($response->getText());
                        $player->sendMessage($response->getIndex());
                        if ($response->hasImage()){
                            $player->sendMessage('§aThe button has an image!');
                        }
                    }));
                    break;
                case 'custom':
                    $sender->showModal(new CustomForm("Enter data", "Content",
                        [
                            new Dropdown("Select product", ["beer", "cheese", "cola"]),
                            new Input("Enter your name", "Bob"),
                            new Label("I am label!"), //Note: this return null in response
                            new Slider("Select count", 0.0, 100.0, 1.0, 50.0),
                            new StepSlider("Select product", ["beer", "cheese", "cola"], 0),
                            new Toggle("Creative", $sender->isCreative())
                        ],
                        function(Player $player, $response) : void{
                            $player->sendMessage("Dropdown: " . $response[0]);
                            $player->sendMessage("Input: " . $response[1]);
                            $player->sendMessage("Label: " . $response[2]); //null
                            $player->sendMessage("Slider: " . $response[3]);
                            $player->sendMessage("StepSlider: " . $response[4]);
                            $player->sendMessage("Toggle: " . $response[5]);
                        }));
                    break;
            }
        }
    }
}