<?php
/**
 * About setup
 *
 * @package Magazine_Saga
 */

if ( ! function_exists( 'magazine_saga_about_setup' ) ) :

	/**
	 * About setup.
	 *
	 * @since 1.0.0
	 */
	function magazine_saga_about_setup() {

		$config = array(

			// Welcome content.
			'welcome_content' => sprintf( esc_html__( '%1$s is now installed and ready to use. We want to make sure you have the best experience using the theme and that is why we have gathered all the necessary information here on this page for you. Thanks again for using our theme and hope you enjoy using the theme.', 'magazine-saga' ), 'Magazine Saga' ),

			// Tabs.
			'tabs' => array(
				'getting-started' => esc_html__( 'Getting Started', 'magazine-saga' ),
				'useful-plugins'  => esc_html__( 'Useful Plugins', 'magazine-saga' ),
				),

			// Quick links.
			'quick_links' => array(
                'theme_url' => array(
                    'text' => esc_html__( 'Theme Details', 'magazine-saga' ),
                    'url'  => 'https://themesaga.com/theme/magazine-saga/',
                ),
                'demo_url' => array(
                    'text' => esc_html__( 'Live Preview', 'magazine-saga' ),
                    'url'  => 'https://demo.themesaga.com/magazine-saga/',
                ),
                'documentation_url' => array(
                    'text'   => esc_html__( 'View Documentation', 'magazine-saga' ),
                    'url'    => 'https://docs.themesaga.com/magazine-saga/',
                    'button' => 'primary',
                ),
				'translation_url' => array(
					'text'   => esc_html__( 'Translate on your own Language', 'magazine-saga' ),
					'url'    => 'https://translate.wordpress.org/projects/wp-themes/magazine-saga/',
					'button' => 'primary',
				),
            ),

			// Getting started.
			'getting_started' => array(
				'one' => array(
					'title'       => esc_html__( 'Theme Documentation', 'magazine-saga' ),
					'icon'        => 'dashicons dashicons-format-aside',
					'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'magazine-saga' ),
					'button_text' => esc_html__( 'View Documentation', 'magazine-saga' ),
					'button_url'  => 'https://docs.themesaga.com/magazine-saga/',
					'button_type' => 'primary',
					'is_new_tab'  => true,
					),
				'two' => array(
					'title'       => esc_html__( 'Static Front Page', 'magazine-saga' ),
					'icon'        => 'dashicons dashicons-admin-generic',
					'description' => esc_html__( 'To achieve custom home page other than blog listing, you need to create and set static front page.', 'magazine-saga' ),
					'button_text' => esc_html__( 'Static Front Page', 'magazine-saga' ),
					'button_url'  => admin_url( 'customize.php?autofocus[section]=static_front_page' ),
					'button_type' => 'primary',
					),
				'three' => array(
					'title'       => esc_html__( 'Theme Options', 'magazine-saga' ),
					'icon'        => 'dashicons dashicons-admin-customizer',
					'description' => esc_html__( 'Theme uses Customizer API for theme options. Using the Customizer you can easily customize different aspects of the theme.', 'magazine-saga' ),
					'button_text' => esc_html__( 'Customize', 'magazine-saga' ),
					'button_url'  => wp_customize_url(),
					'button_type' => 'primary',
					),
				'four' => array(
					'title'       => esc_html__( 'Demo Content', 'magazine-saga' ),
					'icon'        => 'dashicons dashicons-layout',
					'description' => sprintf( esc_html__( 'To import sample demo content, %1$s plugin should be installed and activated. After plugin is activated, visit Import Demo Data menu under Appearance.', 'magazine-saga' ), esc_html__( 'One Click Demo Import', 'magazine-saga' ) ),
					),
				'five' => array(
					'title'       => esc_html__( 'Theme Preview', 'magazine-saga' ),
					'icon'        => 'dashicons dashicons-welcome-view-site',
					'description' => esc_html__( 'You can check out the theme demos for reference to find out what you can achieve using the theme and how it can be customized.', 'magazine-saga' ),
					'button_text' => esc_html__( 'View Demo', 'magazine-saga' ),
					'button_url'  => 'https://demo.themesaga.com/magazine-saga/',
					'button_type' => 'secondary',
					'is_new_tab'  => true,
					),
                'six' => array(
                    'title'       => esc_html__( 'Contact Support', 'magazine-saga' ),
                    'icon'        => 'dashicons dashicons-sos',
                    'description' => esc_html__( 'Got theme support question or found bug or got some feedbacks? Best place to ask your query is the dedicated Support forum for the theme.', 'magazine-saga' ),
                    'button_text' => esc_html__( 'Contact Support', 'magazine-saga' ),
                    'button_url'  => 'https://themesaga.com/support/',
					'button_type' => 'secondary',
                    'is_new_tab'  => true,
                ),
				),

			// Useful plugins.
			'useful_plugins' => array(
				'description' => esc_html__( 'Theme supports some helpful WordPress plugins to enhance your site. But, please enable only those plugins which you need in your site. For example, enable WooCommerce only if you are using e-commerce.', 'magazine-saga' ),
				),

			);

		magazine_saga_About::init( $config );
	}

endif;

add_action( 'after_setup_theme', 'magazine_saga_about_setup' );
