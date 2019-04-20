<?php

namespace Mic2100\FuzzyTime;

use DateTime;
use Mic2100\FuzzyTime\Language\AbstractLanguage;
use Mic2100\FuzzyTime\Language\Dictionaries\EnGb;
use Mic2100\FuzzyTime\Language\LanguageInterface;

/**
 * Class Generator
 *
 * @package Mic2100\FuzzyTime
 * @author Michael Bardsley <@mic_bardsley>
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

    public function __construct(LanguageInterface $language = null)
    {
        $this->language = $language ?? new EnGb;
    }

    /**
     * @param DateTime|null $time
     *
     * @return mixed
     * @throws \Exception
     */
    public function getFuzzyTime(DateTime $time = null)
    {
        $this->time = $time ?? new DateTime;

        return str_replace(
            [':minutes', ':divider', ':hour'],
            [$this->getMinuteString(), $this->getDividerString(), $this->getHourString()],
            $this->getTimeFormat()
        );
    }

    /**
     * @return string
     */
    private function getMinuteString()
    {
        return $this->iterateConfig($this->minuteConfig, function ($config) {
            return $this->language->getMinuteString($config['string']);
        }, 'number of minutes');
    }

    /**
     * @return string
     */
    private function getDividerString()
    {
        return $this->iterateConfig($this->dividerConfig, function ($config) {
            return $this->language->getDividerString($config['string']);
        }, 'divider');
    }

    /**
     * @return string
     */
    private function getHourString()
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
     * @return string
     */
    private function getTimeFormat()
    {
        return $this->iterateConfig($this->timeFormatConfig, function ($config) {
            return $this->language->getFormat($config['string']);
        }, 'time format');
    }

    /**
     * Iterate the configuration and execute the $function if the $config matches
     *
     * @param array $configuration
     * @param callable $function
     * @param string $functionName
     *
     * @return mixed
     */
    private function iterateConfig(array $configuration, callable $function, string $functionName)
    {
        $time = $this->time->format('i.s');
        foreach ($configuration as $config) {
            if ($time >= $config['from'] && $time < $config['to']) {
                return $function($config);
            }
        }


        throw new \InvalidArgumentException(
            sprintf('Unknown %s when getting for the time: %s', $functionName, $time)
        );
    }
}
