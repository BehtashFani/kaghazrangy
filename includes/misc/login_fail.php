<html>
	<head>
		<title><?php echo $setting['site_name'];?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo $setting['site_url'];?>/includes/misc/core.css" />
	</head>
	<body>
	<div class="information"><?php echo 'New password set: Please <a href='.$setting['site_url'].'/login.php?action=logout>'.UA_LOGOUT.'</a> and then login with your new password.';?></div>
	</body>
</html>