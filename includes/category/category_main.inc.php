<?php
defined( 'WSS_' ) or die( '' );
$therow = 0;

if ($id != 0) {
	$where = "(category = $id OR category_parent = $id) AND";
}
else {
	$where = '';
}

if (isset($_COOKIE['wss_resfilter']) && $_COOKIE['wss_resfilter'] != 'all' && $setting['show_all_resolutions'] == 0) {
	$dimensions = explode("x", secure($_COOKIE['wss_resfilter']));
	$where .= " (original_width >= $dimensions[0] AND original_height >= $dimensions[1]) AND";
}

$cat_numb = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_wallpapers WHERE $where published=1"), 0);

if ($cat_numb > 0) {
	$cat_name = mysql_fetch_array(mysql_query("SELECT name FROM wss_cats WHERE id=$id"));
	$from = (($page * $template['wallpapers_per_page']) - $template['wallpapers_per_page']);

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
		else if ($_GET['sortby'] == 'downloads') {
				$sort = 'downloads DESC';
			}
	}
	else {
		$sort = 'id DESC';
	}
	$sql = mysql_query("SELECT * FROM wss_wallpapers WHERE $where published=1 ORDER BY $sort LIMIT $from, $template[wallpapers_per_page]");

	while ($row = mysql_fetch_array($sql)) {
		$therow = $therow + 1;
		
		$wallpaper = WallpaperData($row, 'category');

		include '.'.$setting['template_url'].'/'.$template['category_wallpaper'];

		if ($therow == $template['category_columns']) {
			$therow = 0;
		}
	}


}
else {
	echo '<div id="no_wallpapers">'.CATEGORY_NO_WALLPAPERS.'</div>';
}
?>