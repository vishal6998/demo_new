<?php

laurent_elated_get_single_post_format_html( $blog_single_type );

do_action( 'laurent_elated_action_after_article_content' );

laurent_elated_get_module_template_part( 'templates/parts/single/author-info', 'blog' );

laurent_elated_get_module_template_part( 'templates/parts/single/single-navigation', 'blog' );

laurent_elated_get_module_template_part( 'templates/parts/single/related-posts', 'blog', '', $single_info_params );

laurent_elated_get_module_template_part( 'templates/parts/single/comments', 'blog' );