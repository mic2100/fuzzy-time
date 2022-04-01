<?php

namespace Mic2100\FuzzyTime\Language;

use Mic2100\FuzzyTime\Exceptions\LanguageException;
use Mic2100\FuzzyTime\Language\Dictionaries\German;
use Mic2100\FuzzyTime\Language\Dictionaries\English;

/**
 * Class LanguageFactory
 *
 * @package Mic2100\FuzzyTime\Language
 * @author Mike Bardsley <mic.bardsley@outlook.com>
 * @license MIT
 */
class LanguageFactory
{
    /**
     * Gets the language class based on the class handles
     *
     * @param string $language
     *
     * @return LanguageInterface
     * @throws LanguageException - If an incorrect language is selected
     */
    public static function get(string $language): LanguageInterface
    {
        switch ($language) {
            case English::HANDLE:
                return new English();

            case German::HANDLE:
                return new German();

            default:
                throw LanguageException::invalidLanguageSelected($language);
        }
    }
}
