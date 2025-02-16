<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="eltdf-post-content">
        <div class="eltdf-post-text">
            <div class="eltdf-post-text-main">
                <div class="eltdf-post-mark">
                    <span class="eltdf-link-mark"></span>
                </div>
                <?php laurent_elated_get_module_template_part('templates/parts/post-type/link', 'blog', '', $part_params); ?>
            </div>
        </div>
        <div class="eltdf-post-text-inner">
            <div class="eltdf-post-info-top">
                <?php laurent_elated_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
                <?php laurent_elated_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                <?php laurent_elated_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
            </div>
            <div class="eltdf-post-additional-content">
                <?php the_content(); ?>
            </div>
            <div class="eltdf-post-info-bottom clearfix">
                <div class="eltdf-post-info-bottom-left">
                    <?php laurent_elated_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $part_params); ?>
                    <?php laurent_elated_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params); ?>
                </div>
                <div class="eltdf-post-info-bottom-right">
                    <?php laurent_elated_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
</article>