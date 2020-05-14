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


class CustomForm extends BaseForm
{
    /** @var string */
    private $title;

    /** @var string */
    private $content;

    /** @var array */
    private $buttons;

    /** @var callable */
    private $callable;

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
        $data = [
            'type' => Form::CUSTOM_FORM,
            'title' => $this->title,
            'content' => []
        ];
        foreach ($this->buttons as $element) {
            $data['content'][] = $element->getDataToJson();
        }
        return $json = json_encode($data);
    }

    /**
     * @param $player
     * @param $response
     */
    public function handle($player, $response)
    {
        $function = $this->callable;
        if ($function !== null) {
            $function($response, $player);
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