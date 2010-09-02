<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

	<div id="container">
		<div id="content" style="width:920px;text-align:center;" role="main">
<img src="<?php bloginfo('template_directory'); ?>/images/error.png" alt="404" />
			<div id="post-0" class="post error404 not-found">
				<h4 class="entry-title">Apologies, but the page you requested could not be found. Perhaps searching will help.</h4>
			</div><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #container -->
	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php get_footer(); ?>