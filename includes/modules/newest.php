<?php
defined( 'WSS_' ) or die( '' );
$q = mysql_query("SELECT * from wss_wallpapers WHERE published = 1 ORDER BY id desc LIMIT $template[new_module_limit]");
while ($module_wallpapers = mysql_fetch_array($q)) {
	$module_wallpaper = WallpaperData($module_wallpapers, 'new_module');
		
}
?>