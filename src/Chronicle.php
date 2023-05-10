<?php

declare(strict_types=1);

namespace SamMcDonald\Chronicle;

use DateTimeInterface;
use SamMcDonald\Chronicle\Components\Date;
use SamMcDonald\Chronicle\Enums\DateShiftRule;

class Chronicle
{
    private const YEARS_IN_LEAP = 4;

    public static function createDate(
        int $day,
        int $month,
        int $year
    ): Date {
        return Date::create($day, $month, $year);
    }

    public static function dateNow(): Date
    {
        return Date::createNow();
    }

    /**
     * @throws \Exception
     */
    public static function dateLastWeek(): Date
    {
        return Date::dateLastWeek();
    }

    /**
     * @throws \Exception
     */
    public static function dateNextWeek(): Date
    {
        return Date::dateNextWeek();
    }

    /**
     * @throws \Exception
     */
    public static function dateTomorrow(): Date
    {
        return Date::dateTomorrow();
    }

    public static function dateYesterday(): Date
    {
        return Date::dateYesterday();
    }

    public static function dateLastFortnight(): Date
    {
        return Date::dateLastFortnight();
    }

    public static function dateNextFortnight(): Date
    {
        return Date::dateNextFortnight();
    }

    public static function weekOfYear(): int
    {
        return self::dateNow()->getWeekOfYear();
    }

    public static function getWeekOfYear(mixed $date): int
    {
        if (is_string($date) && Date::validateDateString($date)) {
            return (Date::createFromTimestamp(
                $date
            ))->getWeekOfYear();
        }

        switch(true) {
            case $date instanceof Date:
                return $date->getWeekOfYear();
            case $date instanceof \DateTimeInterface:
                return (int) $date->format("W");
        }

        throw new \InvalidArgumentException("Date is in incompatible type.");
    }

    public static function agoText(
        Date|DateTimeInterface $date1,
        Date|DateTimeInterface $date2,
    ): string
    {
        if ($date1 instanceof DateTimeInterface) {
            $d1 = Date::createFromDateTimeInterface($date1);
            return $d1->ago($date2);
        }

        return $date1->ago($date2);
    }

    public static function dayOfWeek(): string
    {
        return Date::today()->getDayOfWeek();
    }

    public static function monthOfYear(): string
    {
        return Date::today()->getMonthOfYear();
    }

    public static function isLeapYear(int $year): bool
    {
        return $year % self::YEARS_IN_LEAP == 0;
    }

    /**
     * @throws \Exception
     */
    public static function sameDayLastMonth(DateShiftRule $rule = DateShiftRule::PhpCore): Date
    {
        return Date::today()->getSameDayLastMonth($rule);
    }
}
