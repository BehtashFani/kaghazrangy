<?php
defined( 'WSS_' ) or die( '' );
$cat_numb = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_wallpapers WHERE featured=1 AND published=1"),0);

if ($cat_numb > 0) {
	$category_wallpapers = mysql_query("SELECT * FROM wss_wallpapers WHERE featured=1 AND published=1 ORDER BY id desc");
	
	while($cat_wallpapers = mysql_fetch_array($category_wallpapers)) {
	
		$featured_wallpaper = WallpaperData($cat_wallpapers, 'featured');
				
		include('.'.$setting['template_url'].'/'.$template['featured_wallpaper']);
	}
}
?>