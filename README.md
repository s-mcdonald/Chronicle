# Chronicle
[![Source](https://img.shields.io/badge/source-S_McDonald-blue.svg)](https://github.com/s-mcdonald/Chronicle)
[![Source](https://img.shields.io/badge/license-MIT-gold.svg)](https://github.com/s-mcdonald/Chronicle)

`Chronicle` is a Date and Time package that provides additional functionality to manage Date and Times used in your PHP program.
A lightweight utility for the most common operations. 


```php
    ///
    /// Chronicle class
    /// 
    Chronicle::createDate(1,1,1969);
    Chronicle::dateNow();
    Chronicle::dateLastWeek();
    Chronicle::dateNextWeek();
    Chronicle::dateTomorrow();
    Chronicle::dateYesterday();
    Chronicle::dateLastFortnight();
    Chronicle::dateNextFortnight();

    Chronicle::sameDayLastMonth();
    Chronicle::sameDayLastMonth(DateShiftRule::Business);
    Chronicle::sameDayLastMonth(DateShiftRule::Strict);
    
    Chronicle::dayOfWeek();
    Chronicle::monthOfYear();
    Chronicle::agoText($date1, $date2);
    
    Chronicle::getWeekOfYear("2023-01-23");
    Chronicle::weekOfYear();
    
    Chronicle::isLeapYear(2028);


    ///
    /// Date class
    /// 
    $today = Date::create(1,11, 2024);
    $today->getDay();
    $today->getMonth();
    $today->getYear();
    
    $today->addDays(3);
    $today->subDays(9);
    $today->subMoths(1);
    $today->subMoths(1)->addMonths(2);
    $today->addYears(3);
    $today->subYears(9);
    
    $today->getTimestamp();
    $today->getUnixTimestamp();
    $today->toMySqlDateTimeString();
    $today->greaterThan($date);
    $today->shiftToFirstDayOfMonth();
    $today->shiftToLastDayOfMonth();
    $today->tomorrow();
    $today->yesterday();
    $today->lastWeek();
    $today->nextWeek();
    $today->lastFortnight();
    $today->nextFortnight();
    $today->lastFortnight()->getDayOfWeek();
    $today->nextFortnight()->tomorrow()->getDayOfWeek();
    $today->nextFortnight()->addDays(1)->getDayOfWeek();
    $today->getWeekOfYear();
    $today->setYear(2024)->isLeapYear();
    
    ///
    /// String formatting
    /// 
    $today->asYmd(DateSeperator::Dash);
    $today->asYmd(DateSeperator::ForwardSlash);
    $today->toShortDateString();
    $today->toUSShortDateString();
    $today->toLongDateString();
    $today->getDayOfWeek();
    $today->getMonthOfYear();
    $today->getDayOfWeekInt();
    $today->toAbbreviatedDayMonthYearString();
    $today->toAbbreviatedMonthDayString();
    
    ///
    /// Period Shifting
    ///
    $feb29->getSameDayLastMonth();
    $feb29->getSameDayLastMonth(DateShiftRule::Business);
    $feb29->getSameDayLastMonth(DateShiftRule::Strict);
    
    $july31->getSameDayLastMonth(DateShiftRule::PhpCore);
    $july31->getSameDayLastMonth(DateShiftRule::Business);
    $july31->getSameDayLastMonth(DateShiftRule::Strict);
    
    
    ///
    /// Static methods
    ///
    Date::createFromDateTimeInterface($dateTime);
    Date::create();
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
