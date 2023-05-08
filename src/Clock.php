<?php

declare(strict_types=1);

namespace SamMcDonald\Chronicle;

use DateTime;
use DateTimeImmutable;
use DateTimeZone;
use Exception;
use SamMcDonald\Chronicle\Components\Date;
use SamMcDonald\Chronicle\Components\Time;
use SamMcDonald\Chronicle\Contracts\ClockInterface;
use SamMcDonald\Chronicle\Contracts\TimeInterface;
use SamMcDonald\Chronicle\Contracts\DateInterface;

class Clock implements ClockInterface
{
    public function __construct(protected string $timeZone = 'UTC')
    {
    }

    /**
     * @throws Exception
     */
    public function getTime(): TimeInterface
    {
        return Time::createFromDateTimeInterface($this->now());
    }

    /**
     * @throws Exception
     */
    public function getDate(): DateInterface
    {
        return Date::createFromDateTimeInterface($this->now());
    }

    /**
     * @throws Exception
     */
    public function getDateTime(): DateTime
    {
        return DateTime::createFromImmutable(
            $this->getDateTimeImmutable()
        );
    }

    /**
     * @throws Exception
     */
    public function getDateTimeImmutable(): DateTimeImmutable
    {
        return new DateTimeImmutable('now', new DateTimeZone($this->timeZone));
    }

    /**
     * @throws Exception
     */
    public function now(): DateTimeImmutable
    {
        return $this->getDateTimeImmutable();
    }

    /**
     * @throws Exception
     */
    public function freeze(): FrozenClock
    {
        return new FrozenClock($this->getDateTime());
    }
}
