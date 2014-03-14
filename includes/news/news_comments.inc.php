<! Report popup & overlay !>
<div id="ava-popup">
	<div id="ava-popup-header">
		<div id="ava-popup-title"></div>
		<div id="popup-close-button" onclick="HidePopup('ava-popup');">X</div>
	</div>
	<div id="ava-popup-content"></div>
</div>
<div id="overlay" onclick="HidePopup('ava-popup')"></div>
<div id="ava-wallpaper_container"></div>

<div id="news_comments">
<ul id="news_comment_list">
<?php
defined( 'WSS_' ) or die( '' );

$sql = mysql_query("SELECT * FROM wss_news_comments WHERE link_id=".$id." ORDER BY id desc");
while ($row = mysql_fetch_array($sql)) {
	$the_user = mysql_query("SELECT * FROM wss_users WHERE id=".$row['user']." LIMIT 1");
	$user2 = mysql_fetch_array($the_user);
	$comment = array('username' => $user2['username'], 'content' => nl2br($row['comment']));
	
	$seo_username = seoname($user2['username']);
		
	$comment['user_url'] = ProfileUrl($user2['id'], $user2['seo_url']);
		
	if ($user['admin'] == 1) { 
		$comment['delete'] = '<a href="#" onclick="DeleteNewsComment('.$row['id'].', '."'".$setting['site_url']."'".'); return false">'.DELETE_COMMENT.'</a>';
		$comment['report_button'] = '<a href="'.$setting['site_url'].'/admin/?task=manage_users#page=1&ip='.$row['ip'].'"><img src="'.$setting['site_url'].'/images/report.png" title="'.$row['ip'].'" style="vertical-align:middle;"/></a>';
	}
	else {
		$comment['delete'] = '';
		if ($setting['report_permissions'] == "1" || $setting['report_permissions'] == "2" && $user['login_status'] == 1) {
			$comment['report_button'] = '<a href="#" onclick="ShowPopup(\'ava-popup\', \''.$setting['site_url'].'/includes/forms/comment_report_form.php?id='.$row['id'].'&type=3\', \'Report comment\'); return false"><img src="'.$setting['site_url'].'/images/report.png" title="'.REPORT.'" style="vertical-align:middle;"/></a>';
		}
		else {
			$comment['report_button'] = '';
		}
	}
		
	if ($user2['avatar'] == '') {
		if ($user2['facebook'] == 1) {
			$comment['avatar_url'] = 'http://graph.facebook.com/'.$user2['facebook_id'].'/picture';
		}
		else {
			$comment['avatar_url'] = $setting['site_url'].'/uploads/avatars/default.png';
		}
	}
	else {
		$comment['avatar_url'] = $setting['site_url'].'/uploads/avatars/'.$user2['avatar'];
	}
	
	if ($row['date'] != '0000-00-00 00:00:00') {
		$comment['date'] = FormatDate($row['date'], 'time');
	}
	else {
		$comment['date'] = '';
	}		
	echo '<a name="comment'.$row['id'].'"></a> <li id="comment-'.$row['id'].'">';
	include '.'.$setting['template_url'].'/'.$template['news_comment'];
	echo '</li>';
}
?>
</ul>
</div>