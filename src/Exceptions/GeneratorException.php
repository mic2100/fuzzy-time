<?php

namespace Mic2100\FuzzyTime\Exceptions;

use Exception;

class GeneratorException extends Exception
{
    /**
     * @param string $functionName
     * @param string $formattedTime
     * @return static
     */
    public static function failedToGetTimeConfig(string $functionName, string $formattedTime): self
    {
        return new static(sprintf('Function: %s failed to get the time for: %s', $functionName, $formattedTime));
    }
}