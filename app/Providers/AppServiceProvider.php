<?php

namespace App\Providers;

use Dba\Connection;
use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Model::preventLazyLoading(!app()->isProduction());
        // Model::preventSilentlyDiscardingAttributes(!app()->isProduction());
        // DB::whenQueryingForLongerThat(500, function (Connection $connection){

        // });
    }
}
