<?php

namespace Sourcetoad\Interface;

use Sourcetoad\Model\Address;

interface ShippingRateService {
    public function getShippingRate(Address $address): float;
}
