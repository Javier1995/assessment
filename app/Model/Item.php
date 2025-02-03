<?php
namespace Sourcetoad\Model;
class Item {
    public function __construct(
        public int $id,
        public string $name,
        public int $quantity,
        public float $price
    ) {}

    public function getTotalCost(): float {
        return $this->quantity * $this->price;
    }
}