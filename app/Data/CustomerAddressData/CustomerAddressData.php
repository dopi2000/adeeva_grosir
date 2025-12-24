<?php
declare(strict_types=1);

namespace App\Data\CustomerAddressData;

use App\Models\UserAddress;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class CustomerAddressData extends Data
{
    #[Computed]
    public string $label;

    public function __construct(
        public string $street_name,
        public string $province,
        public string $city,
        public string $district,
        public string $village,
        public string $postal_code
    ) {
        $this->label = "$street_name, $village, $district, $city, $province, $postal_code";
    }

    public static function formModel(UserAddress $address) : self {
        return new self(
            street_name: $address->street_name,
            province: $address->province,
            city: $address->city,
            district: $address->district,
            village: $address->village,
            postal_code: $address->postal_code
        );
    }
}
