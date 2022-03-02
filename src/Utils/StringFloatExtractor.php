<?php
declare(strict_types=1);
namespace App\Utils;

class StringFloatExtractor
{
    public static function extractDecimalsFromString(string $string): array
    {
        preg_match(
            '/\d+\.\d+/',
            $string,
            $floatsInString
        );

        return $floatsInString;
    }
}