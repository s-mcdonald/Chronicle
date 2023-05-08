<?php

declare(strict_types=1);

namespace SamMcDonald\Chronicle\Components;

use DateTimeInterface;
use Exception;
use SamMcDonald\Chronicle\Contracts\DateInterface;
use SamMcDonald\Chronicle\Contracts\DateStringFormatsInterface;
use SamMcDonald\Chronicle\Contracts\MySqlDateTimeInterface;
use SamMcDonald\Chronicle\Traits\OnlyFormatDateTrait;
use Stringable;

/**
 * The Date class is not determined by a time or a timezone.
 * It is immutable making it a reliable source of truth.
 */
class Date implements DateInterface, DateStringFormatsInterface, MySqlDateTimeInterface, Stringable
{
    use OnlyFormatDateTrait;

    public const DAYS_IN_WEEK = 7;

    public const ONE_DAY = 1;

    private readonly int $weekOfYear;

    private const ZERO_TIMESTAMP = '00:00:00';

    public function __construct(
        private readonly int $day,
        private readonly int $month,
        private readonly int $year
    ) {
        $this->weekOfYear = (int) $this->toDateTimeImmutable()->format("W");
    }

    public static function createFromTimestamp(string $timestamp): DateInterface
    {
        return self::createFromDateTimeInterface(
            \DateTimeImmutable::createFromFormat(
                'Y-m-d',
                date('Y-m-d', strtotime($timestamp))
            )
        );
    }

    public static function createFromDateTimeInterface(DateTimeInterface $dateTime): DateInterface
    {
        return new static(
            (int) ($dateTime->format('d')),
            (int) ($dateTime->format('m')),
            (int) $dateTime->format('Y'),
        );
    }

    public function copy(): Date
    {
        return new static(
            $this->getDay(),
            $this->getMonth(),
            $this->getYear()
        );
    }

    public static function today(): Date
    {
        return self::createFromDateTimeInterface(
            new \DateTimeImmutable('now')
        );
    }

    public static function createNow(): Date
    {
        return self::today();
    }

    /**
     * @throws Exception
     */
    private static function assertPositiveNumber(int $years, string $message = 'Only positive number allowed'): void
    {
        if ($years < 1) {
            throw new Exception($message);
        }
    }

    public function getDay(): int
    {
        return $this->day;
    }

