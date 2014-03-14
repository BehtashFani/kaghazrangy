<?php

require_once 'config.php';
include 'includes/core.php';

// Include language file
include 'language/'.$setting['language'].'.php';

// Check and set referrer
if (isset($_GET['ref'])) {
	setcookie("wss_ref", $_GET['ref'], time()+60*60*24*100);
}

$id = intval($_GET['id']);

$wallpaper = mysql_query("SELECT * FROM wss_wallpapers WHERE id=$id");
$get_wallpaper = mysql_fetch_array($wallpaper);

$url = WallpaperUrl($get_wallpaper['id'], $get_wallpaper['seo_url'], $get_wallpaper['category']);
$url = str_replace("&amp;", "&", $url);

header("Location: $url");

?>