<?php
$total_cats2 = 0;

if ($cat_info['total_subcats'] != 0) {
	$sql = mysql_query("SELECT * FROM wss_cats WHERE parent_id = $id ORDER BY cat_order");
	
	while($row = mysql_fetch_array($sql)) {
	
		$total_cats2 = ($total_cats2 + 1);
		$seo_name = seoname($row['name']);
		
		$url = CategoryUrl($row['id'], $row['seo_url'], 1, 'newest');
	
		echo '<a href="'.$url.'">'.$row['name'].'</a>';
	
		$cat_numb = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_wallpapers WHERE category=".$row['id'].""),0);
		echo ' ('.$cat_numb.')';
	
		if($total_cats2 != $cat_info['total_subcats']) {
			echo ' | ';
		}
	}
}
?>