<div class="wallpaper_item2">
	<a href="<?php echo $wallpaper['url'];?>">
		<img src="<?php echo $wallpaper['thumbnail'];?>" alt="<?php echo $wallpaper['name'];?>"  width="180" height="102" />
	</a>
	<div class="wallpaper_item2_name">
		<a href="<?php echo $wallpaper['url'];?>">
			<?php   
				if ($setting['show_names'] == 1) { 
					echo $wallpaper['name']; 
				} else {
					echo INFO_AND_DOWNLOAD_LINK;
				}
			?>
		</a>
	</div>
</div>