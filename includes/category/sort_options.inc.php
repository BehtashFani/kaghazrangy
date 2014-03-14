<?php
defined( 'WSS_' ) or die( '' );

if (!isset($_GET['sortby'])) 
	$sortby = 'newest';
else 
	$sortby = $_GET['sortby'];

foreach ($sort_options as $key => $sort_name) {
	$url = CategoryUrl($cat_info['id'], $cat_info['seo_url'], 1, $key);
	
	if ($sortby == $key) {
		$class = 'bold';
	}
	else {
		$class = 'notbold';
	}
	
	echo '<a class="sort_'.$class.'" href="'.$url.'">'.$sort_name.'</a>';
	
	if ($key != 'namedesc') {
		echo ' | ';
	}
}

?>