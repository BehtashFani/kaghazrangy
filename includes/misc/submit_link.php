<?php

if ($_POST && $setting['link_exchange'] == 1) {
	$anchor = mysql_secure($_POST['anchor']);
	$description = mysql_secure($_POST['description']);
	$url = mysql_secure($_POST['url']);

	if ($anchor == '' || $description == '' || $url == '' || ($user['login_status'] == 0 && $email == '')) {
		echo '<div class="link_exchange_info">'.LINK_EXCHANGE_ERROR.'</div>';
		$anchor = secure($_POST['anchor']);
		$description = secure($_POST['description']);
		
		include 'includes/forms/add_link_form.php';
	}
	else {
		if ($user['login_status'] == 1) {
			$submitter = $user['id'];
		}
		else {
			$submitter = 0;
		}
		mysql_query("INSERT INTO wss_links SET name='$anchor', url = '$url', description = '$description', sitewide = 1, published = 0, 
		submitter = $submitter") or die (mysql_error());
		
		$link_id = mysql_insert_id();
		
		$referral_link = $setting['site_url'].'/?r='.$link_id;
	
		echo '<div class="link_exchange_info">'.LINK_EXCHANGE_STEP2.'<br /></div>';
		
		include 'includes/forms/add_link_form2.php';

	}
}
else {
	$anchor = $description = $url = $email = '';
	echo '<div class="link_exchange_info">'.LINK_EXCHANGE_INFO.'</div>';
	include 'includes/forms/add_link_form.php';
}

?>