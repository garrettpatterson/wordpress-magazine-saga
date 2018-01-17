<?php 

if ( ! function_exists( 'magazine_saga_display_posts_navigation' ) ) :

	/**
	 * Display Pagination.
	 *
	 * @since 1.0.0
	 */
	function magazine_saga_display_posts_navigation() {

        $pagination_type = magazine_saga_get_option( 'pagination_type', true );
        switch ( $pagination_type ) {

            case 'default':
                the_posts_navigation();
                break;

            case 'numeric':
                the_posts_pagination();
                break;

            default:
                break;
        }
		return;
	}

endif;

add_action( 'magazine_saga_posts_navigation', 'magazine_saga_display_posts_navigation' );
