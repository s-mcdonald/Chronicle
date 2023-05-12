# Chronicle
[![Source](https://img.shields.io/badge/source-S_McDonald-blue.svg)](https://github.com/s-mcdonald/Chronicle)
[![Source](https://img.shields.io/badge/license-MIT-gold.svg)](https://github.com/s-mcdonald/Chronicle)

`Chronicle` is a Date and Time package that provides additional functionality to manage Date and Times used in your PHP program.
A lightweight utility for the most common operations. 


```php
    ///
    /// Chronicle class
    /// 
    Chronicle::createDate(1,1,1969);                        // 01-01-1969
    Chronicle::dateNow();                                   // 12-05-2023   (date executed was `12-05-2023`)
    Chronicle::dateLastWeek();                              // 05-05-2023   (date executed was `12-05-2023`)
    Chronicle::dateNextWeek();                              // 19-05-2023   (date executed was `12-05-2023`)
    Chronicle::dateTomorrow();                              // 13-05-2023   (date executed was `12-05-2023`)
    Chronicle::dateYesterday();                             // 11-05-2023   (date executed was `12-05-2023`)
    Chronicle::dateLastFortnight();                         // 28-04-2023   (date executed was `12-05-2023`)
    Chronicle::dateNextFortnight();                         // 26-05-2023   (date executed was `12-05-2023`)

    Chronicle::sameDayLastMonth();                          // 12-04-2023   (date executed was `12-05-2023`)
    Chronicle::sameDayLastMonth(DateShiftRule::Business);   // 12-04-2023   (date executed was `12-05-2023`)
    Chronicle::sameDayLastMonth(DateShiftRule::Strict);     // 12-04-2023   (date executed was `12-05-2023`)
    
    Chronicle::dayOfWeek();                                 // Friday       (date executed was `12-05-2023`)
    Chronicle::monthOfYear();                               // May          (date executed was `12-05-2023`)
    Chronicle::agoText($date1, $date2);                     // 1 day ago    (date executed was `12-05-2023`)
    
    Chronicle::getWeekOfYear("2023-01-23");                 // 4            (date executed was `12-05-2023`)
    Chronicle::weekOfYear();                                // int value representing current week of the year
    
    Chronicle::isLeapYear(2028);                            // true


    ///
    /// Date (as created as 1/November/2024)
    /// 
    $today = Date::create(6,11, 2024);
    $today->getDay();                                       // 6
    $today->getMonth();                                     // 11
    $today->getYear();                                      // 2024

    $today->addDays(3);                                     // 09-11-2024
    $today->subDays(9);                                     // 28-10/2024
    $today->subMoths(1);                                    // 06-12-2024
    $today->subMoths(1)->addMonths(2);                      // 06-12-2024 
    $today->addYears(3);                                    // 06-11-2027
    $today->subYears(9);                                    // 06-11-2015

    $today->getTimestamp();                                 // 1730811600
    $today->getUnixTimestamp();                             // 1730811600
    $today->toMySqlDateTimeString();                        // 2024-11-06 00:00:00

    $date = new DateTime("1/1/2005");
    $today->greaterThan($date);                             // true
    $today->shiftToFirstDayOfMonth();                       // 01-11-2024
    $today->shiftToLastDayOfMonth();                        // 30-11-2024
    $today->tomorrow();                                     // 07-11-2024
    $today->yesterday();                                    // 05-11-2024
    $today->lastWeek();                                     // 30-10-2024
    $today->nextWeek();                                     // 13-11-2024
    $today->lastFortnight();                                // 23-10-2024
    $today->nextFortnight();                                // 20-11-2024
    $today->getDayOfWeek();                                 // Wednesday
    $today->lastFortnight()->getDayOfWeek();                // Wednesday
    $today->nextFortnight()->tomorrow()->getDayOfWeek();    // Thursday
    $today->nextFortnight()->addDays(1)->getDayOfWeek();    // Thursday 
    $today->getWeekOfYear();                                // 45
    $today->setYear(2024)->isLeapYear();                    // true
    
    ///
    /// String formatting
    /// 
    $today->asYmd(DateSeperator::Dash);                     // 2024-11-06
    $today->asYmd(DateSeperator::ForwardSlash);             // 2024/11/06
    $today->toShortDateString();                            // 2024-11-06
    $today->toUSShortDateString();                          // 11-06-2024
    $today->toLongDateString();                             // Wednesday 6th of November 2024
    $today->getDayOfWeek();                                 // Wednesday
    $today->getMonthOfYear();                               // November
    $today->getDayOfWeekInt();                              // 3
    $today->toAbbreviatedDayMonthYearString();              // Wed, Nov 06, 2024
    $today->toAbbreviatedMonthDayString();                  // Nov 6
    
    ///
    /// Period Shifting
    ///
    $feb29 = Date::create(29,2, 2024);
    $feb29->getSameDayLastMonth();                          // 29-01-2024
    $feb29->getSameDayLastMonth(DateShiftRule::Business);   // 31-01-2024
    $feb29->getSameDayLastMonth(DateShiftRule::Strict);     // 29-01-2024
    
    $july31 = Date::create(31,7, 2024);
    $july31->getSameDayLastMonth(DateShiftRule::PhpCore);   // 01-07-2024
    $july31->getSameDayLastMonth(DateShiftRule::Business);  // 30-06-2024
    $july31->getSameDayLastMonth(DateShiftRule::Strict);    // 30-06-2024
    
    
    ///
    /// Static methods
    ///
    Date::createFromDateTimeInterface(new DateTime("now"));
    Date::createFromTimestamp(string $timestamp);           // example Date::createFromTimestamp("1730811600");
    Date::create(int $day, int $month, int $year);
    Date::today();
    Date::dateNextWeek();
    Date::dateLastWeek();
    Date::dateTomorrow();
    Date::dateYesterday();
    Date::dateLastFortnight();
    Date::dateNextFortnight();
    Date::validateDateString();


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
