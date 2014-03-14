<?php
echo '<ul>';
$sql = mysql_query("SELECT * FROM wss_news ORDER BY id desc LIMIT 10");
while($row = mysql_fetch_array($sql)) {
			
	$url = NewsUrl($row['id'], $row['seo_url']);
		
	$title = shortenStr($row['title'], $template['module_max_chars']);
	
	if ($setting['module_thumbs'] == 1) {
		$image_url = $setting['site_url'].'/uploads/news_icons/'.$row['image'];
		$image = '<img src="'.$image_url.'" width="25" height="25" style="vertical-align: middle;" />';
	}
	else {
		$image = '';
	}
	
	echo '<li>'.$image.' <a href="'.$url.'">'.$title.'</a></li>';
}
echo '</ul>';
?>
