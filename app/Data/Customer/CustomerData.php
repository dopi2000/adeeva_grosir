<?php

namespace App\Data\Customer;

use Spatie\LaravelData\Data;

class CustomerData extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public string $phone,
    ) {}
}
