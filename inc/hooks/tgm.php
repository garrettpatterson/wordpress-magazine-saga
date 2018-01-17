<?php
/**
 * Recommended plugins
 *
 * @package magazine-saga
 */
if ( ! function_exists( 'magazine_saga_recommended_plugins' ) ) :
	/**
	 * Recommend plugins.
	 *
	 * @since 1.0.0
	 */
	function magazine_saga_recommended_plugins() {
		$plugins = array(
			array(
				'name'     => esc_html__( 'One Click Demo Import', 'magazine-saga' ),
				'slug'     => 'one-click-demo-import',
				'required' => false,
			),
		);
		tgmpa( $plugins );
	}
endif;
add_action( 'tgmpa_register', 'magazine_saga_recommended_plugins' );
