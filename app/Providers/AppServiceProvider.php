<?php

namespace App\Providers;

use App\Article;
use App\Book;
use App\Observers\ArticleObserver;
use App\Observers\BookObserver;
use App\Observers\ProceedingObserver;
use App\Proceeding;
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

        /*OBSERVERS*/
        Proceeding::observe(ProceedingObserver::class);
        Article::observe(ArticleObserver::class);
        Book::observe(BookObserver::class);
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
