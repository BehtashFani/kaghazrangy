<?php
echo '<ul>';
$sql = mysql_query("SELECT * FROM wss_links WHERE sitewide=1 AND published=1 ORDER BY id desc");

while ($row = mysql_fetch_array($sql))
	echo '<li><a href="'.$row['url'].'">'.htmlspecialchars($row['name']).'</a></li>';

echo '</ul><div class="more_links">';

if ($setting['seo_on'] == 0) {
	if($setting['link_exchange'] == 1) {
		echo '<a href="'.$setting['site_url'].'/index.php?task=links">'.LINK_EXCHANGE.'</a>';
	}
	
	echo '<a href="'.$setting['site_url'].'/index.php?task=links">'.MORELINKS.'</a>';
}

echo '</div>';
?>