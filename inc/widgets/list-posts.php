<?php

/**
 * Adds Magazine_Saga_List_Posts widget.
 */
class Magazine_Saga_List_Posts extends WP_Widget
{
    /**
     * Sets up a new widget instance.
     *
     * @since 1.0.0
     */
    function __construct()
    {
        parent::__construct(
            'magazine_saga_list_posts_widget',
            esc_html__('MS: List Posts', 'magazine-saga'),
            array('description' => esc_html__('Displays posts in list style', 'magazine-saga'),)
        );
    }

    /**
     * Outputs the content for the current widget instance.
     *
     * @since 1.0.0
     *
     * @param array $args Display arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        if (!empty($instance['short_desc'])) {
            $short_desc = apply_filters( 'widget_title', $instance['short_desc'], $instance, $this->id_base );
            echo $args['before_title'] . $short_desc . $args['after_title'];
        }
        ?>

        <?php
        if (-1 != $instance['post_cat']):
            $list_posts_args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 6,
                'cat' => $instance['post_cat'],
            );
            $list_posts = new WP_Query($list_posts_args);
            if ($list_posts->have_posts()):
                $first = true;
                $grid_content = $list_content = '';
                if ($list_posts->found_posts >= 2) {
                    $list_content_wrapper_start = '<div class="col-half"><ul class="category-list-post">';
                    $list_content_wrapper_end = '</ul></div>';
                } else {
                    $list_content_wrapper_start = $list_content_wrapper_end = '';
                }
                ?>
                <div class="widget-panel widget-panel-2">
                    <?php
                    while ($list_posts->have_posts()):$list_posts->the_post();
                        if(has_post_thumbnail()){
                            $image = get_the_post_thumbnail_url( get_the_ID(), 'magazine-saga-small-img' );
                        }else {
                            $image = get_template_directory_uri().'/assets/images/no-image.png';
                        }
                        if (true == $first):
                            $grid_content = '<div class="col-half"><article class="st-article st-article-2">';
                            $categories = get_the_category_list(', ');
                            $grid_content .= '<div class="secondary-background border-overlay">';
                            $grid_content .= '<a href="' . esc_url(get_the_permalink(get_the_ID())) . '" class="bg-image bg-image-3"><img src="'.esc_url($image).'"></a>';
                            if (!empty($categories)) {
                                $grid_content .= '<div class="post-content border-overlay-content"><div class="post-cat primary-font">' . $categories . '</div></div>';
                            }
                            $grid_content .= '</div>';
                            $grid_content .= '<div class="post-details clearfix"><h2 class="post-title"><a href="' . esc_url(get_the_permalink(get_the_ID())) . '">' . esc_html(get_the_title()) . '</a></h2>';
                            $grid_content .= '<div class="post-meta"><span class="saga-meta-info post-date">' . get_the_date('M  d, Y') . '</span><span class="saga-meta-info meta-divider"><i class="ion-android-close"></i></span><span class="saga-meta-info post-author"><a href="' . esc_url(get_the_author_link()) . '">' . esc_html(get_the_author()) . '</a></span></div>';
                            $grid_content .= '<div class="post-des dropcap">' . wp_trim_words( get_the_content(), 25, '' ) . '</div>';
                            $grid_content .= '</div></article></div>';
                        else:
                            $list_content .= '<li class="clearfix">';
                            $list_content .= '<div class="post-thumb"><a href="' . esc_url(get_the_permalink(get_the_ID())) . '" class="bg-image bg-image-4"><img src="'.esc_url($image).'"/></a></div>';
                            $list_content .= '<div class="post-details"><h3 class="entry-title entry-title-1"><a href="' . esc_url(get_the_permalink(get_the_ID())) . '">' . esc_html(get_the_title()) . '</a></h3></div>';
                            $list_content .= '</li>';
                        endif;
                        $first = false;
                    endwhile;
                    wp_reset_postdata();
                    echo $grid_content . $list_content_wrapper_start . $list_content . $list_content_wrapper_end;
                    ?>
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
    public function form($instance)
    {
        $short_desc = !empty($instance['short_desc']) ? $instance['short_desc'] : '';
        $post_cat = !empty($instance['post_cat']) ? $instance['post_cat'] : 0;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('short_desc')); ?>">
                <?php esc_attr_e('Title:', 'magazine-saga'); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('short_desc')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('short_desc')); ?>" type="text"
                   value="<?php echo esc_attr($short_desc); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('post_cat')); ?>">
                <?php esc_attr_e('Choose Category:', 'magazine-saga'); ?>
            </label>
            <?php
            $args = array(
                'show_option_none' => __('&mdash; Select &mdash;', 'magazine-saga'),
                'selected' => $post_cat,
                'id' => esc_attr($this->get_field_id('post_cat')),
                'name' => esc_attr($this->get_field_name('post_cat')),
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
    public function update($new_instance, $old_instance)
    {
        $instance = array();

        $instance['short_desc'] = (!empty($new_instance['short_desc'])) ? sanitize_text_field($new_instance['short_desc']) : '';
        $instance['post_cat'] = (!empty($new_instance['post_cat'])) ? absint($new_instance['post_cat']) : '';

        return $instance;
    }

}