<?php
if ($setting['seo_on'] == 0) {
	echo '<a href="'.$setting['site_url'].'/index.php?task=news">'.NEWS.'</a>'.$template['secondary_menu_seperator'].'
	<a href="'.$setting['site_url'].'/rss.php">'.PAGES_SUBSCRIBE.'</a>'.$template['secondary_menu_seperator'].'
	<a href="'.$setting['site_url'].'/index.php?task=member_list">'.MEMBER_LIST.'</a>'.$template['secondary_menu_seperator'].'
	<a href="'.$setting['site_url'].'/index.php?task=links">'.LINKS.'</a>'.$template['secondary_menu_seperator'];
}
else {
	echo '<a href="'.$setting['site_url'].'/news'.$setting['seo_extension'].'">'.NEWS.'</a>'.$template['secondary_menu_seperator'].'
	<a href="'.$setting['site_url'].'/rss.php">'.PAGES_SUBSCRIBE.'</a>'.$template['secondary_menu_seperator'].'
	<a href="'.$setting['site_url'].'/members'.$setting['seo_extension'].'">'.MEMBER_LIST.'</a>'.$template['secondary_menu_seperator'].'
	<a href="'.$setting['site_url'].'/links'.$setting['seo_extension'].'">'.LINKS.'</a>';
}


$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_pages WHERE menu = 2"),0); 
if ($total_results >= 1) {
	$sql = mysql_query("SELECT * FROM wss_pages WHERE menu = 2 ORDER BY id");
	while($row = mysql_fetch_array($sql)) {
		if ($setting['seo_on'] == 0) {
			echo $template['secondary_menu_seperator'].'<a href="'.$setting['site_url'].'/index.php?task=view_page&amp;id='.$row['id'].'">'.$row['name'].'</a>';
		}
		else if ($setting['seo_on'] == 3) {
			echo $template['secondary_menu_seperator'].'<a href="'.$setting['site_url'].'/page/'.$row['seo_url'].$setting['seo_extension'].'">'.$row['name'].'</a>';
		}
		else {	
			echo $template['secondary_menu_seperator'].'<a href="'.$setting['site_url'].'/page/'.$row['id'].'/'.$row['seo_url'].$setting['seo_extension'].'">'.$row['name'].'</a>';
		}
	}
}
?>