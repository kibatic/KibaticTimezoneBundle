Kibatic Timezone Bundle
=====================

[![Build Status](https://travis-ci.com/kibatic/KibaticTimezoneBundle.svg?branch=master)](https://travis-ci.com/kibatic/KibaticTimezoneBundle)

This bundle is used to manage the display of a \DateTimeInterface in the right timezone.

The common case is a project with all the \DateTimeInterface objects are
in UTC (in the DB, in PHP, ...) but the user can change the timezone in
his preferences in order to display the dates with its own timezone.

Quick start
-----------

in config.yml

```yml
kibatic_timezone:
    default_display_timezone: "Europe/Paris"
    timezone_provider: "\Timezone\MyTimezoneProvider"
```

in php

```php
/** @var \DateTimeInterface $date */
$date = new \DateTimeImmutable();

$tzAdjuster = $container->get('\\Kibatic\\TimezoneBundle\\Adjuster');
$dateTime = $tzAdjuster->asDateTimeImmutable($date);
$dateTime2 = $tzAdjuster->asDateTime($date);
```

in twig

```twig
{{ date | timezone | date('Y/m/d') }}
```

Timezone Provider
-----------------

A timezone Provider is a service that implements TimezoneProviderInterface.

It's a service that is used to know the current timezone to display (for
a webpage, an API, in a command, for an export,...)

It implements [TimezoneProviderInterface](Provider/TimezoneProviderInterface)
