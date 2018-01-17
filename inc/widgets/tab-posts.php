<?php
/**
 * Adds Magazine_Saga_Tab_Posts widget.
 */
class Magazine_Saga_Tab_Posts extends WP_Widget {
    /**
     * Sets up a new widget instance.
     *
     * @since 1.0.0
     */
    function __construct() {
        parent::__construct(
            'magazine_saga_tab_posts_widget',
            esc_html__( 'MS: Tab Posts', 'magazine-saga' ),
            array( 'description' => esc_html__( 'Displays posts in tabs', 'magazine-saga' ), )
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
        ?>
        <div class="tabbed-container">
            <div class="tabbed-head">
                <ul class="nav nav-tabs primary-background secondary-font" role="tablist">
                    <li role="presentation" class="tab tab-popular active">
                        <a href="#ms-popular" aria-controls="<?php esc_html_e('Popular', 'magazine-saga'); ?>" role="tab" data-toggle="tab" class="primary-bgcolor">
                            <?php esc_html_e('Popular', 'magazine-saga'); ?>
                        </a>
                    </li>
                    <li class="tab tab-recent">
                        <a href="#ms-recent" aria-controls="<?php esc_html_e('Recent', 'magazine-saga'); ?>" role="tab" data-toggle="tab" class="primary-bgcolor">
                            <?php esc_html_e('Recent', 'magazine-saga'); ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div id="ms-popular" role="tabpanel" class="tab-pane active">
                    <?php
                    $this->render_post('popular',$instance);
                    ?>
                </div>
                <div id="ms-recent" role="tabpanel" class="tab-pane">
                    <?php
                    $this->render_post('recent',$instance);
                    ?>
                </div>
            </div>
        </div>
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
        $no_of_popular_posts = ! empty( $instance['no_of_popular_posts'] ) ? $instance['no_of_popular_posts'] : 5;
        $popular_content_length = ! empty( $instance['popular_content_length'] ) ? $instance['popular_content_length'] : 25;
        $no_of_recent_posts = ! empty( $instance['no_of_recent_posts'] ) ? $instance['no_of_recent_posts'] : 5;
        $recent_content_length = ! empty( $instance['recent_content_length'] ) ? $instance['recent_content_length'] : 25;
        ?>
        <h4 class="widefat" style="text-align:center;background-color:#f1f1f1;padding:5px 0;margin-top:5px;">
            <span class="field-label"><strong><?php _e('Popular','magazine-saga') ?></strong></span>
        </h4>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'no_of_popular_posts' ) ); ?>">
                <?php esc_attr_e( 'No of Posts:', 'magazine-saga' ); ?>
            </label>
            <input type="number" id="<?php echo esc_attr( $this->get_field_id( 'no_of_popular_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'no_of_popular_posts' ) ); ?>" value="<?php echo esc_attr( $no_of_popular_posts ); ?>" min="1" max="5" step="1" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'popular_content_length' ) ); ?>">
                <?php esc_attr_e( 'Content Length (Words):', 'magazine-saga' ); ?>
            </label>
            <input type="number" id="<?php echo esc_attr( $this->get_field_id( 'popular_content_length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'popular_content_length' ) ); ?>" value="<?php echo esc_attr( $popular_content_length ); ?>" min="0" max="50" step="1" />
        </p>
        <h4 class="widefat" style="text-align:center;background-color:#f1f1f1;padding:5px 0;margin-top:5px;">
            <span class="field-label"><strong><?php _e('Recent','magazine-saga') ?></strong></span>
        </h4>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'no_of_recent_posts' ) ); ?>">
                <?php esc_attr_e( 'No of Posts:', 'magazine-saga' ); ?>
            </label>
            <input type="number" id="<?php echo esc_attr( $this->get_field_id( 'no_of_recent_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'no_of_recent_posts' ) ); ?>" value="<?php echo esc_attr( $no_of_recent_posts ); ?>" min="1" max="5" step="1" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'recent_content_length' ) ); ?>">
                <?php esc_attr_e( 'Content Length (Words):', 'magazine-saga' ); ?>
            </label>
            <input type="number" id="<?php echo esc_attr( $this->get_field_id( 'recent_content_length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'recent_content_length' ) ); ?>" value="<?php echo esc_attr( $recent_content_length ); ?>" min="1" max="50" step="1" />
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

        $instance['no_of_popular_posts'] = ( ! empty( $new_instance['no_of_popular_posts'] ) ) ? absint( $new_instance['no_of_popular_posts'] ) : '';
        $instance['popular_content_length'] = ( ! empty( $new_instance['popular_content_length'] ) ) ? absint( $new_instance['popular_content_length'] ) : 0;

        $instance['no_of_recent_posts'] = ( ! empty( $new_instance['no_of_recent_posts'] ) ) ? absint( $new_instance['no_of_recent_posts'] ) : '';
        $instance['recent_content_length'] = ( ! empty( $new_instance['recent_content_length'] ) ) ? absint( $new_instance['recent_content_length'] ) : 0;

        return $instance;
    }

    /**
     * Outputs the tab posts
     *
     * @since 1.0.0
     *
     * @param array $args  Post Arguments.
     */
    public  function render_post( $type, $args ){
        $post_args = array();
        $content_length = 0;
        switch ($type) {
            case 'popular':
                $post_args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => $args['no_of_popular_posts'],
                    'orderby' => 'comment_count',
                );
                $content_length = absint($args['popular_content_length']);
                break;

            case 'recent':
                $post_args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => $args['no_of_recent_posts'],
                );
                $content_length = absint($args['recent_content_length']);
                break;

            default:
                break;
        }

        if( !empty($post_args) && is_array($post_args) ){
            $post_data = new WP_Query($post_args);
            if($post_data->have_posts()):
                echo '<ul class="article-item article-list-item article-tabbed-list article-item-left">';
                while($post_data->have_posts()):$post_data->the_post();
                ?>
                    <li class="full-item clearfix">
                        <div class="full-item-image col-four">
                            <a href="<?php the_permalink(); ?>" class="post-thumb">
                                <?php
                                if(has_post_thumbnail()){
                                    $image = get_the_post_thumbnail_url( get_the_ID(), 'magazine-saga-small-img' );
                                }else {
                                    $image = get_template_directory_uri().'/assets/images/no-image.png';
                                }
                                ?>
                                <img src="<?php echo esc_url($image);?>"/>
                                <span class="post-format">
                                    <i class="ion-paper-airplane st-icon"></i>
                                </span>
                            </a>
                        </div>
                        <div class="full-item-details col-eight">
                            <div class="full-item-metadata primary-font">
                                <div class="item-metadata posts-date small-font">
                                    <<?php echo get_the_date('M  d, Y'); ?>
                                </div>
                            </div>
                            <div class="full-item-content">
                                <h3 class="entry-title entry-title-2">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                <?php if($content_length > 0):?>
                                    <div class="full-item-desc">
                                        <div class="post-description">
                                            <?php echo wp_trim_words( get_the_content(), $content_length, '' );?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </li>
                <?php
                endwhile;wp_reset_postdata();
                echo '</ul>';
            endif;
        }
    }
}