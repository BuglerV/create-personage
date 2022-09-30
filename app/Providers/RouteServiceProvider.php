<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

use App\System\Routing\ResourceRegistrar;
use Illuminate\Routing\PendingResourceRegistration;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/person';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();
        $this->addingMacroses();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
	
    protected function addingMacroses()
    {
        Route::macro('resourceFull',function($name,$controller,array $options = []){
            return new PendingResourceRegistration(
                new ResourceRegistrar($this), $name, $controller, $options
            );
        });
        
        Router::macro('resourcesFull',function(array $resources, array $options = []){
            $routes = [];
            foreach($resources as $name => $controller){
                $routes[] = $this->resourceFull($name,$controller,$options);
            }
            return collect($routes);
        });
    }
}
