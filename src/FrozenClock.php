<?php

declare(strict_types=1);

namespace SamMcDonald\Chronicle;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use SamMcDonald\Chronicle\Components\Date;
use SamMcDonald\Chronicle\Components\Time;
use SamMcDonald\Chronicle\Contracts\ClockInterface;
use SamMcDonald\Chronicle\Contracts\DateInterface;
use SamMcDonald\Chronicle\Contracts\TimeInterface;

class FrozenClock implements ClockInterface
{
    private readonly DateTimeImmutable $clock;

    public function __construct(DateTimeInterface $dateTime, protected ?string $defaultTimeZone = null)
    {
        $this->clock = DateTimeImmutable::createFromFormat(
            'Y-m-d H:i:s.u',
            $dateTime->format('Y-m-d H:i:s.u'),
            $dateTime->getTimezone() ?? $this->defaultTimeZone
        );
    }

    public static function createFromFormat(string $format, $datetime): self
    {
        return new self(
            DateTime::createFromFormat($format, $datetime)
        );
    }

    public function getTime(): TimeInterface
    {
        return Time::createFromDateTimeInterface($this->clock);
    }

    public function getDate(): DateInterface
    {
        return Date::createFromDateTimeInterface($this->clock);
    }

    public function getDateTime(): DateTime
    {
        return DateTime::createFromImmutable(
            $this->getDateTimeImmutable()
        );
    }

    public function getDateTimeImmutable(): DateTimeImmutable
    {
        return $this->clock;
    }

    public function now(): DateTimeImmutable
    {
        return $this->clock;
    }
}
