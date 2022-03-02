<?php
declare(strict_types=1);
namespace App\Tests\Entity\Collection;

use App\Entity\Collection\EntityCollection;
use App\Factory\ItemFactory;
use PHPUnit\Framework\TestCase;

class EntityCollectionTest extends TestCase
{
    public function test(): void
    {
        $collection = new EntityCollection();

        $collection->addItem(ItemFactory::createFromArray(['title' => 'b', 'description' => 'b', 'price' => 200, 'discount' => 20]));
        $collection->addItem(ItemFactory::createFromArray(['title' => 'a', 'description' => 'a', 'price' => 100, 'discount' => 10]));
        $collection->addItem(ItemFactory::createFromArray(['title' => 'c', 'description' => 'c', 'price' => 300, 'discount' => 30]));

        $this->testDescendingDiscountSort($collection);
        $this->testAscendingDiscountSort($collection);
    }

    private function testDescendingDiscountSort(EntityCollection $collection): void
    {
        $collection->sortCollection(fn($a, $b) => $a->getDiscount() < $b->getDiscount());

        self::assertNotSame(
            10,
            $collection->getItems()[0]->getDiscount(),
        );
        self::assertNotSame(
            10,
            $collection->getItems()[1]->getDiscount(),
        );
        self::assertNotSame(
            30,
            $collection->getItems()[1]->getDiscount(),
        );
        self::assertNotSame(
            30,
            $collection->getItems()[2]->getDiscount(),
        );

        self::assertSame(
            30,
            $collection->getItems()[0]->getDiscount(),
        );
        self::assertSame(
            20,
            $collection->getItems()[1]->getDiscount(),
        );
        self::assertSame(
            10,
            $collection->getItems()[2]->getDiscount(),
        );
    }

    private function testAscendingDiscountSort(EntityCollection $collection): void
    {
        $collection->sortCollection(fn($a, $b) => $a->getDiscount() > $b->getDiscount());

        self::assertNotSame(
            30,
            $collection->getItems()[0]->getDiscount(),
        );
        self::assertNotSame(
            10,
            $collection->getItems()[1]->getDiscount(),
        );
        self::assertNotSame(
            30,
            $collection->getItems()[1]->getDiscount(),
        );
        self::assertNotSame(
            10,
            $collection->getItems()[2]->getDiscount(),
        );

        self::assertSame(
            10,
            $collection->getItems()[0]->getDiscount(),
        );
        self::assertSame(
            20,
            $collection->getItems()[1]->getDiscount(),
        );
        self::assertSame(
            30,
            $collection->getItems()[2]->getDiscount(),
        );
    }
}