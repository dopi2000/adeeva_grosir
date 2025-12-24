<?php
declare(strict_types=1);

namespace App\Livewire\Frontend;

use App\Models\Tag;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use App\Data\ProductCatalogData;
use App\Data\ProductCategoryData;
use Livewire\Attributes\On;

class ProductCatalog extends Component
{
    use WithPagination;

    public $queryString = [
        'select_category' => ['except' =>[]],
        'search' => ['except' => []],
        'sort_by' => ['except' =>'newest']
    ];

    public array $select_category = [];
    public string $search = '';
    public string $sort_by = 'newest';

    public function mount() {
        $this->validate();
    }

    public function applyFilters(){
        $this->validate();
        $this->resetPage();
    }

    public function resetFilters() {
        $this->reset(['select_category', 'search', 'sort_by']);
        $this->resetPage();
        $this->resetErrorBag();
    }

    protected function rules() {
        return [
            'select_category' => 'array',
            'select_category.*' => 'integer|exists:tags,id',
            'search' => 'nullable|string|max:50',
            'sort_by' => 'in:newest,latest,price_asc,price_desc'
        ];
    }

    protected function messages()
    {
        return [
            'select_category.array' => 'Kategori yang dipilih tidak valid.',
            'select_category.*.integer' => 'Kategori yang dipilih tidak valid.',
            'select_category.*.exists' => 'Kategori yang dipilih tidak valid.',
            'search.string' => 'Kolom pencarian harus berupa teks.',
            'search.max' => 'Kolom pencarian maksimal 50 karakter.',
            'sort_by.in' => 'Pilihan opsi sortir tidak valid.',
        ];
    }


    public function updated() {
        $this->validate();
        $this->resetPage();
    }

    // #[On('cart-count-updated')]
    // public function toastAddToCartSuccess() {
    //     return redirect(request()->header('Referer'))->with('status', 'Produk berhasil ditambahkan ');
    //     return redirect()->route('product.catalog')->with('status', "Produk berhasil masuk di keranjang belanja");
    // }
    
    public function render()
    {

        if($this->getErrorBag()->isNotEmpty()) {
            $products = ProductCatalogData::collect([]);
            $categories = ProductCategoryData::collect([]);
            return view('livewire.frontend.product-catalog', compact('products', 'categories'));
        }

        $category_result = Tag::query()->withType('collection')->withCount('products')->get();
        $query = Product::query();

        if($this->search) {
            $query->where('name', 'LIKE', "%$this->search%");
        }

        if(!empty($this->select_category)) {
            $query->whereHas('tags', function($query) {
                $query->whereIn('id', $this->select_category);
            });
        }
        switch ($this->sort_by) {
            case 'latest':
                $query->latest();
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->oldest();
                break;
        }

        $products = ProductCatalogData::collect($query->paginate(6));
        $categories = ProductCategoryData::collect($category_result);
        return view('livewire.frontend.product-catalog', compact('products', 'categories'));
    }
}
