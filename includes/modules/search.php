<form name="form" action="<?php echo $setting['site_url']?>/index.php?task=search" method="get">
  <div align="center">
      <input name="q" type="text" size="15"/> 
      <input type="submit" name="Submit" value="<?php echo SEARCH; ?>" class="btn" />
      <input name="task" type="hidden" value="search" />
  </div>
</form>
