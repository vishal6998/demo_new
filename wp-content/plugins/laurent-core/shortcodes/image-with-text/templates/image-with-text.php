<div class="eltdf-image-with-text-holder <?php echo esc_attr($holder_classes); ?>">
    <div class="eltdf-iwt-image">
        <?php if ($image_behavior === 'scrolling-image') { ?>
            <div class="eltdf-iwt-image-holder">
                <div class="eltdf-iwt-image-holder-inner">
        <?php } ?>
        <?php if (($image_behavior === 'scrolling-image' || $image_behavior === 'custom-link') && !empty($custom_link)) { ?>
            <a itemprop="url" href="<?php echo esc_url($custom_link); ?>" target="<?php echo esc_attr($custom_link_target); ?>">
        <?php } ?>
            <?php if(is_array($image_size) && count($image_size)) : ?>
                <?php echo laurent_elated_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]); ?>
            <?php else: ?>
                <?php echo wp_get_attachment_image($image['image_id'], $image_size, false, array('class' => 'eltdf-iwt-main-image')); ?>
            <?php endif; ?>
        <?php if ($image_behavior === 'lightbox') { ?>
            <a itemprop="image" href="<?php echo esc_url($image['url']); ?>" data-rel="prettyPhoto[iwt_pretty_photo]" title="<?php echo esc_attr($image['alt']); ?>">
        <?php } ?>
        <?php if ($image_behavior === 'lightbox' && !empty($custom_link)) { ?>
            <?php echo laurent_elated_print_svg('overlay-plus'); ?>
        <?php } ?>
        <?php if ($image_behavior === 'lightbox' || (($image_behavior === 'custom-link' || $image_behavior === 'scrolling-image') && !empty($custom_link))) { ?>
            </a>
        <?php } ?>
        <?php if ($image_behavior === 'scrolling-image') { ?>
                </div>
                <img class="eltdf-iwt-frame" src="<?php echo LAURENT_ELATED_ROOT ?>/assets/img/scrolling-image-frame.png" alt="<?php esc_html_e('Scrolling Image Frame', 'laurent-core') ?>" />
            </div>
        <?php } ?>
    </div>
    <div class="eltdf-iwt-text-holder">
        <div class="eltdf-iwt-text-holder-inner">
            <?php if(!empty($title)) { ?>
                <<?php echo esc_attr($title_tag); ?> class="eltdf-iwt-title" <?php echo laurent_elated_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
            <?php } ?>
            <?php if(!empty($text)) { ?>
                <p class="eltdf-iwt-text" <?php echo laurent_elated_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
            <?php } ?>
        </div>
	<?php if(!empty($bottom_buttons) && $bottom_buttons == 'yes') { ?>
        <dvi class="eltdf-iwt-bottom-buttons-holder">
			<?php if( ! empty( $bottom_button_one_link ) ) { ?>
                <a class="eltdf-iwt-bottom-link eltdf-iwt-first-link" itemprop="url" href="<?php echo esc_url($bottom_button_one_link); ?>" target="_blank">
					<?php if( ! empty( $bottom_button_one_label ) ) { ?>
						<?php echo esc_html($bottom_button_one_label); ?>
					<?php } ?>
                    <span class="eltdf-btn-first-line"></span>
                    <span class="eltdf-btn-second-line"></span>
                </a>
			<?php } ?>
			<?php if( ! empty( $bottom_button_two_link ) ) { ?>
                <a class="eltdf-iwt-bottom-link eltdf-iwt-second-link" itemprop="url" href="<?php echo esc_url($bottom_button_two_link); ?>" target="_blank">
					<?php if( ! empty( $bottom_button_two_label ) ) { ?>
						<?php echo esc_html($bottom_button_two_label); ?>
					<?php } ?>
                    <span class="eltdf-btn-first-line"></span>
                    <span class="eltdf-btn-second-line"></span>
                </a>
			<?php } ?>
	        <?php if( ! empty( $bottom_button_three_link ) ) { ?>
                <a class="eltdf-iwt-bottom-link eltdf-iwt-third-link" itemprop="url" href="<?php echo esc_url($bottom_button_three_link); ?>" target="_blank">
					<?php if( ! empty( $bottom_button_three_label ) ) { ?>
						<?php echo esc_html($bottom_button_three_label); ?>
					<?php } ?>
                    <span class="eltdf-btn-first-line"></span>
                    <span class="eltdf-btn-second-line"></span>
                </a>
			<?php } ?>
        </dvi>
	<?php } ?>
    </div>

</div>