<?php

namespace Sourcetoad\Service;

use Sourcetoad\Model\Item;
use Sourcetoad\Model\Address;
use Sourcetoad\Model\Customer;
use Sourcetoad\Interface\ShippingRateService;

class Cart {
    private array $items = [];
    private const TAX_RATE = 0.07;
    private Customer $customer;
    private Address $shippingAddress;
    private ShippingRateService $shippingRateService;

    public function __construct(Customer $customer, Address $shippingAddress, ShippingRateService $shippingRateService) {
        $this->customer = $customer;
        $this->shippingAddress = $shippingAddress;
        $this->shippingRateService = $shippingRateService;
    }

    public function addItem(Item $item): void {
        $this->items[] = $item;
    }

    public function getSubtotal(): float {
        return array_reduce($this->items, fn($sum, $item) => $sum + $item->getTotalCost(), 0);
    }

    public function getTax(): float {
        return $this->getSubtotal() * self::TAX_RATE;
    }

    public function getShippingCost(): float {
        return $this->shippingRateService->getShippingRate($this->shippingAddress); 
    }

    public function getTotal(): float {
        return $this->getSubtotal() + $this->getTax() + $this->getShippingCost();
    }

    
}