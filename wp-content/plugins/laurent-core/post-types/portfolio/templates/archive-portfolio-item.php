<?php
get_header();
laurent_elated_get_title();
do_action( 'laurent_elated_action_before_main_content' ); ?>
<div class="eltdf-container eltdf-default-page-template">
	<?php do_action( 'laurent_elated_action_after_container_open' ); ?>
	<div class="eltdf-container-inner clearfix">
        <?php do_action('laurent_elated_action_after_container_inner_open'); ?>
		<?php
			$laurent_taxonomy_id   = get_queried_object_id();
			$laurent_taxonomy_type = is_tax( 'portfolio-tag' ) ? 'portfolio-tag' : 'portfolio-category';
			$laurent_taxonomy      = ! empty( $laurent_taxonomy_id ) ? get_term_by( 'id', $laurent_taxonomy_id, $laurent_taxonomy_type ) : '';
			$laurent_taxonomy_slug = ! empty( $laurent_taxonomy ) ? $laurent_taxonomy->slug : '';
			$laurent_taxonomy_name = ! empty( $laurent_taxonomy ) ? $laurent_taxonomy->taxonomy : '';
			
			laurent_core_get_archive_portfolio_list( $laurent_taxonomy_slug, $laurent_taxonomy_name );
		?>
	</div>
	<?php do_action( 'laurent_elated_action_before_container_close' ); ?>
</div>
<?php get_footer(); ?>
