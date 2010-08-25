<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Constellation
 * @subpackage Constellation_Theme
 * @since Constellation Theme 2.0
 */
?>

<?php get_header(); ?>

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
<script type="text/javascript">
$(document).ready(function(){

	$('#content ul').wrap('<div id="slider" class="svw" />');
	$('div#slider').wrap('<div id="slide" />');
	$('div#slide').next().wrap('<div id="mainContent" />');
	$('div#slider').slideView();

});
</script>
<?php get_footer(); ?>
