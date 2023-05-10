<?php

use SamMcDonald\Chronicle\Components\Time;

include '../vendor/autoload.php';

echo "\n\n\nChronicle: Time\n---------------------\n";

echo "\n\nTime methods.\n\n";
echo 'Time: create                   : ', Time::create(0,0,0,500), PHP_EOL;
echo 'Time: now                      : ', Time::now(), PHP_EOL;
echo 'Time: getHour                  : ', Time::now()->getHour(), PHP_EOL;
echo 'Time: getMinute                : ', Time::now()->getMinute(), PHP_EOL;
echo 'Time: getSeconds               : ', Time::now()->getSeconds(), PHP_EOL;
echo 'Time: getMicroseconds          : ', Time::now()->getMicroseconds(), PHP_EOL;
echo 'Time: getUnixTimestamp         : ', Time::now()->getUnixTimestamp(), PHP_EOL;
echo 'Time: getTimestamp             : ', Time::now()->getTimestamp(), PHP_EOL;
echo 'Time: toShortTimeString        : ', Time::now()->toShortTimeString(), PHP_EOL;
echo 'Time: toLongTimeString         : ', Time::now()->toLongTimeString(), PHP_EOL;
echo 'Time: toMySqlDateTimeString    : ', Time::now()->toMySqlDateTimeString(), PHP_EOL;

