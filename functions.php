<?php
/*
 *  Author: Sean Corgan @seancorgan based off of html5blank theme
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
    if (!is_admin()) {
    
    	wp_deregister_script('jquery'); // Deregister WordPress jQuery
    	wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js', array(), '1.9.1'); // Google CDN jQuery
    	wp_enqueue_script('jquery'); // Enqueue it!
    	
    	wp_register_script('conditionizr', 'http://cdnjs.cloudflare.com/ajax/libs/conditionizr.js/2.2.0/conditionizr.min.js', array(), '2.2.0'); // Conditionizr
        wp_enqueue_script('conditionizr'); // Enqueue it!
        
        wp_register_script('modernizr', 'http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js', array(), '2.6.2'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!

        wp_register_script('jqueryui', get_template_directory_uri() . '/js/jquery-ui.min.js', array(), '1.0.0'); 
        wp_enqueue_script('jqueryui'); // Enqueue it!

         wp_register_script('parsley', get_template_directory_uri() . '/js/parsley.min.js', array(), '1.0.0'); 
        wp_enqueue_script('parsley'); // Enqueue it!
        
        wp_register_script('scripts', get_template_directory_uri() . '/js/scripts.js', array(), '1.0.0'); // Custom scripts
        wp_enqueue_script('scripts'); // Enqueue it!
    }
}

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!
    }
}

// Load HTML5 Blank styles
function html5blank_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!

    wp_register_style('jqueryui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css', array(), '1.0', 'all');
    wp_enqueue_style('jqueryui'); // Enqueue it!
    
    wp_register_style('style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('style'); // Enqueue it!
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return $length;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <div class="clearfix"></div> <a class="btn blue" href="' . get_permalink($post->ID) . '">' . __('Read More', 'html5blank') . '</a>';
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
	
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts

add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

/**
 * Remove Admin toolbar (provided by WP)
 */
function my_function_admin_bar(){ return false; }
add_filter( 'show_admin_bar' , 'my_function_admin_bar');


/* ==========================================================================
   Custom Post Type
   ========================================================================== */

function games() {
 
    register_taxonomy('games','games', array(
            'hierarchical' => true,
             'show_ui' => true,
            'query_var' => true,
            'label' => 'Events'
    )); 
 
    $args = array(
            'label' => __('Game Events', 'agera'),
            'singular_label' => __('Game Event', 'agera'),
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => array('slug' => 'game'),
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_name' => 'Game Events'
    );
    register_post_type('games', $args);
}
add_action('init', 'games'); 


function roster() {
 
    register_taxonomy('roster','roster', array(
            'hierarchical' => true,
             'show_ui' => true,
            'query_var' => true,
            'label' => 'Roster Type'
    )); 
 
    $args = array(
            'label' => __('Roster', 'agera'),
            'singular_label' => __('Roster', 'agera'),
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => array('slug' => 'roster'),
            'supports' => array('title', 'editor', 'thumbnail'),
    );
    register_post_type('roster', $args);
}
add_action('init', 'roster');


function coaching() {
 
    register_taxonomy('coaching','coaching', array(
            'hierarchical' => true,
             'show_ui' => true,
            'query_var' => true,
            'label' => 'Coach Type'
    )); 
 
    $args = array(
            'label' => __('Coaching Staff', 'agera'),
            'singular_label' => __('Coaching Staff', 'agera'),
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => array('slug' => 'coaches'),
            'supports' => array('title', 'editor', 'thumbnail'),
    );
    register_post_type('coaching', $args);
}
add_action('init', 'coaching');


function supporters() {
 
    register_taxonomy('supporters','supporters', array(
            'hierarchical' => true,
             'show_ui' => true,
            'query_var' => true,
            'label' => 'Supporter'
    )); 
 
    $args = array(
            'label' => __('Recognized Supporters', 'agera'),
            'singular_label' => __('Recognized Supporters', 'agera'),
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => array('slug' => 'supporters'),
            'supports' => array('title', 'editor', 'thumbnail'),
    );
    register_post_type('supporters', $args);
}
add_action('init', 'supporters');


