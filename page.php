<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>


<div id="aside">
	<?php 
	$menu_args = array(
		'walker'          => new Custom_Walker_Nav_Sub_Menu(),
		'container'       => ''
	);

	wp_nav_menu($menu_args);

	?>
</div>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<div id="content" role="main">
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">Pages:', 'after' => '</div>' ) ); ?>
				<?php edit_post_link('Edit', '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-content -->
		</div><!-- #post-## -->

		<?php comments_template( '', true ); ?>

<?php endwhile; ?>

	</div><!-- #content -->

<?php get_footer(); ?>
