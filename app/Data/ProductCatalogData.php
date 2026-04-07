<?php
declare(strict_types=1);

namespace App\Data;

use App\Enums\PriceType;
use App\Models\Product;
use Illuminate\Support\Number;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class ProductCatalogData extends Data
{
    #[Computed]
    public string $price_formatted;

    public function __construct(
        public int $product_id,
        public string $name,
        public string $category,
        public string $sku,
        public string $slug,
        public PriceType $type,
        public string|Optional|null $description,
        public int $stock,
        public float $price,
        public int $weight,
        public string $cover_url,
        public Optional|array $gallery = new Optional(),
        public int|Optional|null $total_terjual

    ) {
        $this->price_formatted = Number::currency($price, locale:'id');
    }

    public static function fromModel(Product $product, bool $with_gallery = false) :self {
        return new self(
            $product->id,
            $product->name,
            $product->tags->where('type', 'collection')->pluck('name')->implode(', '),
            $product->sku,
            $product->slug,
            $product->type,
            $product->description,
            $product->stock,
            FloatVal($product->price),
            $product->weight,
            $product->getFirstMediaUrl('cover'),
            gallery: $with_gallery ? $product->getMedia('gallery')->map(fn($record) => $record->getUrl())->toArray() : new Optional(),
            total_terjual: (int) ($product->total_terjual ?? 0)
        );
    }
}