function videos() {
 
    register_taxonomy('videos','videos', array(
            'hierarchical' => true,
             'show_ui' => true,
            'query_var' => true,
            'label' => 'Supporter'
    )); 
 
    $args = array(
            'label' => __('Videos', 'agera'),
            'singular_label' => __('Video', 'agera'),
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => array('slug' => 'videos'),
            'supports' => array('title', 'editor', 'thumbnail'),
    );
    register_post_type('videos', $args);
}
add_action('init', 'videos');


/* ==========================================================================
   Shortcodes
   ========================================================================== */

/**
 * Shows the very next game event on the tickets/schedule page
 * is automatically removed once the event is over
 */
function next_game($atts, $content = NULL) {

    $today = date('Y-m-d');

    $args = array(
        'post_type' => 'games',
        'posts_per_page' => -1,
        'meta_key' => 'game_date',
        'orderby' => 'meta_value',
        'order' => 'ASC'
    );

    $loop = new WP_Query($args);

    if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();

        $date = get_field('date'); 
        $date_formatted =  date('M j', strtotime($date));

        $tickets = get_field('purchase_url');

        if ($date >= $today && !empty($tickets)):

        $html .= '<div class="next-game">';
        $html .= '<div class="details clearfix">';

            $html .= '<div class="left opponent">';

            $location = get_field('location');
            $opponent = get_field('opponent');
            if ($location == 'Home'): 
                $html .= get_field('opponent_name').' @ Arizona';
            else:
                $html .= 'Arizona @ '.get_field('opponent_name');
            endif;

            $html .= '</div>';

            $html .= '<div class="right ticket">';

            $html .= '<div class="purchase right"><a href="'.get_field('purchase_url').'">Purchase Tickets</a></div>';

            $html .= '<div class="datetime right">';
            $date = get_field('game_date'); 
            $date_formatted =  date('M j', strtotime($date));
            $html .= $date_formatted.' - '.get_field('time');
            $html .= '</div>';

            $html .= '</div>';

        $html .= '<img src="'.get_field('banner_image').'" />';

        $html .= '</div>';
        $html .= '<div class="divider"></div>';
        $html .= '</div>';

        endif;

    endwhile; wp_reset_query(); endif;

    return $html;
}
add_shortcode('next_game', 'next_game');


/**
 * Lists all of the games (in order) and removes
 * them once the event is over
 */
function games_list($atts, $content = NULL) {

    $html .= '<table class="games" cellpadding="0" cellspacing="0" border="0">';

        $today = date('Y-m-d');

        $args = array(
            'post_type' => 'games',
            'posts_per_page' => -1,
            'meta_key' => 'game_date',
            'orderby' => 'meta_value',
            'order' => 'ASC'
        );

        $loop = new WP_Query($args);

        if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();

            $date = get_field('game_date'); 
            $date_formatted =  date('M j', strtotime($date));

            $tickets = get_field('purchase_url');

            if ($date >= $today && !empty($tickets)):

            $html .= '<tr>';

                $html .= '<td>'.$date_formatted.'</td>';
                $html .= '<td>'.get_field('time').'</td>';
                
                if (get_field('location') == 'Home'):
                    $html .= '<td>'.get_field('opponent_name').' @ Arizona</td>';
                else:
                    $html .= '<td>Arizona @ '.get_field('opponent_name').'</td>';
                endif;

                if (get_field('purchase_url')):
                    $html .= '<td align="right"><a href="'.get_field('purchase_url').'" class="btn blue">Purchase Tickets</a></td>';
                else:
                    $html .= '<td>&nbsp;</td>';
                endif;

            $html .= '</tr>';

            endif;

        endwhile; wp_reset_query(); endif;

    $html .= '</table>';

    return $html;
}
add_shortcode('games_list', 'games_list');


/**
 * Lists all of the games (in order) and removes
 * them once the event is over
 */
