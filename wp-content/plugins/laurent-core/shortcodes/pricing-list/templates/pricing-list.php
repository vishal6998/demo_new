<div class="eltdf-pricing-holder <?php echo esc_attr( $holder_classes ); ?>">
    <?php $i = 0;
    foreach ( $menu_items as $item ): ?>
        <?php if ( ! empty( $item['title'] ) ) { ?>
            <div class="eltdf-pricing-item">
                <?php if ( ! empty( $item['image'] ) ) { ?>
                    <div class="eltdf-pricing-img"><?php echo wp_get_attachment_image( $item['image'], 'full' ); ?></div>
                <?php } ?>

                <div class="eltdf-pricing-main" <?php echo laurent_elated_get_inline_style( $title_styles ); ?>>
                    <<?php echo esc_attr( $title_tag ); ?> class="eltdf-pricing-title">
                        <?php echo esc_html( $item['title'] ); ?>
                    </<?php echo esc_attr( $title_tag ); ?>>
                    <div class="eltdf-pricing-lines"></div>
                    <?php if ( ! empty( $item['price'] ) ) { ?>
                        <span class="eltdf-pricing-price" <?php echo laurent_elated_get_inline_style( $price_styles ); ?>><?php echo esc_html( $item['price'] ); ?></span>
                    <?php } ?>
                </div>
            <?php if ( ! empty( $item['description'] ) ) { ?>
                <p class="eltdf-pricing-desc"><?php echo esc_html( $item['description'] ); ?></p>
            <?php } ?>
            </div>
        <?php }
        $i++;
    endforeach; ?>
</div>