<?php
if (!isset($_POST['page'])) {
	$page = 1;
	$div_id = '<div id="user_fav_wallpapers_section">';
	$location = '.';
}
else {
	include '../../config.php';
	include '../../includes/core.php';
	include '../../language/'.$setting['language'].'.php';
	$page = intval($_POST['page']);
	$id = intval($_POST['id']);
	include '../../'.$setting['template_url'].'/template_settings.php';
	$location = '../../';
	$profile = mysql_fetch_array(mysql_query("SELECT * FROM wss_users WHERE id = $id"));
	$div_id = '';
}

if ($profile['favourites'] != '') {
	$from = (($page * $template['fav_wallpaper_limit']) - $template['fav_wallpaper_limit']);

	$favourites = substr($profile['favourites'], 2);

	$total_wallpapers = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_wallpapers WHERE id IN ($favourites) AND published=1"), 0);

	$sql = mysql_query("SELECT * from wss_wallpapers WHERE id IN ($favourites) AND published = 1  LIMIT $from, $template[fav_wallpaper_limit]");

	echo $div_id;

	while ($wallpapers = mysql_fetch_array($sql)) {
		$wallpaper = WallpaperData($wallpapers, 'user_submissions');

		// Include the template for favourite wallpapers
		include($location.$setting['template_url'].'/'.$template['favourite_wallpaper']);
	}

	$total_pages = ceil($total_wallpapers / $template['fav_wallpaper_limit']);
	
	if ($total_pages != 0) {
		echo '<br style="clear:both" /><div id="profile_fav_wallpapers_pages" class="profile_fav_pages">';
		if ($page != 1) {
			$prev_page = $page - 1;
			echo '<a href="#" onclick="UserWallpapers('.$id.', \'fav_wallpapers\', '.$prev_page.');return false">&laquo; '.PREVIOUS.'</a> ';
		}
		if ($total_pages != $page) {
			$next_page = $page + 1;
			echo '<a href="#" onclick="UserWallpapers('.$id.', \'fav_wallpapers\', '.$next_page.');return false">'.MORE.' &raquo;</a>';
		}
		echo '</div>';
	}

	if (!isset($_POST['page']))
		echo '</div>';
}

else {
	echo PROFILE_NO_FAVS;
}
?>