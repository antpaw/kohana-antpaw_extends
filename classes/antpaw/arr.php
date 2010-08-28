<?php defined('SYSPATH') or die('No direct script access.');

class antpaw_Arr extends Kohana_Arr {
	
	public static function trim(array $array)
	{
		foreach ($array as $key => $value)
		{
			if ($value == NULL)
			{
				unset($array[$key]);
			}
		}
		
		return $array;
	}
	
	public static function set_null(array $array)
	{
		foreach ($array as $key => $value)
		{
			if (is_string($value) && strtolower($value) === 'null')
			{
				$array[$key] = NULL;
			}
		}
		
		return $array;
	}
	
	public static function set_same_key(array $array)
	{
		$new_array = array();
		foreach ($array as $value)
		{
			$new_array[$value] = $value;
		}
		
		return $new_array;
	}
}