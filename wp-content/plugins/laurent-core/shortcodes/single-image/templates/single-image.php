<div class="eltdf-single-image-holder <?php echo esc_attr($holder_classes); ?>">
    <div class="eltdf-si-inner" <?php echo laurent_elated_get_inline_style($holder_styles); ?>>
        <?php if ($image_behavior === 'lightbox') { ?>
            <a itemprop="image" href="<?php echo esc_url($image['url']); ?>" data-rel="prettyPhoto[si_pretty_photo]" title="<?php echo esc_attr($image['alt']); ?>">
        <?php } else if ($image_behavior === 'custom-link' && !empty($custom_link)) { ?>
	            <a itemprop="url" href="<?php echo esc_url($custom_link); ?>" target="<?php echo esc_attr($custom_link_target); ?>">
        <?php } ?>
            <?php if ( ! empty( $image ) ) { ?>
                <?php if(is_array($image_size) && count($image_size)) : ?>
                    <?php echo laurent_elated_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]); ?>
                <?php else: ?>
                    <?php echo wp_get_attachment_image($image['image_id'], $image_size); ?>
                <?php endif; ?>
            <?php } else if ( ! empty( $svg_image ) ) { ?>
            <?php echo laurent_elated_get_module_part( urldecode( base64_decode( $svg_image ) ) ); ?>
            <?php } ?>
        <?php if ($image_behavior === 'lightbox' || $image_behavior === 'custom-link') { ?>
            </a>
        <?php } ?>
        <?php if ($enable_ornament === 'yes') { ?>
            <div class="eltdf-si-ornament <?php echo esc_attr($ornament_shape); ?>" <?php echo laurent_elated_get_inline_style($ornament_styles); ?>>
                <?php echo laurent_elated_get_module_part( $ornament ); ?>
            </div>
        <?php } ?>
    </div>
</div>