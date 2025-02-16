<?php

if ( ! function_exists( 'laurent_elated_sidearea_options_map' ) ) {
	function laurent_elated_sidearea_options_map() {

        laurent_elated_add_admin_page(
            array(
                'slug'  => '_side_area_page',
                'title' => esc_html__('Side Area', 'laurent'),
                'icon'  => 'fa fa-indent'
            )
        );

        $side_area_panel = laurent_elated_add_admin_panel(
            array(
                'title' => esc_html__('Side Area', 'laurent'),
                'name'  => 'side_area',
                'page'  => '_side_area_page'
            )
        );

        laurent_elated_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_type',
                'default_value' => 'side-menu-slide-from-right',
                'label'         => esc_html__('Side Area Type', 'laurent'),
                'description'   => esc_html__('Choose a type of Side Area', 'laurent'),
                'options'       => array(
                    'side-menu-slide-from-right'       => esc_html__('Slide from Right Over Content', 'laurent'),
                    'side-menu-slide-with-content'     => esc_html__('Slide from Right With Content', 'laurent'),
                    'side-area-uncovered-from-content' => esc_html__('Side Area Uncovered from Content', 'laurent'),
                ),
            )
        );

        laurent_elated_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'text',
                'name'          => 'side_area_width',
                'default_value' => '',
                'label'         => esc_html__('Side Area Width', 'laurent'),
                'description'   => esc_html__('Enter a width for Side Area (px or %). Default width: 405px.', 'laurent'),
                'args'          => array(
                    'col_width' => 3,
                )
            )
        );

        $side_area_width_container = laurent_elated_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_width_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_type' => 'side-menu-slide-from-right',
                    )
                )
            )
        );

        laurent_elated_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'color',
                'name'          => 'side_area_content_overlay_color',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Color', 'laurent'),
                'description'   => esc_html__('Choose a background color for a content overlay', 'laurent'),
            )
        );

        laurent_elated_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'text',
                'name'          => 'side_area_content_overlay_opacity',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Transparency', 'laurent'),
                'description'   => esc_html__('Choose a transparency for the content overlay background color (0 = fully transparent, 1 = opaque)', 'laurent'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        laurent_elated_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_icon_source',
                'default_value' => 'predefined',
                'label'         => esc_html__('Select Side Area Icon Source', 'laurent'),
                'description'   => esc_html__('Choose whether you would like to use icons from an icon pack or SVG icons', 'laurent'),
                'options'       => laurent_elated_get_icon_sources_array()
            )
        );

        $side_area_icon_pack_container = laurent_elated_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_icon_pack_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_icon_source' => 'icon_pack'
                    )
                )
            )
        );

        laurent_elated_add_admin_field(
            array(
                'parent'        => $side_area_icon_pack_container,
                'type'          => 'select',
                'name'          => 'side_area_icon_pack',
                'default_value' => 'font_elegant',
                'label'         => esc_html__('Side Area Icon Pack', 'laurent'),
                'description'   => esc_html__('Choose icon pack for Side Area icon', 'laurent'),
                'options'       => laurent_elated_icon_collections()->getIconCollectionsExclude(array('linea_icons', 'dripicons', 'simple_line_icons'))
            )
        );

        $side_area_svg_icons_container = laurent_elated_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_svg_icons_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_icon_source' => 'svg_path'
                    )
                )
            )
        );

        laurent_elated_add_admin_field(
            array(
                'parent'      => $side_area_svg_icons_container,
                'type'        => 'textarea',
                'name'        => 'side_area_icon_svg_path',
                'label'       => esc_html__('Side Area Icon SVG Path', 'laurent'),
                'description' => esc_html__('Enter your Side Area icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'laurent'),
            )
        );

        laurent_elated_add_admin_field(
            array(
                'parent'      => $side_area_svg_icons_container,
                'type'        => 'textarea',
                'name'        => 'side_area_close_icon_svg_path',
                'label'       => esc_html__('Side Area Close Icon SVG Path', 'laurent'),
                'description' => esc_html__('Enter your Side Area close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'laurent'),
            )
        );

        $side_area_icon_style_group = laurent_elated_add_admin_group(
            array(
                'parent'      => $side_area_panel,
                'name'        => 'side_area_icon_style_group',
                'title'       => esc_html__('Side Area Icon Style', 'laurent'),
                'description' => esc_html__('Define styles for Side Area icon', 'laurent')
            )
        );

        $side_area_icon_style_row1 = laurent_elated_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row1'
            )
        );

        laurent_elated_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type'   => 'colorsimple',
                'name'   => 'side_area_icon_color',
                'label'  => esc_html__('Color', 'laurent')
            )
        );

        laurent_elated_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type'   => 'colorsimple',
                'name'   => 'side_area_icon_hover_color',
                'label'  => esc_html__('Hover Color', 'laurent')
            )
        );

        $side_area_icon_style_row2 = laurent_elated_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row2',
                'next'   => true
            )
        );

        laurent_elated_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row2,
                'type'   => 'colorsimple',
                'name'   => 'side_area_close_icon_color',
                'label'  => esc_html__('Close Icon Color', 'laurent')
            )
        );

        laurent_elated_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row2,
                'type'   => 'colorsimple',
                'name'   => 'side_area_close_icon_hover_color',
                'label'  => esc_html__('Close Icon Hover Color', 'laurent')
            )
        );

        laurent_elated_add_admin_field(
            array(
                'parent'      => $side_area_panel,
                'type'        => 'color',
                'name'        => 'side_area_background_color',
                'label'       => esc_html__('Background Color', 'laurent'),
                'description' => esc_html__('Choose a background color for Side Area', 'laurent')
            )
        );

        laurent_elated_add_admin_field(
            array(
                'parent'      => $side_area_panel,
                'type'        => 'text',
                'name'        => 'side_area_padding',
                'label'       => esc_html__('Padding', 'laurent'),
                'description' => esc_html__('Define padding for Side Area in format top right bottom left', 'laurent'),
                'args'        => array(
                    'col_width' => 3
                )
            )
        );

        laurent_elated_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'selectblank',
                'name'          => 'side_area_aligment',
                'default_value' => 'center',
                'label'         => esc_html__('Text Alignment', 'laurent'),
                'description'   => esc_html__('Choose text alignment for side area', 'laurent'),
                'options'       => array(
                    'left'   => esc_html__('Left', 'laurent'),
                    'center' => esc_html__('Center', 'laurent'),
                    'right'  => esc_html__('Right', 'laurent')
                )
            )
        );
    }

    add_action('laurent_elated_action_options_map', 'laurent_elated_sidearea_options_map', laurent_elated_set_options_map_position( 'sidearea' ) );
}