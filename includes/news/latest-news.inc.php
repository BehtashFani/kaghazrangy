<?php
defined( 'WSS_' ) or die( '' );
$sql = mysql_query("SELECT * FROM wss_news ORDER BY id DESC LIMIT 5");
while ($row = mysql_fetch_array($sql)) {
	$content = strip_tags($row['content']);
	if (strlen($content) > 65) {
		$content = substr($content, 0, 65)."...";
	}
	
	$news_url = NewsUrl($row['id'], $row['seo_url']);
	
	echo '<div class="homepage_news"><strong><a href="'.$news_url.'">'.$row['title'].'</a></strong> - '.$content.'</div>';
}
?>