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
    default_display_timezone: "Europe/Paris"    # mandatory
    timezone_provider: "App\\Timezone\\MyTimezoneProvider"   # optional
```

in php

```php
/** @var \DateTimeInterface $date */
$date = new \DateTimeImmutable();

$tzAdjuster = $container->get('kibatic_timezone.adjuster');
$dateTimeImmutable = $tzAdjuster->asDateTimeImmutable($date);
$dateTime = $tzAdjuster->asDateTime($date);
```

in twig the syntax of tzdate is exactly the same as the date filter
(it calls the default date filter. The only difference is that the
timezone argument is set to false by default)

```twig
{{ date | tzdate }}
{{ date | tzdate('Y/m/d') }}
```

Timezone Provider
-----------------

A timezone Provider is a service that implements TimezoneProviderInterface.

It's a service that is used to know the current timezone to display (for
a webpage, an API, in a command, for an export,...)

It implements [TimezoneProviderInterface](Provider/TimezoneProviderInterface)

Versions
--------

2019-10-11 : v1.0

* initial publication
