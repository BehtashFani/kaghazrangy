<?php
$therow = 0;

$get_tag = mysql_secure($_GET['t']);

if (!isset($_GET['page'])) {
	$page = 1;
}
else {
	$page = $_GET['page'];
}

if (isset($_GET["sortby"])) {
	if ($_GET['sortby'] == 'nameasc') {
			$sort = 'name ASC';
	}
	else if ($_GET['sortby'] == 'namedesc') {
		$sort = 'name DESC';
	}
	else if ($_GET['sortby'] == 'newest') {
		$sort = 'id DESC';
	}
	else if ($_GET['sortby'] == 'oldest') {
		$sort = 'id ASC';
	}
	else if ($_GET['sortby'] == 'rating') {
		$sort = 'rating DESC';
	}
}
else {
	$sort = 'id DESC';
}

$from = (($page * $template['wallpapers_per_page']) - $template['wallpapers_per_page']);

$where = '';
if (isset($_COOKIE['wss_resfilter']) && $_COOKIE['wss_resfilter'] != 'all' && $setting['show_all_resolutions'] == 0) {
	$dimensions = explode("x", secure($_COOKIE['wss_resfilter']));
	$where = "AND (b.original_width >= $dimensions[0] AND b.original_height >= $dimensions[1])";
}
$count_sql = mysql_query("
	SELECT b.*
	FROM wss_tag_relations bt, wss_wallpapers b, wss_tags t
	WHERE bt.tag_id = t.id
	AND t.seo_url = '$get_tag'
	AND b.id = bt.wallpaper_id
	AND b.published = 1
	$where
	GROUP BY b.id
	ORDER BY b.$sort
	") or die (mysql_error());
$total_results = mysql_num_rows($count_sql);

if ($total_results != 0) {
	
$sql = mysql_query("
	SELECT b.*
	FROM wss_tag_relations bt, wss_wallpapers b, wss_tags t
	WHERE bt.tag_id = t.id
	AND t.seo_url = '$get_tag'
	AND b.id = bt.wallpaper_id
	AND b.published = 1
	$where
	GROUP BY b.id
	ORDER BY b.$sort
	LIMIT $from, $template[wallpapers_per_page]
	") or die (mysql_error());
}
else {
	$noresults = 1;
}

$sort_options = array('newest' => CATEGORY_NEWEST, 'oldest' => CATEGORY_OLDEST, 'rating' => CATEGORY_RATING, 'nameasc' => CATEGORY_AZ, 'namedesc' => CATEGORY_ZA);

echo '<div class="tag_sort_options">';
foreach ($sort_options as $key => $sort_name) {
	$url = TagUrl($get_tag, 1, $key);
	
	echo '<a href="'.$url.'">'.$sort_name.'</a>';
	
	if ($key != 'namedesc') {
		echo ' | ';
	}
}

echo ' &nbsp; ';
					include 'includes/category/resolutions_filter.inc.php';
			
echo '</div><div class="tag_container">';

while($row = mysql_fetch_array($sql)) 
{
 		$wallpaper = WallpaperData($row, 'category');

		include('.'.$setting['template_url'].'/'.$template['search_wallpaper']);

}
if (isset($noresults)) {
	echo NORESULTS;
}
echo '</div>';

echo '<div class="tag_pages">';

if ($total_results != 0) {
$count_sql = mysql_query("
	SELECT *
	FROM wss_tag_relations bt, wss_wallpapers b, wss_tags t
	WHERE bt.tag_id = t.id
	AND t.seo_url = '$get_tag'
	AND b.id = bt.wallpaper_id
	AND b.published = 1
	GROUP BY b.id
	ORDER BY b.$sort
	") or die (mysql_error());
$total_results = mysql_num_rows($count_sql);
$total_pages = ceil($total_results / $template['wallpapers_per_page']);
}
else {
$total_pages = 1;
}

if (isset($_GET['sortby'])) {
	$sortby = mysql_secure($_GET['sortby']);
}
else {
	$sortby = 'newest';
}


if($page > 1){
	$prev = ($page - 1);
	$url = TagUrl($get_tag, $prev, $sortby);
	
	echo '<a href="'.$url.'">&laquo; '.PREVIOUS.'</a> ';

}

if ($page > 4) {
	$url = TagUrl($get_tag, 1, $sortby);
	echo '<a href="'.$url.'">1</a> ';
}
if ($page > 5) {
	$url = TagUrl($get_tag, 2, $sortby);
	echo '<a href="'.$url.'">2</a> ... ';
}

$low = $page - 4;
$high = $page + 8;

for($i = 1; $i <= $total_pages; $i++){
	if (($i > $low) && ($i < $high)) {
    	if($page == $i){
       	 	echo '<b><a href="#">'.$i.'</a></b> ';
    	} 
    	else {
    		$url = TagUrl($get_tag, $i, $sortby);
			echo '<a href="'.$url.'">'.$i.'</a> ';
    	}
    }
}

if (($page < $total_pages - 8)) {
	$penultimate = $total_pages - 1;
	$url = TagUrl($get_tag, $penultimate, $sortby);
	echo ' ... <a href="'.$url.'">'.$penultimate.'</a> ';
}
if (($page < $total_pages - 7)) {
	$url = TagUrl($get_tag, $total_pages, $sortby);
	echo '<a href="'.$url.'">'.$total_pages.'</a> ';
}

if($page < $total_pages){
    $next = ($page + 1);
    $url = TagUrl($get_tag, $next, $sortby);
	echo '<a href="'.$url.'">'.NEXT.' &raquo;</a> ';
}	

echo '</div>';

?>