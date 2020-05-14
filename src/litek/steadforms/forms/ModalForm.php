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

/** @package ModalForm */
class ModalForm extends BaseForm
{
    /** @var string */
    private $json = '';

    /** @var string */
    private $title;

    /** @var string */
    private $content;

    /** @var Button[] */
    private $buttons;

    /** @var callable */
    private $callable;

    /**
     * ModalForm constructor.
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
    }

    /**
     * @return string
     */
    public function toJSON(): string
    {
        try {
            return $this->json = json_encode([
                'type' => Form::MODAL_FORM,
                'title' => $this->title,
                'content' => $this->content,
                'button1' => $this->buttons[0]->getText(),
                'button2' => $this->buttons[1]->getText(),
            ], JSON_THROW_ON_ERROR, 512);
        } catch (JsonException $e) {
            $e->getMessage();
        }
        return $this->json;
    }

    /**
     * @param $response
     * @param $player
     */
    public function handle($response, $player): void
    {
        $function = $this->callable;
        if ($function !== null) {
            $function($player, $response);
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