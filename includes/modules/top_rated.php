<?php
defined( 'WSS_' ) or die( '' );
$q = mysql_query("SELECT * from wss_wallpapers ORDER BY rating desc LIMIT $template[top_rated_module_limit]");
while ($wallpapers = mysql_fetch_array($q)) {
	$wallpaper['name'] = $wallpapers['name'];
	$wallpaper['description'] = $wallpapers['description'];
		
	$wallpaper['url'] = WallpaperUrl($wallpapers['id'], $wallpapers['seo_url'], $wallpapers['category']);
		
	$wallpaper['thumbnail'] = WallpaperThumbnail($wallpapers['id'], $template['submitted_thumbnail'], $wallpapers['filename']);
		
	// Include the template for favourite wallpapers
	include('.'.$setting['template_url'].'/'.$template['top_rated_module_wallpaper']);
}
?>