function full_schedule($atts, $content = NULL) {

    $html .= '<table class="games" cellpadding="0" cellspacing="0" border="0">';

        $today = date('Y-m-d');

        $args = array(
            'post_type' => 'games',
            'posts_per_page' => -1,
            'meta_key' => 'game_date',
            'orderby' => 'meta_value',
            'order' => 'ASC'
        );

        $loop = new WP_Query($args);

        if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();

            $date = get_field('game_date'); 
            $date_formatted =  date('M j', strtotime($date));

            $html .= '<tr>';

                $html .= '<td>'.$date_formatted.'</td>';
                $html .= '<td>'.get_field('time').'</td>';
                
                if (get_field('location') == 'Home'):
                    $html .= '<td>'.get_field('opponent_name').' @ Arizona</td>';
                else:
                    $html .= '<td>Arizona @ '.get_field('opponent_name').'</td>';
                endif;

                if (get_field('purchase_url') && get_field('final_score') == ''):
                    $html .= '<td align="center"><a href="'.get_field('purchase_url').'" class="btn blue">Purchase Tickets</a></td>';
                elseif (get_field('final_score')):
                    $html .= '<td align="center">'.get_field('final_score').'</td>';
                else:
                    $html .= '<td>&nbsp;</td>';
                endif;

            $html .= '</tr>';

        endwhile; wp_reset_query(); endif;

    $html .= '</table>';

    return $html;
}
add_shortcode('full_schedule', 'full_schedule');


/**
 * Shortcode created to showcase the next 3 games
 * on the right sidebar
 */
function next_games($atts, $content = NULL) {

    $today = date('Y-m-d');

    $args = array(
        'post_type' => 'games',
        'posts_per_page' => -1,
        'meta_key' => 'game_date',
        'orderby' => 'meta_value',
        'order' => 'ASC'
    );

    $loop = new WP_Query($args);

    if ($loop->have_posts()) : 

        $html .= '<div class="next-games clearfix">';
        $html .= '<span class="title uppercase center">Next Home Games</span>';
        $html .= '<div class="content">';

        while ($loop->have_posts()) : $loop->the_post();

        $date = get_field('game_date'); 
        $date_formatted =  date('M j', strtotime($date));

        $tickets = get_field('purchase_url');

        if ($date >= $today && !empty($tickets)):

            $html .= '<div class="boxes">';

            if (get_field('icon_image')):
                $html .= '<a href="'.get_field('purchase_url').'"><img src="'.get_field('icon_image').'" alt=""></a>';
            else:
                $html .= '<a href="'.get_field('purchase_url').'"><img src="http://placehold.it/97x146" /></a>';
            endif;

            $html .= '<span class="date">'.$date_formatted.'</span>';
            $html .= '<span class="versus">'.get_field('opponent_name').'</span>';
            $html .= '<span class="time">'.get_field('time').'</span>';
            $html .= '<p><a href="'.get_field('purchase_url').'" class="btn red" target="_blank">Tickets</a></p>';

            $html .= '</div>';

        endif;

    endwhile; 

    $html .= '</div>';
    $html .= '</div>';

    wp_reset_query(); endif;

    return $html;
}
add_shortcode('next_games', 'next_games');


/**
 * Create a custom select field for any forms asking 
 * the user to select a specific event
 */
function event_dropdown_field($content) {

    $html = '<p><label>Select the event you would like to purchase for:</label><select name="fields_games" class="fs2" required>';
    $html .= '<option value="" selected="selected">- select event -</option>';

    $args = array(
        'post_type' => 'games',
        'posts_per_page' => -1,
        'meta_key' => 'game_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC'
    );
    $the_query = new WP_Query($args);

    if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();

        $date = get_field('date'); 
        $date_formatted =  date('M j', strtotime($date));

        $html .= '<option value="'.get_the_title().' - '.$date.'">'.get_the_title().' - '.$date.'</option>';
        
    endwhile; wp_reset_query(); endif;

    $html .='</select></p>';

    return $html;
}
wpcf7_add_shortcode('event_dropdown_field', 'event_dropdown_field', true);


