<?php
declare(strict_types=1);
namespace App\Entity\Item;

use App\Entity\Entity;
use App\Utils\MoneyConverter;
use JsonSerializable;

class Item implements Entity, JsonSerializable
{
    private string $title;

    private string $description;

    /**
     * Stored in cents (ex. 1USD = 100 cents) in order to avoid rounding errors
     */
    private int $price;

    /**
     * Stored in cents (ex. 1USD = 100 cents) in order to avoid rounding errors
     */
    private int $discount;

    public function __construct(string $title, string $description, int $price, int $discount)
    {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->discount = $discount;
    }

    public function toArray(): array
    {
        return [
            'title'       => $this->title,
            'description' => $this->description,
            'price'       => MoneyConverter::convertCentsToCurrency($this->price),
            'discount'    => MoneyConverter::convertCentsToCurrency($this->discount),
        ];
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDiscount(): int
    {
        return $this->discount;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}