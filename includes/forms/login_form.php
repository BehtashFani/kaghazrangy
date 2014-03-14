<?php 
if (isset($error_message)) {
	echo '<div id="error_message">'.$error_message.'</div>';
}
?>

<form method="post" action="<?php echo $setting['site_url'];?>/login.php?done=1">
<div class="login_form">
  <?php echo LOGIN_USERNAME; ?><br />
  <input name="username" type="text" id="username" class="form_textbox" /><br />
  <br /><?php echo LOGIN_PASSWORD; ?><br />
    <input name="password" type="password" id="password" class="form_textbox" /><br /><br />
     <a href="<?php echo $setting['site_url'];?>/index.php?task=lost_password"><?php echo LOGIN_FORGOT_PASSWORD; ?></a><br /><br />
    <label><input type="checkbox" name="remember" id="remember" checked="checked" /> <?php echo LOGIN_REMEMBER_ME; ?></label><br /><br />
      <input type="submit" name="Submit" value="<?php echo LOGIN_BUTTON; ?>" class="dropdown-submit" />
</div>
</form>