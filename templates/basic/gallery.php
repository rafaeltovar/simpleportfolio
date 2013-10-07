<?php get_header(); ?>

<div id="gallery" class="container">
	<div class="row">
		<?php while(have_gallery()): ?>
		<div class="col-xs-6 col-sm-6 col-md-3">
			<a href="<?php echo get_gallery_item_link(); ?>" class="thumbnail"><img src="<?php echo get_gallery_item_file(); ?>" alt="<?php echo strip_tags(get_gallery_item_alt()); ?>"></a>
		</div>
	    <?php endwhile; ?>
	</div>
</div>

<?php get_footer(); ?> 