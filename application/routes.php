<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/

// Home Page
Route::get('/', function() 
{
  $dropbox = IoC::resolve('dropbox::api');
  $file = $dropbox->getFile('home.md');
  $name = explode('.',$file['name']);
  $output = $file['data'];
  Section::inject('description',preg_replace('/[^a-zA-Z0-9 ]/','',Str::words($output,20)));
  $output = Wiki::parseLinks($output);
  $content =  Sparkdown\Markdown($output);
  Section::inject('title', Str::title($name[0]));
  Section::inject('content', $content);
  return View::make('modelo::master');
});

Route::get('index', function () 
{
  Section::inject('title', 'Index');
  $output = Wiki::showIndex();
  $content =  Sparkdown\Markdown($output);
  Section::inject('content', $content);
  return View::make('modelo::master');
});

Route::get('([a-zA-Z0-9\/\-_]+)', function ($page)
{
  $dropbox = IoC::resolve('dropbox::api');
  $file = $dropbox->getFile($page.'.md');
  $name = explode('.',$file['name']);
  $output = $file['data'];
  Section::inject('description',preg_replace('/[^a-zA-Z0-9 ]/','',Str::words($output,20)));
  $output = Wiki::parseLinks($output);
  $content =  Sparkdown\Markdown($output);
  Section::inject('title', Str::title($name[0]));
  Section::inject('content', $content);
  return View::make('modelo::master');
});

/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Router::register('GET /', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
  $old = Session::get('current'.'/');
  $current = URI::current();
  
  Session::put('old', $old);
  Session::put('current', $current);
  
  // Start Bundles && Other Settings
  Bundle::start('sparkdown');
  Laravel\Database\Eloquent\Pivot::$timestamps = false;
	
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('/');
});