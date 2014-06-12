# \TechLang\DateTime

## Introduction

Enhance DateTime objects to add calendar months.
What this means is that it will keep the day of the month and only modify month number.
If the resulting month does not have that day (for example 31 February) it will use the highest day available for that month.

## Examples

* adding a month
```php
$date = \TechLang\DateTime::createFromFormat('Y-m-d', '2000-01-31');
$date->add(new \DateInterval('P1M'));
echo $date->format('Y-m-d');
// this will output: 2000-02-29
```

* adding 2 months
```php
$date = \TechLang\DateTime::createFromFormat('Y-m-d', '2000-12-31');
$date->add(new \DateInterval('P2M'));
echo $date->format('Y-m-d');
// this will output: 2001-02-28
```

## Future development
* implement `sub` method
