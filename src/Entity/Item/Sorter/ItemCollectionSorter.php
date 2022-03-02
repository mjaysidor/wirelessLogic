<?php
declare(strict_types=1);
namespace App\Entity\Item\Sorter;

use App\Entity\Collection\CollectionSorter;
use App\Entity\Entity;

class ItemCollectionSorter implements CollectionSorter
{
    /**
     * Sorts by price descending
     */
    public static function getDefaultSortCallback(Entity $a, Entity $b): bool
    {
        return $a->getPrice() < $b->getPrice();
    }
}