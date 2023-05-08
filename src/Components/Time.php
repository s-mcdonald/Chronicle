<?php

declare(strict_types=1);

namespace SamMcDonald\Chronicle\Components;

use DateTimeInterface;
use Exception;
use SamMcDonald\Chronicle\Contracts\TimeInterface;
use SamMcDonald\Chronicle\Contracts\TimeStringFormatsInterface;

class Time implements TimeInterface, TimeStringFormatsInterface, \Stringable
{
    public function __construct(
        protected readonly int $hour,
        protected readonly int $minute = 0,
        protected readonly int $seconds = 0,
        protected readonly int $microseconds = 0) {
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

    public function __toString(): string
    {
        return $this->format('H:i:s.u');
    }

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

    public function toDateTimeImmutable(): \DateTimeImmutable
    {
        return (new \DateTimeImmutable())
            ->setDate(0, 0, 0)
            ->setTimestamp($this->getUnixTimestamp())
            ->setTime($this->hour, $this->minute, $this->seconds, $this->microseconds)
            ;
    }

    public function getUnixTimestamp(): false|int
    {
        $h = sprintf("%02d", $this->getHour());
        $m = sprintf("%02d", $this->getMinute());
        $s = sprintf("%02d", $this->getSeconds());
        return strtotime("0/0/000 {$h}:{$m}:{$s}");
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
