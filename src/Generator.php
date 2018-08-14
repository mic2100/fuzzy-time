<?php

namespace Mic2100\FuzzyTime;

use DateTime;
use Mic2100\FuzzyTime\Language\AbstractLanguage;
use Mic2100\FuzzyTime\Language\EnGb;

/**
 * Class Generator
 *
 * @package Mic2100\FuzzyTime
 * @author Michael Bardsley <@mic_bardsley>
 */
class Generator
{
    /**
     * @var AbstractLanguage
     */
    private $language;

    /**
     * @var DateTime
     */
    private $time;

    public function __construct(AbstractLanguage $language = null)
    {
        $this->language = $language ?: new EnGb;
    }

    public function getFuzzyTime(DateTime $time = null)
    {
        $this->time = $time ?: new DateTime;
        $minutes = $this->getMinuteString();
        $divider = $this->getDividerString();
        $hour = $this->getHourString();
        $format = $this->getTimeFormat();
        $search = [':minutes', ':divider', ':hour'];
        $replace = [$minutes, $divider, $hour];
        $string = str_replace($search, $replace, $format);

        echo $string . PHP_EOL;
    }

    private function getMinuteString()
    {
        $time = $this->time->format('i.s');
        switch (true) {
            case ($time >= '00.00' && $time < '02.30'):
            case ($time >= '57.30' && $time <= '59.59'):
                //o'clock
                $minuteString = $this->language->getMinuteString('00');
                break;

            case ($time >= '02.30' && $time < '07.30'):
                //five
                $minuteString = $this->language->getMinuteString('05');
                break;

            case ($time >= '07.30' && $time < '12.30'):
                //ten
                $minuteString = $this->language->getMinuteString('10');
                break;

            case ($time >= '12.30' && $time < '17.30'):
                //fifteen
                $minuteString = $this->language->getMinuteString('15');
                break;

            case ($time >= '17.30' && $time < '22.30'):
                //twenty
                $minuteString = $this->language->getMinuteString('20');
                break;

            case ($time >= '22.30' && $time < '27.30'):
                //twenty five
                $minuteString = $this->language->getMinuteString('20') . ' ' . $this->language->getMinuteString('05');
                break;

            case ($time >= '27.30' && $time < '32.30'):
                //thirty
                $minuteString = $this->language->getMinuteString('30');
                break;

            case ($time >= '32.30' && $time < '37.30'):
                //thirty five
                $minuteString = $this->language->getMinuteString('20') . ' ' . $this->language->getMinuteString('05');
                break;

            case ($time >= '37.30' && $time < '42.30'):
                //forty
                $minuteString = $this->language->getMinuteString('40');
                break;

            case ($time >= '42.30' && $time < '47.30'):
                //forty five
                $minuteString = $this->language->getMinuteString('45');
                break;

            case ($time >= '47.30' && $time < '52.30'):
                //fifty
                $minuteString = $this->language->getMinuteString('50');
                break;

            case ($time >= '52.30' && $time < '57.30'):
                //fifty five
                $minuteString = $this->language->getMinuteString('55');
                break;

            default:
                throw new \InvalidArgumentException('Unable to calculate the number of minutes');
        }

        return $minuteString;
    }

    private function getDividerString()
    {
        $time = $this->time->format('i');
        switch (true) {
            case ($time >= '00.00' && $time < '02.30'):
            case ($time >= '57.30' && $time <= '59.59'):
                //o'clock
                $dividerString = $this->language->getDividerString(AbstractLanguage::ON_THE_HOUR);
                break;

            case ($time >= '02.30' && $time <= '30'):
                $dividerString = $this->language->getDividerString(AbstractLanguage::BEFORE_HALF_PAST);
                break;

            case ($time > '30' && $time < '57.30'):
                $dividerString = $this->language->getDividerString(AbstractLanguage::AFTER_HALF_PAST);
                break;

            default:
                throw new \InvalidArgumentException('Unable to find the divider incorrect time passed: ' . $time);
        }

        return $dividerString;
    }

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

    private function getTimeFormat()
    {
        $time = $this->time->format('i.s');
        switch (true) {
            case ($time >= '00.00' && $time < '02.30'):
            case ($time >= '57.30' && $time <= '59.59'):
                //o'clock
                $formatString = $this->language->getFormat(AbstractLanguage::ON_THE_HOUR);
                break;

            case ($time >= '02.30' && $time < '32.30'):
                $formatString = $this->language->getFormat(AbstractLanguage::BEFORE_HALF_PAST);
                break;

            case ($time >= '32.30' && $time < '57.30'):
                $formatString = $this->language->getFormat(AbstractLanguage::AFTER_HALF_PAST);
                break;

            default:
                throw new \InvalidArgumentException('Unknown time when getting the format: ' . $time);
        }

        return $formatString;
    }
}
