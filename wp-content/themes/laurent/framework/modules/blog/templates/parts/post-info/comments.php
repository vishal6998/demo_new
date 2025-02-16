<?php if(comments_open()) { ?>
	<div class="eltdf-post-info-comments-holder">
		<a itemprop="url" class="eltdf-post-info-comments" href="<?php comments_link(); ?>">
			<?php comments_number('0 ' . esc_html__('Comments','laurent'), '1 '.esc_html__('Comment','laurent'), '% '.esc_html__('Comments','laurent') ); ?>
		</a>
	</div>
<?php } ?>