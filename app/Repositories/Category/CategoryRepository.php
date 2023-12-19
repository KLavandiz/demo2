<?php

namespace App\Repositories\Category;

use App\DTO\RequestDTO;
use App\Http\Resources\Category\CategoryCollection;
use App\Interfaces\Category\ICategory;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryRepository implements ICategory
{

    private RequestDTO $requestDTO;

    /**
     * @param RequestDTO $requestDTO
     */
    public function __construct(RequestDTO $requestDTO)
    {
        $this->requestDTO = $requestDTO;
    }

    public function getAllCategories(string $search): array
    {

        $categories = Category::query()->where('category_name', 'LIKE', '%' . $search . '%')->get();
        if (!$categories->count()) {
            $this->requestDTO->setMessage(__('product.notFound'));
            $this->requestDTO->setCode(1);
            $this->requestDTO->setData([]);
            return $this->requestDTO->toArray();
        }

        $this->requestDTO->setCode(-1);
        $dtoCollection = new CategoryCollection($categories);
        $this->requestDTO->setData($dtoCollection->getArray());
        return $this->requestDTO->toArray();
    }

    public function createCategory(Request $request): array
    {
        $check = Category::query()->where('category_name', '=', $request->category_name)->first();
        if ($check) {
            $this->requestDTO->setMessage(__('category.duplicate'));
            $this->requestDTO->setCode(1);
            $this->requestDTO->setData([]);
            return $this->requestDTO->toArray();
        }
        $newCategory = Category::create([
            'category_name' => $request->category_name,
            'description' => data_get($request, 'category_description', ' '),
        ]);

        if (!$newCategory) {
            $this->requestDTO->setMessage(__('category.error'));
            $this->requestDTO->setCode(1);
            $this->requestDTO->setData([]);
            return $this->requestDTO->toArray();
        }

        $this->requestDTO->setCode(-1);
        $this->requestDTO->setData($newCategory->id);
        return $this->requestDTO->toArray();

    }

    public function showCategory(int $id): array
    {
        $check = Category::find($id);
        if (!$check) {
            $this->requestDTO->setMessage(__('category.notFound'));
            $this->requestDTO->setCode(1);
            $this->requestDTO->setData([]);
            return $this->requestDTO->toArray();
        }

        $this->requestDTO->setCode(-1);
        $this->requestDTO->setData($check);
        return $this->requestDTO->toArray();

    }

    public function destroyCategory(int $id): array
    {

        $result = Category::find($id);

        if (!$result) {
            $this->requestDTO->setMessage(__('category.notFound'));
            $this->requestDTO->setCode(1);
            $this->requestDTO->setData([]);
            return $this->requestDTO->toArray();
        }
        Category::destroy($id);
        $this->requestDTO->setCode(-1);
        $this->requestDTO->setData($result);
        return $this->requestDTO->toArray();
    }

    public function updateCategory(Request $request): array
    {


        $check = Category::query()->where('category_name', '=', $request->category_name)->where('id', '!=', $request->categoryId)->first();
        if ($check) {
            $this->requestDTO->setMessage(__('category.duplicate'));
            $this->requestDTO->setCode(1);
            $this->requestDTO->setData([]);
            return $this->requestDTO->toArray();
        }


        $newCategory = Category::query()->where('id', '=', $request->categoryId)->first();
        if (!$newCategory) {
            $this->requestDTO->setMessage(__('category.notFound'));
            $this->requestDTO->setCode(1);
            $this->requestDTO->setData([]);
            return $this->requestDTO->toArray();
        }

        $newCategory->category_name = $request->category_name;
        $newCategory->description = data_get($request, 'description', $newCategory->description);
        $newCategory->save();
        $this->requestDTO->setCode(-1);
        $this->requestDTO->setData($newCategory->id);
        return $this->requestDTO->toArray();

    }
}
