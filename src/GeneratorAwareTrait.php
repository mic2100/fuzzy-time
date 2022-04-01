<?php

namespace Mic2100\FuzzyTime;

use DateTimeImmutable;
use DateTimeInterface;
use Exception;
use InvalidArgumentException;
use Mic2100\FuzzyTime\Language\Dictionaries\English;
use Mic2100\FuzzyTime\Language\LanguageFactory;
use Mic2100\FuzzyTime\Language\LanguageInterface;

/**
 * Trait GeneratorAwareTrait
 *
 * @package Mic2100\FuzzyTime
 * @author Mike Bardsley <mic.bardsley@outlook.com>
 * @license MIT
 */
trait GeneratorAwareTrait
{
    /**
     * Gets the fuzzy time string or throws an exception
     *
     * @param DateTimeInterface|null $time
     * @param LanguageInterface|null $language
     *
     * @return string
     * @throws InvalidArgumentException -
     * @throws Exception
     */
    public function getFuzzyTime(?DateTimeInterface $time = null, ?LanguageInterface $language = null): string
    {
        $selectedLanguage = $language ?? LanguageFactory::get(English::HANDLE);

        return GeneratorFactory::get($selectedLanguage)->getFuzzyTime($time ?? new DateTimeImmutable('now'));
    }
}
