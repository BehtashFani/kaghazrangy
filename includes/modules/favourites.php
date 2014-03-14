<?php
defined( 'WSS_' ) or die( '' );
if ($user['login_status'] == 1) {
	$q = mysql_query("SELECT favourites from wss_users WHERE id=$user[id]");
	$favs = mysql_fetch_array($q);
	if ($favs['favourites'] == '') {
		echo '<div class="module_notice">'.PROFILE_NO_FAVS.'</div>';
	}
	else {
		$favourites = substr($favs['favourites'], 2);

		$sql = mysql_query("SELECT * from wss_wallpapers WHERE id IN ($favourites) AND published = 1 LIMIT 5");
		while ($module_wallpapers = mysql_fetch_array($sql)) {
			$module_wallpaper = WallpaperData($module_wallpapers, 'fav_module');
		
			// Include the template for favourite wallpapers
			include('.'.$setting['template_url'].'/'.$template['popular_module_wallpaper']);
		}
		
		echo '<div class="more_links"><a href="'.ProfileUrl($user['id'], $user['seo_url']).'">'.FAVOURITES_VIEW_ALL.' >></a></div>';
	}
}
else {
	echo '<div class="module_notice">'.FAVOURITES_LOG_IN.'</div>';
}
?>