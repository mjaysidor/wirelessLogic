<?php
declare(strict_types=1);
namespace App\Tests\Utils;

use App\Utils\MoneyConverter;
use App\Utils\StringFloatExtractor;
use PHPUnit\Framework\TestCase;

class StringFloatExtractorTest extends TestCase
{
    public function test(): void
    {
        self::assertNotSame(
            StringFloatExtractor::extractDecimalsFromString('Sample string 1.23 with float')[0],
            '2.31'
        );
        self::assertSame(
            StringFloatExtractor::extractDecimalsFromString('Sample string 1.23 with float')[0],
            '1.23'
        );
    }
}