<?php 
if (isset($error_message)) {
	echo '<div id="error_message">'.$error_message.'</div>';
}
?>

<form method="post" action="<?php echo $setting['site_url'];?>/login.php?done=1">
<div id="main_login_form">
<div class="login_form">
<h1>لطفا فرم زیر را پر کنید</h1>
  <input name="username" type="text" id="username" value="<?php echo LOGIN_USERNAME; ?>" />
    <input name="password" type="password" id="password" value="زمر عبور" /><br/>
     
    <label class="remember">
    	<input type="checkbox" name="remember" id="remember_checkbox" />مرا به خاطر بسپارید 
    </label><br/>
      <input type="submit" name="Submit" value="<?php echo LOGIN_BUTTON; ?>" id="dropdown-submit" />
</div>
		<a href="<?php echo $setting['site_url'];?>/index.php?task=lost_password" id="lost_password">
     	    <?php echo LOGIN_FORGOT_PASSWORD; ?>
        </a><br/>
</div>
</form>