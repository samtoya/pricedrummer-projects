<?php
/*  ----------------------------------------------------------------------------
	Newspaper 7 Child theme - Please do not use this child theme with older versions of Newspaper Theme

	What can be overwritten via the child theme:
	 - everything from /parts folder
	 - all the loops (loop.php loop-single-1.php) etc

	 - the rest of the theme has to be modified via the theme api:
	   http://forum.tagdiv.com/the-theme-api/

 */


/*  ----------------------------------------------------------------------------
	add the parent style + style.css from this folder
 */
add_action('wp_enqueue_scripts', 'theme_enqueue_styles', 1001);
function theme_enqueue_styles()
{
	wp_enqueue_style('td-theme', get_template_directory_uri() . '/style.css', '', TD_THEME_VERSION . 'c', 'all');
	wp_enqueue_style('td-theme-child', get_stylesheet_directory_uri() . '/style.css', ['td-theme'], TD_THEME_VERSION . 'c', 'all');

}

//enqueues our external font awesome stylesheet
function enqueue_our_required_stylesheets()
{
	wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
}

add_action('wp_enqueue_scripts', 'enqueue_our_required_stylesheets');

function alnp_support()
{
	add_theme_support('auto-load-next-post');
}

add_action('after_setup_theme', 'alnp_support');