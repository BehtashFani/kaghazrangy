<div class="add_link_form_container">
<form id="form1" name="form1" method="post" action="index.php?task=links">

<div class="link_form_element_container">
   <div class="link_form_lable"><label><?php echo LINK_EXCHANGE_ANCHOR;?></label></div>
   <div class="link_form_element"><input class="link_text_box" name="anchor" type="text" value="<?php echo $anchor;?>"/></div>
</div>
  
<div class="link_form_element_container">
   <div class="link_form_lable"><label><?php echo LINK_EXCHANGE_DESCRIPTION;?></label></div>
   <div class="link_form_element"><input class="link_text_box" name="description" type="text" value="<?php echo $description;?>"/></div>
</div>

<div class="link_form_element_container">
   <div class="link_form_lable">
   <label><?php echo LINK_EXCHANGE_URL;?></label></div>
   <div class="link_form_element"><input class="link_text_box" name="url" type="text"  value="<?php echo $url;?>"/></div>
</div>

<?php if ($user['login_status'] != 1) { ?>

<div class="link_form_element_container">
   <div class="link_form_lable">
   <label><?php echo LINK_EXCHANGE_EMAIL;?></label></div>
   <div class="link_form_element"><input class="link_text_box" name="email" type="text"  value="<?php echo $email;?>"/></div>
</div>

<?php } ?>

<input name="id" type="hidden" value="0" id="id0" />
<div class="link_button_container"><input class="link_button" name="Submit" type="submit" value="<?php echo SUBMIT;?>" id="submit0" /><br /></div>
</form>
</div>