<?php	if ($user['login_status'] == 1) { // IF USER IS LOGGED IN ?>

<div class="ua_avatar_container">
<div class="ua_avatar">
	<img src="<?php echo $user['avatar'];?>" width="70" height="70" alt="Avatar" />
</div>
<div class="ua_username">
		<?php echo $user['username'];?>
	</div></div>

<div class="ua_info">
	
	<a href="<?php echo $user['url'];?>" id="user_profile"><?php echo UA_PROFILE;?></a>
	<a href="<?php echo $user['message_url'];?>" id="user_message"><?php echo UA_MESSAGES;?> (<?php echo $user['messages'];?>)</a>
	<p id="user_manager"><?php echo $user['admin_link'];?></p>
	<?php if ($user['facebook'] == 1) { ?>
	<fb:login-button  autologoutlink="true"><?php echo FB_LOGOUT;?></fb:login-button>
	<?php } else { ?>
	<a href="<?php echo $setting['site_url'].'/login.php?action=logout';?>" id="log_out"><?php echo UA_LOGOUT;?></a>
	<?php } ?>
	
</div>

<?php } else { ?>

<?php include 'includes/forms/mini_login_form.php';?>

<a href="<?php echo $setting['site_url'].'/index.php?task=register';?>"><?php echo UA_REGISTER_LONG;?></a>
	
	<?php if ($setting['facebook_on'] == 1) { ?>
	&nbsp;&nbsp;<fb:login-button  autologoutlink="true" perms="email,user_birthday,user_hometown,user_about_me,user_website,publish_stream"><?php echo FB_LOGIN;?></fb:login-button>
	<?php } ?>

<br />
<?php } ?>