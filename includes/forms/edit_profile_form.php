<?php
include('includes/forms/avatar_form.php');
echo '<div class="edit_profile_header">'.EP_TITLE.'</div>
<div class="edit_info_container">
<form id="form1" name="form1" method="post" action="index.php?task=edit_profile&done=1">
  '.EP_LOCATION.':<br />
            <input name="location" type="text" id="location" class="edit_profile_textbox" value="'.$location2.'" size="30" /><br /><br />
  '.EP_INTERESTS.':<br />
            <textarea name="interests" cols="30" id="interests" class="edit_profile_textarea">'.$interests2.'</textarea><br /><br />
  '.EP_ABOUT.':<br />
            <textarea name="about" cols="30" id="about" class="edit_profile_textarea">'.$about2.'</textarea><br /><br />
 '.EP_WEBSITE.':<br />         
            <input name="website" type="text" id="website" class="edit_profile_textbox" value="'.$website2.'" size="30" /><br /><br />
'.LP_BUTTON2.':<br />         
            <input name="new_password" id="new_password" class="edit_profile_textbox" size="30" type="password" /><br /><br />
  <br />
            <input type="submit" name="Submit" value="'.EP_BUTTON.'" class="edit_profile_button" />
  </form></div>';
?>