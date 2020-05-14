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


class BaseForm extends Form
{

    /** @var string */
    private $title;

    /** @var string */
    private $content;

    /** @var array */
    private $buttons;

    /** @var callable */
    private $callable;

    /**
     * BaseForm constructor.
     * @param string $title
     * @param string $content
     * @param array $buttons
     * @param callable $function
     */
    public function __construct(string $title, string $content, array $buttons, callable $function)
    {
        parent::__construct($function);
        $this->title = $title;
        $this->content = $content;
        $this->buttons = $buttons;
        $this->callable = $function;
    }

    /**
     * @param $response
     * @param $player
     */
    public function handle($response, $player)
    {
        $function = $this->callable;
        if ($function !== null) {
            $function($player, $response);
        }
    }

}