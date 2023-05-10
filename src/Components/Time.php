<?php

declare(strict_types=1);

namespace SamMcDonald\Chronicle\Components;

use DateTimeInterface;
use Exception;
use SamMcDonald\Chronicle\Contracts\ClockInterface;
use SamMcDonald\Chronicle\Contracts\TimeInterface;
use SamMcDonald\Chronicle\Traits\OnlyFormatTimeTrait;

class Time implements TimeInterface, \Stringable
{
    use OnlyFormatTimeTrait;

    public function __construct(
        protected readonly int $hour,
        protected readonly int $minute = 0,
        protected readonly int $seconds = 0,
        protected readonly int $microseconds = 0) {
    }

    public static function create(
        int $hour,
        int $minute = 0,
        int $seconds = 0,
        int $microseconds = 0
    ): Time {
        return new Time($hour, $minute, $seconds, $microseconds);
    }

    public static function now(null|ClockInterface|DateTimeInterface $truth = null): TimeInterface
    {
        if ($truth === null) {
            $truth = new \DateTimeImmutable('now');
        }
        if ($truth instanceof ClockInterface) {
            $truth = $truth->now();
        }
        return new self(
            (int) $truth->format('H'),
            (int) $truth->format('i'),
            (int) $truth->format('s'),
            (int) $truth->format('u'),
        );
    }

    public static function createFromDateTimeInterface(DateTimeInterface $dateTime): TimeInterface
    {
        return new self(
            (int) $dateTime->format('H'),
            (int) $dateTime->format('i'),
            (int) $dateTime->format('s'),
            (int) $dateTime->format('u'),
        );
    }

    public function getHour(): int
    {
        return $this->hour;
    }

    public function getMinute(): int
    {
        return $this->minute;
    }

    public function getSeconds(): int
    {
        return $this->seconds;
    }

    public function getMicroseconds(): int
    {
        return $this->microseconds;
    }

    //
    public function addHours(int $hours): Time
    {
        return new Time(
            ($this->hour + $hours),
            $this->minute,
            $this->seconds,
            $this->microseconds
        );
    }

    public function addMinutes(int $minutes): Time
    {
        return new Time(
            $this->hour,
            $this->minute + $minutes,
            $this->seconds,
            $this->microseconds
        );
    }

    public function addSeconds(int $seconds): Time
    {
        return new Time(
            $this->hour,
            $this->minute,
            $this->seconds + $seconds,
            $this->microseconds
        );
    }

    public function addMicroseconds(int $microseconds): Time
    {
        return new Time(
            $this->hour,
            $this->minute,
            $this->seconds,
            $this->microseconds + $microseconds
        );
    }

    public function __toString(): string
    {
        return $this->format('H:i:s.u');
    }

    public function toDateTimeImmutable(): \DateTimeImmutable
    {
        return (new \DateTimeImmutable())
            ->setDate(0, 0, 0)
            ->setTimestamp($this->createUnixTimestamp())
            ->setTime($this->hour, $this->minute, $this->seconds, $this->microseconds)
            ;
    }

    private function createUnixTimestamp(): int
    {
        $h = sprintf("%02d", $this->getHour());
        $m = sprintf("%02d", $this->getMinute());
        $s = sprintf("%02d", $this->getSeconds());
        return (int) strtotime("0/0/0000 {$h}:{$m}:{$s}");
    }

    public function getUnixTimestamp(): int
    {
        return $this->toDateTimeImmutable()->getTimestamp();
    }

    public function getTimestamp(): int
    {
        return $this->createUnixTimestamp();
    }

    /**
     * @throws Exception
     */
    public function equals($other): bool
    {
        if ($other instanceof self) {
            return $this->getHour() === $other->getHour()
                && $this->getMinute() === $other->getMinute()
                && $this->getSeconds() === $other->getSeconds()
                && $this->getMicroseconds() === $other->getMicroseconds();
        }

        throw new Exception();
    }

    /**
     * Do not allow public access to this method.
     */
    private function format(string $format): string
    {
        return $this->toDateTimeImmutable()->format($format);
    }
}
