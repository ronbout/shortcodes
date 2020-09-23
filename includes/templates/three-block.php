<?php
/**
 * three-block.php
 * template for a single post in a row of 3
 */

defined('ABSPATH') or die('Direct script access disallowed.');

function tt_three_block($attrs) {
	$output = '';

	if (! isset($attrs['id'])) {
		return $output;
	}

	// explode the attrs id into an array 
	$post_ids = explode(',', $attrs['id']);
	if (! count($ids) === 3) {
		return $output;
	}
	$output .=  '<div class="post-row">';
	foreach($post_ids as $post_id) {
		$post = get_post($post_id);
		$thumb = get_the_post_thumbnail($post_id);
		$excerpt = get_the_excerpt($post_id);
		$output .= "
		<div class='three-block' style='width: 30%; float: left; margin: 5px;'>
			<div>
				$thumb
			</div>
			<div>
				$post->post_title
			</div>
			<div class='entry excerpt entry-summary'>
				$excerpt
			</div><!--/.entry-->
		</div>
		";
	}
	$output .=  '</div>';

	return $output;
}