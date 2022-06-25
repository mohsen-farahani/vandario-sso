<?php

declare(strict_types=1);

namespace Vandar\Sso;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Vandar\Sso\Middleware\VandarAuthenticate;

class SsoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/Configs/sso.php' => config_path('sso.php'),
        ]);
        
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('vandar', VandarAuthenticate::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }
}
