<?php
defined( 'WSS_' ) or die( '' );
$id = intval($_GET['id']);
$comment = array();
$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_comments WHERE user='".$id."'"), 0);
if ($total_results <= 0) {
	echo "$profile[name] ".PROFILE_NO_COMMENTS;
}
else {
	$id = intval($_GET['id']);
	if ($_GET['task'] == 'profile') {
		$sql = mysql_query("SELECT * FROM wss_comments WHERE user=".$id." ORDER BY id DESC LIMIT 8");
	}
	else {
		$sql = mysql_query("SELECT * FROM wss_comments WHERE user=".$id." ORDER BY id DESC");
	}

	while ($row = mysql_fetch_array($sql)) {
		
		$wallpaper_exists = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_wallpapers WHERE id=$row[link_id]"), 0);
		if ($wallpaper_exists == 1) {
			$sql2 = mysql_query("SELECT * FROM wss_wallpapers WHERE id=".$row['link_id']." LIMIT 1");
			$row2 = mysql_fetch_array($sql2);
		
			$comment['the_comment'] = nl2br($row['comment']);
			$comment['wallpaper_name'] = $row2['name'];
		
			$comment['wallpaper_url'] = WallpaperUrl($row2['id'], $row2['seo_url'], $row2['category']);
		
			if ($user['admin'] == 1) {
				$comment['admin_options'] = ' <a href='.$setting['site_url'].'/admin/index.php?action=delete_comment&amp;id='.$row['id'].'&link_id='.$row2['id'].'><img src="'.$setting['site_url'].'/admin/delete.png" align="absmiddle" /></a>';
			}
		
			include('.'.$setting['template_url'].'/'.$template['users_comments']);
		}
	}
}


?>