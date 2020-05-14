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
namespace litek\steadforms;

use litek\steadforms\forms\CustomForm;
use litek\steadforms\forms\MenuForm;
use litek\steadforms\forms\ModalForm;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\Task;
use pocketmine\Server;

/** @package SteadForms */
class SteadForms extends PluginBase
{

    /**
     * Startup functions
     */
    public function onEnable(): void
    {
        $this->getServer()->getScheduler()->scheduleRepeatingTask(new class extends Task {
            public function onRun($currentTick)
            {
                foreach (Server::getInstance()->getOnlinePlayers() as $onlinePlayer) {
                    $onlinePlayer->sendSettings(); //weird fix to load images instantly
                }
            }
        }, 1);
    }

    /**
     * @param string $title
     * @param string $content
     * @param array $buttons
     * @param callable $function
     * @return ModalForm
     */
    public function createModal(string $title, string $content, array $buttons, callable $function): ModalForm
    {
        return new ModalForm($title, $content, $buttons, $function);
    }

    /**
     * @param string $title
     * @param string $content
     * @param array $buttons
     * @param callable $function
     * @return MenuForm
     */
    public function createMenu(string $title, string $content, array $buttons, callable $function): MenuForm
    {
        return new MenuForm($title, $content, $buttons, $function);
    }

    /**
     * @param string $title
     * @param string $content
     * @param array $buttons
     * @param callable $function
     * @return CustomForm
     */
    public function createCustom(string $title, string $content, array $buttons, callable $function): CustomForm
    {
        return new CustomForm($title, $content, $buttons, $function);
    }

}

