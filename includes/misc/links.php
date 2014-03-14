<?php
if ($setting['link_exchange'] == 1) {

	echo '<div class="links_header">'.LINK_EXCHANGE.'</a></div>';

	include 'includes/misc/submit_link.php';
	
}



$sql = mysql_query("SELECT * FROM wss_links  WHERE published = 1 ORDER BY id asc");

while($row = mysql_fetch_array($sql))	{
	
	

}
?>