<?php
/**
 * block-shortcode.php
 * base template for all block (2,3,4) shortcodes
 * 
 * 	9/28/2020	Ron Boutilier
 */

defined('ABSPATH') or die('Direct script access disallowed.');

function block_shortcode($attrs, $block_cnt) {
	$output = '';
	// explode the attrs id into an array and build WP_Query
	$post_ids = explode(',', $attrs['id']);
	$posts_in         = array_map( 'intval', explode( ',', $attrs['id'] ) );
	if (! count($posts_in) === $block_cnt) {
		return $output;
	}
	$query_args = array(
		'orderby' => 'post__in',
		'ignore_sticky_posts' => 1,
		'post__in' => $posts_in,
		'post_type' => 'any',
	);

	$posts = new WP_Query($query_args);

	if ( $posts->have_posts() ) {
		$output .=  '[su_row]';
		while ( $posts->have_posts() ) {
			$output .= '[su_column size="1/' . $block_cnt . '"]';
			$posts->the_post();
			$link = get_the_permalink();
			$title = get_the_title();
			$title = (4 === $block_cnt) ? htmlentities(mb_strimwidth(html_entity_decode($title), 0, 35, '...')) : $title;
			if ( has_post_thumbnail() ) {
				$thumb = get_the_post_thumbnail();
				$output .= "<a class='tt-post-thumbnail tt-post-$block_cnt-thumbnail href='$link'>$thumb</a>";
			}
			$output .= "<h6 class='tt-post-title'><a href='$link'>$title</a></h6>[/su_column]";
		}
		$output .=  '[/su_row]';
	} else {
		$output .= '<p class="su-posts-not-found">' . esc_html( 'Posts not found', 'shortcodes-ultimate' ) . '</p>';
	}

	return $output;
}
