<?php
declare(strict_types=1);

namespace App\Data\RegionData;

use App\Models\Region;
use Spatie\LaravelData\Data;

class RegionData extends Data
{
    public function __construct(
        public string $code,
        public string $province,
        public string $city,
        public string $district,
        public string $village,
        public string $postal_code,
        public string $country = 'indonesia'
    ) {

    }

    public static function fromModel(Region $region) : self {
        return new self(
            code: $region->code,
            province: $region->parent->parent->parent->name,
            city: $region->parent->parent->name,
            district: $region->parent->name,
            village: $region->name,
            postal_code: $region->postal_code
        );
    }
}
