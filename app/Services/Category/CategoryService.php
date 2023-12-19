<?php

namespace App\Services\Category;

use App\Http\Resources\Category\CategoryCollection;
use App\Interfaces\Category\ICategory;
use Illuminate\Http\Request;

class CategoryService
{

    private ICategory $category;

    /**
     * @param ICategory $category
     */
    public function __construct(ICategory $category)
    {
        $this->category = $category;
    }

    public function getAllCategories(string $search):array{
        return $this->category->getAllCategories($search);
    }

    public function createCategory(Request $request):array{
    return  $this->category->createCategory($request);
    }

    public function showCategory(int $id):array{
        return $this->category->showCategory($id);
    }

    public function destroyCategory(int $id):array{
        return $this->category->destroyCategory($id);
    }

    public function updateCategory(Request $request):array{
        return $this->category->updateCategory($request);
    }

}
