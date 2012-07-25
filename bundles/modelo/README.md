# Modelo - Starter template for the Laravel Framework

Modelo is a set of views that serve as a site's **very basic template**.  
It gathers best practices from around the web (see [h5pb](http://html5boilerplate.com) or Zurb's [Foundation](http://foundation.zurb.com)) in order to provide a **robust starting template for most sites**.

## Quick overview
Modelo consists of three basic files:

* master.blade.php
* head.blade.php
* tail.blade.php

### master.blade.php
The *master.blade.php* file is pretty simple.  
It **opens and closes** the page by adding the `html`, `head` and `body` tags.  
It also includes the other two files (*head.blade.php* and *tail.blade.php*).

### head.blade.php
Like its name points out, this is the `<head>` of your site.  
Here we add basic metadata and include *css stylesheets* and *javascript files*.  
This is basically implemented as [the guys at html5boilerplate do it](http://html5boilerplate.com).

### tail.blade.php
Closes the page.  
We get to add most of our *javascript files* here for better website performance as well as a tracking id for *Google Analyitics*.

## Install
You can install Modelo in three ways:

- *[Easiest]*  
Use laravel's artisan via the command line: `php artisan bundle:install modelo`
- *[Still, easy]*  
[Download the zip file from github](https://github.com/crlosmify/modelo/zipball/master), unzip it and change the folder name to **modelo**.  
Then copy the folder into your *bundles directory*.
- *[Not really hard but...]*  
cd into your *bundles folder* and use this command: `git clone git@github.com:crlosmify/modelo.git`

That's it.  
Now you need to **activate the bundle**.  
Do this by going into your *application/bundles.php* file and adding this line inside the array:

`'modelo' => array('auto' => true)`

You should also publish the bundles public files via artisan:

`php artisan bundle:publish`

## Usage
You can of course use *Modelo* as the template for any of your views.  
Just add this line at the beginning of the file:

```
@layout('modelo::master')
```

The actual content of your page goes into a **content** tag:

```
@section('content')
	<!-- Yout content here -->
@endsection
```

### Example
Let's say you want to make an 'about' page.  
Just do as follows:

```
@layout('modelo::master')

	@section('title')
		About Us
	@endsection

	@section('description')
		Some description for the meta tag here
	@endsection

@section('content')
	<!-- The content goes here -->
@endsection
```

That is the basics.  
But you can do a lot more using the other helper tags modelo has.

### List of tags

#### The master layout

* `@section('content')` for the actual page content
* `@section('header')` is pretty handy if you want to share a common header throughout the site.
* `@section('footer')` is great for adding a common footer.


#### The head section

You can make a completely new `<head>` for a specific page if you want to.  
Use:`@section('head')`

Inside the head we have other tags:

* `@section('title')` for adding a meta title.
* `@section('description')` for adding a meta description
* `@section('meta')`for adding custom meta data (like, for example. hiding a page)
* `@section('styles')` for adding a new set of css styles to the page
* `@section('custom_style')`if you want to use the same css style you use throughout the site but want to also include a new one.
* `@section('scripts')` for adding javascript files that are supposed to be added in the `<head>`. It is strongly recommended you add the js files at the bottom though.


#### The tail section

* `@sectiom('tail')` for a totally different tail section
* `@section('more_scripts')` for your javascript files.

### Configuration
There is a *config/modelo-sample.php* file. Duplicate it and change its name to *modelo.php*.  
You have this options:

* Change the language of the website
* Define the author of the site
* Define the path to where your main css file is. Because you **are compressing your files and serving only one**, right?
* Turn jquery *on* or *off*.
* Choose the jquery version.
* Choose the scripts you will serve to all pages
* Turn Google Analytics *on* or *off*