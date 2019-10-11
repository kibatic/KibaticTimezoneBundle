<?php
namespace Kibatic\TimezoneBundle\Twig\Extension;

use Kibatic\TimezoneBundle\Adjuster\AdjusterInterface;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TimezoneExtension extends AbstractExtension
{
    protected $adjuster;
    protected $twig;

    public function __construct(
        AdjusterInterface $adjuster,
        Environment $twig
    ) {
        $this->adjuster = $adjuster;
        $this->twig = $twig;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('tzdate', [$this, 'tzDate']),
        ];
    }

    /**
     * doc extracted from the \twig_date_format_filter function from twig
     *
     * Converts a date to the given format.
     *
     *   {{ post.published_at|date("m/d/Y") }}
     *
     * @param \DateTimeInterface|\DateInterval|string $date     A date
     * @param string|null                             $format   The target format, null to use the default
     * @param \DateTimeZone|string|false|null         $timezone The target timezone, null to use the default, false to leave unchanged
     *
     * @return string The formatted date
     */
    public function tzDate($date, $format = null, $timezone = false): string
    {
        return \twig_date_format_filter(
            $this->twig,
            $this->adjuster->asDateTime($date),
            $format,
            $timezone
        );
    }
}
