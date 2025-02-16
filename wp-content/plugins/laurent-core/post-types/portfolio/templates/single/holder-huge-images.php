<div class="eltdf-full-width">
	<div class="eltdf-full-width-inner">
        <?php do_action('laurent_elated_action_after_container_inner_open'); ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="eltdf-portfolio-single-holder <?php echo esc_attr($holder_classes); ?>">
				<?php if(post_password_required()) {
					echo get_the_password_form();
				} else {
					do_action('laurent_elated_action_portfolio_page_before_content');
					
					laurent_core_get_cpt_single_module_template_part('templates/single/layout-collections/'.$item_layout, 'portfolio', '', $params);
					
					do_action('laurent_elated_action_portfolio_page_after_content');
					
					laurent_core_get_cpt_single_module_template_part('templates/single/parts/navigation', 'portfolio', $item_layout);
					?>
					
					<div class="eltdf-container">
						<div class="eltdf-container-inner clearfix">
							<?php laurent_core_get_cpt_single_module_template_part('templates/single/parts/comments', 'portfolio'); ?>
						</div>
					</div>
				<?php } ?>
			</div>
		<?php endwhile; endif; ?>
	</div>
</div>