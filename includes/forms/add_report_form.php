<div class="wallpaper_report_text"><?php echo WALLPAPER_REPORT_TITLE; ?></div><br />

<form action="" method="get" onsubmit="return false;">
    <div><textarea name="report" cols="60" rows="4" id="the_report" class="add_report_box"></textarea>
    <br />
    </div>
      <div class="report_button_container" style="position:center;"><input type="submit" name="Submit" id="report_submit" value="<?php echo WALLPAPER_SUBMIT_REPORT;?>" onclick="SendReport(<?php echo $id.",'".$setting['site_url'];?>')" />
      
      <input type="button" name="close" id="close_report" value="<?php echo WALLPAPER_CLOSE_REPORT;?>" onclick="toggleSlide('reportform')" />
      
      </div>
</form>