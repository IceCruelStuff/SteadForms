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

/** @package Toggle */
class Toggle extends Element
{
    /** @var string */
    public const TYPE = 'toggle';

    /** @var bool */
    private $default;

    /**
     * Toggle constructor.
     * @param string $text
     * @param bool $default
     */
    public function __construct(string $text, bool $default = false)
    {
        parent::__construct($text);
        $this->text = $text;
        $this->default = $default;
    }

    public function getDataToJson() {
        return [
            "type" => self::TYPE,
            "text" => $this->text,
            "default" => $this->default
        ];
    }
}