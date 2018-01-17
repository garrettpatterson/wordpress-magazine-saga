<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Magazine_Saga
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			// Show Related Posts
											$args = array(
								'wpp_start'=>'<div class="row"><div class="col-sm-12">
                                    <div class="saga-title-wrapper saga-title-wrapper-1">
                                        <h2 class="saga-title">
                                            <span class="primary-background">
                                               Related posts
                                            </span>
                                        </h2>
                                    </div>
                                </div>',
								'wpp_end'=>'</div>',
								'cat'=> join(',',wp_get_post_categories(get_the_ID())),
								'pid'=> strval(get_the_ID()),
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


			/*the_post_navigation(array(
                'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'magazine-saga' ) . '</span> ' .
                    '<span class="screen-reader-text">' . __( 'Next post:', 'magazine-saga' ) . '</span> ' .
                    '<span class="post-title">%title</span>',
                'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'magazine-saga' ) . '</span> ' .
                    '<span class="screen-reader-text">' . __( 'Previous post:', 'magazine-saga' ) . '</span> ' .
                    '<span class="post-title">%title</span>',
            )); */

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
$page_layout = magazine_saga_get_page_layout();
if( 'no-sidebar' != $page_layout ){
    get_sidebar();
}
get_footer();
