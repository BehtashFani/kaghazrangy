<?php
$therow = 0;
if ($_GET['q'] && $_GET['q'] != 'Search...') {
	if (!isset($_GET['page'])) {
		$page = 1;
	}
	else {
		$page = $_GET['page'];
	}
	$from = (($page * $template['wallpapers_per_page']) - $template['wallpapers_per_page']);

	$var = $_GET['q'] ;
	$trimmed = mysql_secure($var);

	$total_results_search = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_wallpapers WHERE description like \"%$trimmed%\" OR name like \"%$trimmed%\" OR tags like \"%$trimmed%\" AND published=1"),0);
	if ($trimmed == "" OR $trimmed == 'Search...') 
		echo '<strong>'.NOSEARCH.'</strong><br /><br />';
		
	elseif ($total_results_search >= 100) 
  		echo '<strong>'.TOO_MANY.'</strong><br /><br />';
			
	elseif ($total_results_search == 0) 
  		echo '<strong>'.NORESULTS.'</strong><br /><br />';

	else 
		$sql = mysql_query("SELECT * FROM wss_wallpapers WHERE description like \"%$trimmed%\" OR name like \"%$trimmed%\" OR tags like \"%$trimmed%\" AND published=1
  			ORDER BY id DESC LIMIT $from, $template[wallpapers_per_page]");
			
	echo '<div class="search_container">';
	while($row = mysql_fetch_array($sql)) {
 		$wallpaper = WallpaperData($row, 'category');
		
		include('.'.$setting['template_url'].'/'.$template['search_wallpaper']);

	}
	echo '</div>';
	
	// Pages
	$total_pages = ceil($total_results_search / $template['wallpapers_per_page']);

	if ($total_pages > 1) {

		echo '<div class="category_pages">';
		$url = $setting['site_url'].'/index.php?task=search&q='.$trimmed.'&page=';
	
		if($page > 1){
			$prev = ($page - 1);
			echo '<a href="'.$url.$prev.'">&lt;&lt; '.PREVIOUS.'</a> ';
		}

		for($i = 1; $i <= $total_pages; $i++){
			if($page == $i){
        		echo '<b><a href="#">'.$i.'</a></b>';
    		} 
    		else {
				echo '<a href="'.$url.$i.'">'.$i.'</a> ';
    		}
		}

		if($page < $total_pages){
   			$next = ($page + 1);
			echo '<a href="'.$url.$next.'">'.NEXT.' >></a> ';
		}

		echo '</div>';
	}
}

else {
	echo '<br /><br /><div align="center">'.ENTER_SEARCH.':<br /><br /><form name="form" action="'.$setting['site_url'].'/index.php?task=search" method="get">
      <input name="q" type="text" size="25"/> 
      <input type="submit" name="Submit" value="'.SEARCH_BUTTON.'" class="btn" />
      <input name="task" type="hidden" value="search" />
</form></div>';}
	
?>