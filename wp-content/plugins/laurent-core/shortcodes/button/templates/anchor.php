<a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" <?php laurent_elated_inline_style($button_styles); ?> <?php laurent_elated_class_attribute($button_classes); ?> <?php echo laurent_elated_get_inline_attrs($button_data); ?> <?php echo laurent_elated_get_inline_attrs($button_custom_attrs); ?>>
    <?php if ( $type === 'special' ) { echo laurent_core_return_special_button_svg('eltdf-sb-left'); } ?>
    <span class="eltdf-btn-text"><?php echo esc_html($text); ?></span>
    <?php echo laurent_elated_icon_collections()->renderIcon($icon, $icon_pack); ?>
    <?php if ( $type === 'special' ) { echo laurent_core_return_special_button_svg('eltdf-sb-right'); } ?>
</a>