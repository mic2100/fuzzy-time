<?php

namespace Mic2100\FuzzyTime\Language;

/**
 * Class AbstractLanguage
 *
 * @package Mic2100\FuzzyTime\Language
 * @author Mike Bardsley <mic.bardsley@outlook.com>
 * @license MIT
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
     * @var array
     */
    protected $minuteConfig = [
        [
            'from' => '00.00',
            'to' => '02.30',
            'string' => '00'
        ],[
            'from' => '57.30',
            'to' => '59.60',
            'string' => '00'
        ],[
            'from' => '02.30',
            'to' => '07.30',
            'string' => '05'
        ],[
            'from' => '07.30',
            'to' => '12.30',
            'string' => '10'
        ],[
            'from' => '12.30',
            'to' => '17.30',
            'string' => '15'
        ],[
            'from' => '17.30',
            'to' => '22.30',
            'string' => '20'
        ],[
            'from' => '22.30',
            'to' => '27.30',
            'string' => '25'
        ],[
            'from' => '27.30',
            'to' => '32.30',
            'string' => '30'
        ],[
            'from' => '32.30',
            'to' => '37.30',
            'string' => '35'
        ],[
            'from' => '37.30',
            'to' => '42.30',
            'string' => '40'
        ],[
            'from' => '42.30',
            'to' => '47.30',
            'string' => '45'
        ],[
            'from' => '47.30',
            'to' => '52.30',
            'string' => '50'
        ],[
            'from' => '52.30',
            'to' => '57.30',
            'string' => '55'
        ],
    ];

    /**
     * @var array
     */
    protected $dividerConfig = [
        [
            'from' => '00.00',
            'to' => '02.30',
            'string' => AbstractLanguage::ON_THE_HOUR,
        ],[
            'from' => '57.30',
            'to' => '59.60',
            'string' => AbstractLanguage::ON_THE_HOUR,
        ],[
            'from' => '02.30',
            'to' => '32.30',
            'string' => AbstractLanguage::BEFORE_HALF_PAST,
        ],[
            'from' => '32.30',
            'to' => '57.30',
            'string' => AbstractLanguage::AFTER_HALF_PAST,
        ],
    ];

    /**
     * @var array
     */
    protected $timeFormatConfig = [
        [
            'from' => '00.00',
            'to' => '02.30',
            'string' => AbstractLanguage::ON_THE_HOUR,
        ],[
            'from' => '57.30',
            'to' => '59.60',
            'string' => AbstractLanguage::ON_THE_HOUR,
        ],[
            'from' => '02.30',
            'to' => '30.00',
            'string' => AbstractLanguage::BEFORE_HALF_PAST,
        ],[
            'from' => '30.00',
            'to' => '57.30',
            'string' => AbstractLanguage::AFTER_HALF_PAST,
        ],
    ];

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

    /**
     * @return array
     */
    public function getMinuteConfig(): array
    {
        return $this->minuteConfig;
    }

    /**
     * @return array
     */
    public function getDividerConfig(): array
    {
        return $this->dividerConfig;
    }

    /**
     * @return array
     */
    public function getTimeFormatConfig(): array
    {
        return $this->timeFormatConfig;
    }
}
