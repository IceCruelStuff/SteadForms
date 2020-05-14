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
namespace litek\steadforms\forms;


use pocketmine\customUI\CustomUI;
use pocketmine\Player;

/** @package Form */
class Form implements CustomUI
{
    /** @var callable $function */
    private $function;

    /** @var string FORM_TYPES */
    public const MODAL_FORM = 'modal';
    public const MENU_FORM = 'form';
    public const CUSTOM_FORM = 'custom_form';

    /**
     * Form constructor.
     * @param callable $function
     */
    public function __construct(callable $function)
    {
        $this->function = $function;
    }

    /**
     * @return string
     */
    public function toJSON(): string {}

    /**
     * @param Player $player
     */
    public function close($player){}

    /**
     * @param $response
     * @param $player
     */
    public function handle($response, $player)
    {
        $function = $this->function;
        if ($function !== null) {
            $function($player, $response);
        }
    }

    /**
     * @param $data
     * @return array
     */
    public function getResult(&$data): array {
        return (is_array($data)) ? $data : [$data];
    }
}