<div class="eltdf-section-title-holder <?php echo esc_attr( $holder_classes ); ?>" <?php echo laurent_elated_get_inline_style( $holder_styles ); ?>>
	<div class="eltdf-st-inner">
        <?php if ( ! empty( $tagline ) ) { ?>
            <span class="eltdf-st-tagline">
                <?php echo wp_kses( $tagline, array( 'br' => true, 'span' => array( 'class' => true ) ) ); ?>
            </span>
        <?php } ?>
		<?php if ( ! empty( $title ) ) { ?>
            <div class="eltdf-st-title-holder">
                <?php if ( $disable_decoration !== 'yes' ) { ?>
                    <div class="decor"><?php echo laurent_elated_print_svg('title-decoration'); ?></div>
                <?php } ?>
                <<?php echo esc_attr( $title_tag ); ?> class="eltdf-st-title" <?php echo laurent_elated_get_inline_style( $title_styles ); ?>>
                    <?php echo wp_kses( $title, array( 'br' => true, 'span' => array( 'class' => true ) ) ); ?>
                </<?php echo esc_attr( $title_tag ); ?>>
                <?php if ( $disable_decoration !== 'yes' ) { ?>
                    <div class="decor"><?php echo laurent_elated_print_svg('title-decoration'); ?></div>
                <?php } ?>
            </div>
		<?php } ?>
		<?php if ( ! empty( $text ) ) { ?>
			<<?php echo esc_attr( $text_tag ); ?> class="eltdf-st-text" <?php echo laurent_elated_get_inline_style( $text_styles ); ?>>
				<?php echo wp_kses( $text, array( 'br' => true ) ); ?>
			</<?php echo esc_attr( $text_tag ); ?>>
		<?php } ?>
		<?php if ( ! empty( $button_parameters ) ) { ?>
			<div class="eltdf-st-button"><?php echo laurent_elated_get_button_html( $button_parameters ); ?></div>
		<?php } ?>
	</div>
</div>