<?php
include '../../../config.php';
$id = intval($_POST['id']);
$userid = intval($_COOKIE['wss_userid']);

$sql = mysql_query("SELECT * FROM wss_users WHERE id=".$userid."");
$row = mysql_fetch_array($sql);
if ($row['password'] == $_COOKIE['wss_code']) {
	$user_rated_yet = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_favourites WHERE user_id='$userid' AND wallpaper_id='$id'"), 0);
	if ($user_rated_yet >= 1) {
		// Remove favourite
		mysql_query("DELETE FROM wss_favourites WHERE user_id='$userid' AND wallpaper_id='$id'");
		$user_favs = str_replace(', '.$id, '', $row['favourites']);
		mysql_query("UPDATE wss_users SET favourites='$user_favs' WHERE id='$userid'");
	}
	else {
		// Add favourite
		mysql_query("INSERT INTO wss_favourites (user_id, wallpaper_id) VALUES ('$userid', '$id')");
		mysql_query("UPDATE wss_users SET favourites = CONCAT(favourites, ', $id') WHERE id='$userid'");
	}
}
?>