<?php do_action( 'laurent_elated_action_before_mobile_logo' ); ?>

    <?php if( ! function_exists('laurent_elated_generate_mobile_logo_svg_output') ) {
        function laurent_elated_generate_mobile_logo_svg_output( $output ) {
            if ( ! empty( $output ) ) {
                return $output;
            }
        }
    } ?>

    <div class="eltdf-mobile-logo-wrapper">
        <a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <span class="eltdf-logo-svg-path"><?php echo laurent_elated_generate_mobile_logo_svg_output($logo_svg_path); ?></span>
        </a>
    </div>

<?php do_action( 'laurent_elated_action_after_mobile_logo' ); ?>