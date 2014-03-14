<?php
defined( 'WSS_' ) or die( '' );
$category_wallpapers = mysql_query("SELECT * FROM wss_wallpapers WHERE (category = $row[id] OR category_parent = $row[id]) AND published=1 ORDER BY rand() LIMIT ".$template['homepage_wallpaper_limit']."");
	
while($cat_wallpapers = mysql_fetch_array($category_wallpapers)) {
	
	$wallpaper = WallpaperData($cat_wallpapers, 'homepage');	
				
	include('.'.$setting['template_url'].'/'.$template['home_wallpaper']);

}
?>