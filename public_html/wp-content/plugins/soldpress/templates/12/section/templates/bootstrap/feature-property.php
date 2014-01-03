<div class="listing-wrapper">
	<div class="listing">
		<div class="top">
			<div class="inner-border">
				<div class="inner-padding">
			<?php 
			echo '<figure><a href="' . get_permalink($id) . '"><img alt="'. get_post_meta($id,'dfd_UnparsedAddress',true) .'" src="' . sp_get_default_listing_image($post->post_name) . '" /></a></figure>';
			?>
					<h3><a href="<?php the_permalink(); ?>"> <?php echo get_post_meta(get_the_ID(),'dfd_UnparsedAddress',true); ?></a></h3>
					<p><?php echo esc_html( get_post_meta( $id, 'dfd_City', true ) ); ?> , <?php echo esc_html( get_post_meta( $id, 'dfd_StateOrProvince', true ) ); ?></p>
				</div>
			</div>
			
		</div>
	</div>
	<div class="price-wrapper" style="display: block;">
		<div class="price">$<?php echo esc_html( number_format(get_post_meta( $id, 'dfd_ListPrice', true )) ); ?></div>
	</div>
</div>
