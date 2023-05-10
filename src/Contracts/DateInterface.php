<?php

declare(strict_types=1);

namespace SamMcDonald\Chronicle\Contracts;

use DateTimeInterface;

interface DateInterface
{
    public static function createFromDateTimeInterface(DateTimeInterface $dateTime): DateInterface;

    public function getDay(): int;

    public function getMonth(): int;

    public function getYear(): int;

    public function getWeekOfYear(): int;

    public function toDateTimeImmutable(): \DateTimeImmutable;

    public function getUnixTimestamp(): int;
}