/**
 * lists all of the players and separates them 
 * by position
 */
function roster_list($atts, $content = NULL) {

    $args = array(
        'hide_empty' => 0
    );
    $terms = get_terms('roster', $args);
    
    foreach ($terms as $term):

        $html .= '<div class="roster clearfix">';
        $html .= '<h3 class="position-title">'.$term->name.'</h3>';

        $arg = array(
            'post_type' => 'roster',
            'posts_per_page' => -1,
            'orderby' => 'name',
            'order' => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'roster',
                    'field' => 'slug',
                    'terms' => array("$term->slug")
                )
            )
        );
        $loop = new WP_Query($arg);
        if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();

            $featured = get_the_post_thumbnail();
            $playerNumber = get_field('player_number');

            $html .= '<article class="single-roster relative">';
                $html .= '<a href="'.get_permalink().'">';
                if (!empty($playerNumber) && $playerNumber != 0):
                    $html .= '<div class="number">'.get_field('player_number').'</div>';
                elseif ($playerNumber == 0):
                    $html .= '<div class="number">0</div>';
                endif;
                if (!empty($featured)):
                    $html .= $featured;
                else:
                    $html .= '<img src="'. get_template_directory_uri() . '/img/no-img.jpg">';
                endif;
                $html .= '<span class="name">'.get_the_title().'</span>';
                $html .= '</a>';
            $html .= '</article>';

        endwhile; wp_reset_query(); endif;

        $html .= '</div>';
    endforeach;

return $html;
}
add_shortcode('roster_list', 'roster_list');


/**
 * lists all of the coaches and separates them 
 * by position
 */
function coach_list($atts, $content = NULL) {

    $arg = array(
        'post_type' => 'coaching',
        'posts_per_page' => -1
    );
    $loop = new WP_Query($arg);
    $html .= '<div class="coaching-list">';
    if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();

        $featured = get_the_post_thumbnail();
        $content = get_the_content();
        $text = apply_filters('the_content', $content);

        $html .= '<article class="single-coach clearfix">';
            if (!empty($featured)):
                $html .= '<div class="coach-img">'.$featured.'</div>';
            endif;
            $html .= '<div class="coach-content">';
                $html .= '<h2 class="coach-name">'.get_the_title().'</h2>';
                $html .= '<p class="bold" style="margin:0 0 15px 0;">'.get_field('position').'</p>';
                $html .= $text;
            $html .= '</div>';
        $html .= '</article>';

    endwhile; wp_reset_query(); endif;

    $html .= '</div>';

return $html;
}
add_shortcode('coach_list', 'coach_list');


/**
 * Creates the Table of the rosters on the single page
 */
function roster_table($atts, $content = NULL) {

    if (get_field('roster_table')): 

        $html .= '<table cellpadding="0" cellspacing="0" border="0">';

            $html .= '<thead>';
                $html .= '<th>Name</th>';
                $html .= '<th>Position</th>';
                $html .= '<th>Date of Birth</th>';
                $html .= '<th>Country</th>';
                $html .= '<th>Former Club</th>';
            $html .= '</thead>';

            $html .= '<tbody>';

                while (has_sub_field('roster_table')):

                    $html .= '<tr>';
                        $html .= '<td>'.get_sub_field('name').'</td>';
                        $html .= '<td>'.get_sub_field('position').'</td>';
                        $html .= '<td>'.get_sub_field('date_of_birth').'</td>';
                        $html .= '<td>'.get_sub_field('country').'</td>';
                        $html .= '<td>'.get_sub_field('former_club').'</td>';
                    $html .= '</tr>';

                endwhile; wp_reset_query();

            $html .= '</tbody>';

        $html .= '</table>';

    endif;

return $html;
}
add_shortcode('roster', 'roster_table');


/**
 * Showcase the featured video (1) on the homepage
 */