    public function getMonth(): int
    {
        return $this->month;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getWeekOfYear(): int
    {
        return $this->weekOfYear;
    }

    public function getUnixTimestamp(): false|int
    {
        return strtotime(
            $this->year . '/' . $this->month . '/' . $this->day . ' ' . self::ZERO_TIMESTAMP
        );
    }

    public function isLeapYear(): bool
    {
        return (bool) (int) $this->format("L");
    }

    public function equals(Date $other): bool
    {
        return $this->day === $other->day
            && $this->weekOfYear === $other->weekOfYear
            && $this->month === $other->month
            && $this->year === $other->year;
    }

    public function getTimestamp(): int
    {
        return $this->toDateTimeImmutable()->getTimestamp();
    }

    public function greaterThan(Date|DateTimeInterface $other): bool
    {
        $a =  $this->getTimestamp();
        $other =  $other->getTimestamp();

        if ($a > $other) {
            return true;
        }

        return false;
    }

    private function format(string $format): string
    {
        return $this->toDateTimeImmutable()->format($format);
    }

    /**
     * @description This method will always return 0's for the time component.
     *                  as the object only represents a date.
     *                  Output will be in this format: 'Y-m-d 00:00:00'
     */
    public function toMySqlDateTimeString(): string
    {
        return $this->format('Y-m-d' . ' ' . self::ZERO_TIMESTAMP);
    }

    public function toDateTimeImmutable(): \DateTimeImmutable
    {
        return (new \DateTimeImmutable())
            ->setDate(
                $this->year,
                $this->month,
                $this->day)
            ->setTimestamp($this->getUnixTimestamp())
            ->setTime(0, 0, 0)
            ;
    }

    public function __toString(): string
    {
        return $this->toDateTimeImmutable()->format("d-m-Y");
    }

    /**
     * @throws Exception
     */
    public function lastWeek(): Date
    {
        return $this->subDays(
            self::DAYS_IN_WEEK
        );
    }

    /**
     * @throws Exception
     */
    public function nextWeek(): Date
    {
        return $this->addDays(
            self::DAYS_IN_WEEK
        );
    }

    /**
     * @throws Exception
     */
    public static function dateNextWeek(): Date
    {
        return Date::createNow()->nextWeek();
    }

    /**
     * @throws Exception
     */
    public static function dateLastWeek(): Date
    {
        return Date::createNow()->lastWeek();
    }

    /**
     * @throws Exception
     */
    public function tomorrow(): Date
    {
        return $this->addDays(
            self::ONE_DAY
        );
    }

    /**
     * @throws Exception
     */
    public static function dateTomorrow(): Date
    {
        return Date::createNow()->tomorrow();
    }

    /**
     * @throws Exception
     */
    public function yesterday(): Date
    {
        return $this->subDays(
            self::ONE_DAY
        );
    }

    public static function dateYesterday(): Date
    {
        return Date::createNow()->yesterday();
    }

    public static function validateDateString(string $date): bool
    {
        return (bool) strtotime($date);
    }

    public function lastFortnight(): Date
    {
        return Date::createFromDateTimeInterface(
            $this->toDateTimeImmutable()->modify(
                '-14 days'
            )
        );
    }

    public static function dateLastFortnight(): Date
    {
        return Date::createNow()->lastFortnight();
    }

    public function nextFortnight(): Date
    {
        return Date::createFromDateTimeInterface(
            $this->toDateTimeImmutable()->modify(
                '+14 days'
            )
        );
    }

    public static function dateNextFortnight(): Date
    {
        return Date::createNow()->nextFortnight();
    }

    /**
     * @throws Exception
     */
    public function addDays(int $days): Date
    {
        self::assertPositiveNumber($days, "Days can only be a positive integer.");

        return Date::createFromDateTimeInterface(
            $this->toDateTimeImmutable()->modify(
                '+' . $days . ' days'
            )
        );
    }

    /**
     * @throws Exception
     */
    public function subDays(int $days): Date
    {
        self::assertPositiveNumber($days, "Days can only be a positive integer.");

        return Date::createFromDateTimeInterface(
            $this->toDateTimeImmutable()->modify(
                '-' . $days . ' days'
            )
        );
    }

    /**
     * @throws Exception
     */
    public function addMonths(int $months): Date
    {
        self::assertPositiveNumber($months, "Months can only be a positive integer.");

        return Date::createFromDateTimeInterface(
            $this->toDateTimeImmutable()->modify(
                '+' . $months . ' months'
            )
        );
    }

    /**
     * @throws Exception
     */
    public function subMoths(int $months): Date
    {
        self::assertPositiveNumber($months, "Months can only be a positive integer.");

        return Date::createFromDateTimeInterface(
            $this->toDateTimeImmutable()->modify(
                '-' . $months . ' months'
            )
        );
    }

    /**
     * @throws Exception
     */
    public function addYears(int $years): Date
    {
        self::assertPositiveNumber($years, "Years can only be a positive integer.");

        return Date::createFromDateTimeInterface(
            $this->toDateTimeImmutable()->modify(
                '+' . $years . ' years'
            )
        );
    }

    /**
     * @throws Exception
     */
    public function subYears(int $years): Date
    {
        self::assertPositiveNumber($years, "Years can only be a positive integer.");

        return Date::createFromDateTimeInterface(
            $this->toDateTimeImmutable()->modify(
                '-' . $years . ' years'
            )
        );
    }

    public function shiftToFirstDayOfMonth(): Date
    {
        return new Date(
            1,
            $this->getMonth(),
            $this->getYear()
        );
    }

    public function shiftToLastDayOfMonth(): Date
    {
        return Date::createFromDateTimeInterface(
            $this->toDateTimeImmutable()->modify("last day of this month")
        );
    }

    public function ago(DateTimeInterface|Date $date, string $message = "ago"): string
    {
        $datetime1 = $this->toDateTimeImmutable();

        if ($date instanceof Date) {
            $datetime2 = $date->toDateTimeImmutable();
        } else {
            $datetime2 = $date;
        }

        $interval = $datetime1->diff($datetime2);
        $elapsed = $interval->format('%a');

        return $interval->format(
            sprintf(
                '%s day%s %s',
                $elapsed,
                ($elapsed > 1) ? 's': '',
                $message
            )
        );
    }

//    public function sameDayLastMonth(int $strategy = 1): Date
//    {
//        if ($strategy > 1) {
//            return $this->subMoths(1);
//        }
//
//        if ($strategy > 2) {
//            if ($this->getDay() > $this->previousMonthLastDay()) {
//                return $this->setDay($this->previousMonthLastDay())->subMonths(1);
//            }
//        }
//
//        if ($strategy > 3) {
//            if ($this->getDay() <= $this->previousMonthLastDay()) {
//                return $this->subMonths(1);
//            }
//        }
//    }
}
