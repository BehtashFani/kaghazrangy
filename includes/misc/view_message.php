<?php
// VIEW A PRIVATE MESSAGE

defined( 'WSS_' ) or die( '' );
if (isset($_COOKIE["wss_username"])) {

	$id = intval($_GET['id']);
	$sql = mysql_query("SELECT * FROM wss_messages WHERE id=".$id."");
	while ($row = mysql_fetch_array($sql)) {

		$usersql = mysql_query("SELECT * FROM wss_users WHERE id=".$row['user_id']."");
		while ($userrow = mysql_fetch_array($usersql)) {
			// Extra password verification
			if ($userrow['password'] == $_COOKIE['wss_code']) {
					// Display the PM and the options
					echo '<div class="pm_subject">'.$row['title'].'</div>
					<div class="pm_details"><strong>'.PM_FROM.':</strong> <a href="'.$setting['site_url'].'/index.php?task=profile&amp;id='.$row['sender_id'].'">'.$row['sender_name'].'</a> <strong>'.PM_DATE.':</strong> '.FormatDate($row['date'], 'time').'</div>
					
					<div class="pm_message">'.$row['message'].'</div>';
					
					$profile_url = ProfileUrl($row['sender_id'], seoname($row['sender_name']));

					echo ' <div class="pm_footer">
						<a href="'.$setting['site_url'].'/index.php?task=send_message&amp;id='.$row['sender_id'].'&re='.$row['id'].'">'.PM_REPLY.'</a> 
						<a href="'.$setting['site_url'].'/index.php?task=messages&pm_task=delete&id='.$row['id'].'">'.PM_DELETE_MESSAGE.'</a> 
						<a href="'.$profile_url.'">'.PM_SENDER_PROFILE.'</a> 
						<a href="'.$setting['site_url'].'/index.php?task=messages&pm_task=unread&id='.$row['id'].'">'.PM_MARK_UNREAD.'</a> 
						<a href="'.$setting['site_url'].'/index.php?task=messages">'.PM_RETURN.'</a>
					</div>';
					if($row['read'] == 0) {
						mysql_query('UPDATE `wss_messages` SET `read` = \'1\' WHERE `wss_messages`.`id` = '.$id.' LIMIT 1;');
						
						// Update user messages counter
						$msg_count = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_messages WHERE user_id=$user[id] AND `read`=0"),0);
						$update = mysql_query("UPDATE wss_users SET messages=$msg_count WHERE id='$user[id]'") or die (mysql_error());
					}
			}
		}
	}
}
else {
	echo '<br />Please log-in to view this message<br /><br />';
	include 'login_form.php';
}
?>