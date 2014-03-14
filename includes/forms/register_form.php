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
<div class="register_form">
<?php echo REGISTER_USERNAME;?><br />
<input name="username" type="text" class="form_textbox" maxlength="30" value="<?php echo $username;?>" /><br /><br />

<?php echo REGISTER_EMAIL;?><br />
<input name="email" type="text" class="form_textbox" value="<?php echo $email;?>" /><br /><br />

<?php echo REGISTER_PASSWORD;?> <br />
<input name="password" type="password" class="form_textbox" /><br /><br />

<?php echo REGISTER_PASSWORD2;?><br />
<input name="password2" type="password" class="form_textbox" /><br /><br />

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

<input type="submit" name="Submit" value="<?php echo REGISTER_BUTTON; ?>" class="register_button" />
</div>
</form>