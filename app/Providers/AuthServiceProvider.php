<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\DTO\RequestDTO;
use App\Filters\V1\Product\ProductFilters;
use App\Interfaces\Category\ICategory;
use App\Interfaces\Product\IProduct;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Product\ProductRepository;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }

    public function register()
    {
        $this->app->bind(RequestDTO::class, function (){
            return new RequestDTO(-1,'success','empty');
        });
        $this->app->bind(ICategory::class,CategoryRepository::class);
        $this->app->bind(IProduct::class,ProductRepository::class);
        $this->app->bind(ProductFilters::class,function (){
            return new ProductFilters();
        });
    }
}
