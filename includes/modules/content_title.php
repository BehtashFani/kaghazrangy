<?php
if (isset($_GET["task"])) {

	if($_GET['task'] == 'login') {
		echo LOGIN;
	}
	else if($_GET['task'] == 'register') {
		echo REGISTER;
	}
	else if($_GET['task'] == 'search') {
		if ($_GET['q'] && $_GET['q'] != 'Search...') {
			$qq = mysql_secure($_GET["q"]);
			echo SEARCH_RESULTS.' "'.$qq.'"';
		}
		else { 
			echo SEARCH_BUTTON;
		}
	}
	else if($_GET['task'] == 'profile') {
		echo $profile['name'];
	}
	else if($_GET['task'] == 'thisis') 
		echo 'This is A<b></b>V A<b></b>rcade Pro';
		
	else if($_GET['task'] == 'edit_profile') 
		echo EDIT_PROFILE;
			
	else if($_GET['task'] == 'lost_password') 
		echo LOST_PASS;
		
	else if($_GET['task'] == 'submit') 
		echo SUBMIT_WALLPAPER;
		
	else if($_GET['task'] == 'validate') 
		echo UA_REGISTER;
		
	else if($_GET['task'] == 'links') 
		echo LINKS;
		
	else if($_GET['task'] == 'news') 
		echo NEWS;
		
	else if($_GET['task'] == 'messages' || $_GET['task'] == 'view_message') 
		echo MESSAGES;
		
	else if($_GET['task'] == 'member_list') 
		echo MEMBER_LIST;
		
	else if ($_GET["task"] == 'facebook_register') 
		echo FB_LOGIN;
		
	else if($_GET['task'] == 'view_page')
		echo $page['name'];

	else if($_GET['task'] == 'view') {
		echo $wallpaper['name'];
	} 
	else if ($_GET['task'] == 'category') { 
		echo $cat_info['name'];  
	}
	else if ($_GET['task'] == 'send_message') {
		if (isset($_GET['id'])) {
			$id = intval($_GET['id']);
			$sql = mysql_query("SELECT * FROM wss_users WHERE id=".$id);
			$row = mysql_fetch_array($sql);
			echo PM_SENDING.' '.$row['username'];
		}
		else {
			echo 'Page not found';
		}
	}
	else if($_GET['task'] == 'tag') {
		$get_tag = str_replace('-', ' ', $_GET['t']);
		$get_tag = mysql_secure($get_tag);
		echo $get_tag;
	}
	else {
		echo PAGE_NOT_FOUND;
	}
}
else {
	echo HOMEPAGE;
}
?>
