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
namespace litek\steadforms\elements;

/** @package Input */
class Input extends Element
{
    /** @var string */
    public const TYPE = 'input';

    /** @var string */
    private $placeholder;

    /** @var string */
    private $default;

    /**
     * Input constructor.
     * @param string $text
     * @param string $placeholder
     * @param string $default
     */
    public function __construct(string $text, string $placeholder, string $default = "")
    {
        parent::__construct($text);
        $this->text = $text;
        $this->placeholder = $placeholder;
        $this->default = $default;
    }

    /**
     * @return array|void
     */
    public function getDataToJson() {
        return [
            "type" => self::TYPE,
            "text" => $this->text,
            "placeholder" => $this->placeholder,
            "default" => $this->default
        ];
    }

}