# Chronicle
[![Source](https://img.shields.io/badge/source-S_McDonald-blue.svg)](https://github.com/s-mcdonald/Chronicle)
[![Source](https://img.shields.io/badge/license-MIT-gold.svg)](https://github.com/s-mcdonald/Chronicle)

`Chronicle` is a Date and Time package that provides additional functionality to manage Date and Times used in your PHP program.
A lightweight utility for the most common operations. 


```php
        Chronicle::now();                                   // ChronicDateTime::class ->extends DateTime
        Chronicle::dateNow();                               // ChronicDate::class
        Chronicle::timeNow();                               // ChronicTime::class
        Chronicle::dateLastWeek();                          // ChronicDate::class
        Chronicle::dateNextWeek();                          // ChronicDate::class
        Chronicle::dateTomorrow();                          // ChronicDate::class
        Chronicle::dateYesterday();                         // ChronicDate::class
        Chronicle::dateLastFortnight();                     // ChronicDate::class
        Chronicle::dateNextFortnight();                     // ChronicDate::class
        Chronicle::getWeekOfYear($date);                    // int (3 for the third week in Jan)
        Chronicle::agoText($date1, $date2);                 // 6 days ago
        
        ChronicDate::createFromTimestamp();                 // ChronicDate::class
        ChronicDate::createFromDateTimeInterface();         // ChronicDate::class
        ChronicDate::copy();                                // ChronicDate::class
        ChronicDate::today();                               // ChronicDate::class
        ChronicDate::createNow();                           // ChronicDate::class
        ChronicDate::getDay();                              // int
        ChronicDate::getMonth();                            // int
        ChronicDate::getYear();                             // int
        ChronicDate::getWeekOfYear();                       // ChronicDate::class
        ChronicDate::getUnixTimestamp();                    // int
        ChronicDate::equals();                              // bool
        ChronicDate::greaterThan();                         // bool
        ChronicDate::getTimestamp();                        // int
        ChronicDate::toMySqlDateTimeString();               // ChronicDate::class
        ChronicDate::toDateTimeImmutable();                 // ChronicDate::class
        ChronicDate::lastWeek();                            // ChronicDate::class
        ChronicDate::nextWeek();                            // ChronicDate::class
        ChronicDate::dateNextWeek();                        // ChronicDate::class
        ChronicDate::dateLastWeek();                        // ChronicDate::class
        ChronicDate::dateTomorrow();                        // ChronicDate::class
        ChronicDate::yesterday();                           // ChronicDate::class
        ChronicDate::lastFortnight();                       // ChronicDate::class
        ChronicDate::nextFortnight();                       // ChronicDate::class
        ChronicDate::addDays();                             // ChronicDate::class
        ChronicDate::subDays();                             // ChronicDate::class
        ChronicDate::addMonths();                           // ChronicDate::class
        ChronicDate::subMoths();                            // ChronicDate::class
        ChronicDate::addYears();                            // ChronicDate::class
        ChronicDate::subYears();                            // ChronicDate::class
        ChronicDate::shiftToFirstDayOfMonth();              // ChronicDate::class
        ChronicDate::shiftToLastDayOfMonth();               // ChronicDate::class
        ChronicDate::ago();                                 // string ( x days ago)


```

## Documentation

* [Installation](#installation)
* [Dependencies](#dependencies)


<a name="installation"></a>
## Installation

Via Composer. Run the following command from your project's root.

```
composer require s-mcdonald/chronicle
```

<a name="dependencies"></a>
## Dependencies

*  Php 8.0

## License

Chronicle is licensed under the terms of the [MIT License](http://opensource.org/licenses/MIT)
(See LICENSE file for details).
