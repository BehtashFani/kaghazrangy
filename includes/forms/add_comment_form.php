<?php
 if ($user['login_status'] == 1) { ?>
<form action="" method="get" onsubmit="return false;">
    <div><textarea name="comment" cols="60" rows="4" id="the_comment" class="add_comment_box"></textarea>
    <br />
    </div>
      <div class="comment_button_container"><input type="submit" name="Submit" id="comment_submit" value="<?php echo WALLPAPER_SUBMIT_COMMENT;?>" onclick="AddComment(<?php echo $id.",'".$setting['site_url'];?>', 'wallpaper')" /></div>
</form>
<?php } else {
echo '<div id="login_to_comment">'.WALLPAPER_LOGIN_COMMENT.'</div>';
}
?>