<?php
namespace Sourcetoad\Model;
class Customer {
    public array $addresses = [];
    
    public function __construct(
        public string $first_name,
        public string $last_name
    ) {}

    public function addAddress(Address $address): void {
        $this->addresses[] = $address;
    }
}