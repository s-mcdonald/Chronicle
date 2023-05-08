<?php

declare(strict_types=1);

namespace SamMcDonald\Chronicle\Contracts;

use DateTimeInterface;

interface TimeInterface
{
    public static function createFromDateTimeInterface(DateTimeInterface $dateTime): TimeInterface;

    public function getHour(): int;

    public function getMinute(): int;

    public function getSeconds(): int;

    public function getMicroseconds(): int;

    public function toDateTimeImmutable(): \DateTimeImmutable;

    public function getUnixTimestamp(): false|int;
}
