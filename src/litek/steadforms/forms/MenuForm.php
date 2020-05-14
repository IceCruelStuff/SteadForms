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


use JsonException;
use litek\steadforms\elements\Button;

/** @package MenuForm */
class MenuForm extends BaseForm
{

    /** @var string */
    private $title;

    /** @var string */
    private $content;

    /** @var Button[] */
    private $buttons;

    /** @var callable */
    private $callable;

    /** @var string */
    private $json = '';

    /**
     * MenuForm constructor.
     * @param string $title
     * @param string $content
     * @param array $buttons
     * @param callable $function
     */
    public function __construct(string $title, string $content, array $buttons, callable $function)
    {
        parent::__construct($title, $content, $buttons, $function);
        $this->title = $title;
        $this->content = $content;
        $this->buttons = $buttons;
        $this->callable = $function;
        foreach ($buttons as $index => $button) {
            /** @var Button $button */
            $button->setIndex($index);
        }
    }

    /**
     * @return string
     */
    public function toJSON(): string
    {
        $data = [
            'type' => Form::MENU_FORM,
            'title' => $this->title,
            'content' => $this->content,
            'buttons' => []
        ];
        foreach ($this->buttons as $button) {
            $data['buttons'][] = [
                'text' => $button->getText(),
                'image' =>
                    [
                        'type' => $button->getImage()->getType(),
                        'data' => $button->getImage()->getPath()
                    ]
            ];
        }
        try {
            return json_encode($data, JSON_THROW_ON_ERROR, 512);
        } catch (JsonException $e) {
            $e->getMessage();
        }
        return $this->json;
    }

    /**
     * @param $response
     * @param $player
     */
    public function handle($response, $player)
    {
        /** @var Button $selectedButton */
        $selectedButton = $this->buttons[$response];
        $function = $this->callable;
        if ($function !== null) {
            $function($player, $selectedButton);
        }
    }

    /**
     * @param $data
     * @return array
     */
    public function getResult(&$data): array
    {
        return (is_array($data)) ? $data : [$data];
    }
}