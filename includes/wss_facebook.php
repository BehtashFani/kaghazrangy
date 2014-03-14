<?php

include 'includes/facebook.php';

$facebook = new Facebook(array(
		'appId'  => $setting['facebook_appid'],
		'secret' => $setting['facebook_secret'],
		'cookie' => true, // enable optional cookie support
	));

if ($facebook->getUser()) {
	$facebook_session = 1;

	try {
		$fb_user = $facebook->api('/me');
	} catch (FacebookApiException $e) {
		error_log($e);
	}

	function get_facebook_cookie($app_id, $application_secret) {
		$args = array();
		parse_str(trim($_COOKIE['fbs_' . $app_id], '\\"'), $args);
		ksort($args);
		$payload = '';
		foreach ($args as $key => $value) {
			if ($key != 'sig') {
				$payload .= $key . '=' . $value;
			}
		}
		if (md5($payload . $application_secret) != $args['sig']) {
			return null;
		}
		return $args;
	}

	$cookie = get_facebook_cookie($setting['facebook_appid'], $setting['facebook_secret']);

	// Facebook's connection failed? Maybe we can still do it ourselves...
	if (!isset($fb_user['id'])) {
		$open = @file_get_contents('https://graph.facebook.com/me?access_token='.$cookie['access_token']);

		if ($open != FALSE) {
			$fbdata = json_decode($open);
			$fb_user = array();

			foreach($fbdata as $key => $fbdata2) {
				$fb_user[$key] = $fbdata2;
			}
		}
	}

}
else {
	$facebook_session = 0;
}

?>