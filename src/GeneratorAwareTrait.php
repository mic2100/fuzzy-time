<?php

namespace Mic2100\FuzzyTime;

use DateTime;
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
     * @param DateTime|null $time
     * @param LanguageInterface|null $language
     *
     * @return string
     * @throws InvalidArgumentException -
     * @throws Exception
     */
    public function getFuzzyTime(DateTime $time = null, LanguageInterface $language = null): string
    {
        return (new Generator(
            $language ?? LanguageFactory::get(English::HANDLE)
        ))->getFuzzyTime($time ?? new DateTime('now'));
    }
}
