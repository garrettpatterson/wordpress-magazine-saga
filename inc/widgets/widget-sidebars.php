<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function magazine_saga_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'magazine-saga'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Displays items on sidebar.', 'magazine-saga'),
        'before_widget' => '<div id="%1$s" class="widget alt-font %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="saga-title-wrapper saga-title-wrapper-2"><h2 class="widget-title saga-title saga-title-small">',
        'after_title' => '</h2></div>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Home Page Column One', 'magazine-saga'),
        'id' => 'home-page-col-one',
        'description' => esc_html__('Displays items on homepage column.', 'magazine-saga'),
        'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="saga-title-wrapper saga-title-wrapper-1"><h2 class="widget-title saga-title"> <span class="primary-background">',
        'after_title' => '</span></h2></div>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Home Page Column Two', 'magazine-saga'),
        'id' => 'home-page-col-two',
        'description' => esc_html__('Displays items on homepage column.', 'magazine-saga'),
        'before_widget' => '<div id="%1$s" class="widget alt-font %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="saga-title-wrapper saga-title-wrapper-2"><h2 class="widget-title saga-title">',
        'after_title' => '</h2></div>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Off-canvas Menu', 'magazine-saga'),
        'id' => 'offcanvas',
        'description' => esc_html__('Displays items on Off-canvas Menu.', 'magazine-saga'),
        'before_widget' => '<div id="%1$s" class="widget alt-font %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Column One', 'magazine-saga'),
        'id' => 'footer-col-one',
        'description' => esc_html__('Displays items on footer first column.', 'magazine-saga'),
        'before_widget' => '<div id="%1$s" class="widget alt-font %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Column Two', 'magazine-saga'),
        'id' => 'footer-col-two',
        'description' => esc_html__('Displays items on footer second column.', 'magazine-saga'),
        'before_widget' => '<div id="%1$s" class="widget alt-font %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Column Three', 'magazine-saga'),
        'id' => 'footer-col-three',
        'description' => esc_html__('Displays items on footer third column.', 'magazine-saga'),
        'before_widget' => '<div id="%1$s" class="widget alt-font %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'magazine_saga_widgets_init');