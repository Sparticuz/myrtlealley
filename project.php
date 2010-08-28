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
			</div><!-- .entry-content -->
		</div><!-- #post-## -->
		<?php $the_title = the_title('<h3>', '</h3>', false);
		$paypal_link = 'https://www.paypal.com/cgi-bin/webscr?cmd=_xclick';
		$paypal_link .= '&business=rebecca@myrtlealleypress.com';
		$paypal_link .= '&item_name='.the_title('','',false);
		$paypal_link .= '&amount='.get_post_meta (get_the_ID(), "price", true);
		$paypal_link .= '&currency_code=USD';

		endwhile; ?>

	</div><!-- #content -->
<script type="text/javascript">
$(document).ready(function(){

	$('#content ul').wrap('<div id="slider" class="svw" />');
	$('div#slider').wrap('<div id="slide" />');
	$('div#slide').next().wrap('<div id="mainContent" />');
	$('div#mainContent').prepend('<?php echo $the_title?>');

	$paypal = '<br />QTY. <input style="width: 50px;" /> CHECKOUT ->';

	$p = $('.entry-content').find('p')
	$p.append($paypal);
	$p.css("float:left");
	$('div#slider').slideView();

});
</script>
<?php get_footer(); ?>
