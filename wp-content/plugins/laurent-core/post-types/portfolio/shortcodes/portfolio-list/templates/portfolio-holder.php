<div class="eltdf-portfolio-list-holder eltdf-grid-list <?php echo esc_attr($holder_classes); ?>" <?php echo wp_kses($holder_data, array('data')); ?>>
	<?php echo laurent_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/filter', '', $params); ?>
	<div class="eltdf-pl-inner eltdf-outer-space <?php echo esc_attr($holder_inner_classes); ?> clearfix">
		<?php
			if($query_results->have_posts()):
				while ( $query_results->have_posts() ) : $query_results->the_post();
					echo laurent_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'portfolio-item', $item_type, $params);
				endwhile;
			else:
				echo laurent_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/posts-not-found');
			endif;
		
			wp_reset_postdata();
		?>
	</div>
    <?php if ( $params['portfolio_slider_on'] === 'yes' && $params['enable_pagination'] === 'yes' ) { ?>
        <div class="swiper-pagination"></div>
    <?php }; ?>
    <?php if ( $params['portfolio_slider_on'] === 'yes' && $params['enable_navigation'] === 'yes' ) { ?>
        <div class="swiper-button-prev"><span><?php echo laurent_elated_print_svg('left-arrow',''); ?></span></div>
        <div class="swiper-button-next"><span><?php echo laurent_elated_print_svg('right-arrow',''); ?></span></div>
    <?php }; ?>
	<?php echo laurent_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'pagination/'.$pagination_type, '', $params, $additional_params); ?>
</div>