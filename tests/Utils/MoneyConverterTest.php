<?php
declare(strict_types=1);
namespace App\Tests\Utils;

use App\Utils\MoneyConverter;
use PHPUnit\Framework\TestCase;

class MoneyConverterTest extends TestCase
{
    public function test(): void
    {
        $this->testCentToCurrencyConversion();
        $this->testStringToIntegerConversion();
    }

    private function testStringToIntegerConversion(): void
    {
        self::assertNotSame(
            MoneyConverter::convertStringPriceToIntegerCents('103.33'),
            1234
        );
        self::assertSame(
            MoneyConverter::convertStringPriceToIntegerCents('100.33'),
            10033
        );
    }

    private function testCentToCurrencyConversion(): void
    {
        self::assertNotSame(
            MoneyConverter::convertCentsToCurrency(12000),
            111.23
        );
        self::assertSame(
            MoneyConverter::convertCentsToCurrency(12000),
            120.00
        );
    }
}