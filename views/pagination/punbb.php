<p class="pagination">
	<?
	echo __('Pages').': ';
	
	if ($current_page > 3)
	{
		echo html::anchor($page->url(1), 1).
				($current_page != 4 ? ' &hellip; ' : ' ');
	}
	
	for ($i = $current_page - 2, $stop = $current_page + 3; $i < $stop; ++$i)
	{
		if ($i < 1 OR $i > $total_pages) continue;
	
		if ($i == $current_page)
		{
			echo '<strong>'.$i.'</strong> ';
		}
		else
		{
			echo html::anchor($page->url($i), $i).' ';
		}	
	}
	
	if ($current_page <= $total_pages - 3)
	{
		echo ($current_page != $total_pages - 3 ? ' &hellip; ' : ' ').
				html::anchor($page->url($total_pages), $total_pages);
	}
	?>
</p>