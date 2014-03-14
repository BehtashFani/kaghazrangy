<?php
if (isset($_GET['id']) || isset($_GET['name'])) {
	include 'config.php';
	include 'includes/core.php';
	include 'language/'.$setting['language'].'.php';

	$id = intval($_GET['id']);
	$row = mysql_fetch_array(mysql_query("SELECT * FROM wss_wallpapers WHERE id = $id"));
	
	if (isset($row['id'])) {
	
		$wallpaper = WallpaperData($row, 'wallpaper_preview');
	
		if ($row['display'] != 'original') {
	
			$width = intval($_GET['width']);
			$height = intval($_GET['height']);
	
			if ($setting['seo_on'] != 0) {
				$wallpaper['download_url'] = $setting['site_url'].'/download/'.$_GET['id'].'/'.$width.'x'.$height.'/'.$wallpaper['display'].'/'.$wallpaper['seo_url'].'.'.$wallpaper['file_extension'];
				$wallpaper['image'] = $setting['site_url'].'/file/'.$_GET['id'].'/'.$width.'x'.$height.'/'.$wallpaper['display'].'/'.$wallpaper['seo_url'].'.'.$wallpaper['file_extension'];
			}
			else {
				$wallpaper['download_url'] = $setting['site_url'].'/image.php?id='.$_GET['id'].'&width='.$width.'&height='.$height.'&crop='.$wallpaper['display'].'&download=1';
				$wallpaper['image'] = $setting['site_url'].'/image.php?id='.$_GET['id'].'&width='.$width.'&height='.$height.'&crop='.$wallpaper['display'];
			}
		}
		else {
			$width = $row['original_width'];
			$height = $row['original_height'];
			$wallpaper['download_url'] = $wallpaper['image'] = $setting['site_url'].'/'.$row['file'];
		}
		include '.'.$setting['template_url'].'/pages/wallpaper_preview.php';
	}
	else {
		include 'includes/misc/404.php';
	}
}
else {
	echo PREVIEW_ERROR;
}
?>