<?php

use SamMcDonald\Chronicle\Chronicle;
use SamMcDonald\Chronicle\Components\Date;
use SamMcDonald\Chronicle\Enums\DateSeperator;
use SamMcDonald\Chronicle\Enums\DateShiftRule;
use SamMcDonald\Chronicle\Enums\MonthOfYear;

include '../vendor/autoload.php';



echo "\n\n\nDate\n-------------\n";
echo "The following methods return Date objects.\n\n";

// Most methods return a new instance of Date
echo 'today() is Date          : ', (Date::today() instanceof Date), PHP_EOL;
echo 'lastFortnight() is Date  : ', (Date::dateLastFortnight() instanceof Date), PHP_EOL;
echo 'copy() is Date           : ', (Date::dateLastFortnight()->copy() instanceof Date), PHP_EOL;
echo PHP_EOL;
echo 'today\'s date             : ', Date::today(), PHP_EOL;
echo 'today\'s date             : ', Date::createNow(), PHP_EOL;
echo 'today\'s day              : ', Date::today()->getDay(), PHP_EOL;
echo PHP_EOL;
echo 'current  month           : ', Date::today()->getMonth(), PHP_EOL;
echo 'current year             : ', Date::today()->getYear(), PHP_EOL;
echo 'add 3 days               : ', Date::today()->addDays(3), PHP_EOL;
echo 'sub 9 days               : ', Date::today()->subDays(9), PHP_EOL;
echo PHP_EOL;
echo 'last month               : ', Date::today()->subMoths(1), PHP_EOL;
echo 'chainable                : ', Date::today()->subMoths(1)->addMonths(2), PHP_EOL;
echo 'add 3 years              : ', Date::today()->addYears(3), PHP_EOL;
echo 'sub 9 years              : ', Date::today()->subYears(9), PHP_EOL;
echo 'unix timestamp           : ', Date::today()->getTimestamp(), PHP_EOL;
echo 'unix timestamp           : ', Date::today()->getUnixTimestamp(), PHP_EOL;
echo 'MySql DateTime format    : ', Date::today()->toMySqlDateTimeString(), PHP_EOL;
echo 'Comparison               : ', Date::today()->greaterThan(Chronicle::dateNow()->subMoths(1)), PHP_EOL;
echo 'shift to 1st of month    : ', Date::today()->shiftToFirstDayOfMonth(), PHP_EOL;
echo 'shift to end of month    : ', Date::today()->shiftToLastDayOfMonth(), PHP_EOL;
echo 'tomorrow                 : ', Date::today()->tomorrow(), PHP_EOL;
echo 'yesterday                : ', Date::today()->yesterday(), PHP_EOL;
echo 'last week                : ', Date::today()->lastWeek(), PHP_EOL;
echo 'next week                : ', Date::today()->nextWeek(), PHP_EOL;
echo 'last fortnight           : ', Date::today()->lastFortnight(), PHP_EOL;
echo 'next fortnight           : ', Date::today()->nextFortnight(), PHP_EOL;
echo 'last fortnight           : ', Date::today()->lastFortnight()->getDayOfWeek(), PHP_EOL;
echo 'next fortnight + 1 day   : ', Date::today()->nextFortnight()->tomorrow()->getDayOfWeek(), PHP_EOL;
echo 'next fortnight + 1 day   : ', Date::today()->nextFortnight()->addDays(1)->getDayOfWeek(), PHP_EOL;
echo 'Week # of the Year       : ', Date::today()->getWeekOfYear(), PHP_EOL;
echo 'Is a leap Year           : ', Date::today()->setYear(2024)->isLeapYear(), PHP_EOL;
echo PHP_EOL;
// if future date is passed in, then the text is ` 17 days to go..`
echo '... ago text             : ', Date::today()->isLeapYear(), PHP_EOL;
echo PHP_EOL;
$feb29 = Date::today()->setYear(2023)->setMonth(MonthOfYear::March)->setDay(29);
echo 'Feb 29                   : ', $feb29, PHP_EOL;
echo 'sameDayLastMonth         : ', $feb29->getSameDayLastMonth(DateShiftRule::PhpCore), PHP_EOL;
echo 'sameDayLastMonth         : ', $feb29->getSameDayLastMonth(DateShiftRule::Business), PHP_EOL;
echo 'sameDayLastMonth         : ', $feb29->getSameDayLastMonth(DateShiftRule::Strict), PHP_EOL;
echo PHP_EOL;
$july31 = Date::today()->setYear(2023)->setMonth(MonthOfYear::July)->setDay(31);
echo 'July31                   : ', $july31, PHP_EOL;
echo 'sameDayLastMonth         : ', $july31->getSameDayLastMonth(DateShiftRule::PhpCore), PHP_EOL;
echo 'sameDayLastMonth         : ', $july31->getSameDayLastMonth(DateShiftRule::Business), PHP_EOL;
echo 'sameDayLastMonth         : ', $july31->getSameDayLastMonth(DateShiftRule::Strict), PHP_EOL;
echo PHP_EOL;
echo PHP_EOL;

echo 'Date formatting          ', PHP_EOL;
echo 'todayYmd DASH            : ', Date::today()->asYmd(DateSeperator::Dash), PHP_EOL;
echo 'todayYmd ForwardSlash    : ', Date::today()->asYmd(DateSeperator::ForwardSlash), PHP_EOL;
echo 'toShortDateString        : ', Date::today()->toShortDateString(), PHP_EOL;
echo 'toUSShortDateString      : ', Date::today()->toUSShortDateString(), PHP_EOL;
echo 'toLongDateString         : ', Date::today()->toLongDateString(), PHP_EOL;
echo 'getDayOfWeek             : ', Date::today()->getDayOfWeek(), PHP_EOL;
echo 'getMonthOfYear           : ', Date::today()->getMonthOfYear(), PHP_EOL;
echo 'getDayOfWeekInt          : ', Date::today()->getDayOfWeekInt(), PHP_EOL;
echo 'toAbbreviatedDayMonthYearString  : ', Date::today()->toAbbreviatedDayMonthYearString(), PHP_EOL;
echo 'toAbbreviatedMonthDayString      : ', Date::today()->toAbbreviatedMonthDayString(), PHP_EOL;

echo "\n\n\n";
//echo 'sameDayLastMonth        :', Chronicle::, PHP_EOL;

// echo Chronicle::dateNow()->lessThan(Chronicle::dateNow()->subMoths(1)), PHP_EOL;

