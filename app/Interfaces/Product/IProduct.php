<?php

namespace App\Interfaces\Product;

use Illuminate\Http\Request;

interface IProduct
{
    public function getAllProducts(string $search, int $page):array;
    public function createProduct(Request $request):array;

    public function showProduct(int $id):array;

    public function destroyProduct(int $id):array;

    public function updateProduct(Request $request):array;

    public function showProductsByCategory(int $id):array;

    public function filterQuery(Request $request):array;
}
