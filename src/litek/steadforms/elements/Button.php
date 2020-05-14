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

use Exception;
use pocketmine\customUI\elements\simpleForm\Button as SteadButton;
use pocketmine\Player;

/** @package Button */
class Button extends SteadButton
{
    /** @var string  */
    protected $text;

    /** @var array */
    protected $data;

    /** @var Player */
    protected $player;

    /** @var Image|null  */
    protected $image;

    /** @var null  */
    protected $index = null;

    /**
     * Button constructor.
     * @param string $text
     * @param Image|null $image
     */
    public function __construct(string $text, Image $image = null)
    {
        $this->text = $text;
        $this->data['text'] = $text;
        $this->image = $image;
        parent::__construct($text);
        if ($image !== null){
            try {
                parent::addImage($image->getType(), $image->getPath());
                $this->data['image'] = [
                    'type' => $image->getType(),
                    'data' => $image->getPath()
                ];
            } catch (Exception $e) {
                $e->getMessage();
            }
        }
    }

    /**
     * @param $data
     * @param Player $player
     */
    public function handle($data, $player)
    {
        $this->data = $data;
        $this->player = $player;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getType(): string {
        return 'Button';
    }

    /**
     * @param int $index
     */
    public function setIndex(int $index): void {
        $this->index = $index;
    }

    /**
     * @return int|null
     */
    public function getIndex(): ?int
    {
        return $this->index !== null ? $this->index : 0;
    }

    /**
     * @return bool
     */
    public function hasImage() : bool{
        return $this->image !== null;
    }

    /**
     * @return Image|null
     */
    public function getImage(): ?Image
    {
        return $this->image;
    }

}