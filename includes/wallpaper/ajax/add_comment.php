<?php
if (isset($_POST['id']) && isset($_POST['comment'])) {
	$userid = intval($_COOKIE['wss_userid']);
	include '../../../config.php';
	include '../../core.php';
	include('../../..'.$setting['template_url'].'/template_settings.php');
	$the_comment = mysql_secure($_POST['comment']);
	$id = intval($_POST['id']);

	if(isset($_COOKIE["wss_username"])){
	
		$cookie_id = intval($_COOKIE["wss_userid"]);
		$code = preg_replace("/[^a-z,A-Z,0-9]/", "", $_COOKIE['wss_code']);
		$valid_time = (time() - 60);
		$last_comment = mysql_query("SELECT last_comment FROM wss_users WHERE id = $cookie_id AND last_comment > $valid_time");
		if (mysql_num_rows($last_comment) == '0') {

			$user = mysql_query("SELECT * FROM wss_users WHERE id=".$cookie_id."");
			$user2 = mysql_fetch_array($user);
			if ($user2['password'] == $code) {

				$date = time();

				mysql_query("INSERT INTO wss_comments (user, comment, link_id, date, ip) VALUES ('$cookie_id', '$the_comment', '$id', '$date', '$_SERVER[REMOTE_ADDR]')");

				$comment = array('username' => $user2['username'], 'content' => stripslashes(nl2br(strip_tags($_POST['comment']))), 'date' => FormatDate($date, 'time'));

				$comment['delete'] = '';
				$comment['report_button'] = '';

				$seo_username = seoname($user2['username']);
			
				$comment['user_url'] = ProfileUrl($user2['id'], $user2['seo_url']);
		
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

				echo '<a name="1"></a>';
				include '../../..'.$setting['template_url'].'/'.$template['wallpaper_comment'];

				mysql_query("UPDATE wss_users SET comments = comments + 1, last_comment = '$date' WHERE id='".$cookie_id."'") or die (mysql_error());

			}
		}
		else {
			echo '<e1>';
		}
	}
}
?>