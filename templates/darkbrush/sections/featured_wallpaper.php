<div class="wallpaper_item">
	<a href="<?php echo $featured_wallpaper['url'];?>">
		<img src="<?php echo $featured_wallpaper['thumbnail'];?>" alt="<?php echo $featured_wallpaper['name'];?>"  width="180" height="102" />
	</a>
	<div class="wallpaper_item_name">
		<a href="<?php echo $featured_wallpaper['url'];?>">
			<?php   
				if ($setting['show_names'] == 1) { 
					echo $featured_wallpaper['name']; 
				} else {
					echo INFO_AND_DOWNLOAD_LINK;
				}
			?>
		</a>
	</div>
</div>