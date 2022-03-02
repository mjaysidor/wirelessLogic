<?php
declare(strict_types=1);
namespace App\Utils;

class MoneyConverter
{
    public static function convertStringPriceToIntegerCents(string $stringPrice): int
    {
        $multiplication = ((float)$stringPrice) * 100;

        return (int)round($multiplication);
    }

    public static function convertCentsToCurrency(int $cents): float
    {
        return (float)($cents / 100);
    }
}