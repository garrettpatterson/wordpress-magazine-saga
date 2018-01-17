<?php

/* Theme Widget sidebars. */
require get_template_directory() . '/inc/widgets/widget-sidebars.php';

/* Theme Widgets*/
require get_template_directory() . '/inc/widgets/grid-posts.php';
require get_template_directory() . '/inc/widgets/list-posts.php';
require get_template_directory() . '/inc/widgets/tab-posts.php';
require get_template_directory() . '/inc/widgets/posts-slider.php';
require get_template_directory() . '/inc/widgets/author-info.php';
require get_template_directory() . '/inc/widgets/social-menu.php';

/* Register site widgets */
if ( ! function_exists( 'magazine_saga_widgets' ) ) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function magazine_saga_widgets() {
        register_widget( 'Magazine_Saga_Grid_Posts' );
        register_widget( 'Magazine_Saga_List_Posts' );
        register_widget( 'Magazine_Saga_Tab_Posts' );
        register_widget( 'Magazine_Saga_Posts_Slider' );
        register_widget( 'Magazine_Saga_Author_Info' );
        register_widget( 'Magazine_Saga_Social_Menu' );
    }
endif;
add_action( 'widgets_init', 'magazine_saga_widgets' );
