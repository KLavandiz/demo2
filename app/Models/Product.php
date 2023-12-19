<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'currency_id',
        'status',
        'category_id'
    ];

    protected $hidden = ['created_at','updated_at'];

    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function getCurrency(){
        return $this->hasOne(Currency::class,'id','currency_id');
    }

}
