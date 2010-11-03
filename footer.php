<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
	</div><!-- #main -->
	<img src="<?php bloginfo('template_directory'); ?>/images/maindecal.png" />
	<div id="footer" role="contentinfo">
		<div id="site-info">
			Copyright &copy; Myrtle Alley Press 2010 | Site by <a href="http://www.constellationco.com">Constellation & Co.</a>
		</div><!-- #site-info -->
	</div><!-- #footer -->
</div><!-- #wrapper -->

<?php if(is_front_page()){ ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#aside').remove();
	});
</script>
<?php } ?>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	wp_footer();
?>
</body>
</html>
