<div class="eltdf-fullscreen-menu-holder-outer">
	<div class="eltdf-fullscreen-menu-holder">
		<div class="eltdf-fullscreen-menu-holder-inner">
			<?php if ($fullscreen_menu_in_grid) : ?>
				<div class="eltdf-container-inner">
			<?php endif; ?>
			
			<?php if ( laurent_elated_is_header_widget_area_active( 'one' ) ) { ?>
				<div class="eltdf-fullscreen-above-menu-widget-holder">
					<?php laurent_elated_get_header_widget_area_one(); ?>
				</div>
			<?php } ?>
			
			<?php 
			//Navigation
			laurent_elated_get_module_template_part('templates/full-screen-menu-navigation', 'header/types/header-minimal');;

			?>
			
			<?php if ( laurent_elated_is_header_widget_area_active( 'two' ) ) { ?>
				<div class="eltdf-fullscreen-below-menu-widget-holder">
					<?php laurent_elated_get_header_widget_area_two(); ?>
				</div>
			<?php } ?>
			
			<?php if ($fullscreen_menu_in_grid) : ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>