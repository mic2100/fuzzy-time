<?php

namespace Mic2100\FuzzyTime;

use Mic2100\FuzzyTime\Language\LanguageInterface;

/**
 * Class GeneratorFactory
 * @package Mic2100\FuzzyTime
 */
class GeneratorFactory
{
    /**
     * Gets the fuzzy time generator class
     *
     * @param LanguageInterface|null $language
     *
     * @return Generator
     */
    public static function get(LanguageInterface $language = null)
    {
        return new Generator($language);
    }
}
