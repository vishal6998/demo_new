<?php if(laurent_elated_options()->getOptionValue('portfolio_single_hide_pagination') !== 'yes') : ?>
    <?php
    $back_to_link = get_post_meta(get_the_ID(), 'portfolio_single_back_to_link', true);
    $nav_same_category = laurent_elated_options()->getOptionValue('portfolio_single_nav_same_category') == 'yes';
    ?>
    <div class="eltdf-ps-navigation">
        <?php if(get_previous_post() !== '') : ?>
            <div class="eltdf-ps-prev">
                <?php if($nav_same_category) {
	                previous_post_link('%link', laurent_elated_print_svg('left-arrow',''), true, '', 'portfolio-category');
                } else {
	                previous_post_link('%link',laurent_elated_print_svg('left-arrow',''));
                } ?>
            </div>
        <?php endif; ?>

        <?php if($back_to_link !== '') : ?>
            <div class="eltdf-ps-back-btn">
                <a itemprop="url" href="<?php echo esc_url(get_permalink($back_to_link)); ?>">
                    <div class="eltdf-ps-back-circle"></div>
                    <div class="eltdf-ps-back-circle"></div>
                    <div class="eltdf-ps-back-circle"></div>
                    <div class="eltdf-ps-back-circle"></div>
                </a>
            </div>
        <?php endif; ?>

        <?php if(get_next_post() !== '') : ?>
            <div class="eltdf-ps-next">
                <?php if($nav_same_category) {
                    next_post_link('%link', laurent_elated_print_svg('right-arrow',''), true, '', 'portfolio-category');
                } else {
                    next_post_link('%link', laurent_elated_print_svg('right-arrow',''));
                } ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>