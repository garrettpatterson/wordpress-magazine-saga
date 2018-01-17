<?php

/*Get default values to set while building customizer elements*/
$default_options = magazine_saga_get_default_customizer_values();

/*Add Homepage Options Panel.*/
$wp_customize->add_panel(
    'theme_home_option_panel',
    array(
        'title' => __( 'Homepage Options', 'magazine-saga' ),
        'description' => __( 'Contains all homepage settings', 'magazine-saga')
    )
);
/**/

/* ========== Home Page Banner Section ========== */
$wp_customize->add_section(
    'home_banner_options' ,
    array(
        'title' => __( 'Banner Options', 'magazine-saga' ),
        'panel' => 'theme_home_option_panel',
    )
);

/*Enable Banner Section*/
$wp_customize->add_setting(
    'theme_options[enable_banner]',
    array(
        'default'           => $default_options['enable_banner'],
        'sanitize_callback' => 'magazine_saga_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'theme_options[enable_banner]',
    array(
        'label'    => __( 'Enable Banner', 'magazine-saga' ),
        'section'  => 'home_banner_options',
        'type'     => 'checkbox',
    )
);

/*Slider Category.*/
$wp_customize->add_setting(
    'theme_options[slider_cat]',
    array(
        'default'           => $default_options['slider_cat'],
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control(
    new Magazine_Saga_Dropdown_Taxonomies_Control(
        $wp_customize,
        'theme_options[slider_cat]',
        array(
            'label'    => __( 'Choose Slider category', 'magazine-saga' ),
            'section'  => 'home_banner_options',
        )
    )
);

/*Pinned Posts Category.*/
$wp_customize->add_setting(
    'theme_options[pinned_posts_cat]',
    array(
        'default'           => $default_options['pinned_posts_cat'],
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control(
    new Magazine_Saga_Dropdown_Taxonomies_Control(
        $wp_customize,
        'theme_options[pinned_posts_cat]',
        array(
            'label'    => __( 'Choose Pinned posts category', 'magazine-saga' ),
            'section'  => 'home_banner_options',
        )
    )
);
/**/

/* ========== Home Page Banner Section Close ========== */

/* ========== Home Page Trending Posts Section ========== */
$wp_customize->add_section(
    'home_trending_posts_options' ,
    array(
        'title' => __( 'Trending Post Options', 'magazine-saga' ),
        'panel' => 'theme_home_option_panel',
    )
);

/*Enable Trending Posts Section*/
$wp_customize->add_setting(
    'theme_options[enable_trending_posts]',
    array(
        'default'           => $default_options['enable_trending_posts'],
        'sanitize_callback' => 'magazine_saga_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'theme_options[enable_trending_posts]',
    array(
        'label'    => __( 'Enable Trending Posts', 'magazine-saga' ),
        'section'  => 'home_trending_posts_options',
        'type'     => 'checkbox',
    )
);

/*Trending Posts Title.*/
$wp_customize->add_setting(
    'theme_options[trending_posts_title]',
    array(
        'default'           => $default_options['trending_posts_title'],
        'sanitize_callback' => 'wp_filter_nohtml_kses',
        'transport'         => 'postMessage',
    )
);
$wp_customize->add_control(
    'theme_options[trending_posts_title]',
    array(
        'label'    => __( 'Trending posts Title', 'magazine-saga' ),
        'section'  => 'home_trending_posts_options',
        'type'     => 'text',
    )
);
/**/

/*Trending Posts Category.*/
$wp_customize->add_setting(
    'theme_options[trending_posts_cat]',
    array(
        'default'           => $default_options['trending_posts_cat'],
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control(
    new Magazine_Saga_Dropdown_Taxonomies_Control(
        $wp_customize,
        'theme_options[trending_posts_cat]',
        array(
            'label'    => __( 'Choose Trending posts category', 'magazine-saga' ),
            'section'  => 'home_trending_posts_options',
        )
    )
);
/**/

/* ========== Home Page Trending Posts Section Close========== */

/* ========== Home Page Masonry Posts Section ========== */
$wp_customize->add_section(
    'home_masonry_posts_options' ,
    array(
        'title' => __( 'Masonry Post Options', 'magazine-saga' ),
        'panel' => 'theme_home_option_panel',
    )
);

/*Enable Masonry Posts Section*/
$wp_customize->add_setting(
    'theme_options[enable_masonry_posts]',
    array(
        'default'           => $default_options['enable_masonry_posts'],
        'sanitize_callback' => 'magazine_saga_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'theme_options[enable_masonry_posts]',
    array(
        'label'    => __( 'Enable Masonry Posts', 'magazine-saga' ),
        'section'  => 'home_masonry_posts_options',
        'type'     => 'checkbox',
    )
);

/*Masonry Posts Title.*/
$wp_customize->add_setting(
    'theme_options[masonry_posts_title]',
    array(
        'default'           => $default_options['masonry_posts_title'],
        'sanitize_callback' => 'wp_filter_nohtml_kses',
        'transport'         => 'postMessage',
    )
);
$wp_customize->add_control(
    'theme_options[masonry_posts_title]',
    array(
        'label'    => __( 'Masonry posts Title', 'magazine-saga' ),
        'section'  => 'home_masonry_posts_options',
        'type'     => 'text',
    )
);
/**/

/*Masonry Posts Category.*/
$wp_customize->add_setting(
    'theme_options[masonry_posts_cat]',
    array(
        'default'           => $default_options['masonry_posts_cat'],
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control(
    new Magazine_Saga_Dropdown_Taxonomies_Control(
        $wp_customize,
        'theme_options[masonry_posts_cat]',
        array(
            'label'    => __( 'Choose Masonry posts category', 'magazine-saga' ),
            'section'  => 'home_masonry_posts_options',
        )
    )
);
/**/

/* ========== Home Page Masonry Posts Section Close========== */


/* ========== Home Page Featured Stories Section ========== */
$wp_customize->add_section(
    'home_featured_stories_options' ,
    array(
        'title' => __( 'Featured Stories Options', 'magazine-saga' ),
        'panel' => 'theme_home_option_panel',
    )
);

/*Enable Featured Stories Section*/
$wp_customize->add_setting(
    'theme_options[enable_featured_stories]',
    array(
        'default'           => $default_options['enable_featured_stories'],
        'sanitize_callback' => 'magazine_saga_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'theme_options[enable_featured_stories]',
    array(
        'label'    => __( 'Enable Featured Stories', 'magazine-saga' ),
        'section'  => 'home_featured_stories_options',
        'type'     => 'checkbox',
    )
);

/*Featured Stories Category.*/
$wp_customize->add_setting(
    'theme_options[featured_stories_cat]',
    array(
        'default'           => $default_options['featured_stories_cat'],
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control(
    new Magazine_Saga_Dropdown_Taxonomies_Control(
        $wp_customize,
        'theme_options[featured_stories_cat]',
        array(
            'label'    => __( 'Choose Featured Stories category', 'magazine-saga' ),
            'section'  => 'home_featured_stories_options',
        )
    )
);
/**/

/* ========== Home Page Featured Stories Section Close========== */

/*Add Theme Options Panel.*/
$wp_customize->add_panel(
    'theme_option_panel',
    array(
        'title' => __( 'Theme Options', 'magazine-saga' ),
        'description' => __( 'Contains all theme settings', 'magazine-saga')
    )
);
/**/

/* ========== Top Bar Section. ==========*/
$wp_customize->add_section(
    'top_bar_options',
    array(
        'title'      => __( 'TopBar Options', 'magazine-saga' ),
        'panel'      => 'theme_option_panel',
    )
);

/*Show Top Bar*/
$wp_customize->add_setting(
    'theme_options[show_top_bar]',
    array(
        'default'           => $default_options['show_top_bar'],
        'sanitize_callback' => 'magazine_saga_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'theme_options[show_top_bar]',
    array(
        'label'    => __( 'Show TopBar', 'magazine-saga' ),
        'section'  => 'top_bar_options',
        'type'     => 'checkbox',
    )
);

/* ========== Top Bar Section Close========== */


/* ========== Layout Section ========== */
$wp_customize->add_section(
    'layout_options',
    array(
        'title'      => __( 'Layout Options', 'magazine-saga' ),
        'panel'      => 'theme_option_panel',
    )
);

/* Global Layout*/
$wp_customize->add_setting(
    'theme_options[global_layout]',
    array(
        'default'           => $default_options['global_layout'],
        'sanitize_callback' => 'magazine_saga_sanitize_select',
    )
);
$wp_customize->add_control(
    'theme_options[global_layout]',
    array(
        'label'       => __( 'Global Layout', 'magazine-saga' ),
        'section'     => 'layout_options',
        'type'        => 'select',
        'choices'     => array(
            'right-sidebar' => __( 'Content - Primary Sidebar', 'magazine-saga' ),
            'left-sidebar' => __( 'Primary Sidebar - Content', 'magazine-saga' ),
            'no-sidebar' => __( 'No Sidebar', 'magazine-saga' )
        ),
    )
);

/* ========== Layout Section Close ========== */

/* ========== Header Section. ==========*/
$wp_customize->add_section( 
    'header_options',
    array(
        'title'      => __( 'Header Options', 'magazine-saga' ),
        'panel'      => 'theme_option_panel',
    )
);

/*Show Ad Banner*/
$wp_customize->add_setting(
    'theme_options[show_ad_banner]',
    array(
        'default'           => $default_options['show_ad_banner'],
        'sanitize_callback' => 'magazine_saga_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'theme_options[show_ad_banner]',
    array(
        'label'    => __( 'Show Ad Banner', 'magazine-saga' ),
        'section'  => 'header_options',
        'type'     => 'checkbox',
    )
);

/*Ad Banner Image*/
$wp_customize->add_setting(
    'theme_options[ad_banner_image]',
    array(
        'default'           => $default_options['ad_banner_image'],
        'sanitize_callback' => 'magazine_saga_sanitize_image',
    )
);
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'theme_options[ad_banner_image]',
        array(
            'label'           => __( 'Ad Banner Image', 'magazine-saga' ),
            'description'	  => sprintf( esc_html__( 'Recommended Size %1$s px X %2$s px', 'magazine-saga' ), 750, 90 ),
            'section'         => 'header_options',
        )
    )
);

/*Ad Banner Link.*/
$wp_customize->add_setting(
    'theme_options[ad_banner_link]',
    array(
        'default'           => $default_options['ad_banner_link'],
        'sanitize_callback' => 'esc_url_raw'
    )
);
$wp_customize->add_control(
    'theme_options[ad_banner_link]',
    array(
        'label'    => __( 'Ad Banner Link', 'magazine-saga' ),
        'section'  => 'header_options',
        'type'     => 'text',
    )
);

/* ========== Header Section Close========== */


/* ========== Pagination Section ========== */
$wp_customize->add_section(
    'pagination_options',
    array(
        'title'      => __( 'Pagination Options', 'magazine-saga' ),
        'panel'      => 'theme_option_panel',
    )
);

/*Pagination Type*/
$wp_customize->add_setting( 
    'theme_options[pagination_type]',
    array(
        'default'           => $default_options['pagination_type'],
        'sanitize_callback' => 'magazine_saga_sanitize_select',
    )
);
$wp_customize->add_control( 
    'theme_options[pagination_type]',
    array(
        'label'       => __( 'Pagination Type', 'magazine-saga' ),
        'section'     => 'pagination_options',
        'type'        => 'select',
        'choices'     => array(
            'default' => esc_html__( 'Default (Older / Newer Post)', 'magazine-saga' ),
            'numeric' => esc_html__( 'Numeric', 'magazine-saga' ),
        ),
    )
);
/* ========== Pagination Section Close========== */

/* ========== Breadcrumb Section ========== */
$wp_customize->add_section(
    'breadcrumb_options',
    array(
        'title'      => __( 'Breadcrumb Options', 'magazine-saga' ),
        'panel'      => 'theme_option_panel',
    )
);

/* Breadcrumb Type*/
$wp_customize->add_setting(
    'theme_options[breadcrumb_type]',
    array(
        'default'           => $default_options['breadcrumb_type'],
        'sanitize_callback' => 'magazine_saga_sanitize_select',
    )
);
$wp_customize->add_control(
    'theme_options[breadcrumb_type]',
    array(
        'label'       => __( 'Breadcrumb Type', 'magazine-saga' ),
        'description' => sprintf( esc_html__( 'Advanced: Requires %1$sBreadcrumb NavXT%2$s plugin', 'magazine-saga' ), '<a href="https://wordpress.org/plugins/breadcrumb-navxt/" target="_blank">','</a>' ),
        'section'     => 'breadcrumb_options',
        'type'        => 'select',
        'choices'     => array(
            'disabled' => __( 'Disabled', 'magazine-saga' ),
            'simple' => __( 'Simple', 'magazine-saga' ),
            'advanced' => __( 'Advanced', 'magazine-saga' ),
        ),
    )
);
/* ========== Breadcrumb Section Close ========== */

/* ========== Excerpt Section ========== */
$wp_customize->add_section(
    'excerpt_options',
    array(
        'title'      => __( 'Excerpt Options', 'magazine-saga' ),
        'panel'      => 'theme_option_panel',
    )
);

/* Excerpt Length */
$wp_customize->add_setting(
    'theme_options[excerpt_length]',
    array(
        'default'           => $default_options['excerpt_length'],
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(
    'theme_options[excerpt_length]',
    array(
        'label'       => __( 'Excerpt Length', 'magazine-saga' ),
        'section'     => 'excerpt_options',
        'type'        => 'number',
    )
);

/* Excerpt Read More Text */
$wp_customize->add_setting(
    'theme_options[excerpt_read_more_text]',
    array(
        'default'           => $default_options['excerpt_read_more_text'],
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);
$wp_customize->add_control(
    'theme_options[excerpt_read_more_text]',
    array(
        'label'       => __( 'Read More Text', 'magazine-saga' ),
        'section'     => 'excerpt_options',
        'type'        => 'text',
    )
);
/* ========== Excerpt Section Close ========== */

/* ========== Footer Section ========== */
$wp_customize->add_section(
    'footer_options' ,
    array(
        'title' => __( 'Footer Options', 'magazine-saga' ),
        'panel' => 'theme_option_panel',
    )
);
/*Copyright Text.*/
$wp_customize->add_setting(
    'theme_options[copyright_text]',
    array(
        'default'           => $default_options['copyright_text'],
        'sanitize_callback' => 'wp_filter_nohtml_kses',
        'transport'           => 'postMessage',
    )
);
$wp_customize->add_control(
    'theme_options[copyright_text]',
    array(
        'label'    => __( 'Copyright Text', 'magazine-saga' ),
        'section'  => 'footer_options',
        'type'     => 'textarea',
    )
);
/* ========== Footer Section Close========== */


/*Homepage Settings - Show static page content.*/
$wp_customize->add_setting(
    'theme_options[show_static_page_content]',
    array(
        'default'           => $default_options['show_static_page_content'],
        'sanitize_callback' => 'magazine_saga_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'theme_options[show_static_page_content]',
    array(
        'label'    => esc_html__( 'Show Static Page Content', 'magazine-saga' ),
        'section'  => 'static_front_page',
        'type'     => 'checkbox',
    )
);