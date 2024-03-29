<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Constellation
 * @subpackage Myrtle_Alley
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="Description" content="Myrtle Alley Press is a design and letterpress studio in Seattle whose mission is to produce unique custom design and fine letterpress printing.">
<title><?php bloginfo( 'name' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo bloginfo('template_directory');?>/js/jscrollpane.css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="alternate" type="application/rss+xml" title="Constellation &amp; Co. News Feed" href="<?php bloginfo('rss2_url'); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<script type="text/javascript" src="<?php echo bloginfo('template_directory'); ?>/js/jquery.slideviewer.1.2.js"></script>
<script type="text/javascript" src="<?php echo bloginfo('template_directory'); ?>/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo bloginfo('template_directory'); ?>/js/jquery.jscrollpane.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-18229762-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>

<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
	<div id="header">
		<div class="logo"><a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt="Myrtle Alley Press" /></a></div>
		<div id="search"><?php get_search_form(); ?></div>
		<div id="menu">
			<?php 
			/* Our navigation menu.
			 * If one isn't filled out, wp_nav_menu falls back to wp_page_menu.
			 * The menu assiged to the primary position is the one used.  
			 * If none is assigned, the menu with the lowest ID is used.  
			 */ 
			
			$args = array(
				'depth' => 1,
				'link_before' => '<span>',
				'link_after' => '</span>'
			);
			
			wp_nav_menu( $args ); ?>
		</div>
	</div><!-- #header -->

<div id="main">