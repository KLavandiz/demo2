<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Category\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    /**
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): array
    {
        $search = data_get($request,'search','');
        return $this->categoryService->getAllCategories($search);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreCategoryRequest $request):array
    {
        return  $this->categoryService->createCategory($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryRequest $category):array
    {
        return $this->categoryService->showCategory((int)$category->categoryId);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request):array
    {
        return $this->categoryService->updateCategory($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryRequest $category):array
    {
       return $this->categoryService->destroyCategory((int)$category->categoryId);
    }
}
