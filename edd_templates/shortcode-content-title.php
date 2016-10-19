<?php $item_prop = edd_add_schema_microdata() ? ' itemprop="name"' : ''; ?>
<h3<?php echo $item_prop; ?> class="shop-item-title">
	<a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
</h3>
