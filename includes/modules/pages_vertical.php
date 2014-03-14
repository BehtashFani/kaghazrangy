<?php
echo '<ul>';

if ($setting['seo_on'] == 0) {
	echo '<li><a href="'.$setting['site_url'].'">Home</a></li>
	<li><a href="'.$setting['site_url'].'/index.php?task=news">'.NEWS.'</a></li>
	<li><a href="'.$setting['site_url'].'/rss.php">Subscribe</a></li>
	<li><a href="'.$setting['site_url'].'/index.php?task=member_list">'.MEMBER_LIST.'</a></li>
	<li><a href="'.$setting['site_url'].'/index.php?task=links">'.LINKS.'</a></li>';
}
else {
	echo '<li><a href="'.$setting['site_url'].'">Home</a></li>
	<li><a href="'.$setting['site_url'].'/news">'.NEWS.'</a></li>
	<li><a href="'.$setting['site_url'].'/rss.php">Subscribe</a></li>
	<li><a href="'.$setting['site_url'].'/members">'.MEMBER_LIST.'</a></li>
	<li><a href="'.$setting['site_url'].'/links/">'.LINKS.'</a></li>';
} 

$sql = mysql_query("SELECT * FROM wss_pages ORDER BY id desc LIMIT 10");
while($row = mysql_fetch_array($sql)) {
	$seo_name = seoname($row['name']);
			
	if ($setting['seo_on'] == 0) {
		$url = 'index.php?task=page&amp;id='.$row['id'];
	}
	else {
		$url = 'page/'.$row['id'].'/'.$seo_name;
	}
	
	echo '<li><a href="'.$setting['site_url'].'/'.$url.'">'.$row['name'].'</a></li>';
}

echo '</ul>';
?>
