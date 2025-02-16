<?php
$rand = rand(0, 1000);
$link_class = !empty($play_button_hover_image) ? 'eltdf-vb-has-hover-image' : '';
?>
<div class="eltdf-video-button-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="eltdf-video-button-image">
		<?php echo wp_get_attachment_image($video_image, 'full'); ?>
	</div>
	<?php if(!empty($play_button_image)) { ?>
    <a class="eltdf-video-button-play-image <?php echo esc_attr($link_class); ?>" href="<?php echo esc_url($video_link); ?>?iframe=true" data-rel="prettyPhoto[video_button_pretty_photo_<?php echo esc_attr($rand); ?>]">
			<span class="eltdf-video-button-play-inner">
				<?php echo wp_get_attachment_image($play_button_image, 'full'); ?>
				<?php if(!empty($play_button_hover_image)) { ?>
					<?php echo wp_get_attachment_image($play_button_hover_image, 'full'); ?>
				<?php } ?>
			</span>
		</a>
	<?php } else { ?>
    <a class="eltdf-video-button-play" <?php echo laurent_elated_get_inline_style($play_button_styles); ?> href="<?php echo esc_url($video_link); ?>?iframe=true" data-rel="prettyPhoto[video_button_pretty_photo_<?php echo esc_attr($rand); ?>]">
			<span class="eltdf-video-button-play-inner">
				<span>
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="97.094px" height="97.094px" viewBox="0 0 97.094 97.094" enable-background="new 0 0 97.094 97.094" xml:space="preserve">
            <circle fill="none" stroke="currentColor" stroke-miterlimit="10" cx="48.558" cy="48.548" r="48"/>
            <circle fill="none" class="eltdf-popout" stroke="none" stroke-miterlimit="10" cx="48.558" cy="48.548" r="41.037"/>
            <polygon fill="none" stroke="currentColor" stroke-miterlimit="10" points="42.578,69.964 42.578,27.13 63.994,48.546 "/>
          </svg>
        </span>
			</span>
		</a>
	<?php } ?>
</div>