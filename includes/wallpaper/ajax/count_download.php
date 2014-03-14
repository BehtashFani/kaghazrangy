<?php
include '../../../config.php';
include '../../../includes/core.php';
	
$id = intval($_POST['wallpaper_id']);

mysql_query("UPDATE wss_wallpapers SET downloads = downloads + 1 WHERE id = $id");
?>