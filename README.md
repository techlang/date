# \TechLang\DateTime
[![Build Status](https://travis-ci.org/techlang/date.svg?branch=master)](https://travis-ci.org/techlang/date)
[![Coverage Status](https://img.shields.io/coveralls/techlang/date.svg)](https://coveralls.io/r/techlang/date)
[![Latest Stable Version](https://poser.pugx.org/techlang/date/v/stable.svg)](https://packagist.org/packages/techlang/date)
[![Latest Unstable Version](https://poser.pugx.org/techlang/date/v/unstable.svg)](https://packagist.org/packages/techlang/date)
[![Total Downloads](https://poser.pugx.org/techlang/date/downloads.svg)](https://packagist.org/packages/techlang/date)
[![License](https://poser.pugx.org/techlang/date/license.svg)](https://packagist.org/packages/techlang/date)

## Introduction

Enhance DateTime objects to add calendar months.
What this means is that it will keep the day of the month and only modify month number.
If the resulting month does not have that day (for example 31 February) it will use the highest day available for that month.

## Examples

* adding a month 6 times; Jan. 31st scenario
```php
$date = new \TechLang\DateTime('2000-01-31');
$date->add(new \DateInterval('P1M'));
echo $date->format('Y-m-d'); // -> 2000-02-29
$date->add(new \DateInterval('P1M'));
echo $date->format('Y-m-d'); // -> 2000-03-31
$date->add(new \DateInterval('P1M'));
echo $date->format('Y-m-d'); // -> 2000-04-30
$date->add(new \DateInterval('P1M'));
echo $date->format('Y-m-d'); // -> 2000-05-31
$date->add(new \DateInterval('P1M'));
echo $date->format('Y-m-d'); // -> 2000-06-30
$date->add(new \DateInterval('P1M'));
echo $date->format('Y-m-d'); // -> 2000-07-31
// and so on
```

* adding a month 6 times; Jan. 30th scenario
```php
$date = new \TechLang\DateTime('2001-01-30');
$date->add(new \DateInterval('P1M'));
echo $date->format('Y-m-d'); // -> 2001-02-28
$date->add(new \DateInterval('P1M'));
echo $date->format('Y-m-d'); // -> 2001-03-30
$date->add(new \DateInterval('P1M'));
echo $date->format('Y-m-d'); // -> 2001-04-30
$date->add(new \DateInterval('P1M'));
echo $date->format('Y-m-d'); // -> 2001-05-30
$date->add(new \DateInterval('P1M'));
echo $date->format('Y-m-d'); // -> 2001-06-30
$date->add(new \DateInterval('P1M'));
echo $date->format('Y-m-d'); // -> 2001-07-30
// and so on
```

* adding 2 months
```php
$date = \TechLang\DateTime::createFromFormat('Y-m-d', '2000-12-31');
$date->add(new \DateInterval('P2M'));
echo $date->format('Y-m-d');
// this will output: 2001-02-28
```

* add anything lower than month and you loose the initial date
```php
$date = new \TechLang\DateTime('2000-11-30');
$date->add(new \DateInterval('P1M2D'));
echo $date->format('Y-m-d'); // -> 2001-01-01

// because we added 2 days the date is now 2000-01-01 and the original day of 30 is lost
$date->add(new \DateInterval('P1M'));
echo $date->format('Y-m-d'); // -> 2001-02-01
```

## Future development
* implement `sub` method
