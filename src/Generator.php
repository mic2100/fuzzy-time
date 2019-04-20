<?php

namespace Mic2100\FuzzyTime;

use DateTime;
use Exception;
use InvalidArgumentException;
use Mic2100\FuzzyTime\Language\AbstractLanguage;
use Mic2100\FuzzyTime\Language\Dictionaries\English;
use Mic2100\FuzzyTime\Language\LanguageFactory;
use Mic2100\FuzzyTime\Language\LanguageInterface;

/**
 * Class Generator
 *
 * @package Mic2100\FuzzyTime
 * @author Mike Bardsley <mic.bardsley@outlook.com>
 */
class Generator
{
    /**
     * @var LanguageInterface
     */
    private $language;

    /**
     * @var DateTime
     */
    private $time;

    /**
     * @var array
     */
    private $minuteConfig = [
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
    private $dividerConfig = [
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
     * @var array
     */
    private $timeFormatConfig = [
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
     * Generator constructor.
     *
     * @param LanguageInterface $language
     *
     * @throws Exception - If the handle is not set on the language class
     * @throws InvalidArgumentException - If an incorrect language is selected
     */
    public function __construct(LanguageInterface $language)
    {
        $this->language = $language ?? LanguageFactory::get(English::HANDLE);
    }

    /**
     * Gets the fuzzy time based on the $time param or the current time
     *
     * @param DateTime|null $time
     *
     * @return string
     * @throws InvalidArgumentException - If the config cannot be found
     * @throws Exception - If there is an issue when creating a DateTime object
     */
    public function getFuzzyTime(DateTime $time = null): string
    {
        $this->time = $time ?? new DateTime('now');

        return str_replace(
            [':minutes', ':divider', ':hour'],
            [$this->getMinuteString(), $this->getDividerString(), $this->getHourString()],
            $this->getTimeFormat()
        );
    }

    /**
     * Gets the mimnute string based on the current time from the config
     *
     * @return string
     */
    private function getMinuteString(): string
    {
        return $this->processConfiguration($this->minuteConfig, __METHOD__, 'getMinuteString');
    }

    /**
     * Gets the divider string based on the current time from the config
     *
     * @return string
     */
    private function getDividerString(): string
    {
        return $this->processConfiguration($this->dividerConfig, __METHOD__, 'getDividerString');
    }

    /**
     * Gets the time format based on the current time from the config
     *
     * @return string
     */
    private function getTimeFormat(): string
    {
        return $this->processConfiguration($this->timeFormatConfig, __METHOD__, 'getFormat');
    }

    /**
     * Process the configuration
     *
     * @param array $configuration
     * @param string $functionName
     * @param string $methodName
     *
     * @return string
     */
    private function processConfiguration(array $configuration, string $functionName, string $methodName): string
    {
        return $this->iterateConfig($configuration, function ($config) use ($methodName) {
            return $this->language->$methodName($config['string']);
        }, $functionName);
    }

    /**
     * Gets the hour string based on the current time
     *
     * @return string
     */
    private function getHourString(): string
    {
        $hour = $this->time->format('H');
        if ($hour == '23') {
            $hour = '00';
        } elseif ($this->time->format('i') > '30') {
            $hour++;
            $hour = str_pad($hour, 2, '0', STR_PAD_LEFT);
        }

        return $this->language->getHourString($hour);
    }

    /**
     * Iterate the configuration and execute the $function if the $config matches
     *
     * @param array $configuration
     * @param callable $function
     * @param string $functionName
     *
     * @return string
     * @throws InvalidArgumentException - If the config cannot be found
     */
    private function iterateConfig(array $configuration, callable $function, string $functionName): string
    {
        $time = $this->time->format('i.s');
        foreach ($configuration as $config) {
            if ($time >= $config['from'] && $time < $config['to']) {
                return $function($config);
            }
        }

        throw new InvalidArgumentException(
            sprintf('Function: %s failed to get the time for: %s', $functionName, $time)
        );
    }
}
