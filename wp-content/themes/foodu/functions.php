<?php
function my_react_theme_scripts() {
    // Enqueue the React build script and styles
    wp_enqueue_script('react-app', get_template_directory_uri() . '/static/js/main.js', array(), null, true);
    wp_enqueue_style('react-app', get_template_directory_uri() . '/static/css/main.css', array(), null, 'all');
}
add_action('wp_enqueue_scripts', 'my_react_theme_scripts');
