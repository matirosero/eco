<?php $item_prop = edd_add_schema_microdata() ? ' itemprop="description"' : ''; ?>
<?php if ( get_field('downloads_intro') ) : ?>
	<div<?php echo $item_prop; ?> class="edd_download_excerpt">
		<?php the_field('downloads_intro'); ?>
	</div>
<?php endif; ?>
