<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Schema::defaultStringLength(191);

        // view()->composer('items.index-vue',function($view){
        //     $view->with('tags',\App\Tag::has('items')->pluck('nombre'));
        // });
        setlocale(LC_TIME, 'Spanish');
        Carbon::setLocale('es');
        Carbon::setUtf8(true);
        
        if (!Collection::hasMacro('paginate')) {

        Collection::macro('paginate', 
            function ($perPage = 15, $page = null, $options = []) {
            $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
            return (new LengthAwarePaginator(
                $this->forPage($page, $perPage), $this->count(), $perPage, $page, $options))
                ->withPath('');
        });
}
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
