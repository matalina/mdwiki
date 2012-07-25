<?php

/**
 * Modelo Bundle
 * 
 * Basic templating foundation for your views.
 * @author Carlos <carlos@koalabs.co>
 */
class Modelo {

	public static $hidden = false;

	/**
	 * Get a configuration variable
	 *
	 * @param  string $key
	 * @return string
	 */
	public static function get($key)
	{
		return Config::get('modelo::modelo.'.$key);
	}
	
}