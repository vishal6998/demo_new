<?php do_action( 'laurent_elated_action_before_footer_content' ); ?>
</div> <!-- close div.content_inner -->
	</div>  <!-- close div.content -->
		<?php if($display_footer && ($display_footer_top || $display_footer_bottom)) { ?>
			<footer class="eltdf-page-footer <?php echo esc_attr($holder_classes); ?>">
				<?php
					if($display_footer_top) {
						laurent_elated_get_footer_top();
					}
					if($display_footer_bottom) {
						laurent_elated_get_footer_bottom();
					}
				?>
			</footer>
		<?php } ?>
	</div> <!-- close div.eltdf-wrapper-inner  -->
</div> <!-- close div.eltdf-wrapper -->
<?php
/**
 * laurent_elated_action_before_closing_body_tag hook
 *
 * @see laurent_elated_get_side_area() - hooked with 10
 * @see laurent_elated_smooth_page_transitions() - hooked with 10
 */
do_action( 'laurent_elated_action_before_closing_body_tag' ); ?>
<?php wp_footer(); ?>
</body>
</html>