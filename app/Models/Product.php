<?php

namespace App\Models;

use App\Enums\PriceType;
use App\States\SalesOrder\Completed;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\HasTags;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia, HasTags;

    protected $fillable = ['name', 'sku', 'slug', 'type', 'description', 'stock', 'price', 'weight'];

    protected $casts = [
        'type' => PriceType::class
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('cover')
            ->fit(Fit::Contain, 400, 400)
            ->nonQueued();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')->useDisk('public');
        $this->addMediaCollection('gallery')->useDisk('public');
    }

    public function salesOrderItems() : HasMany {
        return $this->hasMany(SalesOrderItem::class, 'product_id');
    }

    public function scopeSoldItem($query) {
        return $query->withSum(
            ['salesOrderItems as total_terjual' => function($q) 
                {
                    $q->whereHas('salesOrder', fn($sq) => $sq->where('status', Completed::class));
                }
            ], 'quantity');
    }

}
