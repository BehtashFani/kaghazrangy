<!-- 
Social buttons for Wallpaper Site Script 

Icon images copyright komodomedia.com

ENCODE CHARS
-->

<br />
<!-- Twitter -->
<a href="http://twitter.com/home?status=<?php echo WALLPAPER_SHARE_MESSAGE;?>: 
<?php echo $short_url;?>" title="Twitter" target="_blank" rel="nofollow">
<img src="<?php echo $setting['site_url'];?>/images/social_icons/twitter.png" alt="Twitter" title="Twitter" />
</a>
<!-- Facebook -->
<a href="http://www.facebook.com/sharer.php?u=<?php echo $short_url;?>&t=<?php echo $wallpaper['name'].'%20-%20'.$setting['site_name'];?>" title="Facebook" target="_blank" rel="nofollow">
<img src="<?php echo $setting['site_url'];?>/images/social_icons/facebook.png" alt="Facebook" title="Facebook" />
</a>
<!-- Digg -->
<a href="http://digg.com/submit?url=<?php echo $long_url;?>" title="Digg" target="_blank" rel="nofollow">
<img src="<?php echo $setting['site_url'];?>/images/social_icons/digg.png" alt="Digg" title="Digg" />
</a>
<!-- Delicious -->
<a href="http://del.icio.us/post?url=<?php echo $long_url;?>&title=<?php echo $wallpaper['name'].'%20-%20'.$setting['site_name'];?>" title="Delicious" target="_blank" rel="nofollow">
<img src="<?php echo $setting['site_url'];?>/images/social_icons/delicious.png" alt="Delicious" title="Delicious" />
</a>
<!-- Stumbleupon -->
<a href="http://www.stumbleupon.com/submit?url=<?php echo $long_url;?>&title=<?php echo $wallpaper['name'].'%20-%20'.$setting['site_name'];?>" title="Stumbleupon" target="_blank" rel="nofollow">
<img src="<?php echo $setting['site_url'];?>/images/social_icons/stumble.png" alt="Stumbleupon" title="Stumbleupon" />
</a>
<!-- Myspace -->
<a href="http://www.myspace.com/index.cfm?fuseaction=postto&t=<?php echo $wallpaper['name'].'%20-%20'.$setting['site_name'];?>&c=<?php echo WALLPAPER_SHARE_MESSAGE;?>&u=<?php echo $short_url;?>&l=" title="Myspace" target="_blank" rel="nofollow">
<img src="<?php echo $setting['site_url'];?>/images/social_icons/myspace.png" alt="Myspace" title="Myspace" />
</a>
<!-- Email -->
<a href="mailto:?subject=<?php echo WALLPAPER_SHARE_MESSAGE;?>&body=<?php echo $wallpaper['name'].'%20-%20'.$setting['site_name'];?> - <?php echo $short_url;?>&l=" title="Email" rel="nofollow">
<img src="<?php echo $setting['site_url'];?>/images/social_icons/email.png" alt="Email" title="Email" />
</a>