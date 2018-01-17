<?php
if (!function_exists('magazine_saga_banner_content')) :
    /**
     * Banner Content.
     *
     * @since 1.0.0
     */
    function magazine_saga_banner_content()
    {
        $enable_banner = magazine_saga_get_option('enable_banner',true);
        if ( $enable_banner ) {
            ?>
            <div class="saga-banner">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <?php
                            /**
                             * Hook - magazine_saga_content_slider.
                             *
                             * @hooked magazine_saga_display_content_slider - 10
                             */
                            do_action('magazine_saga_content_slider');
                            ?>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <?php
                            /**
                             * Hook - magazine_saga_pinned_post.
                             *
                             * @hooked magazine_saga_display_pinned_post - 10
                             */
                            do_action('magazine_saga_pinned_post');
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
endif;
add_action('magazine_saga_banner', 'magazine_saga_banner_content');

if (!function_exists('magazine_saga_display_content_slider')) :
    /**
     * Content Slider.
     *
     * @since 1.0.0
     */
    function magazine_saga_display_content_slider()
    {
        $slider_cat = magazine_saga_get_option('slider_cat',true);
        if ( !empty($slider_cat) ) {
            $slider_args = array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'post_status' => 'publish',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field' => 'term_id',
                        'terms' => $slider_cat,
                    ),
                ),
            );
            $slider = new WP_Query($slider_args);
            if ($slider->have_posts()):
                echo '<section class="saga-slide saga-slider-common">';
                while ($slider->have_posts()):$slider->the_post();
                    $image = magazine_saga_get_post_image(get_the_ID(),'magazine-saga-large-img');
                    ?>
                    <div class="single-slide">
                        <div class="slide-bg bg-image">
                            <img src="<?php echo esc_url($image); ?>">
                        </div>
                        <div class="slide-text">
                            <div class="slide-text-wrapper">
                                <h2>
                                    <a href="<?php the_permalink() ?>">
                                       <?php the_title(); ?>
                                    </a>
                                </h2>
                                <a href="<?php the_permalink() ?>" class="bttn">
                                    <?php _e('Browse More', 'magazine-saga') ?>
                                    <i class="ion-ios-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                echo '</section>';
            endif;
        }
    }
endif;
add_action('magazine_saga_content_slider', 'magazine_saga_display_content_slider');

if (!function_exists('magazine_saga_display_pinned_post')) :
    /**
     * Pinned Post.
     *
     * @since 1.0.0
     */
    function magazine_saga_display_pinned_post()
    {
        $pinned_posts_cat = magazine_saga_get_option('pinned_posts_cat',true);
        if( !empty($pinned_posts_cat) ){
            $post_args = array(
                'post_type' => 'post',
                'posts_per_page' => 2,
                'post_status' => 'publish',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field' => 'term_id',
                        'terms' => $pinned_posts_cat,
                    ),
                ),
            );
            $pinned_post = new WP_Query($post_args);
            if ($pinned_post->have_posts()):
                while ($pinned_post->have_posts()):$pinned_post->the_post();
                    ?>
                    <div class="trending-item-content primary-background border-overlay">
                        <a href="<?php the_permalink() ?>" class="bg-image bg-image-2 bg-opacity">
                            <?php $image = magazine_saga_get_post_image(get_the_ID(),'magazine-saga-small-img');?>
                            <img class="trending-post-img" src="<?php echo esc_url($image); ?>">
                        </a>
                        <div class="post-content border-overlay-content">
                            <div class="post-cat primary-font">
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
                            </div>
                            <h2 class="entry-title entry-title-1">
                                <a href="<?php the_permalink();?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
        }
    }
endif;
add_action('magazine_saga_pinned_post', 'magazine_saga_display_pinned_post');