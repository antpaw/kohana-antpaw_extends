<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Sitemap helper.
 *
 * @author     Anton Pawlik
 */
class antpaw_Sitemap {
	
	public static function create($items, $sitemap_version = '0.9', $encoding = 'UTF-8')
	{
		if ( ! function_exists('simplexml_load_file'))
			throw new Kohana_Exception('SimpleXML must be installed!');
		
		$feed = '<?xml version="1.0" encoding="'.$encoding.'"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/'.$sitemap_version.'"></urlset>';
		$feed = simplexml_load_string($feed);
		
		foreach ($items as $item)
		{
			$row = $feed->addChild('url');

			foreach ($item as $name => $value)
			{
				$row->addChild($name, $value);
			}
		}
		
		return $feed->asXML();
	}

}