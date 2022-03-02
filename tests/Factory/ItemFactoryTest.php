<?php
declare(strict_types=1);
namespace App\Tests\Factory;

use App\Entity\Item\Item;
use App\Factory\ItemFactory;
use PHPUnit\Framework\TestCase;

class ItemFactoryTest extends TestCase
{
    public function test(): void
    {
        /** @var Item $objects */
        $objects = [
            new Item('asd', 'asd', 100, 10),
            ItemFactory::createFromArray(['title' => 'asd', 'description' => 'asd', 'price' => 100, 'discount' => 10]),
        ];

        self::assertSame(
            $objects[0]->getTitle(),
            $objects[1]->getTitle(),
        );
        self::assertSame(
            $objects[0]->getDescription(),
            $objects[1]->getDescription(),
        );
        self::assertSame(
            $objects[0]->getPrice(),
            $objects[1]->getPrice(),
        );
        self::assertSame(
            $objects[0]->getDiscount(),
            $objects[1]->getDiscount(),
        );
    }
}