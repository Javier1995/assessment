<?php 

namespace Sourcetoad\Service;

use Sourcetoad\Model\Address;
use Sourcetoad\Interface\ShippingRateService;

class FixedRateShipping implements ShippingRateService {
    public function getShippingRate(Address $address): float {
        return 10.00; // Placeholder shipping cost
    }
}