<div class="eltdf-stacked-images-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="eltdf-si-images">
		<?php if (!empty($background_image) && empty($background_svg)) : ?>
			<?php echo wp_get_attachment_image($background_image, 'full', false, array('class' => 'eltdf-si-first-image')); ?>
        <?php elseif (!empty($background_svg) && empty($background_image)) : ?>
            <div class="eltdf-si-first-image">
                <?php echo laurent_elated_get_module_part( urldecode( base64_decode( $background_svg ) ) ); ?>
            </div>
		<?php endif; ?>
        <?php if (!empty($middle_image)) : ?>
            <?php echo wp_get_attachment_image($middle_image, 'full', false, array('class' => 'eltdf-si-second-image')); ?>
        <?php endif; ?>
		<?php if (!empty($foreground_image)): ?>
			<?php echo wp_get_attachment_image($foreground_image, 'full', false, array('class' => 'eltdf-si-third-image')); ?>
		<?php endif; ?>
	</div>
</div>