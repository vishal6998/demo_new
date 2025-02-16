<?php
$share_type = isset( $share_type ) ? $share_type : 'list';
?>
<?php if ( laurent_elated_is_plugin_installed( 'core' ) && laurent_elated_options()->getOptionValue( 'enable_social_share' ) === 'yes' && laurent_elated_options()->getOptionValue( 'enable_social_share_on_post' ) === 'yes' ) { ?>
	<div class="eltdf-blog-share">
		<?php echo laurent_elated_get_social_share_html( array( 'type' => $share_type, 'icon_type' => 'ion-icons' ) ); ?>
	</div>
<?php } ?>