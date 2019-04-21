<?php

namespace Mic2100\FuzzyTime\Language;

/**
 * Interface LanguageInterface
 *
 * @package Mic2100\FuzzyTime\Language
 * @author Mike Bardsley <mic.bardsley@outlook.com>
 * @license MIT
 */
interface LanguageInterface
{
    /**
     * @param string $minutes
     * @return string
     */
    public function getMinuteString(string $minutes): string;

    /**
     * @param string $hour
     * @return string
     */
    public function getHourString(string $hour): string;

    /**
     * @param int $key
     * @return string mixed
     */
    public function getDividerString(int $key): string;

    /**
     * @param int $key
     * @return string
     */
    public function getFormat(int $key): string;

    /**
     * @return array
     */
    public function getMinuteConfig(): array;

    /**
     * @return array
     */
    public function getDividerConfig(): array;

    /**
     * @return array
     */
    public function getTimeFormatConfig(): array;
}
