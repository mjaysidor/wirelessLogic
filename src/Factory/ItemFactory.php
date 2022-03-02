<?php
declare(strict_types=1);
namespace App\Factory;

use App\Entity\Item\Item;

class ItemFactory
{
    public static function createFromArray(array $array): Item
    {
        return new Item(
            $array['title'],
            $array['description'],
            $array['price'],
            $array['discount'],
        );
    }
}