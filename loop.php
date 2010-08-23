<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package Constellation
 * @subpackage Constellation_Theme
 * @since Constellation_Theme 2.0
 */
?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found box">
		<h1 class="entry-title">Not Found</h1>
		<div class="entry-content">
			<p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php
	/* Start the Loop.
	 *
	 * In Twenty Ten we use the same loop in multiple contexts.
	 * It is broken into three main parts: when we're displaying
	 * posts that are in the gallery category, when we're displaying
	 * posts in the asides category, and finally all other posts.
	 *
	 * Additionally, we sometimes check for whether we are on an
	 * archive page, a search page, etc., allowing for small differences
	 * in the loop on each template without actually duplicating
	 * the rest of the loop that is shared.
	 *
	 * Without further ado, the loop:
	 */

?>
<?php while ( have_posts() ) : the_post(); ?>

<?php /* How to display all other posts. */ ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="box">
			<header>
				<h1 class="entry-title" style="margin-top:2px;"><a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h1><hr />
				<em><small>by <?php	the_author_posts_link(); ?> on <?php the_time('F jS, Y'); ?></small></em>
			</header>
			<br />

			<article class="entry-content">
				<?php the_content('Continue reading &nbsp;<span class="meta-nav" style="font-size:1.75em;vertical-align:middle;">☞</span>'); ?>
			</article><!-- .entry-content -->

			<footer>
				<p class="postmetadata"><?php
					the_tags('Tags: ', ', ', '<br />'); ?> <?php
					edit_post_link('Edit', '', ' | '); ?>  <?php
					comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
			</footer><!-- .entry-utility -->
			</div>
		</article><!-- #post-## -->

		<?php comments_template( '', true ); ?>

<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<nav class="navigation">
		<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
		<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
</nav>
