<?php
if (!function_exists('magazine_saga_display_trending_posts')) :
    /**
     * Trending Post.
     *
     * @since 1.0.0
     */
    function magazine_saga_display_trending_posts()
    {
        $enable_trending_posts = magazine_saga_get_option('enable_trending_posts',true);
        $trending_posts_cat = magazine_saga_get_option('trending_posts_cat',true);
        $trending_posts_title = magazine_saga_get_option('trending_posts_title',true);
        if ( $enable_trending_posts ) {
            if (!empty($trending_posts_cat)) {
                $post_args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'post_status' => 'publish',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'term_id',
                            'terms' => $trending_posts_cat,
                        ),
                    ),
                );
                $trending_post = new WP_Query($post_args);
                if ($trending_post->have_posts()):
                    ?>
                    <section class="section-block section-trend">
                        <div class="container">
                            <div class="row">
                                <?php
                                if ( !empty($trending_posts_title) ) {
                                ?>
                                <div class="col-sm-12">
                                    <div class="saga-title-wrapper saga-title-wrapper-1">
                                        <h2 class="saga-title">
                                            <span class="primary-background">
                                                <?php echo esc_html($trending_posts_title); ?>
                                            </span>
                                        </h2>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                                <?php while ($trending_post->have_posts()):$trending_post->the_post(); ?>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="trending-item-content primary-background border-overlay">
                                            <a href="<?php the_permalink(); ?>" class="bg-image bg-image-1 bg-opacity">
                                                <?php
                                                $image = magazine_saga_get_post_image(get_the_ID(),'magazine-saga-small-img');
                                                echo '<img class="trending-post-img" src="' . esc_url($image) . '">';
                                                ?>
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
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile;
                                wp_reset_postdata(); ?>
                            </div>
                        </div>
                    </section>
                    <?php
                endif;
            }
        }
    }
endif;
add_action('magazine_saga_display_posts', 'magazine_saga_display_trending_posts',10);

if (!function_exists('magazine_saga_display_masonry_posts')) :
    /**
     * Masonry Post.
     *
     * @since 1.0.0
     */
    function magazine_saga_display_masonry_posts()
    {
        $enable_masonry_posts = magazine_saga_get_option('enable_masonry_posts',true);
        $masonry_posts_cat = magazine_saga_get_option('masonry_posts_cat',true);
        if ( $enable_masonry_posts ) {
            if ( !empty($masonry_posts_cat) ) {
                $post_args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 6,
                    'post_status' => 'publish',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'term_id',
                            'terms' => $masonry_posts_cat,
                        ),
                    ),
                );
                $masonry_post = new WP_Query($post_args);
                if ($masonry_post->have_posts()):
                    ?>
                    <section class="section-block section-masonry section-bg">
                        <span class="saga-vr vr-start"></span>
                        <div class="container">
                            <div class="row">
                                <?php
                                $masonry_posts_title = magazine_saga_get_option('masonry_posts_title',true);
                                if(empty($masonry_posts_title)){
                                    $masonry_posts_title = get_cat_name($masonry_posts_cat);
                                }
                                ?>
                                <div class="col-sm-12">
                                    <div class="saga-title-wrapper saga-title-wrapper-2">
                                        <h2 class="saga-title">
                                            <?php echo esc_html($masonry_posts_title); ?>
                                        </h2>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-12">
                                    <div class="masonry-grid masonry-col-3">
                                        <!-- width of .grid-sizer used for columnWidth -->
                                        <?php while ($masonry_post->have_posts()): $masonry_post->the_post(); ?>
                                            <div class="masonry-item masonry-brick">
                                                <article class="st-article st-article-3">
                                                    <?php $image = magazine_saga_get_post_image(get_the_ID(),'magazine-saga-small-img');?>
                                                    <div class="post-thumb primary-background border-overlay border-overlay-white">
                                                        <a href="<?php the_permalink() ?>" class="post-background-overlay">
                                                            <span class="post-format">
                                                                <i class="ion-paper-airplane st-icon"></i>
                                                            </span>
                                                            <img src="<?php echo esc_url($image);?>">
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
                                                        </div>
                                                    </div>
                                                    <div class="post-details">
                                                        <h3 class="post-title">
                                                            <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                                        </h3>
                                                        <div class="post-meta">
                                                        <span class="saga-meta-info post-date"><?php echo get_the_date('M  d, Y'); ?></span>
                                                        </div>
                                                        <div class="post-des">
                                                            <?php echo wp_trim_words(get_the_content(), 25, ''); ?>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                        <?php endwhile;
                                        wp_reset_postdata(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="saga-vr vr-end"></span>
                    </section>
                    <?php
                endif;
            }
        }
    }
