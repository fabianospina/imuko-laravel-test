<?php

namespace App\Http\Middleware;

use Closure;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Menu::make('MyNavBar', function ($menu) {
            //$menu->add('Home');
            $charac_list = $menu->add('Personajes', ['route'  => 'home',  'class' => 'nav-item']);
            $charac_list->link->attr(['class' => 'nav-link']);
        });

        return $next($request);
    }
}
