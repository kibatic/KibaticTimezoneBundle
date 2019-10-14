Kibatic Timezone Bundle
=====================

[![Build Status](https://travis-ci.com/kibatic/KibaticTimezoneBundle.svg?branch=master)](https://travis-ci.com/kibatic/KibaticTimezoneBundle)

This bundle is used to manage the display of a \DateTimeInterface in the right timezone.

The common case is a project with all the \DateTimeInterface objects are
in UTC (in the DB, in PHP, ...) but the user can change the timezone in
his preferences in order to display the dates with its own timezone.

Quick start
-----------

installation

```bash
composer require kibatic/timezone-bundle
```

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

in twig the syntax of tzdate is exactly the same as the
[twig date filter](https://twig.symfony.com/doc/2.x/filters/date.html).
(it calls the default date filter. The only difference is that the
timezone argument is set to false by default)

```twig
{{ date | tzdate }}
{{ date | tzdate('Y/m/d') }}
```

Localized date
--------------

You can use the new twig : tzlocalizeddate filter. It has the same
interface than the [localizeddate filter from twig-extension intl](https://twig-extensions.readthedocs.io/en/latest/intl.html#localizeddate), but with a $timezone to
false by default.

In order to make it work, you have to enable intl extension in your config.yaml
file.

```yaml
services:
    twig.extension.intl:
        class: Twig\Extensions\IntlExtension
        tags:
            - { name: twig.extension }
```

Then use

```twig
{{ date | tzlocalizeddate('short', 'short') }}
{{ date | tzlocalizeddate('long', 'long') }}
{{ date | tzlocalizeddate }}
```

Timezone Provider
-----------------

A timezone Provider is a service that implements TimezoneProviderInterface.

It's a service that is used to know the current timezone to display (for
a webpage, an API, in a command, for an export,...)

It implements [TimezoneProviderInterface](Provider/TimezoneProviderInterface)

The adjuster as twig global variable
------------------------------------

If needed, you can add the adjuster as a twig global variable :

in config/packages/twig.yaml, you can add

```yaml
twig:
  globals:
    timezoneAdjuster: '@kibatic_timezone.adjuster'
```

and then in any twig you can use the adjuster

```twig
<div>Timezone : {{ timezoneAdjuster.displayTimezone().name }}</div>

{# convertir un datetime en datetime avec la bone timezone #}
{{ timezoneAdjuster.asDateTime(date) }}

```

Versions
--------

2019-10-14 : v1.1.1

* hum... fix unit tests in travis for v1.1.0

2019-10-14 : v1.1.0

* Readme updated
* add tzlocalizeddate twig filter

2019-10-11 : v1.0.2

* only for sf4.3+

2019-10-11 : v1.0.1

* fix deprecation in Configurator for sf4

2019-10-11 : v1.0.0

* initial publication

