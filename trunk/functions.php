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
		'supports' => array('title', 'editor', 'author', 'trackbacks', 'custom-fields')
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

/*Add Menu Management & Sidebar support */
if (function_exists('add_theme_support'))
	add_theme_support('menus');

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
