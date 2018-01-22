<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\DAO\RestaurantDAO;

class FacadeServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {

        // Ajax Facade
        $this->app->singleton('restaurant', function($app) {
            return new RestaurantDAO();
        });
        
    }
}