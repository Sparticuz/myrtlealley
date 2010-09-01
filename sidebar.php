<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

<div id="sidebar" class="grid_4" role="complementary">
	<ul>
		<?php /* Widgetized sidebar, if you have the plugin installed. */
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) :
			echo 'The Sidebar'; ?>
		<?php endif; ?>
	</ul>
</div>
