<?php
$c_answer = '';
if (isset($_POST['username'])) {
	$username = secure($_POST['username']);
	$email = secure($_POST['email']);
	if (isset($_POST['qa_captcha_answer']))
		$c_answer = secure($_POST['qa_captcha_answer']);
}
else {
	$username = '';
	$email = '';
}
?>

<form method="post" action="<?php echo $setting['site_url'];?>/index.php?task=register&amp;done=1">

<div class="main_register_form">
<h1>لطفا ثبت نام کنید</h1>
<br />
<div class="register_form">
<h3><?php echo REGISTER_USERNAME;?></h3><br />
<input name="username" type="text" class="form_username" maxlength="30" value="<?php echo $username;?>" /><br /><br />
<h3><?php echo REGISTER_EMAIL;?></h3><br />
<input name="email" type="text" class="form_email" value="<?php echo $email;?>" /><br /><br />

<h3><?php echo REGISTER_PASSWORD;?></h3> <br />
<input name="password" type="password" class="form_passwd" /><br /><br />

<h3><?php echo REGISTER_PASSWORD2;?></h3><br />
<input name="password2" type="password" class="form_passwd2" /><br /><br />

<?php
if ($setting['use_captcha'] == 1) {
	require_once('includes/misc/recaptchalib.php');
	echo recaptcha_get_html($setting['captcha_pubkey']);
}
?>

<?php
if ($setting['use_qa_captcha'] == 1) {
	echo $setting['qa_captcha_question'];
	echo '<br /><input name="qa_captcha_answer" type="text" class="form_textbox" value="'.$c_answer.'" /><br /><br />';
}
?>
<br />
<div class="registeration_button">
<button type="submit" name="Submit" id="registeration_button" ><?php echo REGISTER_BUTTON; ?></button>
</div>
</div>
</div>
</form>