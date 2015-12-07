<?php
namespace App\Http\Routes;

use LaravelBA\RouteBinder\RouteBinder;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Routing\Router;

class WikiRoutes implements RouteBinder
{
    /**
     * This is what I meant with #3 up there.
     * Completely optional, but highly recommended.
     */
    const INDEX = 'foo.index';

    public function addBindings(Router $router)
    {
        /*$router->bind('user_id', function(){
            // Fetch your User object here!
        });*/
    }

    public function addRoutes(Registrar $router)
    {
        // Authentication routes...
        $router->get('/', [
            'as' => 'login-home',
            'uses' => 'App\Http\Controllers\Auth\AuthController@getLogin'
        ]);
        $router->get('auth/login', [
            'as' => 'login',
            'uses' => 'App\Http\Controllers\Auth\AuthController@getLogin'
        ]);
        $router->post('auth/login', [
            'as' => 'doLogin',
            'uses' => 'App\Http\Controllers\Auth\AuthController@postLogin'
        ]);
        $router->get('auth/logout', [
            'as' => 'logout',
            'uses' => 'App\Http\Controllers\Auth\AuthController@getLogout'
        ]);
            
        $router->group(['middleware' => 'auth'], function() use ($router) {
            $router->get('image/{filename}', [
                'as' => 'image',
                'uses' => 'App\Http\Controllers\WikiController@getImage',
            ]);
            
            $router->get('{arg1?}/{arg2?}/{arg3?}/{arg4?}/{arg5?}', [
                'as' => 'page', 
                'uses' => 'App\Http\Controllers\WikiController@getPage',
            ]);
        });
        
    }
}