<?php

declare(strict_types=1);

namespace SamMcDonald\Chronicle\Contracts;

interface TimeStringFormatsInterface
{
    public function toShortTimeString(): string;

    public function toLongTimeString(): string;

    public function toMySqlDateTimeString(): string;
}
