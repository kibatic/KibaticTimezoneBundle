<?php
namespace Kibatic\TimezoneBundle\Adjuster;

use Kibatic\TimezoneBundle\Provider\TimezoneProviderInterface;

class Adjuster implements AdjusterInterface
{
    /**
     * @var \DateTimeZone
     */
    protected $defaultDisplayTimezone;

    /**
     * @var TimezoneProviderInterface
     */
    protected $timezoneProvider;

    public function __construct(
        string $defaultDisplayTimezone,
        TimezoneProviderInterface $provider
    ) {
        $this->defaultDisplayTimezone = new \DateTimeZone($defaultDisplayTimezone);
        $this->timezoneProvider = $provider;
    }

    /**
     * @inheritDoc
     */
    public function getDisplayTimezone(): \DateTimeZone
    {
        if (null === $this->timezoneProvider->getDisplayTimezone()) {
            return $this->defaultDisplayTimezone;
        }
        return $this->timezoneProvider->getDisplayTimezone();
    }
}
