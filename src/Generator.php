<?php

namespace Mic2100\FuzzyTime;

use DateTime;
use Exception;
use InvalidArgumentException;
use Mic2100\FuzzyTime\Language\LanguageInterface;

/**
 * Class Generator
 *
 * @package Mic2100\FuzzyTime
 * @author Mike Bardsley <mic.bardsley@outlook.com>
 * @license MIT
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
     * Generator constructor.
     *
     * @param LanguageInterface $language
     *
     * @throws Exception - If the handle is not set on the language class
     * @throws InvalidArgumentException - If an incorrect language is selected
     */
    public function __construct(LanguageInterface $language)
    {
        $this->language = $language;
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
        return $this->processConfiguration(
            $this->language->getMinuteConfig(),
            __METHOD__,
            'getMinuteString'
        );
    }

    /**
     * Gets the divider string based on the current time from the config
     *
     * @return string
     */
    private function getDividerString(): string
    {
        return $this->processConfiguration(
            $this->language->getDividerConfig(),
            __METHOD__,
            'getDividerString'
        );
    }

    /**
     * Gets the time format based on the current time from the config
     *
     * @return string
     */
    private function getTimeFormat(): string
    {
        return $this->processConfiguration(
            $this->language->getTimeFormatConfig(),
            __METHOD__,
            'getFormat'
        );
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