function featured_video($atts, $content = NULL) {

    $args = array(
        'post_type' => 'videos',
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' => 'DESC',
        'tax_query' => array(
            array(
                'taxonomy' => 'videos',
                'field' => 'slug',
                'terms' => array('featured')
            )
        )
    );

    $loop = new WP_Query($args);

    if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();

        $content = apply_filters('the_content', get_the_content());
        $html .= $content;

    endwhile; wp_reset_query(); endif;

return $html;
}
add_shortcode('featured_video', 'featured_video');


/**
 * Make categories to showcase on the blog sidebar if empty
 */
add_filter('widget_categories_args','show_empty_categories_links');
function show_empty_categories_links($args) {
    $args['hide_empty'] = 0;
    return $args;
}

function supporters_list($atts, $content = null) {

    $args = array(
        'post_type' => 'supporters',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    );

    $loop = new WP_Query($args);

    if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();

        $html .= '<article class="supporter-list">';

            $html .= '<h2>'.get_the_title().'</h2>';
            $content = apply_filters('the_content', get_the_content());
            $html .= $content;

        $html .= '</article>';

    endwhile; wp_reset_query(); endif;

return $html;
}
add_shortcode('recognized_supporters', 'supporters_list');

/*
function forms($atts, $content = NULL) {

    extract(shortcode_atts(array(
        'name' => 'contact',
        'content' => '[event_dropdown_field]'
    ), $atts, 'contact') );

    $event = event_dropdown_field();

    switch($name):

        case 'contact':
            $html .= '<form id="contactForm" class="formSubmit">';
                $html .= '
                    <input type="hidden" name="listid" value="123424">
                    <input type="hidden" name="specialid:123424" value="NWT7">
                    <input type="hidden" name="clientid" value="470377">
                    <input type="hidden" name="formid" value="7386">
                    <input type="hidden" name="reallistid" value="1">
                    <input type="hidden" name="doubleopt" value="0">
                    <input type="hidden" name="redirect" value="none">
                    <input type="hidden" name="errorredirect" value="none">
                    <input type="hidden" name="formtype" value="contact">';

                $html .= '<div class="clearfix">';
                    $html .= '<p class="forty8 left"><label for="name">First Name</label> <input type="text" name="fields_fname" required></p>';
                    $html .= '<p class="forty8 right"><label for="name">Last Name</label> <input type="text" name="fields_lname" required></p>';
                $html .= '</div>';
                $html .= '<p><label for="phone">Phone Number</label> <input type="text" name="fields_phone" required></p>';
                $html .= '<p><label for="email">Email Address</label> <input type="email" name="fields_email" required></p>';
                $html .= '<p><label for="comments">Comments / Questions</label><textarea name="comments" id="" cols="30" rows="10"></textarea></p>';
                $html .= '<p><input type="submit" value="SUBMIT"> <img src="'.get_template_directory_uri().'/img/ajax_loader.gif" class="loader2" alt=""></p>';
            $html .= '</form>';
        break;

        case 'grouptickets':
            $html .= '<form id="grouptickets" class="formSubmit">';
                $html .= '
                    <input type="hidden" name="listid" value="123710">
                    <input type="hidden" name="specialid:123710" value="5GYV">

                    <input type="hidden" name="clientid" value="470377">
                    <input type="hidden" name="formid" value="7405">
                    <input type="hidden" name="reallistid" value="1">
                    <input type="hidden" name="doubleopt" value="0">
                    <input type="hidden" name="redirect" value="none">
                    <input type="hidden" name="errorredirect" value="none">
                    <input type="hidden" name="formtype" value="group">';

                $html .= '<p><label>Enter your first name</label><input type="text" name="fields_fname" required></p>';
                $html .= '<p><label>Enter your last name</label><input type="text" name="fields_lname" required></p>';
                $html .= '<p><label>Enter your email address</label><input type="text" name="fields_email" required></p>';
                $html .= $event;
                $html .= '<p><label>How many tickets?</label><input type="text" name="fields_amountoftickets" required></p>';
                $html .= '<p><label>Questions / Comments / Special Requests</label><textarea name="fields_questions" required></textarea></p>';
                $html .= '<p><input type="submit" value="SUBMIT REQUEST" class="btn red"> <img src="'.get_template_directory_uri().'/img/ajax_loader.gif" class="loader2" alt=""></p>';
            $html .= '</form>';
        break;

        case 'family4pack':

            $html .= '<form id="familyfourpack" class="formSubmit">';

                $html .= '
                    <input type="hidden" name="listid" value="123712">
                    <input type="hidden" name="specialid:123712" value="TEVK">

                    <input type="hidden" name="clientid" value="470377">
                    <input type="hidden" name="formid" value="7406">
                    <input type="hidden" name="reallistid" value="1">
                    <input type="hidden" name="doubleopt" value="0">
                    <input type="hidden" name="redirect" value="none">
                    <input type="hidden" name="errorredirect" value="none">
                    <input type="hidden" name="formtype" value="family">';

                $html .= '<p><label>Enter your first name</label><input type="text" name="fields_fname" required></p>';
                $html .= '<p><label>Enter your last name</label><input type="text" name="fields_lname" required></p>';
                $html .= '<p><label>Enter your email address</label><input type="text" name="fields_email" required></p>';
                $html .= $event;
                $html .= '<p><label>How many tickets?</label><input type="text" name="fields_amountoftickets" required></p>';
                $html .= '<p><label>Questions / Comments / Special Requests</label><textarea name="fields_questions" required></textarea></p>';
                $html .= '<p><input type="submit" value="SUBMIT REQUEST" class="btn red"> <img src="'.get_template_directory_uri().'/img/ajax_loader.gif" class="loader2" alt=""></p>';
            $html .= '</form>';
        break;

        case 'volunteers':
            $html .= '<form id="volunteers" class="formSubmit">';

                $html .= '
                    <input type="hidden" name="listid" value="123713">
                    <input type="hidden" name="specialid:123713" value="1W2X">

                    <input type="hidden" name="clientid" value="470377">
                    <input type="hidden" name="formid" value="7407">
                    <input type="hidden" name="reallistid" value="1">
                    <input type="hidden" name="doubleopt" value="0">
                    <input type="hidden" name="redirect" value="none">
                    <input type="hidden" name="errorredirect" value="none">
                    <input type="hidden" name="formtype" value="volunteers">';

                $html .= '<p><label>Enter your first name</label><input type="text" name="fields_fname" required></p>';
                $html .= '<p><label>Enter your last name</label><input type="text" name="fields_lname" required></p>';
                $html .= '<p><label>Enter your email address</label><input type="text" name="fields_email" required></p>';
                $html .= '<p><label>Tell us a little about yourself</label><textarea name="fields_tellusalittleaboutyourself" required></textarea></p>';
                $html .= '<p><label>Have you even volunteered for a sports team before?</label><select name="fields_workedwithsportsteamsbefore"><option value="">-select-</option><option value="yes">Yes</option><option value="no">No</option></select></p>';
                $html .= '<p><label>Is there anything else that we should know?</label><textarea name="fields_questions" required></textarea></p>';
                $html .= '<p><input type="submit" value="SUBMIT REQUEST" class="btn red"> <img src="'.get_template_directory_uri().'/img/ajax_loader.gif" class="loader2" alt=""></p>';
            $html .= '</form>';
        break;

        case 'newsletter':

            $html .= '<form id="newsletter" class="formSubmit">';
            $html .= '<input type="hidden" name="formtype" value="newsletter">';
            $html .= '<input type="text" name="email" placeholder="join our newsletter" required>';
            $html .= '<input type="submit" value="Join"><img src="'.get_template_directory_uri().'/img/ajax_loader.gif" class="loader2" alt="">';
            $html .= '</form>';

        break;

    endswitch;


return $html;
}
add_shortcode('forms', 'forms');
*/

