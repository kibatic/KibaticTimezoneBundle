<?php
namespace Kibatic\TimezoneBundle\Twig\Extension;

use Kibatic\TimezoneBundle\Adjuster\AdjusterInterface;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\Extra\Intl\IntlExtension;
use Twig\TwigFilter;

class TimezoneExtension extends AbstractExtension
{
    protected $adjuster;
    protected $twig;
    protected $intlExtension;

    public function __construct(
        AdjusterInterface $adjuster,
        Environment $twig,
        IntlExtension $intlExtension
    ) {
        $this->adjuster = $adjuster;
        $this->twig = $twig;
        $this->intlExtension = $intlExtension;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('tzdate', [$this, 'tzDate']),
            new TwigFilter('tz_format_datetime', [$this, 'tzFormatDatetime']),
            new TwigFilter('tzlocalizeddate', [$this, 'tzLocalizedDate']),
        ];
    }

    /**
     * doc extracted from the \twig_date_format_filter function from twig
     *
     * Converts a date to the given format.
     *
     *   {{ post.published_at|date("m/d/Y") }}
     *
     * @param \DateTimeInterface|\DateInterval|string $date A date
     * @param null $format
     * @param \DateTimeZone|string|false|null $timezone The target timezone, null
     * to use the default, false to leave unchanged
     * @return string The formatted date
     */
    public function tzDate(
        $date,
        $format = null,
        $timezone = false
    ) {
        return \twig_date_format_filter(
            $this->twig,
            $this->adjuster->asDateTime($date),
            $format,
            $timezone
        );
    }

    /**
     * an exact copy of the filter :
     * https://twig.symfony.com/doc/3.x/filters/format_datetime.html
     * but with the default timezone to false
     *
     * @param $date
     * @param string|null $dateFormat
     * @param string|null $timeFormat
     * @param string $pattern
     * @param bool $timezone
     * @param string $calendar
     * @param string|null $locale
     * @return string
     * @throws \Twig\Error\RuntimeError
     */
    public function tzFormatDatetime(
        $date,
        ?string $dateFormat = 'medium',
        ?string $timeFormat = 'medium',
        string $pattern = '',
        $timezone = false,
        string $calendar = 'gregorian',
        string $locale = null
    ):string {
        return $this->intlExtension->formatDateTime(
            $this->twig,
            $this->adjuster->asDateTime($date),
            $dateFormat,
            $timeFormat,
            $pattern,
            $timezone,
            $calendar,
            $locale
        );
    }

    /**
     * same signature as the old filter localizeddate
     * https://twig-extensions.readthedocs.io/en/latest/intl.html
     *
     * @deprecated Use tz_format_datetime instead
     *
     * @param $date
     * @param string|null $dateFormat
     * @param string|null $timeFormat
     * @param false $timezone
     * @param string $calendar
     * @param string|null $locale
     * @return string
     * @throws \Twig\Error\RuntimeError
     */
    public function tzLocalizedDate(
        $date,
        ?string $dateFormat = 'medium',
        ?string $timeFormat = 'medium',
        $timezone = false,
        string $calendar = 'gregorian',
        string $locale = null
    ):string {
        return $this->intlExtension->formatDateTime(
            $this->twig,
            $this->adjuster->asDateTime($date),
            $dateFormat,
            $timeFormat,
            '',
            $timezone,
            $calendar,
            $locale
        );
    }

}
