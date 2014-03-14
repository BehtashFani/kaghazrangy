<?php
echo '<ul>';
$sql = mysql_query("SELECT * FROM wss_users ORDER BY id desc LIMIT 10");
while($row = mysql_fetch_array($sql))
{				
	$url = ProfileUrl($row['id'], $row['seo_url']);
		
	echo '<li><a href="'.$url.'">'.$row['username'].'</a></li>';
}

echo '</ul>';
?>
