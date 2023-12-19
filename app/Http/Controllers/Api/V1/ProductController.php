<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Requests\Product\ProductList;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductService $productService;

    /**
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ProductList $request): array
    {
        $search = data_get($request, 'search', '');
        $page = (int)data_get($request, 'page',-1);
        return $this->productService->getAllProducts($search,$page);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreProductRequest $productRequest):array
    {
        return $this->productService->createProduct($productRequest);
    }

    public function category(CategoryRequest $request): array
    {
        return $this->productService->showProductsByCategory($request->categoryId);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductRequest $product): array
    {

        return $this->productService->showProduct((int)$product->productId);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request):array
    {
        return $this->productService->updateProduct($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductRequest $product):array
    {
        return $this->productService->destroyProduct($product->productId);
        //
    }

    /*
     * Display a listing of products
     *   'id' => ['eq', 'ne'],
        'name' => ['eq', 'lk'],
        'description' => ['lk'],
        'price' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'currency' => ['eq', 'ne'],
        'isActive' => ['eq', 'ne'],
        'categoryId' => ['eq', 'ne']
    Example
    ?name[eq]=Ahmet

         'eq' => '=',
        'lt' => '<',
        'gt' => '>',
        'lte' => '<=',
        'gte' => '>=',
        'ne' => '!=',
        'lk' => 'LIKE'
     *
     * */
    public function filterQuery(Request $request):array{
      //  return $request->toArray();
        return $this->productService->filterQuery($request);
    }
}
