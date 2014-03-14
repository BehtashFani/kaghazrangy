<?php

echo '<a href="'.$setting['site_url'].'">'.HOMEPAGE.'</a>'.$template['pages_menu_seperator'].'
<a href="'.CategoryUrl(0, 'all', '1', 'newest').'">'.NEWEST.'</a>'.$template['pages_menu_seperator'].'
<a href="'.CategoryUrl(0, 'all', '1', 'rating').'">'.TOP_RATED.'</a>'.$template['pages_menu_seperator'].'
<a href="'.$setting['site_url'].'/index.php?task=news">'.NEWS;



if ($setting['seo_on'] == 0) {
	if ($setting['allow_submissions'] == 1)
		echo '<a href="'.$setting['site_url'].'/index.php?task=submit">'.PAGES_SUBMIT.'</a>'.$template['pages_menu_seperator'];
}
else {
	if ($setting['allow_submissions'] == 1)
		echo '<a href="'.$setting['site_url'].'/submit'.$setting['seo_extension'].'">'.PAGES_SUBMIT.'</a>'.$template['pages_menu_seperator'];
} 


	
$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_pages WHERE menu = 1"),0); 
if ($total_results >= 1) {
	$sql = mysql_query("SELECT * FROM wss_pages WHERE menu = 1 ORDER BY id");
	while($row = mysql_fetch_array($sql)) {
		if ($setting['seo_on'] == 0) {
			echo $template['pages_menu_seperator'].'<a href="'.$setting['site_url'].'/index.php?task=view_page&amp;id='.$row['id'].'">'.$row['name'].'</a>';
		}
		else if ($setting['seo_on'] == 3) {
			echo $template['pages_menu_seperator'].'<a href="'.$setting['site_url'].'/page/'.$row['seo_url'].$setting['seo_extension'].'">'.$row['name'].'</a>';
		}
		else {	
			echo $template['pages_menu_seperator'].'<a href="'.$setting['site_url'].'/page/'.$row['id'].'/'.$row['seo_url'].$setting['seo_extension'].'">'.$row['name'].'</a>';
		}
	}
}
?>