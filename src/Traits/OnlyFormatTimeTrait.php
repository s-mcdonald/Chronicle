<?php

declare(strict_types=1);

namespace SamMcDonald\Chronicle\Traits;

trait OnlyFormatTimeTrait
{
    public function toShortTimeString(): string
    {
        return $this->format('H:i A');
    }

    public function toLongTimeString(): string
    {
        return $this->format('H:i:s A');
    }

    /**
     * @description This method will always return 0's for the date component as the object only
     *              represents a time. Output will be as formatted: '00-00-00 H:i:s'
     */
    public function toMySqlDateTimeString(): string
    {
        return $this->format('00-00-00 H:i:s');
    }
}
