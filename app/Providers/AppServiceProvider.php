<?php

namespace App\Providers;

use App\Repositories\ProceedingsRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        View::composer('public.layouts.latest-proceeding', function ($view) {
            $repository = new ProceedingsRepository;
            $view->with('latestProceedings', $repository->get()->data->take(4));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /*REGISTER SWAGGER INTEGRATION*/
        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);
    }
}
