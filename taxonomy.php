<?php
/**
 * The template for displaying Taxonomy Pages.
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
<div id="content" style="overflow-y: auto;">
	<?php
		$paged = get_query_var('paged');
		$tax = get_query_var('type');
		query_posts('posts_per_page=8&post_type=project&type='.$tax.'&paged='.$paged);

		while( have_posts() ) : the_post() ?>

<div id="post-<?php the_ID(); ?>" class="project-thumb">
	<a href="<?php the_permalink(); ?>" rel="bookmark">
		<?php echo get_the_post_thumbnail(get_the_ID()); ?>
		<p style="margin-bottom: 1px;"><?php the_title(); ?></p>
	</a>
</div><!-- .post -->
<?php endwhile; ?>
<div class="navigation">
	<div class="alignleft"><?php previous_posts_link('<span>Previous</span>'); ?></div>
	<div class="alignright"><?php next_posts_link('<span>Next</span>'); ?></div>
</div>
</div>
<?php get_footer(); ?>
