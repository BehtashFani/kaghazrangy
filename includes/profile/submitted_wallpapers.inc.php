<?php
if (!isset($_POST['page'])) {
	$page = 1;
	$div_id = '<div id="user_submitted_wallpapers_section">';
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
	$div_id = '';
}

$from = (($page * $template['submitted_wallpaper_limit']) - $template['submitted_wallpaper_limit']);

$total_wallpapers = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_wallpapers WHERE submitter = $id AND published=1"), 0);

$sql = mysql_query("SELECT * from wss_wallpapers WHERE submitter = $id AND published = 1  LIMIT $from, $template[submitted_wallpaper_limit]");

if ($total_wallpapers != 0) {
	echo $div_id;

	while ($wallpapers = mysql_fetch_array($sql)) {
		$wallpaper = WallpaperData($wallpapers, 'user_submissions');

		// Include the template for favourite wallpapers
		include($location.$setting['template_url'].'/'.$template['submitted_wallpaper']);
	}

	$total_pages = ceil($total_wallpapers / $template['submitted_wallpaper_limit']);
	
	if ($total_pages != 0) {
		echo '<br style="clear:both" /><div id="profile_submitted_wallpapers_pages" class="profile_submitted_pages">';
		if ($page != 1) {
			$prev_page = $page - 1;
			echo '<a href="#" onclick="UserWallpapers('.$id.', \'submitted_wallpapers\', '.$prev_page.');return false">&laquo; '.PREVIOUS.'</a> ';
		}
		if ($total_pages != $page) {
			$next_page = $page + 1;
			echo '<a href="#" onclick="UserWallpapers('.$id.', \'submitted_wallpapers\', '.$next_page.');return false">'.MORE.' &raquo;</a>';
		}
		echo '</div>';
	}

	if (!isset($_POST['page']))
		echo '</div>';
}

else {
	echo PROFILE_NO_UPLOADS;
}
?>