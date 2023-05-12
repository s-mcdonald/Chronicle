<?php

use SamMcDonald\Chronicle\Components\Time;

include '../vendor/autoload.php';

echo "\n\n\nChronicle: Time\n---------------------\n";

echo "\n\nTime methods.\n\n";
$time = Time::create(3,15,20,500);
echo 'Time: getHour                  : ', $time->getHour(), PHP_EOL;
echo 'Time: getMinute                : ', $time->getMinute(), PHP_EOL;
echo 'Time: getSeconds               : ', $time->getSeconds(), PHP_EOL;
echo 'Time: getMicroseconds          : ', $time->getMicroseconds(), PHP_EOL;
echo 'Time: getUnixTimestamp         : ', $time->getUnixTimestamp(), PHP_EOL;
echo 'Time: getTimestamp             : ', $time->getTimestamp(), PHP_EOL;
echo 'Time: toShortTimeString        : ', $time->toShortTimeString(), PHP_EOL;
echo 'Time: toLongTimeString         : ', $time->toLongTimeString(), PHP_EOL;
echo 'Time: toMySqlDateTimeString    : ', $time->toMySqlDateTimeString(), PHP_EOL;