endif;
add_action('magazine_saga_display_posts', 'magazine_saga_display_masonry_posts',20);

if (!function_exists('magazine_saga_latest_posts')) :
    /**
     * Latest Posts
     *
     * @since 1.0.0
     */
    function magazine_saga_latest_posts()
    {
        if( is_front_page() && is_home() ){
            if ( 'posts' == get_option( 'show_on_front' ) ) {
                echo '<section class="section-block section-latest-block"><div class="container">';
                include( get_home_template() );
                echo '</div></section>';
            }
        }
    }
endif;
add_action('magazine_saga_before_footer', 'magazine_saga_latest_posts', 10);

if (!function_exists('magazine_saga_featured_stories')) :
    /**
     * Featured Stories
     *
     * @since 1.0.0
     */
    function magazine_saga_featured_stories()
    {
        if( is_front_page() ){
            $enable_featured_stories = magazine_saga_get_option('enable_featured_stories',true);
            $featured_stories_cat = magazine_saga_get_option('featured_stories_cat',true);
            if ( $enable_featured_stories ) {
                if ( !empty($featured_stories_cat) ) {
                    $post_args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 4,
                        'post_status' => 'publish',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'field' => 'term_id',
                                'terms' => $featured_stories_cat,
                            ),
                        ),
                    );
                    $featured_stories_post = new WP_Query($post_args);
                    if ($featured_stories_post->have_posts()):
                        $counter = 1;
                        $class = array('col-sm-8','col-sm-4');
                        ?>
                        <section class="section-block section-features section-bg">
                            <div class="container">
                                <div class="row row-collapse">
                                    <?php while($featured_stories_post->have_posts()):$featured_stories_post->the_post();?>
                                        <div class="<?php echo esc_attr($class[0]); ?> col-xs-12 small-pad">
                                            <div class="saga-grid">
                                                <article class="overlay-article primary-background">
                                                    <?php $image = magazine_saga_get_post_image(get_the_ID(),'magazine-saga-small-img');?>
                                                    <div class="post-thumb">
                                                        <a href="<?php the_permalink();?>" class="bg-image bg-image-3">
                                                            <img src="<?php echo esc_url($image); ?>"/>
                                                        </a>
                                                    </div>
                                                    <div class="post-details">
                                                        <div class="post-details-inner">
                                                            <h3 class="post-title">
                                                                <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                                            </h3>
                                                            <div class="post-meta">
                                                                <span class="post-date">
                                                                    <?php echo get_the_date('M  d, Y'); ?>
                                                                </span>
                                                                <span class="post-category">
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
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                        </div>
                                        <?php
                                        $counter++;
                                        if($counter % 2 == 0 ){
                                            $class = array_reverse($class);
                                        }
                                    endwhile; wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                        </section>
                        <?php
                    endif;
                }
            }
        }
    }
endif;
add_action('magazine_saga_before_footer', 'magazine_saga_featured_stories', 20);

if (!function_exists('magazine_saga_static_page_content')) :
    /**
     * Static Page Content
     *
     * @since 1.0.0
     */
    function magazine_saga_static_page_content()
    {
        if( is_front_page() ){
            if ( 'page' == get_option( 'show_on_front' ) ) {
                $show_static_page_content = magazine_saga_get_option('show_static_page_content', true);
                if ($show_static_page_content) {
                    echo '<div class="container">'
                    ?>
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">
                            <?php
                            while (have_posts()) : the_post();
                                get_template_part('template-parts/content', 'page');
                            endwhile;
                            ?>
                        </main>
                    </div>
                    <?php
                    get_sidebar();
                    echo '</div>';
                }
            }
        }
    }
endif;
add_action('magazine_saga_before_footer', 'magazine_saga_static_page_content', 30);
