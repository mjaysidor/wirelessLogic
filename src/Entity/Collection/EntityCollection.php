<?php
declare(strict_types=1);
namespace App\Entity\Collection;

use App\Entity\Entity;
use App\Serializer\ArrayToJsonSerializer;
use JsonException;

class EntityCollection
{
    /** @var Entity[]|array */
    private array $items = [];

    public function addItem(Entity $object): void
    {
        $this->items[] = $object;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function sortCollection(callable $callback): void
    {
        usort($this->items, $callback);
    }

    /**
     * @throws JsonException
     */
    public function toJson(): string
    {
        return ArrayToJsonSerializer::serialize($this->items);
    }
}