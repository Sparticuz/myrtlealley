<?php
/*
 *
 * @package Constellation
 * @subpackage Constellation_Theme
 * @since Constellation Theme 2.0
 */

function register_project(){
	register_post_type('project', array(
		'label' => __('Projects'),
		'singular_label' => __('Project'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug'=>'project'),
		'query_var' => true,
		'supports' => array('title', 'editor', 'author', 'trackbacks', 'custom-fields', 'thumbnail')
	));
}

function project_columns($columns)
{
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => "Project Title",
	);
	return $columns;
}

function template_redirect(){
	global $wp;
	global $wp_query;
	if ( $wp->query_vars["post_type"] == 'project' ){
		//Switch to project.php for template
		if(have_posts()){
			include(TEMPLATEPATH . '/project.php');
			die();
		} else {
			$wp_query->is_404 = true;
		}
	}
}

function taxys(){
	register_taxonomy(
			'type',
			array('project'),
			array(
				'public'=>true,
				'labels'=>
					array(
						'name'=> __('Types'),
						'singular_name'=>__('Type')
					),
				'hierarchical' => true,
				'query_var' => true
			)

	);
}

function constellation_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class('box'); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="avatar">
				<?php echo get_avatar($comment,$size='32',$default='<path_to_url>' ); ?>
			</div>
			<?php printf('<cite class="fn">%s</cite> <span class="says">says:</span>', get_comment_author_link()) ?>
			<?php if ($comment->comment_approved == '0') : ?>
				<em><?php _e('Your comment is awaiting moderation.') ?></em>
				<br />
			<?php endif; ?>

			<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></div>
		<?php comment_text() ?>
		<div class="reply">
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</div>
	</div>
<?php
}

/**
 * Custom Walker to extract current sub-menu
 */

class Custom_Walker_Nav_Sub_Menu extends Walker_Nav_Menu {

  var $found_parents = array();

  function start_el(&$output, $item, $depth, $args) {
    global $wp_query;

      $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

      $class_names = $value = '';

      $classes = empty( $item->classes ) ? array() : (array) $item->classes;

      $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
      $class_names = ' class="' . esc_attr( $class_names ) . '"';

      // Checks if the current element is in the current selection
		 if (strpos($class_names, 'current-menu-item')
		    || strpos($class_names, 'current-menu-parent')
		    || strpos($class_names, 'current-menu-ancestor')
		    || (is_array($this->found_parents) && in_array( $item->menu_item_parent, $this->found_parents )) ) {

        // Keep track of all selected parents
        $this->found_parents[] = $item->ID;

        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
      //}
      $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
  }

	function end_el(&$output, $item, $depth) {
	  // Closes only the opened li
	  if ( is_array($this->found_parents) && in_array( $item->ID, $this->found_parents ) ) {
	      $output .= "</li>\n";
    }
  }

  function end_lvl(&$output, $depth) {
    $indent = str_repeat("\t", $depth);
    // If the sub-menu is empty, strip the opening tag, else closes it
    if (substr($output, -22)=="<ul class=\"sub-menu\">\n") {
      $output = substr($output, 0, strlen($output)-23);
    } else {
      $output .= "$indent</ul>\n";
    }
  }
}



/*Add Menu Management & Sidebar support */
if (function_exists('add_theme_support')){
	add_theme_support('menus');
	add_theme_support('post-thumbnails');
}

if ( function_exists('register_sidebars') )
	register_sidebars();

/*change to google hosted jquery*/
if( !is_admin()){
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js");
   wp_enqueue_script('jquery');
}

/*Add actions and filters */

add_action('init', 'taxys', 0);
add_action("template_redirect", 'template_redirect');
add_filter("manage_edit-project_columns", "project_columns");
add_action('init', 'register_project');

?>
