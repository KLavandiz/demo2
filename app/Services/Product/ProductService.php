<?php

namespace App\Services\Product;

use App\Interfaces\Product\IProduct;
use Illuminate\Http\Request;

class ProductService
{
    private IProduct $product;

    /**
     * @param IProduct $product
     */
    public function __construct(IProduct $product)
    {
        $this->product = $product;
    }


    public function getAllProducts(string $search, int $page):array{
        return $this->product->getAllProducts($search, $page);
    }
    public function createProduct(Request $request):array{
        return $this->product->createProduct($request);
    }

    public function showProductsByCategory(int $id):array{
        return $this->product->showProductsByCategory($id);
    }

    public function showProduct(int $id):array{
        return $this->product->showProduct($id);
    }

    public function destroyProduct(int $id):array{
        return $this->product->destroyProduct($id);
    }

    public function updateProduct(Request $request):array{
        return $this->product->updateProduct($request);
    }

    public function filterQuery(Request $request):array{
        return $this->product->filterQuery($request);
    }


}
