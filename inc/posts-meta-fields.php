<?php
/**
 * Implement posts metabox.
 *
 * @package Magazine Saga
 */

if ( ! function_exists( 'magazine_saga_add_theme_meta_box' ) ) :

	/**
	 * Add the Meta Box
	 *
	 * @since 1.0.0
	 */
	function magazine_saga_add_theme_meta_box() {

		$post_types = array( 'post', 'page' );

		foreach ( $post_types as $post_type ) {
			add_meta_box(
				'magazine-saga-custom-box',
                sprintf( esc_html__( '%1s Settings', 'magazine-saga' ), ucwords($post_type) ),
				'magazine_saga_custom_box_html',
                $post_type
			);
		}

	}

endif;
add_action( 'add_meta_boxes', 'magazine_saga_add_theme_meta_box' );

if ( ! function_exists( 'magazine_saga_custom_box_html' ) ) :

	/**
	 * Render theme settings meta box.
	 *
	 * @since 1.0.0
	 */
	function magazine_saga_custom_box_html( $post ) {

        wp_nonce_field( basename( __FILE__ ), 'magazine_saga_meta_box_nonce' );
        $page_layout = get_post_meta($post->ID,'magazine_saga_page_layout',true);
        ?>
        <div id="magazine-saga-settings-metabox-container" class='inside'>
            <h3><label for="page-layout"><?php echo __( 'Page Layout', 'magazine-saga' ); ?></label></h3>
            <p>
                <select name="magazine_saga_page_layout" id="page-layout">
                    <option value=""><?php _e( '&mdash; Select &mdash;', 'magazine-saga' )?></option>
                    <option value="left-sidebar" <?php selected('left-sidebar',$page_layout);?>>
                        <?php _e( 'Primary Sidebar - Content', 'magazine-saga' )?>
                    </option>
                    <option value="right-sidebar" <?php selected('right-sidebar',$page_layout);?>>
                        <?php _e( 'Content - Primary Sidebar', 'magazine-saga' )?>
                    </option>
                    <option value="no-sidebar" <?php selected('no-sidebar',$page_layout);?>>
                        <?php _e( 'No Sidebar', 'magazine-saga' )?>
                    </option>
                </select>
            </p>
            <hr/>
        </div>
        <?php
	}

endif;


if ( ! function_exists( 'magazine_saga_save_postdata' ) ) :

	/**
	 * Save posts meta box value.
	 *
	 * @since 1.0.0
	 *
	 * @param int  $post_id Post ID.
	 */
	function magazine_saga_save_postdata( $post_id ) {

		// Verify nonce.
		if ( ! isset( $_POST['magazine_saga_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['magazine_saga_meta_box_nonce'], basename( __FILE__ ) ) ) {
			  return; }

		// Bail if auto save or revision.
		if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post_id ) ) || is_int( wp_is_post_autosave( $post_id ) ) ) {
			return;
		}

		// Check the post being saved == the $post_id to prevent triggering this call for other save_post events.
		if ( empty( $_POST['post_ID'] ) || $_POST['post_ID'] != $post_id ) {
			return;
		}

		// Check permission.
		if ( 'page' === $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return; }
		} else if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

        if ( isset( $_POST['magazine_saga_page_layout'] )){
            $valid_values = array(
                'left-sidebar',
                'right-sidebar',
                'no-sidebar',
            );
            $value = sanitize_text_field( $_POST['magazine_saga_page_layout'] );
            if( in_array( $value, $valid_values ) ) {
                update_post_meta($post_id, 'magazine_saga_page_layout', $value);
            }else{
                delete_post_meta($post_id,'magazine_saga_page_layout');
            }

        }
	}

endif;
add_action( 'save_post', 'magazine_saga_save_postdata' );