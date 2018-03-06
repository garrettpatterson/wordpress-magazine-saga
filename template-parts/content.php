<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Magazine_Saga
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <!-- content.php -->
    <?php 
    $header_tag = "h1";
	if(!is_singular()){
		$header_tag = "h2";
	}
	?>
  
        <header class="entry-header">
            <?php
            the_title( '<'.$header_tag.' class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></'.$header_tag.'>' );
            if ( 'post' === get_post_type() ) : ?>
            <div class="entry-meta">
                <?php magazine_saga_posted_on(); ?>
            </div><!-- .entry-meta -->
            <?php
            endif; ?>
        </header><!-- .entry-header -->
    

	<div class="entry-content">
		<?php
        if(is_singular()){
            if(has_post_thumbnail()){
                echo '<div class="saga-featured-image post-thumb border-overlay">'.get_the_post_thumbnail(get_the_ID(),'magazine-saga-large-img').'</div>';
            }
            the_content( sprintf(
                wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'magazine-saga' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ) );
            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'magazine-saga' ),
                'after'  => '</div>',
            ) );
        }else{
            if(has_post_thumbnail()){
                echo '<div class="saga-featured-image post-thumb border-overlay">'.get_the_post_thumbnail(get_the_ID(),'magazine-saga-large-img').'</div>';
            }
            the_excerpt();
            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'magazine-saga' ),
                'after'  => '</div>',
            ) );
        }
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php magazine_saga_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
