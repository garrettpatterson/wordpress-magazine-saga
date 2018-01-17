<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Magazine_Saga
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'magazine-saga'); ?></a>
	<!--
    <div id="loader" class="loader">
        <div class="loader-inner">
            <span id="loader-typed"></span>
            <div id="loader-typed-strings">
                <h2><?php esc_html_e('Loading', 'magazine-saga'); ?></h2>
                <h2><?php esc_html_e('wait a moment', 'magazine-saga'); ?></h2>
            </div>
        </div>
    </div>
   -->
    <?php
    $header_image = get_template_directory_uri().'/assets/images/header-banner.jpg';
    $dynamic_header_image = get_header_image();
    if($dynamic_header_image){
        $header_image = $dynamic_header_image;
    }
    ?>
    <header id="saga-header" class="site-header data-bg" data-background="<?php echo esc_url($header_image);?>">
        <?php
        $show_top_bar = magazine_saga_get_option('show_top_bar',true);
        if($show_top_bar){
            ?>
            <div class="saga-topnav primary-background">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="top-nav primary-font">
                                <?php
                                wp_nav_menu(
                                    array(
                                        'theme_location' => 'topbar-menu',
                                        'menu_id' => 'top-menu',
                                        'container' => 'div',
                                        'depth'        => 1,
                                        'fallback_cb' => false,
                                        'menu_class'=> false
                                    )
                                );
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="social-icons">
                                <?php
                                wp_nav_menu( array(
                                        'theme_location' => 'social-nav',
                                        'link_before' => '<span class="screen-reader-text">',
                                        'link_after' => '</span>',
                                        'menu_id' => 'social-menu',
                                        'fallback_cb' => false,
                                        'depth'        => 1,
                                        'menu_class'=> false
                                    )
                                );
                                ?>
                            </div>
                            <div class="pull-right">
                                <a href="#" class="search-button">
                                    <span class="saga-search-icon" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="search-box">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 col-xs-12">
                        <?php get_search_form(); ?>
                    </div>
                </div>
            </div>
        </div><!--Searchbar Ends-->


        <div class="saga-midnav">
            <div class="container">
                <div class="row flex-row">
                    <div class="col-sm-4 flex-row-child">
                        <div class="site-branding-wrapper">
                            <div class="site-branding">
                                <?php
                                the_custom_logo();

                                if ( is_front_page() && is_home() ) : ?>
                                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                <?php else : ?>
                                    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                                    <?php
                                endif;

                                $description = get_bloginfo( 'description', 'display' );
                                if ( $description || is_customize_preview() ) : ?>
                                    <p class="site-description primary-font"><?php echo $description; ?></p>
                                    <?php
                                endif;
                                ?>
                            </div><!-- .site-branding -->
                        </div>
                    </div>
                    <?php
                    $show_ad_banner = magazine_saga_get_option('show_ad_banner',true);
                    $ad_banner_image = magazine_saga_get_option('ad_banner_image',true);
                    $ad_banner_link = magazine_saga_get_option('ad_banner_link',true);
                    if($show_ad_banner){
                        if($ad_banner_image){
                            $ad_banner_image_html = '<img src="'.esc_url($ad_banner_image).'">';
                            $ad_banner_link_open = $ad_banner_link_close = '';
                            ?>
                            <div class="col-sm-8 flex-row-child">
                                <div class="ms-space primary-background">
                                    <?php
                                    if($ad_banner_link){
                                        $ad_banner_link_open = '<a href="'.esc_url($ad_banner_link).'" target="_blank" class="border-overlay">';
                                        $ad_banner_link_close = '</a>';
                                    }
                                    echo $ad_banner_link_open.$ad_banner_image_html.$ad_banner_link_close;
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="saga-navigation navigation-background">
            <div class="container">
                <nav id="site-navigation" class="main-navigation">

                <?php if (is_active_sidebar('offcanvas')) : ?>
                    <span class="icon-sidr secondary-background">
                        <div class="switch">
                            <a href="javascript:;" id="widgets-nav" class="widgets-nav-btn">
                                <span class="burger-bars">
                                    <span class="bars-upper"></span>
                                    <span class="bars-mid"></span>
                                    <span class="bars-lower"></span>
                                </span>
                            </a>
                        </div>
                    </span>
                <?php endif; ?>

                <span class="toggle-menu" aria-controls="primary-menu" aria-expanded="false">
                     <span class="screen-reader-text">
                        <?php esc_html_e('Primary Menu', 'magazine-saga'); ?>
                    </span>
                    <i class="ham"></i>
                </span>
                <?php wp_nav_menu(array(
                    'theme_location' => 'menu-1',
                    'menu_id' => 'primary-menu',
                    'container' => 'div',
                    'container_class' => 'menu col-md-8'
                )); ?>
                
                
                	<div class="col-md-4">
                		<div class="social-icons">
                                <?php
                                wp_nav_menu( array(
                                        'theme_location' => 'social-nav-1',
                                        'link_before' => '<span class="screen-reader-text">',
                                        'link_after' => '</span>',
                                        'menu_id' => 'social-menu',
                                        'fallback_cb' => false,
                                        'depth'        => 1,
                                        'menu_class'=> false
                                    )
                                );
                                ?>
                		</div>
                	</div>
                </nav><!-- #site-navigation -->
            </div>
        </div>
    </header><!-- #masthead -->

    <?php
    if( is_front_page() ) {
        /**
         * Hook - magazine_saga_banner.
         *
         * @hooked magazine_saga_banner_content - 10
         */
        do_action('magazine_saga_banner');
        /**
         * Hook - magazine_saga_trending_posts.
         *
         * @hooked magazine_saga_display_trending_posts - 10
         * @hooked magazine_saga_display_masonry_posts - 20
         */
        do_action('magazine_saga_display_posts');

        if ( is_active_sidebar('home-page-col-one') || is_active_sidebar('home-page-col-two') ){
            echo '<div id="content" class="site-content">';
        }
		
		?>
		<!-- start popular posts trending hack -->
		                    <section class="section-block section-trend">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="saga-title-wrapper saga-title-wrapper-1">
                                        <h2 class="saga-title">
                                            <span class="primary-background">
                                               Most Popular
                                            </span>
                                        </h2>
                                    </div>
                                </div>
     
                                <?php
								$args = array(
								'wpp_start'=>'<span>',
								'wpp_end'=>'</span>',
								'limit' => 3,
								    'post_html' =>'<div class="col-md-4 col-sm-4">
                                        <div class="trending-item-content primary-background border-overlay">
                                            <a href="{url}" class="bg-image bg-image-1 bg-opacity">
     
                                                <img class="trending-post-img" src="{img_url}">
                                                <!--
                                                thumb: {thumb}
												thumb_img: {thumb_img}
												thumb_Url: {thumb_url}
												image: {image}
												img_url: {img_url}
												-->
                                                
                                            </a>
                                            <div class="post-content border-overlay-content">
                                                <div class="post-cat primary-font">
                                                    {category} 
                                                </div>
                                                <h2 class="entry-title entry-title-1">
                                                    <a href="{url}">{title}</a>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>');
                                    wpp_get_mostpopular( $args );
                                    ?>

                            </div>
                        </div>
                    </section>
                    <!-- end popular posts trending hack -->
		<?php
    }else{
        /**
         * Hook - magazine_saga_inner_header.
         *
         * @hooked magazine_saga_display_inner_header - 10
         */
        do_action('magazine_saga_inner_header');
        ?>
        <div id="content" class="site-content">
        <?php
    }
