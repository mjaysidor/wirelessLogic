<?php
declare(strict_types=1);
namespace App\Serializer;

use JsonException;

class ArrayToJsonSerializer
{
    /**
     * @throws JsonException
     */
    public static function serialize(array $array): string
    {
        return json_encode($array, JSON_THROW_ON_ERROR);
    }
}