<?php
include '../../../config.php';
include '../../core.php';
$id = intval($_POST['id']);
$userid = intval($_COOKIE['wss_userid']);

if (isset($_COOKIE["wss_username"])) {
	$user_rated_yet = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_ratings WHERE user_id='$userid' AND wallpaper_id='$id'"), 0);
	if ($user_rated_yet >= 1) {
		echo ALREADY_RATED;
	}
	else {

		$wss_userid = intval($_COOKIE['wss_userid']);
		$rating = intval($_POST['rating']);

		if ($_POST['rating'] > 5 || $_POST['rating'] < 0) {
			echo 'Nope';
			exit();
		}


		$sql = mysql_query("SELECT * FROM wss_users WHERE id=".$userid."");
		$row = mysql_fetch_array($sql);
		if ($row['password'] == $_COOKIE['wss_code']) {
			mysql_query("INSERT INTO wss_ratings (wallpaper_id, user_id, rating, ip) VALUES ('$id', '$wss_userid', '$rating', '$_SERVER[REMOTE_ADDR]')");
				
			$no_of_ratings = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_ratings WHERE wallpaper_id='$id'"),0);
			$get_ratings = mysql_query("SELECT sum(rating) AS rating FROM wss_ratings WHERE wallpaper_id='$id'");
			$ratings_sum = mysql_fetch_array($get_ratings);

			$rating = ($ratings_sum['rating'] / $no_of_ratings);
				
			mysql_query("UPDATE wss_wallpapers SET rating='$rating' WHERE id='$id'") or die (mysql_error());
			mysql_query("UPDATE wss_users SET ratings = ratings + 1 WHERE id='".$userid."'") or die (mysql_error());
							
		}
	}
}

?>