<?php

namespace App\Filters\V1\Product;

use App\Filters\V1\BaseFilters;
use Illuminate\Http\Request;

class ProductFilters extends BaseFilters
{

    protected $safeParms = [
        'id' => ['eq', 'ne'],
        'name' => ['eq', 'lk'],
        'description' => ['lk'],
        'price' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'currency' => ['eq', 'ne'],
        'isActive' => ['eq', 'ne'],
        'categoryId' => ['eq', 'ne']
    ];

    protected $columnMap = [

        'id' => 'id',
        'name' => 'name',
        'description' => 'description',
        'image' => 'email',
        'price' => 'price',
        'currency' => 'currency',
        'isActive' => 'is_active',
        'categoryId' => 'category_id'

    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'gt' => '>',
        'lte' => '<=',
        'gte' => '>=',
        'ne' => '!=',
        'lk' => 'LIKE'
    ];

}
