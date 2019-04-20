<?php

namespace Mic2100\FuzzyTime\Language;

/**
 * Class AbstractLanguage
 *
 * @package Mic2100\FuzzyTime\Language
 * @author Mike Bardsley <mic.bardsley@outlook.com>
 */
abstract class AbstractLanguage implements LanguageInterface
{
    const HANDLE = '';
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
     * AbstractLanguage constructor.
     * @throws \Exception - If no handle is set
     */
    public function __construct()
    {
        if (static::HANDLE === '') {
            throw new \Exception(sprintf('Class: %s must have and handle set', get_class($this)));
        }
    }

    /**
     * @param string $minutes
     * @return string
     */
    public function getMinuteString(string $minutes): string
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
    public function getHourString(string $hour): string
    {
        if (!isset($this->hours[$hour])) {
            throw new \InvalidArgumentException('Invalid hour passed: ' . $hour);
        }

        return $this->hours[$hour];
    }

    /**
     * @param int $key
     * @return string mixed
     */
    public function getDividerString(int $key): string
    {
        if (!isset($this->divider[$key])) {
            throw new \InvalidArgumentException('Invalid divider key passed: ' . $key);
        }

        return $this->divider[$key];
    }

    /**
     * @param int $key
     * @return string
     */
    public function getFormat(int $key): string
    {
        if (!isset($this->formats[$key])) {
            throw new \InvalidArgumentException('Invalid format key passed: ' . $key);
        }

        return $this->formats[$key];
    }
}
