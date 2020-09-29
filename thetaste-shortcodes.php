<?php
/*
    Plugin Name: TheTaste Shortcodes Plugin
    Plugin URI: http://theTT.ie
    Description: Various shortcodes to replace missing TT shortcodes
    Version: 1.0.0
    Author: Ron Boutilier
    Text Domain: taste-plugin
 */

defined('ABSPATH') or die('Direct script access disallowed.');

define('TT_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('TT_PLUGIN_URL', plugin_dir_url(__FILE__));
define('TT_PLUGIN_INCLUDES', TT_PLUGIN_PATH.'includes');
define('TT_PLUGIN_INCLUDES_URL', TT_PLUGIN_URL.'includes');

// enqueue css

function taste_shortcodes_enqueue() {
	wp_enqueue_style( 'taste-shortcodes-css', TT_PLUGIN_INCLUDES_URL."/css/taste-shortcodes.css" );
}
add_action('wp_enqueue_scripts', 'taste_shortcodes_enqueue');

// include shortcode functions
require_once TT_PLUGIN_INCLUDES . "/templates/two-block.php";
require_once TT_PLUGIN_INCLUDES . "/templates/three-block.php";
require_once TT_PLUGIN_INCLUDES . "/templates/four-block.php";
require_once TT_PLUGIN_INCLUDES . "/templates/article-block.php";

// add shortcode definitions
function tt_add_shortcodes() {
	add_shortcode("TT-TWOBLOCK", "tt_two_block");
	add_shortcode("TT-THREEBLOCK", "tt_three_block");
	add_shortcode("TT-FOURBLOCK", "tt_four_block");
	add_shortcode("TT-ARTICLEBLOCK", "tt_article_block");
}
add_action("init", "tt_add_shortcodes");
