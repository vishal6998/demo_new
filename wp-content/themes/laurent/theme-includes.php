<?php

//define constants
define( 'LAURENT_ELATED_ROOT', get_template_directory_uri() );
define( 'LAURENT_ELATED_ROOT_DIR', get_template_directory() );
define( 'LAURENT_ELATED_ASSETS_ROOT', LAURENT_ELATED_ROOT . '/assets' );
define( 'LAURENT_ELATED_ASSETS_ROOT_DIR', LAURENT_ELATED_ROOT_DIR . '/assets' );
define( 'LAURENT_ELATED_FRAMEWORK_ROOT', LAURENT_ELATED_ROOT . '/framework' );
define( 'LAURENT_ELATED_FRAMEWORK_ROOT_DIR', LAURENT_ELATED_ROOT_DIR . '/framework' );
define( 'LAURENT_ELATED_FRAMEWORK_ADMIN_ASSETS_ROOT', LAURENT_ELATED_ROOT . '/framework/admin/assets' );
define( 'LAURENT_ELATED_FRAMEWORK_ICONS_ROOT', LAURENT_ELATED_ROOT . '/framework/lib/icons-pack' );
define( 'LAURENT_ELATED_FRAMEWORK_ICONS_ROOT_DIR', LAURENT_ELATED_ROOT_DIR . '/framework/lib/icons-pack' );
define( 'LAURENT_ELATED_FRAMEWORK_MODULES_ROOT', LAURENT_ELATED_ROOT . '/framework/modules' );
define( 'LAURENT_ELATED_FRAMEWORK_MODULES_ROOT_DIR', LAURENT_ELATED_ROOT_DIR . '/framework/modules' );
define( 'LAURENT_ELATED_FRAMEWORK_HEADER_ROOT', LAURENT_ELATED_ROOT . '/framework/modules/header' );
define( 'LAURENT_ELATED_FRAMEWORK_HEADER_ROOT_DIR', LAURENT_ELATED_ROOT_DIR . '/framework/modules/header' );
define( 'LAURENT_ELATED_FRAMEWORK_HEADER_TYPES_ROOT', LAURENT_ELATED_ROOT . '/framework/modules/header/types' );
define( 'LAURENT_ELATED_FRAMEWORK_HEADER_TYPES_ROOT_DIR', LAURENT_ELATED_ROOT_DIR . '/framework/modules/header/types' );
define( 'LAURENT_ELATED_FRAMEWORK_SEARCH_ROOT', LAURENT_ELATED_ROOT . '/framework/modules/search' );
define( 'LAURENT_ELATED_FRAMEWORK_SEARCH_ROOT_DIR', LAURENT_ELATED_ROOT_DIR . '/framework/modules/search' );
define( 'LAURENT_ELATED_PROFILE_SLUG', 'elated' );
define( 'LAURENT_ELATED_OPTIONS_SLUG', 'laurent_elated_theme_menu');

//include necessary files
include_once LAURENT_ELATED_ROOT_DIR . '/framework/eltdf-framework.php';
include_once LAURENT_ELATED_ROOT_DIR . '/includes/nav-menu/eltdf-menu.php';
require_once LAURENT_ELATED_ROOT_DIR . '/includes/plugins/class-tgm-plugin-activation.php';
include_once LAURENT_ELATED_ROOT_DIR . '/includes/plugins/plugins-activation.php';
include_once LAURENT_ELATED_ROOT_DIR . '/assets/custom-styles/general-custom-styles.php';
include_once LAURENT_ELATED_ROOT_DIR . '/assets/custom-styles/general-custom-styles-responsive.php';

if ( file_exists( LAURENT_ELATED_ROOT_DIR . '/export' ) ) {
	include_once LAURENT_ELATED_ROOT_DIR . '/export/export.php';
}

if ( ! is_admin() ) {
	include_once LAURENT_ELATED_ROOT_DIR . '/includes/eltdf-body-class-functions.php';
	include_once LAURENT_ELATED_ROOT_DIR . '/includes/eltdf-loading-spinners.php';
}