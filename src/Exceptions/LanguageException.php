<?php

namespace Mic2100\FuzzyTime\Exceptions;

use Exception;

class LanguageException extends Exception
{
    /**
     * @param string $language
     * @return static
     */
    public static function invalidLanguageSelected(string $language): self
    {
        return new static(sprintf('An invalid language was selected: %s', $language));
    }

    /**
     * @param string $className
     * @return static
     */
    public static function invalidHandle(string $className): self
    {
        return new static(sprintf('Class: %s must have and handle set', $className));
    }

    /**
     * @param string $minutes
     * @return static
     */
    public static function invalidMinutes(string $minutes): self
    {
        return new static(sprintf('Invalid minutes passed: %s', $minutes));
    }

    /**
     * @param string $hour
     * @return static
     */
    public static function invalidHours(string $hour): self
    {
        return new static(sprintf('Invalid hour passed: %s', $hour));
    }

    /**
     * @param string $divider
     * @return static
     */
    public static function invalidDivider(string $divider): self
    {
        return new static(sprintf('Invalid divider key passed: %s', $divider));
    }

    /**
     * @param string $format
     * @return static
     */
    public static function invalidFormat(string $format): self
    {
        return new static(sprintf('Invalid format key passed: %s', $format));
    }
}