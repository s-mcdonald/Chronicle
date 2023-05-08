<?php

declare(strict_types=1);

namespace Tests\SamMcDonald\Chronicle\Components;

use PHPUnit\Framework\TestCase;
use SamMcDonald\Chronicle\Components\Date;
use SamMcDonald\Chronicle\Enums\DateSeperator;

/**
 * @covers \SamMcDonald\Chronicle\Components\Date
 * @covers \SamMcDonald\Chronicle\Traits\OnlyFormatDateTrait
 */
class DateTest extends TestCase
{
    public function testGetWeekOfYear(): void
    {
        $sut = new Date(1,2,2023);
        $this->assertEquals(
            5,
            $sut->getWeekOfYear()
        );
    }

    public function testToMySqlDateTimeString()
    {
        // 1st Jan 2020 - no time on a Date object so
        // should always be 00:00:00.

        $sut = new Date(1,1,2020);
        $this->assertEquals(
            '2020-01-01 00:00:00',
            $sut->toMySqlDateTimeString()
        );
    }

    public function testGetDayOfWeek()
    {
        $sut = new Date(1,2,2023);
        $this->assertEquals(
            'Wednesday',
            $sut->getDayOfWeek()
        );
    }

    public function testGetDayOfWeekInt()
    {
        $sut = new Date(1,2,2023);
        $this->assertEquals(
            '3',
            $sut->getDayOfWeekInt()
        );
    }

    /**
     * @dataProvider provideDataForTestOnlyFormatDateYmdTrait
     */
    public function testOnlyFormatDateYmdTrait(DateSeperator $separator, string $expected): void
    {
        $day = 1;
        $month = 2;
        $year = 2023;

        $sut = new Date($day, $month, $year);
        $this->assertEquals(
            $expected,
            $sut->asYmd($separator)
        );
    }

    public static function provideDataForTestOnlyFormatDateYmdTrait(): array
    {
        return [
            'Y-m-d format' => [
                DateSeperator::Dash,
                '2023-02-01'
            ],
            'Y/m/d format' => [
                DateSeperator::ForwardSlash,
                '2023/02/01'
            ],
            'Ymd format' => [
                DateSeperator::None,
                '20230201'
            ]
        ];
    }

    public function testToShortDateString()
    {
        $day = 1;
        $month = 2;
        $year = 2023;

        $sut = new Date($day, $month, $year);
        $this->assertEquals(
            '2023-02-01',
            $sut->toShortDateString()
        );
    }

    /**
     * @dataProvider provideDataForTestGetMonth
     */
    public function testGetMonth(int $month): void
    {
        $sut = new Date(17, $month,2023);
        $this->assertEquals(
            $month,
            $sut->getMonth()
        );
    }

    public static function provideDataForTestGetMonth(): array
    {
        return [
            [1],
            [2],
            [3],
            [4],
            [5],
            [6],
            [7],
            [8],
            [9],
            [10],
            [11],
            [12]
        ];
    }

    public function testToLongDateString()
    {
        $day = 1;
        $month = 2;
        $year = 2023;

        $sut = new Date($day, $month, $year);
        $this->assertEquals(
            'Wednesday 1st of February 2023',
            $sut->toLongDateString()
        );
    }

    public function testGetUnixTimestamp()
    {
        $day = 1;
        $month = 2;
        $year = 2023;

        $sut = new Date($day, $month, $year);
        $this->assertEquals(
            '1675209600',
            $sut->getUnixTimestamp()
        );
    }

    /**
     * @dataProvider provideDataForTestToAbbreviatedMonthDayString
     */
    public function testToAbbreviatedMonthDayString(bool $hyphenated, string $expected)
    {
        $day = 5;
        $month = 7;
        $year = 2023;

        $sut = new Date($day, $month, $year);
        $this->assertEquals(
            $expected,
            $sut->toAbbreviatedMonthDayString($hyphenated)
        );
    }

    public function provideDataForTestToAbbreviatedMonthDayString(): array
    {
        return [
            'hyphenated' => [
                true,
                'Jul-5',
            ],
            'not hyphenated' => [
                false,
                'Jul 5',
            ]
        ];
    }

    public function testGetYear()
    {
        $day = 1;
        $month = 2;
        $year = 2023;

        $sut = new Date($day, $month, $year);
        $this->assertEquals(
            2023,
            $sut->getYear()
        );
    }

    public function testToUSShortDateString()
    {
        $day = 1;
        $month = 2;
        $year = 2023;

        $sut = new Date($day, $month, $year);
        $this->assertEquals(
            '02-01-2023',
            $sut->toUSShortDateString()
        );
    }

    public function testGetDay()
    {
        $day = 1;
        $month = 2;
        $year = 2023;

        $sut = new Date($day, $month, $year);
        $this->assertEquals(
            1,
            $sut->getDay()
        );
    }

    /**
     * @dataProvider provideDataForTestGetMonthOfYear
     */
    public function testGetMonthOfYear(int $month, string $monthString)
    {
        $day = 1;
        $month = $month;
        $year = 2023;

        $sut = new Date($day, $month, $year);
        $this->assertEquals(
            $monthString,
            $sut->getMonthOfYear()
        );
    }

