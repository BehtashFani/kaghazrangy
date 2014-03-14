<?php
defined( 'WSS_' ) or die( '' );
if ($user['previously_viewed'] == '') {
	echo '<div class="no_recents">'.NO_RECENTLY_VIEWED.'</div>';
}
else {
	$recents = substr($user['previously_viewed'], 0, -1);

	$q2 = mysql_query("SELECT * from wss_wallpapers WHERE id IN ($recents) AND published = 1 ORDER BY find_in_set(id, '$recents') DESC");
	while ($module_wallpapers = mysql_fetch_array($q2)) {
		$module_wallpaper = WallpaperData($module_wallpapers, 'recent_module');
		
		// Include the template for favourite wallpapers
		include('.'.$setting['template_url'].'/'.$template['recent_wallpaper']);
	}
}
?>