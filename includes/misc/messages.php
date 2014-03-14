<?php
defined( 'WSS_' ) or die( '' );
if ($user['login_status'] == 1) {

	if (isset($_GET['pm_task']) && $_GET['pm_task'] == 'delete') {
		$id = intval($_GET['id']);
		
		$result = mysql_query("DELETE FROM wss_messages WHERE id='".$id."' AND user_id='$user[id]'");
		
		// Update user messages counter
		$msg_count = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_messages WHERE user_id=$user[id] AND `read`=0"),0);
		$update = mysql_query("UPDATE wss_users SET messages=$msg_count WHERE id='$user[id]'") or die (mysql_error());
		
		echo '<div id="pm_task_complete">'.PM_DELETED.'</div>';
	}
	else if (isset($_GET['pm_task']) && $_GET['pm_task'] == 'unread') {
			$id = intval($_GET['id']);
			$sql = mysql_query("SELECT * FROM wss_messages WHERE id=".$id."");
			$row = mysql_fetch_array($sql);
			if ($row['read'] == 1) {
				mysql_query('UPDATE `wss_messages` SET `read` = \'0\' WHERE `wss_messages`.`id` = '.$id.' LIMIT 1;');
				
				// Update user messages counter
				$msg_count = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_messages WHERE user_id=$user[id] AND `read`=0"),0);
				$update = mysql_query("UPDATE wss_users SET messages=$msg_count WHERE id='$user[id]'") or die (mysql_error());
				echo '<div id="pm_task_complete">'.PM_MAU.'</div>';
			}
	}
	
	$msgs = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wss_messages WHERE user_id=$user[id]"),0);
	if ($msgs >= 1) { 
		$sql = mysql_query("SELECT * FROM wss_messages WHERE user_id=$user[id] ORDER BY id desc");
		echo '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="pm_table">
    	<tr>
        <td><strong>'.PM_SUBJECT.'</strong></td>
        <td><strong>'.PM_FROM.'</strong></td>
	    <td><strong>'.PM_DATE.'</strong></td>
        <td><strong></strong></td>
        </tr>';
		while ($row = mysql_fetch_array($sql)) {
			if ($row['read'] == 0) {
				$img = '<img align="absmiddle" src="'.$setting['site_url'].$setting['template_url'].'/images/newmessage.png">';
				$link_class = 'unread_pm_link';
			}
			else {
				$img = '<img align="absmiddle" src="'.$setting['site_url'].$setting['template_url'].'/images/readmessage.png">';
				$link_class = 'read_pm_link';
			}
			echo '<tr>
      		<td>
      		'.$img.' <a class="'.$link_class.'" href="'.$setting['site_url'].'/index.php?task=view_message&amp;id='.$row['id'].'">'.$row['title'].'</a>
      		</td>
     		<td>
     			'.$row['sender_name'].'
     		</td>
			<td>
				'.FormatDate($row['date'], 'time').'
			</td>
      		<td>
      			<div align="right">
      				<a href="'.$setting['site_url'].'/index.php?task=send_message&amp;re='.$row['id'].'&amp;id='.$row['sender_id'].'"><img src="'.$setting['site_url'].$setting['template_url'].'/images/reply.png" title="'.PM_REPLY.'" /></a>&nbsp;';
      				$profile_url = ProfileUrl($row['sender_id'], seoname($row['sender_name']));
      				echo '<a href="'.$profile_url.'"><img src="'.$setting['site_url'].$setting['template_url'].'/images/profile.png" title="'.PM_SENDER_PROFILE.'" /></a>&nbsp;&nbsp;&nbsp;
					<a href="'.$setting['site_url'].'/index.php?task=messages&pm_task=delete&id='.$row['id'].'"><img src="'.$setting['site_url'].$setting['template_url'].'/images/deletemessage.png" title="'.PM_DELETE_MESSAGE.'" /></a>
				</div>
			</td>
    		  </tr>';
    	 } 
    	 echo'</table>';
	}
	else {
		echo '<div class="pm_no_messages">'.PM_NO_MESSAGES.'</div>';
	}
}
else {
	echo PM_LOGIN.'<br /><br />';
}
?>