<div class="wallpaper_item">
	<a href="<?php echo $new_wallpaper['url'];?>">
		<img src="<?php echo $new_wallpaper['thumbnail'];?>" alt="<?php echo $new_wallpaper['name'];?>"  />
	</a>
	<div class="wallpaper_item_name">
		<a href="<?php echo $new_wallpaper['url'];?>">
			<?php   
				if ($setting['show_names'] == 1) { 
					echo $new_wallpaper['name']; 
				} else {
					echo INFO_AND_DOWNLOAD_LINK;
				}
			?>
		</a>
	</div>
</div>