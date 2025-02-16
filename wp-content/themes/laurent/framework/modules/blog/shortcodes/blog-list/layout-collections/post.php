<li class="eltdf-bl-item eltdf-item-space">
	<div class="eltdf-bli-inner">
		<?php if ( $post_info_image == 'yes' ) {
			laurent_elated_get_module_template_part( 'templates/parts/media', 'blog', '', $params );
		} ?>
        <div class="eltdf-bli-content">
            <?php if ($post_info_section == 'yes') { ?>
                <div class="eltdf-bli-info-top">
	                <?php
		                if ( $post_info_date == 'yes' ) {
			                laurent_elated_get_module_template_part( 'templates/parts/post-info/date', 'blog', '', $params );
		                }
		                if ( $post_info_category == 'yes' ) {
			                laurent_elated_get_module_template_part( 'templates/parts/post-info/category', 'blog', '', $params );
		                }
		                if ( $post_info_author == 'yes' ) {
			                laurent_elated_get_module_template_part( 'templates/parts/post-info/author', 'blog', '', $params );
		                }
	                ?>
                </div>
            <?php } ?>
	
	        <?php laurent_elated_get_module_template_part( 'templates/parts/title', 'blog', '', $params ); ?>
	
	        <div class="eltdf-bli-excerpt">
		        <?php laurent_elated_get_module_template_part( 'templates/parts/excerpt', 'blog', '', $params ); ?>
		        <?php laurent_elated_get_module_template_part( 'templates/parts/post-info/read-more', 'blog', '', $params ); ?>
	        </div>

            <div class="eltdf-bli-info-bottom">
                <?php
                    if ( $post_info_comments == 'yes' ) {
                        laurent_elated_get_module_template_part( 'templates/parts/post-info/comments', 'blog', '', $params );
                    }
                    if ( $post_info_share == 'yes' ) {
                        laurent_elated_get_module_template_part( 'templates/parts/post-info/share', 'blog', '', $params );
                    }
                ?>
            </div>
        </div>
	</div>
</li>