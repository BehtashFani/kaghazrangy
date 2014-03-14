<div class="submit_form">
<form id="form1" name="form1" method="post" action="index.php?task=submit" enctype="multipart/form-data">
<div class="submit_form_element_container">
   <div class="submit_form_lable">
   <label><?php echo SUBMIT_NAME;?> *</label></div>
   <div class="submit_form_element"><input class="submit_text_box" name="name" type="text"/></div>
</div>

<div class="submit_form_element_container">
   <div class="submit_form_lable"><label><?php echo SUBMIT_DESC;?></label></div>
   <div class="submit_form_element"><textarea class="submit_text_area" name="description"></textarea></div>
</div>

<div class="submit_form_element_container">
   <div class="submit_form_lable">
   <label><?php echo SUBMIT_TAGS;?></label></div>
   <div class="submit_form_element"><input class="submit_text_box" name="tags" type="text"/></div>
</div>
  
<div class="submit_form_element_container">
   <div class="submit_form_lable"><label><?php echo SUBMIT_FILE;?> *</label></div>
   <div class="submit_form_element">
      <input type="file" name="file" id="file"/> 
      <br />
   </div>
</div>

<div class="submit_form_element_container">
   <div class="submit_form_lable">
   <label><?php echo SUBMIT_CAT;?> *</label>
</div>
<div class="submit_form_element"><select name="category">
   <?php categorylist(0); ?>
   </select>
</div>
</div>

<input name="id" type="hidden" value="0" id="id0" />
<div class="submit_button_container"><input class="submit_button" name="Submit" type="submit" value="<?php echo SUBMIT;?>" id="submit0" /></div>
</form>
</div>