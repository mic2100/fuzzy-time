<?php

namespace Mic2100\FuzzyTime\Language;

/**
 * Interface LanguageInterface
 *
 * @package Mic2100\FuzzyTime\Language
 * @author Michael Bardsley <@mic_bardsley>
 */
interface LanguageInterface
{
    public function getMinuteString($minutes);

    public function getHourString($hour);

    public function getDividerString($key);
}
