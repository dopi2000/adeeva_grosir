<?php

declare(strict_types=1);
namespace App\Services\Region;

use App\Data\RegionData\RegionData;
use App\Models\Region;
use Spatie\LaravelData\DataCollection;


class RegionQueryService {

    public function searchRegionByName(string $keyword) : DataCollection {
        $regions = Region::where('type', 'village')
        ->where(function($query) use ($keyword) {

            $query->where('name', 'LIKE', "%$keyword%")
            ->orWhere('postal_code', 'LIKE', "%$keyword%")
            ->orWhereHas('parent', function($query) use ($keyword) {

                $query->where('name', 'LIKE', "%$keyword%");

            })
            ->orWhereHas('parent.parent', function($query) use ($keyword) {

                $query->where('name', 'LIKE', "%$keyword%");

            })
            ->orWhereHas('parent.parent.parent', function($query) use ($keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
            });
            
        })->with(['parent.parent.parent'])->first();

        return new DataCollection(RegionData::class, $regions);
    }

    public function searchRegionByCode(string $code) : RegionData {
        return RegionData::fromModel(Region::where('code', $code)->first());
    }
 }