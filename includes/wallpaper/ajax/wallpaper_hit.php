<?php
include '../../../config.php';
	
$id = intval($_POST['wallpaper_id']);

mysql_query("UPDATE wss_wallpapers SET hits = hits + 1 WHERE id=$id") or die (mysql_error());
?>