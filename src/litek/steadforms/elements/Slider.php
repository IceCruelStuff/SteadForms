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

/** @package Slider */
class Slider extends Element
{
    /** @var string */
    public const TYPE = 'slider';

    /** @var float */
    private $min;

    /**@var float */
    private $max;

    /** @var float */
    private $step;

    /** @var float|null */
    private $default;

    /**
     * Slider constructor.
     * @param string $text
     * @param float $min
     * @param float $max
     * @param float $step
     * @param float|null $default
     */
    public function __construct(string $text, float $min, float $max, float $step = 1.0, ?float $default = null)
    {
        parent::__construct($text);
        $this->text = $text;
        $this->min = $min;
        $this->max = $max;
        $this->step = $step;
        $this->default = $default;
    }

    /**
     * @return array|void
     */
    public function getDataToJson() {
        $data = [
            "type" => self::TYPE,
            "text" => $this->text,
            "min" => $this->min,
            "max" => $this->max
        ];
        if ($this->step > 0) {
            $data["step"] = $this->step;
        }
        if ($this->default != $this->min) {
            $data["default"] = $this->default;
        }
        return $data;
    }

}