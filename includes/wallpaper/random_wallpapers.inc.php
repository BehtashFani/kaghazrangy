<?php
defined( 'WSS_' ) or die( '' );
$sqla = mysql_query("SELECT * FROM wss_wallpapers WHERE published=1 AND category = $wallpaper[category] AND id != $wallpaper[id] ORDER BY rand() LIMIT $template[random_wallpaper_limit]");

while($row = mysql_fetch_array($sqla)) {

	$random_wallpaper = WallpaperData($row, 'random');
		
	include('.'.$setting['template_url'].'/'.$template['random_wallpaper']);
}
?>