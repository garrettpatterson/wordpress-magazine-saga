<?php
/**
 * Default customizer values.
 *
 * @package Magazine_Saga
 */
if ( ! function_exists( 'magazine_saga_get_default_customizer_values' ) ) :
	/**
	 * Get default customizer values.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default customizer values.
	 */
	function magazine_saga_get_default_customizer_values() {

		$defaults = array();

        // Home Page.
        $defaults['enable_banner']      = false;
        $defaults['slider_cat']         = 1;
        $defaults['pinned_posts_cat']   = 1;

        $defaults['enable_trending_posts'] = true;
        $defaults['trending_posts_title'] = __('Trending Now','magazine-saga');
        $defaults['trending_posts_cat'] = 1;

        $defaults['enable_masonry_posts'] = false;
        $defaults['masonry_posts_title'] = '';
        $defaults['masonry_posts_cat']  = 1;

        $defaults['enable_featured_stories'] = false;
        $defaults['featured_stories_cat']  = 1;

        // Top Bar.
        $defaults['show_top_bar']   = true;

        // Global Layout
        $defaults['global_layout'] = 'right-sidebar';

		// Header.
        $defaults['show_ad_banner'] = false;
        $defaults['ad_banner_image'] = '';
        $defaults['ad_banner_link'] = '';

        //Pagination
        $defaults['pagination_type'] = 'numeric';

        //BreadCrumbs
        $defaults['breadcrumb_type'] = 'simple';

        //Excerpt
        $defaults['excerpt_length'] = 40;
        $defaults['excerpt_read_more_text'] = __( 'Read More' , 'magazine-saga');

		// Footer.
		$defaults['copyright_text'] = esc_html__( 'Copyright &copy; All rights reserved.', 'magazine-saga' );

		//Homepage Settings
        $defaults['show_static_page_content'] = true;

		$defaults = apply_filters( 'magazine_saga_default_customizer_values', $defaults );
		return $defaults;
	}
endif;
