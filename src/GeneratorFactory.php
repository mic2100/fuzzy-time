<?php

namespace Mic2100\FuzzyTime;

use Exception;
use InvalidArgumentException;
use Mic2100\FuzzyTime\Language\Dictionaries\English;
use Mic2100\FuzzyTime\Language\LanguageFactory;
use Mic2100\FuzzyTime\Language\LanguageInterface;

/**
 * Class GeneratorFactory
 *
 * @package Mic2100\FuzzyTime
 * @author Mike Bardsley <mic.bardsley@outlook.com>
 * @license MIT
 */
class GeneratorFactory
{
    /**
     * Gets the fuzzy time generator class
     *
     * @param LanguageInterface|null $language
     *
     * @return Generator
     * @throws Exception - If the handle is not set on the language class
     * @throws InvalidArgumentException - If an incorrect language is selected
     */
    public static function get(LanguageInterface $language = null): Generator
    {
        return new Generator($language ?? LanguageFactory::get(English::HANDLE));
    }
}
