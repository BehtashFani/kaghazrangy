<?php
if (isset($_GET['id']) || isset($_GET['name'])) {
	if (isset($_GET['id'])) {
		$id = intval($_GET['id']);
		$sql = mysql_query("SELECT * FROM wss_news WHERE id=".$id." LIMIT 1");
	}
	else {
		$name = mysql_secure($_GET['name']);
		$sql = mysql_query("SELECT * FROM wss_news WHERE seo_url= '$name'");
	}

	$count = mysql_num_rows($sql);

	if (!$count) {
		header("HTTP/1.0 404 Not Found");
		include 'includes/misc/404.php';
		exit();
	}

	$news = mysql_fetch_array($sql);
}

$news['rss_icon'] = '<a href="'.$setting['site_url'].'/rss_news.php"><img valign="middle" src="'.$setting['site_url'].'/images/rss_small.png" /></a>';

if ($setting['seo_on'] == 0) {
	$nh_url = '/index.php?task=news';
}
else {
	$nh_url = '/news';
}
$news['home_url'] = $setting['site_url'].'/'.$nh_url;
?>