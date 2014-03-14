<form name="form1" method="post" target="_self" action="<?php echo $setting['site_url'];?>/index.php?task=lost_password&step=4&id=<?php echo $_GET['id'].'&reset_code='.$_GET['reset_code'];?>">
 <?php echo LP_PASSWORD;?><br />
    <input name="password1" type="password" id="password1" class="form_textbox"><br /><br />
   <?php echo LP_PASSWORD2;?><br />
    <input name="password2" type="password" id="password1" class="form_textbox"><br /><br />
    
      <input type="submit" name="Submit" value="<?php echo LP_BUTTON2;?>" class="dropdown-submit">
</form>