<?php
namespace Concave\Bkash;
use Illuminate\Support\ServiceProvider;

class BkashServiceProvider extends ServiceProvider{

    public function boot(){
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations/2020_24_10_000000_create_bkash_response_table.php');
        $this->publishes([
            __DIR__.'/assets/bkash.js' => public_path('concave/bkash.js'),
            __DIR__.'/assets/config.json' => public_path('concave/config.json'),
        ], 'public');
    }

    public function register(){
        
    }

}