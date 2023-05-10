<?php


include '../vendor/autoload.php';

use SamMcDonald\Chronicle\Clock;
use SamMcDonald\Chronicle\FrozenClock;

echo "\n\n\nChronicle: Clock\n---------------------\n";
$clock = new Clock();

for ($i = 0; $i < 5; $i++) {
    sleep(1);
    echo $clock->getTime(), PHP_EOL;
}



echo "\n\n\nChronicle: FrozenClock\n---------------------\n";
$frozen = new FrozenClock($clock->getDateTimeImmutable());
for ($i = 0; $i < 5; $i++) {
    sleep(1);
    echo $frozen->getTime(), PHP_EOL;
}