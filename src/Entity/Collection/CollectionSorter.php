<?php
declare(strict_types=1);
namespace App\Entity\Collection;

use App\Entity\Entity;

interface CollectionSorter
{
    public static function getDefaultSortCallback(Entity $a, Entity $b): bool;
}