<?php

namespace Mic2100Test;

use DateTime;
use Mic2100\FuzzyTime\Generator;
use Mic2100\FuzzyTime\GeneratorFactory;
use PHPUnit\Framework\TestCase;

class GeneratorTest extends TestCase
{
    /**
     * @var Generator
     */
    private $generator;

    /**
     * @throws \Exception
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->generator = GeneratorFactory::get();
    }

    /**
     * @param DateTime $time
     * @param string $expectedResponse
     *
     * @dataProvider dataFuzzyTimeDates
     * @throws \Exception
     */
    public function testGetFuzzyTimeExpectSuccess(DateTime $time, string $expectedResponse)
    {
        $repsonse = $this->generator->getFuzzyTime($time);

        $this->assertSame($expectedResponse, $repsonse);
    }

    public function dataFuzzyTimeDates(): array
    {
        return [
            [new DateTime('2019-01-01 00:00:00'), 'twelve o\'clock'],
            [new DateTime('2019-01-02 01:30:00'), 'half past one'],
            [new DateTime('2019-01-03 05:45:00'), 'quarter to six'],
            [new DateTime('2019-01-04 09:15:00'), 'quarter past nine'],

            [new DateTime('2019-01-02 01:00:00'), 'one o\'clock'],
            [new DateTime('2019-01-02 01:05:00'), 'five past one'],
            [new DateTime('2019-01-02 01:10:00'), 'ten past one'],
            [new DateTime('2019-01-02 01:15:00'), 'quarter past one'],
            [new DateTime('2019-01-02 01:20:00'), 'twenty past one'],
            [new DateTime('2019-01-02 01:25:00'), 'twenty five past one'],
            [new DateTime('2019-01-02 01:30:00'), 'half past one'],
            [new DateTime('2019-01-02 01:35:00'), 'twenty five to two'],
            [new DateTime('2019-01-02 01:40:00'), 'twenty to two'],
            [new DateTime('2019-01-02 01:45:00'), 'quarter to two'],
            [new DateTime('2019-01-02 01:50:00'), 'ten to two'],
            [new DateTime('2019-01-02 01:55:00'), 'five to two'],
        ];
    }
}
