<?php

namespace Mic2100\FuzzyTime\Language;

/**
 * Class EnGb
 *
 * Time translations for English (Great Britain)
 *
 * @package Mic2100\FuzzyTime\Language
 * @author Michael Bardsley <@mic_bardsley>
 */
class EnGb extends AbstractLanguage
{
    /**
     * Represents the required minute entries for the languages
     *
     * @var array
     */
    protected $minutes = [
        '00' => '',
        '05' => 'five',
        '10' => 'ten',
        '15' => 'quarter',
        '20' => 'twenty',
        '30' => 'half',
        '40' => 'twenty',
        '45' => 'quarter',
        '50' => 'ten',
        '55' => 'five',
    ];

    /**
     * Represents the required hour entries for the languages
     *
     * @var array
     */
    protected $hours = [
        '00' => 'twelve',
        '01' => 'one',
        '02' => 'two',
        '03' => 'three',
        '04' => 'four',
        '05' => 'five',
        '06' => 'six',
        '07' => 'seven',
        '08' => 'eight',
        '09' => 'nine',
        '10' => 'ten',
        '11' => 'eleven',
        '12' => 'twelve',
        '13' => 'one',
        '14' => 'two',
        '15' => 'three',
        '16' => 'four',
        '17' => 'five',
        '18' => 'six',
        '19' => 'seven',
        '20' => 'eight',
        '21' => 'nine',
        '22' => 'ten',
        '23' => 'eleven',
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
        self::ON_THE_HOUR => 'o\'clock',
        self::BEFORE_HALF_PAST => 'past',
        self::AFTER_HALF_PAST => 'to',
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
