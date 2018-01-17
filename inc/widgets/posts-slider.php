<?php
/**
 * Adds Magazine_Saga_Posts_Slider widget.
 */
class Magazine_Saga_Posts_Slider extends WP_Widget {
    /**
     * Sets up a new widget instance.
     *
     * @since 1.0.0
     */
    function __construct() {
        parent::__construct(
            'magazine_saga_posts_slider_widget',
            esc_html__( 'MS: Posts Slider', 'magazine-saga' ),
            array( 'description' => esc_html__( 'Displays posts in slider', 'magazine-saga' ), )
        );
    }

    /**
     * Outputs the content for the current widget instance.
     *
     * @since 1.0.0
     *
     * @param array $args     Display arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        if ( ! empty( $instance['short_desc'] ) ) {
            $short_desc = apply_filters( 'widget_title', $instance['short_desc'], $instance, $this->id_base );
            echo $args['before_title'] . $short_desc . $args['after_title'];
        }
        ?>

        <?php
        if( -1 != $instance['post_cat']):
            $posts_args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 3,
                'cat' => $instance['post_cat'],
            );
            $slider_posts = new WP_Query($posts_args);
            if ($slider_posts->have_posts()):
                echo '<section class="saga-widget-slide saga-slider-common">';
                while ($slider_posts->have_posts()):$slider_posts->the_post();
                    if (has_post_thumbnail()) {
                        ?>
                        <div class="single-slide">
                            <div class="slide-bg bg-image">
                                <img src="<?php the_post_thumbnail_url('full') ?>">
                            </div>
                            <div class="slide-text">
                                <div class="primary-background bg-overlay"></div>
                                <div class="slide-text-wrapper">
                                    <a href="<?php the_permalink() ?>">
                                        <h2><?php the_title(); ?></h2>
                                    </a>
                                    <div class="title-seperator secondary-background"></div>
                                    <a href="<?php the_permalink() ?>" class="saga-btn">
                                        <?php _e('Browse More', 'magazine-saga') ?>
                                        <i class="ion-ios-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                endwhile;
                wp_reset_postdata();
                echo '</section>';
            endif;
        endif;
        ?>

        <?php
        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @since 1.0.0
     *
     * @param array $instance Previously saved values from database.
     *
     *
     */
    public function form( $instance ) {
        $short_desc = ! empty( $instance['short_desc'] ) ? $instance['short_desc'] : '';
        $post_cat = ! empty( $instance['post_cat'] ) ? $instance['post_cat'] : 0;
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'short_desc' ) ); ?>">
                <?php esc_attr_e( 'Title:', 'magazine-saga' ); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'short_desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'short_desc' ) ); ?>" type="text" value="<?php echo esc_attr( $short_desc ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'post_cat' ) ); ?>">
                <?php esc_attr_e( 'Choose Category:', 'magazine-saga' ); ?>
            </label>
            <?php
            $args = array(
                'show_option_none'   => __( '&mdash; Select &mdash;','magazine-saga' ),
                'selected'           => $post_cat,
                'id'                 => esc_attr( $this->get_field_id( 'post_cat' ) ),
                'name'              => esc_attr( $this->get_field_name( 'post_cat' ) ),
            );
            wp_dropdown_categories($args);
            ?>
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @since 1.0.0
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();

        $instance['short_desc'] = ( ! empty( $new_instance['short_desc'] ) ) ? sanitize_text_field( $new_instance['short_desc'] ) : '';
        $instance['post_cat'] = ( ! empty( $new_instance['post_cat'] ) ) ? absint( $new_instance['post_cat'] ) : '';

        return $instance;
    }

}