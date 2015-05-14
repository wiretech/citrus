<?php

namespace Wiretech\Citrus\Config;
//If you're using Sentry, it will look like \Sentry::getUser() instead of \Auth::user
$user = \Auth::user();

return array(
	/*
	|--------------------------------------------------------------------------
	| Citrus Cache 
	|--------------------------------------------------------------------------
	|
	| This will change whatever will be stored in the Citrus Cache.
	| We suggest a $user object and a relationship method, such as $user->posts or the like
	| If you don't want to use the cache system, make sure you set it to null
	|
	*/
	'cache' => array(
		'user' => $user
		)
	);