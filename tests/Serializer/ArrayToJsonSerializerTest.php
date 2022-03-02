<?php
declare(strict_types=1);
namespace App\Tests\Serializer;

use App\Factory\ItemFactory;
use App\Serializer\ArrayToJsonSerializer;
use PHPUnit\Framework\TestCase;

class ArrayToJsonSerializerTest extends TestCase
{
    public function test(): void
    {
        $object = ItemFactory::createFromArray(['title' => 'asd', 'description' => 'asd', 'price' => 10000, 'discount' => 1000]);

        self::assertNotSame(
            '{"title":"zxc","description":"zxc","price":10,"discount":100}',
            ArrayToJsonSerializer::serialize($object->toArray())
        );

        self::assertSame(
            ArrayToJsonSerializer::serialize($object->toArray()),
            '{"title":"asd","description":"asd","price":100,"discount":10}'
        );
    }
}