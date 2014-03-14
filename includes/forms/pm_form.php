<form name="form1" method="post" action="<?php echo $setting['site_url']?>/index.php?id=<?php echo $_GET['id'];?>&task=send_message&done=1">
  <p>
    <label>
    <?php echo PM_SUBJECT;?>: <br /><input type="text" name="message_title" id="message_title" class="pm_subject_textbox" value="<?php echo $subject;?>" />
    </label><br /><br />
    <?php echo PM_MESSAGE;?>: <br />
  <textarea name="message" cols="50" rows="4" id="message" class="pm_message_textbox"></textarea>
  <br /><br /><input type="submit" name="Submit" value="<?php echo PM_SEND_MESSAGE;?>" class="pm_button" />
  </p>
</form>
