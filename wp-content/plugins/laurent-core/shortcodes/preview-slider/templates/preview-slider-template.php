<div class="eltdf-preview-slider" <?php echo laurent_elated_get_inline_attrs($slider_data); ?>>
	<div class="eltdf-ps-images-holder">
		<div class="eltdf-ps-images-holder-inner">
			<div class="eltdf-ps-tablet-holder">
				<img src="<?php echo LAURENT_CORE_ASSETS_URL_PATH .'/img/tablet.png' ?>" class="eltdf-ps-tablet-frame"  alt="<?php esc_attr_e('tablet','laurent-core');?>"/>
				<div class="eltdf-ps-tablet-slider">
						<div class="eltdf-ps-tablet-images  eltdf-preview-slider-element">
							<?php
							$j = 0;
							foreach($tablet_images as $tablet_image){ ?>
								<div class="eltdf-ps-tablet-image">
									<?php if(array_key_exists($j, $slider_links)){ ?>
										<a href="<?php echo esc_url($slider_links[$j]); ?>" target="<?php echo esc_attr($slider_targets[$j]); ?>">
											<?php echo wp_get_attachment_image($tablet_image,'full'); ?>
										</a>
									<?php } else { ?>
										<?php echo wp_get_attachment_image($tablet_image,'full'); ?>
									<?php } ?>
								</div>
							<?php $j++; } ?>
						</div>
				</div>
			</div>
			<div class="eltdf-ps-laptop-holder">
				<img src="<?php echo LAURENT_CORE_ASSETS_URL_PATH .'/img/laptop.png' ?>" class="eltdf-ps-laptop-frame" alt="<?php esc_attr_e('laptop','laurent-core');?>"/>
				<div class="eltdf-ps-laptop-slider">
					<div class="eltdf-ps-laptop-images eltdf-preview-slider-element">
						<?php
						$i = 0;
						foreach($laptop_images as $laptop_image){ ?>
							<?php if(array_key_exists($i, $slider_links)){ ?>
								<div class="eltdf-ps-laptop-image"><a href="<?php echo esc_url($slider_links[$i]); ?>" target="<?php echo esc_attr($slider_targets[$i]); ?>"><?php echo wp_get_attachment_image($laptop_image,'full'); ?></a></div>
							<?php } else { ?>
								<div class="eltdf-ps-laptop-image"><?php echo wp_get_attachment_image($laptop_image,'full'); ?></div>
							<?php } ?>
							<?php $i++; } ?>
					</div>
				</div>
			</div>
			<div class="eltdf-ps-mobile-holder">
				<img src="<?php echo LAURENT_CORE_ASSETS_URL_PATH .'/img/phone.png' ?>" class="eltdf-ps-phone-frame"  alt="<?php esc_attr_e('phone','laurent-core');?>"/>
				<div class="eltdf-ps-mobile-slider">
					<div class="eltdf-ps-mobile-images  eltdf-preview-slider-element">
						<?php
						$k = 0;
						foreach($mobile_images as $mobile_image){ ?>
							<?php if(array_key_exists($k, $slider_links)){ ?>
								<div class="eltdf-ps-mobile-image"><a href="<?php echo esc_url($slider_links[$k]); ?>" target="<?php echo esc_attr($slider_targets[$k]); ?>"><?php echo wp_get_attachment_image($mobile_image,'full'); ?></a></div>
							<?php } else { ?>
								<div class="eltdf-ps-mobile-image"><?php echo wp_get_attachment_image($mobile_image,'full'); ?></div>
							<?php } ?>
							<?php $k++; } ?>
					</div>
				</div>
                <img src="<?php echo LAURENT_CORE_ASSETS_URL_PATH .'/img/phone-mask.png' ?>" class="eltdf-ps-phone-mask"  alt="<?php esc_attr_e('phone','laurent-core');?>"/>
			</div>
		</div>
	</div>
</div>