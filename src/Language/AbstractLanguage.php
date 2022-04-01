<?php

namespace Mic2100\FuzzyTime\Language;

use Mic2100\FuzzyTime\Exceptions\LanguageException;

/**
 * Class AbstractLanguage
 *
 * @package Mic2100\FuzzyTime\Language
 * @author Mike Bardsley <mic.bardsley@outlook.com>
 * @license MIT
 */
abstract class AbstractLanguage implements LanguageInterface
{
    public const HANDLE = '';
    protected const ON_THE_HOUR = 0;
    protected const BEFORE_HALF_PAST = 1;
    protected const AFTER_HALF_PAST = 2;

    /**
     * @var array
     */
    protected array $minutes = [];

    /**
     * @var array
     */
    protected array $hours = [];

    /**
     * @var array
     */
    protected array $divider = [];

    /**
     * @var array
     */
    protected array $formats = [];

    /**
     * @var array
     */
    protected array $minuteConfig = [
        [
            'from' => '00.00',
            'to' => '02.30',
            'string' => '00'
        ],
        [
            'from' => '57.30',
            'to' => '59.60',
            'string' => '00'
        ],
        [
            'from' => '02.30',
            'to' => '07.30',
            'string' => '05'
        ],
        [
            'from' => '07.30',
            'to' => '12.30',
            'string' => '10'
        ],
        [
            'from' => '12.30',
            'to' => '17.30',
            'string' => '15'
        ],
        [
            'from' => '17.30',
            'to' => '22.30',
            'string' => '20'
        ],
        [
            'from' => '22.30',
            'to' => '27.30',
            'string' => '25'
        ],
        [
            'from' => '27.30',
            'to' => '32.30',
            'string' => '30'
        ],
        [
            'from' => '32.30',
            'to' => '37.30',
            'string' => '35'
        ],
        [
            'from' => '37.30',
            'to' => '42.30',
            'string' => '40'
        ],
        [
            'from' => '42.30',
            'to' => '47.30',
            'string' => '45'
        ],
        [
            'from' => '47.30',
            'to' => '52.30',
            'string' => '50'
        ],
        [
            'from' => '52.30',
            'to' => '57.30',
            'string' => '55'
        ],
    ];

    /**
     * @var array
     */
    protected array $dividerConfig = [
        [
            'from' => '00.00',
            'to' => '02.30',
            'string' => AbstractLanguage::ON_THE_HOUR,
        ],
        [
            'from' => '57.30',
            'to' => '59.60',
            'string' => AbstractLanguage::ON_THE_HOUR,
        ],
        [
            'from' => '02.30',
            'to' => '32.30',
            'string' => AbstractLanguage::BEFORE_HALF_PAST,
        ],
        [
            'from' => '32.30',
            'to' => '57.30',
            'string' => AbstractLanguage::AFTER_HALF_PAST,
        ],
    ];

    /**
     * @var array
     */
    protected array $timeFormatConfig = [
        [
            'from' => '00.00',
            'to' => '02.30',
            'string' => AbstractLanguage::ON_THE_HOUR,
        ],
        [
            'from' => '57.30',
            'to' => '59.60',
            'string' => AbstractLanguage::ON_THE_HOUR,
        ],
        [
            'from' => '02.30',
            'to' => '30.00',
            'string' => AbstractLanguage::BEFORE_HALF_PAST,
        ],
        [
            'from' => '30.00',
            'to' => '57.30',
            'string' => AbstractLanguage::AFTER_HALF_PAST,
        ],
    ];

    /**
     * AbstractLanguage constructor.
     * @throws LanguageException - If no handle is set
     */
    public function __construct()
    {
        if (static::HANDLE === '') {
            throw LanguageException::invalidHandle(get_class($this));
        }
    }

    /**
     * @param string $minutes
     * @return string
     * @throws LanguageException
     */
    public function getMinuteString(string $minutes): string
    {
        if (!isset($this->minutes[$minutes])) {
            throw LanguageException::invalidMinutes($minutes);
        }

        return $this->minutes[$minutes];
    }

    /**
     * @param string $hour
     * @return string
     * @throws LanguageException
     */
    public function getHourString(string $hour): string
    {
        if (!isset($this->hours[$hour])) {
            throw LanguageException::invalidHours($hour);
        }

        return $this->hours[$hour];
    }

    /**
     * @param int $key
     * @return string mixed
     * @throws LanguageException
     */
    public function getDividerString(int $key): string
    {
        if (!isset($this->divider[$key])) {
            throw LanguageException::invalidDivider($key);
        }

        return $this->divider[$key];
    }

    /**
     * @param int $key
     * @return string
     * @throws LanguageException
     */
    public function getFormat(int $key): string
    {
        if (!isset($this->formats[$key])) {
            throw LanguageException::invalidFormat($key);
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
