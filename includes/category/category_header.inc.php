<?php
if (isset($_GET['name'])) {
	$seo_name = mysql_secure($_GET['name']);
	if ($seo_name != 'all') {
		$cat_query = mysql_query("SELECT * FROM wss_cats WHERE seo_url = '$seo_name'");
		$cat_info = mysql_fetch_array($cat_query);
		$id = $cat_info['id'];
	}
	else {
		$id = 0;
	}
}
else {
	$id = intval($_GET['id']);
	$cat_query = mysql_query("SELECT * FROM wss_cats WHERE id = $id");
	$cat_info = mysql_fetch_array($cat_query);
}

if ($id == '0') {
	$cat_info = array ('id' => 0, 'name' => ALL_WALLPAPERS, 'seo_url' => 'all', 'description' => ALL_WALLPAPERS_DESC, 'keywords' => $setting['site_keywords'], 'total_subcats' => 0, 'parent_id' => 0);
}
else {
	$exists = mysql_num_rows($cat_query);
	if ($exists != 1) {
		header("HTTP/1.0 404 Not Found");
		include 'includes/misc/404.php';
		exit();
	}
	else {
		$cat_info['total_subcats'] = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_cats WHERE parent_id = $id"),0);
		if ($cat_info['parent_id'] != 0) {
			$get_parent_category = mysql_query("SELECT name,seo_url FROM wss_cats WHERE id = $cat_info[parent_id]");
			$parent_category = mysql_fetch_array($get_parent_category);
		}
	}
}

if (!isset($_GET['page'])) {
	$page = 1;
}
else {
	$page = intval($_GET['page']);
}

$sort_options = array('newest' => CATEGORY_NEWEST, 'oldest' => CATEGORY_OLDEST, 'rating' => CATEGORY_RATING, 'downloads' => CATEGORY_DOWNLOADS, 'nameasc' => CATEGORY_AZ, 'namedesc' => CATEGORY_ZA);
?>