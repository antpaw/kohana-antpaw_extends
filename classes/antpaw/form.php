<?php defined('SYSPATH') or die('No direct script access.');

class antpaw_Form extends Kohana_Form {
	
	public static function label($input, $text = NULL, array $attributes = NULL)
	{
		return parent::label($input, __($text), $attributes);
	}
	
	public static function input($name, $value = NULL, array $attributes = NULL)
	{
		$attributes = self::get_id($name, $attributes);
		
		$has_type = isset($attributes['type']);
		if ($_POST + $_GET && ( ! $has_type || $has_type && $attributes['type'] === 'hidden'))
		{
			$ref = self::parse_post_array($name);
			
			if ( ! empty($ref))
			{
				$value = $ref;
			}
		}
		
		return parent::input($name, $value, $attributes);
	}
	
	public static function checkbox($name, $value = NULL, $checked = FALSE, array $attributes = NULL)
	{
		$attributes = self::get_id($name, $attributes);
		
		if ($_POST + $_GET)
		{
			$ref = self::parse_post_array($name);
			$checked = ( ! empty($ref) && $ref == $value);
		}
		
		return parent::checkbox($name, $value, (bool) $checked, $attributes);
	}
	
	public static function radio($name, $value = NULL, $checked = FALSE, array $attributes = NULL)
	{
		$attributes = self::get_id($name, $attributes);
		
		if ($_POST + $_GET)
		{
			$ref = self::parse_post_array($name);
			$checked = ( ! empty($ref) && $ref == $value);
		}
		
		return parent::radio($name, $value, (bool) $checked, $attributes);
	}
	
	public static function textarea($name, $body = '', array $attributes = NULL, $double_encode = TRUE)
	{
		$attributes = self::get_id($name, $attributes);
		
		if ($_POST + $_GET)
		{
			$ref = self::parse_post_array($name);
			if ( ! empty($ref))
			{
				$body = $ref;
			}
		}
		
		return parent::textarea($name, $body, $attributes, $double_encode);
	}
	
	public static function select($name, array $options = NULL, $selected = NULL, array $attributes = NULL)
	{
		$attributes = self::get_id($name, $attributes);
		
		if ($_POST + $_GET)
		{
			$selected = self::parse_post_array($name);
		}
		
		return parent::select($name, $options, $selected, $attributes);
	}
	
	public static function password($name, $value = NULL, array $attributes = NULL)
	{
		$attributes = self::get_id($name, $attributes);
		
		return parent::password($name, $value, $attributes);
	}
	
	private static function parse_post_array($name)
	{
		$ref = $_POST + $_GET;
		
		preg_match_all('/\w+/', $name, $uu);
		
		$new_value = FALSE;
		
		foreach ($uu[0] as $subname)
		{
			if (isset($ref[$subname]))
			{
				$new_value = TRUE;
				$ref = $ref[$subname];
			}
		}
		
		if ($new_value && ! is_array($ref))
		{
			return $ref;
		}
		return NULL;
	}
	
	private static function get_id($name, array $attributes = NULL)
	{
		if ($attributes === NULL || ! isset($attributes['id']))
		{
			$attributes['id'] = strtr($name, array('[' => '_', ']' => NULL));
		}
		
		return $attributes;
	}
}