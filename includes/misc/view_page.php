<?php
$count = mysql_num_rows($get_page_data);
if ($count == 1) {
	echo $page['page'];
}
else {
	echo PAGE_NOT_FOUND_INFO;
}
?>
