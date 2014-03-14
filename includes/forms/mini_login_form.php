<?php 
if (isset($error_message)) {
	echo '<div id="error_message">'.$error_message.'</div>';
}
?>

<form method="post" action="<?php echo $setting['site_url'];?>/login.php?done=1">
<div class="mini_login_form">
  <p><?php echo LOGIN_USERNAME; ?></p>
  <input name="username" type="text" id="username" class="mini_login_textbox" /><br />
  <p><?php echo LOGIN_PASSWORD; ?></p>
    <input name="password" type="password" id="password" class="mini_login_textbox" /><br />
    <p><label><input type="checkbox" name="remember" id="remember" checked="checked" /> <?php echo LOGIN_REMEMBER_ME; ?></label></p>
      <input type="submit" name="Submit" value="<?php echo LOGIN_BUTTON; ?>" class="mini_login_button" />
      
      <a href="<?php echo $setting['site_url'];?>/index.php?task=lost_password"><?php echo LOGIN_FORGOT_PASSWORD; ?></a>
</div>
</form>