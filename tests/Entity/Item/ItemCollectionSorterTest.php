<?php
declare(strict_types=1);
namespace App\Tests\Entity\Item;

use App\Entity\Collection\EntityCollection;
use App\Entity\Item\Sorter\ItemCollectionSorter;
use App\Factory\ItemFactory;
use PHPUnit\Framework\TestCase;

class ItemCollectionSorterTest extends TestCase
{
    public function test(): void
    {
        $collection = new EntityCollection();

        $collection->addItem(ItemFactory::createFromArray(['title' => 'x', 'description' => 'x', 'price' => 440, 'discount' => 17]));
        $collection->addItem(ItemFactory::createFromArray(['title' => 'z', 'description' => 'z', 'price' => 821, 'discount' => 22]));
        $collection->addItem(ItemFactory::createFromArray(['title' => 'w', 'description' => 'w', 'price' => 671, 'discount' => 33]));


        $this->testDescendingPriceSort($collection);
    }

    private function testDescendingPriceSort(EntityCollection $collection): void
    {
        $collection->sortCollection(fn($a, $b) => ItemCollectionSorter::getDefaultSortCallback($a, $b));

        self::assertNotSame(
            440,
            $collection->getItems()[0]->getPrice(),
        );
        self::assertNotSame(
            440,
            $collection->getItems()[1]->getPrice(),
        );
        self::assertNotSame(
            821,
            $collection->getItems()[1]->getPrice(),
        );
        self::assertNotSame(
            671,
            $collection->getItems()[2]->getPrice(),
        );

        self::assertSame(
            821,
            $collection->getItems()[0]->getPrice(),
        );
        self::assertSame(
            671,
            $collection->getItems()[1]->getPrice(),
        );
        self::assertSame(
            440,
            $collection->getItems()[2]->getPrice(),
        );
    }
}