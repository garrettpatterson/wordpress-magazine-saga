<?php
/**
 * The template for displaying home page.
 * @package magazine-saga
 */
get_header();
$wrapper_class = 'homepage-widget-fullwidth';
$second_sidebar_is_active = false;
if (is_active_sidebar('home-page-col-two')) :
    $wrapper_class = '';
    $second_sidebar_is_active = true;
endif;
?>
<div class="home-upper-widgetarea <?php echo esc_attr($wrapper_class); ?>">
    <div class="home-primary-sidebar">
        <?php
        if (is_active_sidebar('home-page-col-one')) :
            dynamic_sidebar('home-page-col-one');
        endif;
        ?>
    </div>
    <?php
    if (true == $second_sidebar_is_active):
        echo '<div class="home-secondary-sidebar"> <div class="sidebar-bg">';
        dynamic_sidebar('home-page-col-two');
        echo '</div></div>';
    endif;
    ?>
</div>
<?php
get_footer();