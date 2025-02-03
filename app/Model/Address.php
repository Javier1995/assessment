<?php

namespace Sourcetoad\Model;
class Address {
    public function __construct(
        public string $line_1 = '',
        public ?string $line_2 = null,
        public string $city = '',
        public string $state = '',
        public string $zip = ''
    ) {}

    public function setLine1(string $line_1): self {
        $this->line_1 = $line_1;
        return $this;
    }

    public function setLine2(?string $line_2): self {
        $this->line_2 = $line_2;
        return $this;
    }

    public function setCity(string $city): self {
        $this->city = $city;
        return $this;
    }

    public function setState(string $state): self {
        $this->state = $state;
        return $this;
    }

    public function setZip(string $zip): self {
        $this->zip = $zip;
        return $this;
    }

    

}