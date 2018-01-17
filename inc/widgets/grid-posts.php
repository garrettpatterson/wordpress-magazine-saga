<?php
/**
 * Adds Magazine_Saga_Grid_Posts widget.
 */
class Magazine_Saga_Grid_Posts extends WP_Widget {
    /**
     * Sets up a new widget instance.
     *
     * @since 1.0.0
     */
    function __construct() {
        parent::__construct(
            'magazine_saga_grid_posts_widget',
            esc_html__( 'MS: Grid Posts', 'magazine-saga' ),
            array( 'description' => esc_html__( 'Displays posts in grid style', 'magazine-saga' ), )
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
            $grid_posts_args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => $instance['no_of_posts'],
                'cat' => $instance['post_cat'],
            );
            $grid_posts = new WP_Query($grid_posts_args);
            if($grid_posts->have_posts()):
                ?>
                <div class="widget-panel widget-panel-1">
                    <?php while ($grid_posts->have_posts()): $grid_posts->the_post();?>
                        <div class="col-half">
                            <article class="st-article st-article-1">
                                <?php
                                if(has_post_thumbnail()){
                                    $image = get_the_post_thumbnail_url( get_the_ID(), 'magazine-saga-small-img' );
                                }else {
                                    $image = get_template_directory_uri().'/assets/images/no-image.png';
                                }
                                ?>
                                <div class="post-thumb">
                                    <a href="<?php the_permalink();?>" class="bg-image bg-image-3">
                                        <span class="post-format">
                                            <i class="ion-paper-airplane st-icon"></i>
                                        </span>
                                        <img src="<?php echo esc_url($image);?>"/>
                                    </a>
                                </div>
                                <div class="post-details">
                                    <h3 class="post-title">
                                        <a href="<?php the_permalink();?>"><?php the_title(); ?></a>
                                    </h3>
                                    <div class="post-meta">
                                        <span class="saga-meta-info post-date">
                                            <?php echo get_the_date('M  d, Y'); ?>
                                        </span>
                                        <span class="saga-meta-info meta-divider">
                                            <i class="ion-android-close"></i>
                                        </span>
                                        <span class="saga-meta-info post-category">
                                             <?php
                                             $categories = get_the_category();
                                             $separator = ', ';
                                             $output = '';
                                             if ( ! empty( $categories ) ) {
                                                 foreach( $categories as $category ) {
                                                     if($category->term_id != 1 ){
                                                         $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'magazine-saga' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                                                     }
                                                 }
                                                 echo trim( $output, $separator );
                                             }
                                             ?>
                                        </span>
                                    </div>
                                    <div class="post-des">
                                        <?php echo wp_trim_words( get_the_content(), $instance['content_length'], '' );?>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endwhile; wp_reset_postdata();?>
                </div>
                <?php
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
        $content_length = ! empty( $instance['content_length'] ) ? $instance['content_length'] : 25;
        $no_of_posts = ! empty( $instance['no_of_posts'] ) ? $instance['no_of_posts'] : 6;
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
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'content_length' ) ); ?>">
                <?php esc_attr_e( 'Content Length (Words):', 'magazine-saga' ); ?>
            </label>
            <input type="number" id="<?php echo esc_attr( $this->get_field_id( 'content_length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'content_length' ) ); ?>" value="<?php echo esc_attr( $content_length ); ?>" min="1" max="50" step="1" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'no_of_posts' ) ); ?>">
                <?php esc_attr_e( 'No of Posts:', 'magazine-saga' ); ?>
            </label>
            <input type="number" id="<?php echo esc_attr( $this->get_field_id( 'no_of_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'no_of_posts' ) ); ?>" value="<?php echo esc_attr( $no_of_posts ); ?>" min="1" max="6" step="1" />
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
        $instance['content_length'] = ( ! empty( $new_instance['content_length'] ) ) ? absint( $new_instance['content_length'] ) : '';
        $instance['no_of_posts'] = ( ! empty( $new_instance['no_of_posts'] ) ) ? absint( $new_instance['no_of_posts'] ) : '';

        return $instance;
    }

}