<?php if ( ! edd_has_variable_prices( get_the_ID() ) ) : ?>
	<?php $item_props = edd_add_schema_microdata() ? ' itemprop="offers" itemscope itemtype="http://schema.org/Offer"' : ''; ?>
	<div<?php echo $item_props; ?>>
		<div itemprop="price" class="edd_price">
			<?php 
			$item_price = edd_get_download_price( get_the_ID() );
			if ( $item_price * 1 == 0 ) :
				echo '<span class="edd_price" id="edd_price_' . get_the_ID() . '">¡Gratis!</span>';
			else:
				edd_price( get_the_ID() );
			endif;
			?>
		</div>
	</div>
<?php endif; ?>
