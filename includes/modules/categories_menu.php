<?php
$sql = mysql_query("SELECT * FROM wss_cats WHERE parent_id = 0 ORDER BY cat_order");
$total_cats = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_cats WHERE parent_id = 0"),0);
$total_cats2 = 0;

if ($setting['all_wallpapers'] == 1) {
	$url = CategoryUrl(0, 'all', 1, 'newest');

	echo '<a href="'.$url.'">'.ALL_WALLPAPERS.'</a>'.$template['categories_menu_seperator'];
}
	
while($row = mysql_fetch_array($sql)) {
	
	$total_cats2 = ($total_cats2 + 1);
	$seo_name = seoname($row['name']);
	
	$url = CategoryUrl($row['id'], $row['seo_url'], 1, 'newest');
	
	echo '<a href="'.$url.'">'.$row['name'].'</a>';
	
	if($total_cats2 != $total_cats) {
		echo $template['categories_menu_seperator'];
	}
}
?>