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


require_once TT_PLUGIN_INCLUDES . "/templates/three-block.php";

function tt_add_shortcodes() {
	add_shortcode("TT-THREEBLOCK", "tt_three_block");
}
add_action("init", "tt_add_shortcodes");
