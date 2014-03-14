<img src="<?php echo $setting['site_url'];?>/images/fb_title.png" />

<div class="facebook_message"><?php echo FB_HELLO.' '.$fb_user['first_name'].'. '.FB_INFO; ?></div>

<form method="post" action="<?php echo $setting['site_url'];?>/facebook_auth.php?signup=1">
<div class="login_form">
  <?php echo FB_USERNAME; ?><br />
  <input name="username" type="text" id="username" class="form_textbox" /><br /><br />
        <input type="submit" name="Submit" value="<?php echo FB_REGISTER; ?>" class="dropdown-submit" />
</div>
</form>