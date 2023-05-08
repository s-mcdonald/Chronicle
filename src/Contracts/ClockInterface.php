<?php

declare(strict_types=1);

namespace SamMcDonald\Chronicle\Contracts;

use DateTime;
use DateTimeImmutable;
use Psr\Clock\ClockInterface as PsrClockInterface;

interface ClockInterface extends PsrClockInterface
{
    public function now(): DateTimeImmutable;

    public function getTime(): TimeInterface;

    public function getDate(): DateInterface;

    public function getDateTime(): DateTime;

    public function getDateTimeImmutable(): DateTimeImmutable;
}
