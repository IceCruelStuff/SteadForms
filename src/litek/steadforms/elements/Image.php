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

/** @package Image */
class Image
{
    /** @var string IMAGE_TYPES */
    const IMAGE_TYPE_PATH = 'path';
    const IMAGE_TYPE_URL = 'url';

    /** @var string */
    private $path;

    /** @var string */
    private $type;

    /**
     * Image constructor.
     * @param string $path
     * @param string $type
     */
    public function __construct(string $path, string $type)
    {
        $this->path = $path;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}