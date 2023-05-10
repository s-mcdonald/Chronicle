<?php

use SamMcDonald\Chronicle\Chronicle;
use SamMcDonald\Chronicle\Components\Date;
use SamMcDonald\Chronicle\Enums\DateShiftRule;

include '../vendor/autoload.php';

echo "\n\n\nChronicle: Date\n---------------------\n";

echo "\n\nThe following methods return Date objects.\n\n";
echo 'Date: today\'s                 : ', Chronicle::createDate(1,1,1969), PHP_EOL;
echo 'Date: today\'s                 : ', Chronicle::dateNow(), PHP_EOL;
echo 'Date: last week                : ', Chronicle::dateLastWeek(), PHP_EOL;
echo 'Date: next week                : ', Chronicle::dateNextWeek(), PHP_EOL;
echo 'Date: tomorrow                 : ', Chronicle::dateTomorrow(), PHP_EOL;
echo 'Date: dateYesterday            : ', Chronicle::dateYesterday(), PHP_EOL;
echo 'Date: dateLastFortnight        : ', Chronicle::dateLastFortnight(), PHP_EOL;
echo 'Date: dateNextFortnight        : ', Chronicle::dateNextFortnight(), PHP_EOL;
echo 'Date: sameDayLastMonth         : ', Chronicle::sameDayLastMonth(DateShiftRule::PhpCore), PHP_EOL;
echo 'Date: sameDayLastMonth         : ', Chronicle::sameDayLastMonth(DateShiftRule::Business), PHP_EOL;
echo 'Date: sameDayLastMonth         : ', Chronicle::sameDayLastMonth(DateShiftRule::Strict), PHP_EOL;

echo "\n\nThe following methods return String values.\n\n";
echo 'string: day of the week        : ', Chronicle::dayOfWeek(), PHP_EOL;
echo 'string: day of the week        : ', Chronicle::dateNow()->getDayOfWeek(), PHP_EOL;
echo 'string: month of the year      : ', Chronicle::monthOfYear(), PHP_EOL;
echo 'string: month of the year      : ', Chronicle::dateNow()->getMonthOfYear(), PHP_EOL;
echo 'string: time `ago` text        : ', Chronicle::agoText(Chronicle::dateYesterday(), Chronicle::dateNow()), PHP_EOL;
echo "\n\n";

echo "\n\nThe following methods return integer values.\n\n";
echo 'int: getWeekOfYear             : ', Chronicle::getWeekOfYear("2023-01-23"), PHP_EOL;
echo 'int: getWeekOfYear             : ', Chronicle::weekOfYear(), PHP_EOL;
echo "\n\n";

echo "\n\nThe following methods return boolean values.\n\n";
echo 'bool: isLeapYear                : ', Chronicle::isLeapYear(2028), PHP_EOL;
echo "\n\n";

echo 'chn early date                  : ', Chronicle::createDate(1,1,55)->asYmd(), PHP_EOL;
echo 'php early date                  : ', (new DateTime("1/1/55"))->format("Y-m-d"), PHP_EOL;

