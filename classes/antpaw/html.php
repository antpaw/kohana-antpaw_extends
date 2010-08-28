<?php defined('SYSPATH') or die('No direct script access.');

class antpaw_HTML extends Kohana_HTML {
	
	public static function li_anchor($href, $text, $classes = FALSE, $close_tag = TRUE)
	{
		$class = ($classes) ? ' class="'.trim(implode(' ', $classes)).'"' : NULL;
		
		$close_li = ($close_tag) ? '</li>'."\n" : NULL;
		
		return '	<li'.$class.'>'.html::anchor($href, $text).$close_li;
	}
	
	public static function image($file, array $attributes = NULL, $index = FALSE)
	{
		if ($file === NULL)
		{
			return NULL;
		}
		
		if ( ! isset($attributes['alt']))
		{
			$attributes['alt'] = '';
		}
		
		return parent::image($file, $attributes, $index);
	}
}