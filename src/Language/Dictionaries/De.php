<?php

namespace Mic2100\FuzzyTime\Language\Dictionaries;

use Mic2100\FuzzyTime\Language\AbstractLanguage;

/**
 * Class De
 *
 * Time translations for English (Great Britain)
 *
 * @package Mic2100\FuzzyTime\Language
 * @author Michael Bardsley <@mic_bardsley>
 */
class De extends AbstractLanguage
{
    /**
     * Represents the required minute entries for the languages
     *
     * @var array
     */
    protected $minutes = [
        '00' => '',
        '05' => 'fünf',
        '10' => 'zehn',
        '15' => 'viertel',
        '20' => 'zwanzig',
        '25' => 'fünfundzwanzig',
        '30' => 'halb',
        '35' => 'fünfundzwanzig',
        '40' => 'zwanzig',
        '45' => 'viertel',
        '50' => 'zehn',
        '55' => 'fünf',
    ];

    /**
     * Represents the required hour entries for the languages
     *
     * @var array
     */
    protected $hours = [
        '00' => 'zwölf',
        '01' => 'ein',
        '02' => 'zwei',
        '03' => 'drei',
        '04' => 'vier',
        '05' => 'fünf',
        '06' => 'sechs',
        '07' => 'sieben',
        '08' => 'acht',
        '09' => 'neun',
        '10' => 'zehn',
        '11' => 'elf',
        '12' => 'zwölf',
        '13' => 'ein',
        '14' => 'zwei',
        '15' => 'drei',
        '16' => 'vier',
        '17' => 'fünf',
        '18' => 'sechs',
        '19' => 'sieben',
        '20' => 'acht',
        '21' => 'neun',
        '22' => 'zehn',
        '23' => 'elf',
    ];


    /**
     * Represents the required divider entries for the languages
     *
     * Dividers are used to split a the hours and minutes
     *
     * e.g.
     * ten to five - the 'to' is the divider
     * quarter past six - the 'past' is the divider
     *
     * @var array
     */
    protected $divider = [
        self::ON_THE_HOUR => 'uhr',
        self::BEFORE_HALF_PAST => 'nach',
        self::AFTER_HALF_PAST => 'vor',
    ];

    /**
     * Represents the required formats that the variables need to be displayed in
     *
     * @var array
     */
    protected $formats = [
        self::ON_THE_HOUR => ':hour :divider',
        self::BEFORE_HALF_PAST => ':minutes :divider :hour',
        self::AFTER_HALF_PAST => ':minutes :divider :hour',
    ];
}
