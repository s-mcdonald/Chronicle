<?php

declare(strict_types=1);

namespace SamMcDonald\Chronicle\Contracts;

interface MySqlDateTimeInterface
{
    public function toMySqlDateTimeString(): string;
}
