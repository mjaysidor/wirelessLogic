<?php
declare(strict_types=1);
namespace App\Utils;

class MoneyConverter
{
    public static function convertStringPriceToIntegerCents(string $stringPrice): int
    {
        return (int)((float)$stringPrice * 100);
    }

    public static function convertCentsToCurrency(int $cents): float
    {
        return (float)($cents / 100);
    }
}