    public static function provideDataForTestGetMonthOfYear(): array
    {
        return [
            [1, 'January'],
            [2, 'February'],
            [3, 'March'],
            [4, 'April'],
            [5, 'May'],
            [6, 'June'],
            [7, 'July'],
            [8, 'August'],
            [9, 'September'],
            [10, "October"],
            [11, "November"],
            [12, "December"],
        ];
    }

    public function testToAbbreviatedDayMonthYearString()
    {
        $day = 5;
        $month = 7;
        $year = 2023;

        $sut = new Date($day, $month, $year);
        $this->assertEquals(
            'Wed, Jul 05, 2023',
            $sut->toAbbreviatedDayMonthYearString()
        );
    }

    public function testCreateFromDateTimeInterface()
    {
        $day = 1;
        $month = 1;
        $year = 2021;

        $date = new Date($day, $month, $year);
        $dateTimeImmutable = new \DateTimeImmutable('2021-01-01');

        $this->assertEquals(
            $date,
            Date::createFromDateTimeInterface($dateTimeImmutable)
        );
    }

    public function testEquals()
    {
        $day = 1;
        $month = 2;
        $year = 2023;

        $sut1 = new Date($day, $month, $year);
        $sut2 = new Date($day + 1, $month, $year);
        $sut3 = new Date($day, $month, $year);
        $this->assertTrue(
            $sut1->equals($sut3)
        );
        $this->assertFalse(
            $sut1->equals($sut2)
        );
    }

    public function test__toString()
    {
        $day = 1;
        $month = 2;
        $year = 2023;

        $sut = new Date($day, $month, $year);

        $this->assertEquals(
            '01-02-2023',
            (string)$sut
        );
    }

    public function testToDateTimeImmutable()
    {
        $day = 1;
        $month = 2;
        $year = 2023;

        $sut = new Date($day, $month, $year);

        $this->assertNotEquals(
            $sut,
            $sut->toDateTimeImmutable()
        );
    }

    /**
     * @dataProvider provideDataForTestNextWeek
     */
    public function testNextWeek(int $day, int $month, int $expectedDay, int $expectedMonth): void
    {
        $year = 2023;

        $sut = new Date($day, $month, $year);
        $nextWeek = new Date($expectedDay, $expectedMonth, $year);

        $this->assertEquals(
            $nextWeek,
            $sut->nextWeek()
        );
    }

    public static function provideDataForTestNextWeek(): array
    {
        return [
            'first example' => [
                'day' => 7,
                'month' => 2,
                'expectedDay' => 14,
                'expectedMonth' => 2
            ],
            'end of february' => [
                'day' => 27,
                'month' => 2,
                'expectedDay' => 6,
                'expectedMonth' => 3
            ]
        ];
    }

    /**
     * @dataProvider provideDataForTestLastWeek
     */
    public function testLastWeek(int $day, int $month, int $expectedDay, int $expectedMonth): void
    {
        $year = 2023;

        $sut = new Date($day, $month, $year);
        $nextWeek = new Date($expectedDay, $expectedMonth, $year);

        $this->assertEquals(
            $nextWeek,
            $sut->lastWeek()
        );
    }

    public static function provideDataForTestLastWeek(): array
    {
        return [
            'first example' => [
                'day' => 8,
                'month' => 2,
                'expectedDay' => 1,
                'expectedMonth' => 2
            ],
            'end of february' => [
                'day' => 6,
                'month' => 3,
                'expectedDay' => 27,
                'expectedMonth' => 2
            ]
        ];
    }

    /**
     * @throws \Exception
     */
    public function testShiftToLastDayOfMonth(): void
    {
        $day = 6;
        $month = 2;
        $year = 2023;

        $sut = new Date($day, $month, $year);

        $this->assertEquals(
            '2025-02-28',
            $sut->addYears(2)
                ->shiftToFirstDayOfMonth()
                ->shiftToLastDayOfMonth()
                ->toShortDateString()
        );
    }


    public function testAgo(): void
    {
        $month = 2;
        $year = 2023;

        $sut1 = new Date(1, $month, $year);
        $sut2 = new Date(25, $month, $year);

        $this->assertEquals(
            "24 days ago",
            $sut2->ago($sut1)
        );
    }

    public function testIsLeapYear(): void
    {
        $day = 1;
        $month = 2;
        $year = 2023;

        $sut = new Date($day, $month, $year);

        $this->assertFalse(
            $sut->isLeapYear()
        );
        $this->assertTrue(
            $sut->addYears(1)->isLeapYear()
        );
    }

    public function testGreaterThan(): void
    {
        $day = 1;
        $month = 2;
        $year = 2023;

        $sut1 = new Date($day, $month, $year);
        $sut2 = new Date($day + 2, $month, $year);

        $this->assertFalse(
            $sut1->greaterThan($sut2)
        );
    }

    public function testGreaterThan2(): void
    {
        $day = 1;
        $month = 2;
        $year = 2023;

        $sut1 = new Date($day, $month, $year);
        $sut2 = new Date($day + 12, $month, ($year - 1));

        $this->assertTrue(
            $sut1->greaterThan($sut2)
        );
    }
}
