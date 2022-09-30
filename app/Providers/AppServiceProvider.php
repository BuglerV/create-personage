<?php

namespace App\Providers;

use App\View\Creators\AdminCreator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Добавляет к названию отображения '-admin' для пользователя админа.
        View::creator([
		    'warcraft.group.index',
			'warcraft.ability.index',
			'warcraft.ability.list',
		], AdminCreator::class);
    }
}
