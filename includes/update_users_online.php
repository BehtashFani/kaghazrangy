<?php
$session=session_id();
$time=time();

if (isset($core_admin)) {
	$user_id = $admin['id'];
}
elseif ($user['login_status'] == 1) {
	$user_id = $user['id'];
}
else {
	$user_id = 0;	
}

$sql = mysql_query("SELECT * FROM wss_usersonline WHERE session_id = '$session'");

$count = mysql_num_rows($sql);

if ($count == 0) {
	mysql_query("INSERT INTO wss_usersonline (session_id, time, user_id) VALUES ('$session', '$time', '$user_id')");
}
else {
	mysql_query("UPDATE wss_usersonline SET time= '$time', user_id = '$user_id' WHERE session_id = '$session'");
}

$time_check = $time-600; // Current time minus 10 mins

// Delete all records older than 10 mins
mysql_query("DELETE FROM wss_usersonline WHERE time < $time_check");

?>