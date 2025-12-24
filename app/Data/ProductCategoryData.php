<?php
declare(strict_types=1);

namespace App\Data;

use App\Models\Tag;
use Spatie\LaravelData\Data;

class ProductCategoryData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $slug,
        public int $product_count
    ) {}

    public static function fromModel(Tag $category) : self {
        return new self(
            $category->id,
            (String)$category->name,
            (String)$category->slug,
            $category->products_count
        );
    }
}
