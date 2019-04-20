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
    public function getMinuteString(string $minutes);

    public function getHourString(string $hour);

    public function getDividerString(int $key);

    public function getFormat(int $key);
}
