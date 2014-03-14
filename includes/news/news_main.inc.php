<?php
defined( 'WSS_' ) or die( '' );
// If id isn't set, get the 10 newest news items.
if ((!isset($_GET['id'])) && (!isset($_GET['name']))) {
	if (!isset($_GET['page'])) {
		$page = 1;
	}
	else {
		$page = $_GET['page'];
	}
	$npp = 5;
	$from = (($page * $npp) - $npp);
	$sql = mysql_query("SELECT * FROM wss_news ORDER BY id DESC LIMIT $from, $npp"); }
else {
	if (isset($_GET['id'])) {
		$sql = mysql_query("SELECT * FROM wss_news WHERE id=".$id." LIMIT 1");
	}
	else {
		$name = mysql_secure($_GET['name']);
		$sql = mysql_query("SELECT * FROM wss_news WHERE seo_url= '$name' LIMIT 1");
	}
}
while ($row = mysql_fetch_array($sql)) {
	$id = $row['id'];
	$sql2 = mysql_query("SELECT * FROM wss_users WHERE id='".$row['user']."' LIMIT 1");
	while ($row2 = mysql_fetch_array($sql2)) {
		// Assign items to 'news' array for use in the template		
		$news = array('title' => $row['title'], 'author' => $row2['username'], 'date' => FormatDate($row['date'], 'short'), 'main' => $row['content']);
		
		$news['user_url'] = ProfileUrl($row2['id'], $row2['seo_url']);
		$news['news_url'] = NewsUrl($row['id'], $row['seo_url']);
				
		$news['comments'] = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_news_comments WHERE link_id=$row[id]"),0);
		
		$news['image_url'] = $setting['site_url'].'/uploads/news_icons/'.$row['image'];
		// Include the template for news items
		include '.'.$setting['template_url'].'/'.$template['news_item']; 
	}
}

if ((!isset($_GET['id'])) && (!isset($_GET['name']))) {
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_news"),0);
	$total_pages = ceil($total_results / $npp);

	if ($total_pages > 1) {

		echo '<div class="category_pages">';
	
		if($page > 1){
			$prev = ($page - 1);
			$url = NewsPagesUrl($prev);
			echo '<a href="'.$url.'">&lt;&lt; '.PREVIOUS.'</a> ';
		}

		for($i = 1; $i <= $total_pages; $i++){
			$url = NewsPagesUrl($i);
			if($page == $i){
        		echo '<b><a href="#">'.$i.'</a></b>';
    		} 
    		else {
				echo '<a href="'.$url.'">'.$i.'</a> ';
    		}
		}

		if($page < $total_pages){
   			$next = ($page + 1);
   			$url = NewsPagesUrl($next);
			echo '<a href="'.$url.'">'.NEXT.' >></a> ';
		}

		echo '</div>';
	}
}
?>