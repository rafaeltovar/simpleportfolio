<?php get_header(); ?>

<div id="gallery" class="container">
	<div class="item">
		<a href="<?php echo get_gallery_next_item_link(); ?>">
	   		<img src="<?php echo get_gallery_item_file(); ?>">
		</a>
	    <p><?php echo get_gallery_item_alt(); ?></p>
	</div>
</div>

<?php get_footer(); ?> 