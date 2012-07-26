<?php

/*
|--------------------------------------------------------------------------
| Basset Routes
|--------------------------------------------------------------------------
|
| Registering routes with Basset is a piece of cake. Simply tell Basset
| what you would like to use (scripts or styles) and begin registering your
| assets.
|
| Let's register styles that respond to http://localhost/basset/website.css
|
| 		Basset::styles('website', function($basset)
|		{
|			$basset->add('theme', 'theme.css');
|		});
|
| The extension and the bundles handler is added automatically for you, all
| you need to do is supply a name.
|
| If you'd like to register scripts, simply swap 'styles' with 'scripts'
| and begin adding your assets.
|
*/
Basset::styles('foundation', function($basset)
{
	$basset->add('foundation', 'css/foundation.css')
    ->add('icons','css/foundation-icons-general.css')
    ->add('app','css/app.css');
});

Basset::scripts('foundation', function($basset)
{
	$basset->add('foundation','js/foundation.js')
    ->add('app','js/app.js');
});