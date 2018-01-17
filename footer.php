<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Magazine_Saga
 */
?>
<?php
if( is_front_page() ) {
    if ( is_active_sidebar('home-page-col-one') || is_active_sidebar('home-page-col-two') ){
        echo '</div>';/*<!-- #content -->*/
    }
}else{
    ?>
    </div><!-- #content -->
    <?php
}
?>

<?php
/**
 * Hook - magazine_saga_before_footer.
 *
 * @hooked magazine_saga_latest_posts - 10
 * @hooked magazine_saga_featured_stories - 20
 * @hooked magazine_saga_static_page_content - 30
 */
do_action('magazine_saga_before_footer');
?>

<?php if (is_active_sidebar('offcanvas')) : ?>
    <div id="sidr-nav" class="primary-background">
        <div class="sidr-close-holder">
            <a class="sidr-class-sidr-button-close" href="#sidr-nav">
                <i class="ion-ios-close-empty"></i>
            </a>
        </div>
        <!-- offcanvas navigation content -->
        <?php dynamic_sidebar('offcanvas'); ?>
    </div>
<?php endif; ?>

<footer id="colophon" class="site-footer">
    <?php if ( is_active_sidebar('footer-col-one') || is_active_sidebar('footer-col-two') || is_active_sidebar('footer-col-three') ): ?>
    <div class="footer-widget-area">
        <div class="container">
            <div class="row">
                <?php if (is_active_sidebar('footer-col-one')) : ?>
                    <div class="col-md-4">
                        <?php dynamic_sidebar('footer-col-one'); ?>
                    </div>
                <?php endif; ?>
                <?php if (is_active_sidebar('footer-col-two')) : ?>
                    <div class="col-md-4">
                        <?php dynamic_sidebar('footer-col-two'); ?>
                    </div>
                <?php endif; ?>
                <?php if (is_active_sidebar('footer-col-three')) : ?>
                    <div class="col-md-4">
                        <?php dynamic_sidebar('footer-col-three'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif;?>

    <div class="site-copyright text-center">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <span>
                        <?php
                        $copyright_text = magazine_saga_get_option('copyright_text',true);
                        if ($copyright_text) {
                            echo wp_kses_post($copyright_text);
                        }
                        ?>
                    </span>
                    <?php printf(esc_html__('Theme: %1$s by %2$s', 'magazine-saga'), 'Magazine Saga', '<a href="http://themesaga.com/" target = "_blank" rel="designer">Themesaga</a>'); ?>
                </div>
            </div>
        </div>
    </div>

</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
