<?php

namespace App\Interfaces\Category;

use App\Http\Resources\Category\CategoryCollection;
use Illuminate\Http\Request;

interface ICategory
{
    public function getAllCategories(string $search):array;
    public function createCategory(Request $request):array;

    public function showCategory(int $id):array;

    public function destroyCategory(int $id):array;

    public function updateCategory(Request $request):array;

}
