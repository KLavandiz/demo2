<?php

namespace App\Http\Resources\Product;

use App\DTO\ProductDTO;
use App\Http\Resources\BaseCollection\CustomCollection;

class ProductCollection extends CustomCollection
{
    protected string $collectionClass = ProductDTO::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */

    public function toArray($collect): array
    {


        return [
            'id' => $collect->id,
            'name' => $collect->name,
            'description' => data_get($collect, 'description', ''),
            'image' => data_get($collect, 'image', ''),
            'price' => data_get($collect, 'price', ''),
            'currency' => $collect->getCurrency->toArray(),
            'isActive' =>  $collect->is_active,
            'categoryId' => $collect->category->toArray(),

        ];

    }

    public function add(ProductDTO $listDTO): void
    {
        $this->push($listDTO);

    }
}
