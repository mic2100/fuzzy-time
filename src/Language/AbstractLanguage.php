<?php

namespace Mic2100\FuzzyTime\Language;

/**
 * Class AbstractLanguage
 *
 * @package Mic2100\FuzzyTime\Language
 * @author Michael Bardsley <@mic_bardsley>
 */
abstract class AbstractLanguage
{
    const ON_THE_HOUR = 0;
    const BEFORE_HALF_PAST = 1;
    const AFTER_HALF_PAST = 2;

    /**
     * @var array
     */
    protected $minutes = [];

    /**
     * @var array
     */
    protected $hours = [];

    /**
     * @var array
     */
    protected $divider = [];

    /**
     * @var array
     */
    protected $formats = [];

    /**
     * @param string $minutes
     * @return string
     */
    public function getMinuteString($minutes)
    {
        if (!isset($this->minutes[$minutes])) {
            throw new \InvalidArgumentException('Invalid minutes passed: ' . $minutes);
        }

        return $this->minutes[$minutes];
    }

    /**
     * @param string $hour
     * @return string
     */
    public function getHourString($hour)
    {
        if (!isset($this->hours[$hour])) {
            throw new \InvalidArgumentException('Invalid hour passed: ' . $hour);
        }

        return $this->hours[$hour];
    }

    /**
     * @param string $key
     * @return string mixed
     */
    public function getDividerString($key)
    {
        if (!isset($this->divider[$key])) {
            throw new \InvalidArgumentException('Invalid divider key passed: ' . $key);
        }

        return $this->divider[$key];
    }

    /**
     * @param string $key
     * @return string mixed
     */
    public function getFormat($key)
    {
        if (!isset($this->formats[$key])) {
            throw new \InvalidArgumentException('Invalid format key passed: ' . $key);
        }

        return $this->formats[$key];
    }
}
