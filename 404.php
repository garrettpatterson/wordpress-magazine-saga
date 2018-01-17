<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Magazine_Saga
 */

get_header(); ?>
<section class="error-404 not-found text-center">
	<div class="page-content">
		<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'magazine-saga' ); ?></p>
		<?php get_search_form(); ?>
	</div>
</section>
<?php
get_footer();
