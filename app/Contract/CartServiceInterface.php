<?php
declare(strict_types=1);

namespace App\Contract;

use App\Data\CartDatas\CartData;
use App\Data\CartDatas\CartItemData;

interface CartServiceInterface
{
    public function addOrUpdate(CartItemData $item) : void;

    public function remove(string $sku) : void;

    public function getItemBySku(string $sku) : ?CartItemData;

    public function all() : CartData;

}
