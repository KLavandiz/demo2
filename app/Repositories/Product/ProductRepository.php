<?php

namespace App\Repositories\Product;

use App\DTO\RequestDTO;
use App\Filters\V1\Product\ProductFilters;
use App\Http\Resources\Product\ProductCollection;
use App\Interfaces\Product\IProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductRepository implements IProduct
{
    private RequestDTO $requestDTO;
    private ProductFilters $filters;

    /**
     * @param RequestDTO $requestDTO
     */
    public function __construct(RequestDTO $requestDTO, ProductFilters $filters)
    {
        $this->requestDTO = $requestDTO;
        $this->filters = $filters;
    }

    public function getAllProducts(string $search, int $page): array
    {
        if($page>0) {
            $products = Product::with(['category', 'getCurrency'])->where('name', 'LIKE', '%' . $search . '%')->orWhere('description', 'LIKE', '%' . $search . '%')->paginate($page);
        }else{
            $products = Product::with(['category', 'getCurrency'])->where('name', 'LIKE', '%' . $search . '%')->orWhere('description', 'LIKE', '%' . $search . '%')->get();

        }
        if (!$products->count()) {
            $this->requestDTO->setMessage(__('product.notFound'));
            $this->requestDTO->setCode(1);
            $this->requestDTO->setData([]);
            return $this->requestDTO->toArray();
        }

        $this->requestDTO->setCode(-1);
        $repo = new ProductCollection($products);
        $this->requestDTO->setData($repo->getArray());
        return $this->requestDTO->toArray();
    }

    public function showProductsByCategory(int $id): array
    {

        $products = Product::with(['category', 'getCurrency'])->where('category_id', '=', $id)->get();
        if (!$products->count()) {
            $this->requestDTO->setMessage(__('product.notFound'));
            $this->requestDTO->setCode(1);
            $this->requestDTO->setData([]);
            return $this->requestDTO->toArray();
        }

        $this->requestDTO->setCode(-1);
        $repo = new ProductCollection($products);
        $this->requestDTO->setData($repo->getArray());
        return $this->requestDTO->toArray();
    }

    public function createProduct(Request $request): array
    {
        $image = data_get($request, 'image');
        if(!$image==null) {
            $image = $request->file('image')->store('public/images/products');

        }
        $createProduct = Product::create([
            'name' => data_get($request, 'name'),
            'description' => data_get($request, 'description'),
            'image' => $image,
            'price' => data_get($request, 'price'),
            'currency_id' => data_get($request, 'currencyId'),
            'category_id' => data_get($request, 'categoryId'),

        ]);

        if (!$createProduct) {
            $this->requestDTO->setMessage(__('product.notCreated'));
            $this->requestDTO->setCode(1);
            $this->requestDTO->setData([]);
            return $this->requestDTO->toArray();
        }

        $this->requestDTO->setCode(-1);
        $this->requestDTO->setData($createProduct);
        return $this->requestDTO->toArray();
    }

    public function showProduct(int $id): array
    {
        $products = Product::with(['category', 'getCurrency'])->where('id', '=', $id)->get();
        if (!$products->count()) {
            $this->requestDTO->setMessage(__('product.notFound'));
            $this->requestDTO->setCode(1);
            $this->requestDTO->setData([]);
            return $this->requestDTO->toArray();
        }

        $this->requestDTO->setCode(-1);
        $repo = new ProductCollection($products);
        $this->requestDTO->setData($repo->getArray());
        return $this->requestDTO->toArray();
    }

    public function destroyProduct(int $id): array
    {
        $result = Product::find($id);

        if (!$result) {
            $this->requestDTO->setMessage(__('product.notFound'));
            $this->requestDTO->setCode(1);
            $this->requestDTO->setData([]);
            return $this->requestDTO->toArray();
        }
        Product::destroy($id);
        $this->requestDTO->setCode(-1);
        $this->requestDTO->setData($result);
        return $this->requestDTO->toArray();
    }

    public function updateProduct(Request $request): array
    {
        $image = data_get($request, 'image');
        if(!$image==null) {
            $image = $request->file('image')->store('public/images/products');

        }

        $check = Product::query()->where('id', '=', $request->productId)->first();

        if (!$check) {
            $this->requestDTO->setMessage(__('product.notFound'));
            $this->requestDTO->setCode(1);
            $this->requestDTO->setData([]);
            return $this->requestDTO->toArray();
        }

        $check->name = data_get($request, 'name', $check->name);
        $check->description = data_get($request, 'description', $check->description);
        $check->image = $image;
        $check->price = data_get($request, 'price', $check->price);
        $check->currency_id = data_get($request, 'currency_id', $check->currency_id);
        $check->category_id = data_get($request, 'category_id', $check->category_id);

        $check->save();
        $this->requestDTO->setCode(-1);
        $this->requestDTO->setData($check);
        return $this->requestDTO->toArray();


    }

    public function filterQuery(Request $request): array
    {

        $queryitems = $this->filters->transform($request);


        if (!count($queryitems)) {
            $this->requestDTO->setMessage(__('product.notFound'));
            $this->requestDTO->setCode(1);
            $this->requestDTO->setData([]);
            return $this->requestDTO->toArray();
        }


        $products = Product::with(['category', 'getCurrency'])->where($queryitems)->get();

        if (!$products->count()) {
            $this->requestDTO->setMessage(__('product.notFound'));
            $this->requestDTO->setCode(1);
            $this->requestDTO->setData([]);
            return $this->requestDTO->toArray();
        }

        $this->requestDTO->setCode(-1);
        $repo = new ProductCollection($products);
        $this->requestDTO->setData($repo->getArray());
        return $this->requestDTO->toArray();

    }
}
