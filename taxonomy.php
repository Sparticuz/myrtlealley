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
<div class="grid_16">
	<h5><?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); echo $term->name; ?></h5>
	<div class="grid_12" style="margin-left:-1px;"><h4><?php echo term_description( '', get_query_var( 'taxonomy' ) ); ?></h4></div>
</div>
<?php while( have_posts() ) : the_post() ?>

<div id="post-<?php the_ID(); ?>" class="grid_4 project" style="background:url('<?php 
			echo get_post_meta (get_the_ID(), "thumb", true); ?>'); margin-bottom: 20px;">
	<a href="<?php the_permalink(); ?>" rel="bookmark" style="display:block; height:210px;padding: 10px 0 0 10px;">
            <span style="margin: 0;"><?php the_title() ?></span>
	</a>
</div><!-- .post -->
<?php endwhile; ?>
<?php get_footer(); ?>
