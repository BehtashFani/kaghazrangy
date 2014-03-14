<div class="add_link_form_container">
	<div class="link_form_element_container">
   		<div class="link_form_lable"><label><?php echo LINK_EXCHANGE_UL;?></label></div>
   		<div class="link_form_element"><input class="link_text_box" value="<a href=&quot;<?php echo $referral_link;?>&quot;><?php echo $setting['site_name'];?></a>" onclick="this.select();"/></div>
	</div>
	
	<div class="link_form_element_container">
   		<div class="link_form_lable"><label><?php echo LINK_EXCHANGE_ANCHOR;?></label></div>
   		<div class="link_form_element"><input class="link_text_box" value="<?php echo $setting['site_name'];?>" onclick="this.select();"/></div>
	</div>
	
	<div class="link_form_element_container">
   		<div class="link_form_lable"><label><?php echo LINK_EXCHANGE_URL;?></label></div>
   		<div class="link_form_element"><input class="link_text_box" value="<?php echo $referral_link;?>" onclick="this.select();"/></div>
	</div>
	
	<div class="link_form_element_container">
   		<div class="link_form_lable"><label><?php echo LINK_EXCHANGE_DESCRIPTION;?></label></div>
   		<div class="link_form_element"><input class="link_text_box" value="<?php echo $setting['site_description'];?>" onclick="this.select();"/></div>
	</div>
</div>