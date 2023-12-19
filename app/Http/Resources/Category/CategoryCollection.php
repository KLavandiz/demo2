<?php

namespace App\Http\Resources\Category;

use App\DTO\CategoryDTO;
use App\Http\Resources\BaseCollection\CustomCollection;

class CategoryCollection extends CustomCollection
{
    protected string $collectionClass = CategoryDTO::class;
    public function toArray($collect): array
    {
        return [
            'id' => $collect->id,
            'categoryName' => $collect->category_name,
            'description' => data_get($collect,'description','') ,
            'isActive' => $collect->is_active
        ];
    }

    public function add(CategoryDTO $categoryDTO):void{
        $this->push($categoryDTO);
    }
}
