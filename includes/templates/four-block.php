<?php
/**
 * 	four-block.php
 * 	template for a single post in a row of 4
 * 
 * 	9/27/2020	Ron Boutilier
 */

defined('ABSPATH') or die('Direct script access disallowed.');

function tt_four_block($attrs) {
	
	if (! isset($attrs['id'])) {
		return '';
	}

	// include modular shortcodes function, which
	// is the basis for he two, three, four blocks
	require_once TT_PLUGIN_INCLUDES . "/templates/block-shortcode.php";

	$output = block_shortcode($attrs, 4);

	return do_shortcode($output);
}