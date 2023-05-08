<?php

declare(strict_types=1);

namespace SamMcDonald\Chronicle;

use DateTimeImmutable;
use DateTimeInterface;
use SamMcDonald\Chronicle\Components\Date;
use SamMcDonald\Chronicle\Contracts\DateInterface;

class Chronicle extends DateTimeImmutable
{
    private function __construct()
    {
        parent::__construct();
    }

//    public static function createDate(string $strDate): DateInterface
//    {
//        return Date::createFromString();
//    }

    public static function dateNow(): DateInterface
    {
        return Date::createNow();
    }

    /**
     * @throws \Exception
     */
    public static function dateLastWeek(): DateInterface
    {
        return Date::dateLastWeek();
    }

    /**
     * @throws \Exception
     */
    public static function dateNextWeek(): DateInterface
    {
        return Date::dateNextWeek();
    }

    /**
     * @throws \Exception
     */
    public static function dateTomorrow(): DateInterface
    {
        return Date::dateTomorrow();
    }

    public static function dateYesterday(): DateInterface
    {
        return Date::dateYesterday();
    }

    public static function dateLastFortnight(): DateInterface
    {
        return Date::dateLastFortnight();
    }

    public static function dateNextFortnight(): DateInterface
    {
        return Date::dateNextFortnight();
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
}
