<?php
/**
 * article-block.php
 * template for the article block shortcode
 * 
 * 	9/28/2020	Ron Boutilier
 */

defined('ABSPATH') or die('Direct script access disallowed.');

function tt_article_block($attrs) {
	$output = '';
	// explode the attrs id into an array and build WP_Query
	$post_id = intval($attrs['id']);
	if (! $post_id) {
		return $output;
	}
	$query_args = array(
		'ignore_sticky_posts' => 1,
		'p' => $post_id,
		'post_type' => 'any',
	);

	$position = (isset($attrs['position']) && "right" === $attrs['position']) ? "right" : "left";

	$post = new WP_Query($query_args);


	if ( $post->have_posts() ) {
		$post->the_post();
		$link = get_the_permalink();
		$output .=  '[su_row]';
		if ("left" === $position ) {
			$output .= disp_image($link);
			$output .= disp_text($link);
		} else {
			$output .= disp_text($link);
			$output .= disp_image($link);
		}
		$output .=  '[/su_row]';
	} else {
		$output .= '<p class="su-posts-not-found">' . esc_html( 'Posts not found', 'shortcodes-ultimate' ) . '</p>';
	}

	return do_shortcode($output);
}

function disp_image($link) {
	$output = '[su_column size="1/2"]';
	if ( has_post_thumbnail() ) {
		$thumb = get_the_post_thumbnail();
		$output .= "<a class='tt-article-post-thumbnail' href='$link'>$thumb</a>";
	}

	$output .= '[/su_column]';
	return $output;
}

function disp_text($link) {
	$title = get_the_title();
	/**
	 * 
	 *  use something like below to create own excerpt from content
	 * 
	 * 
	 *	$title = (4 === $block_cnt) ? htmlentities(mb_strimwidth(html_entity_decode($title), 0, 35, '...')) : $title;
	 */

	// build own excerpt as easier to control length w/o 
	// changing length of all excerpts on site
	$text = get_the_content( '', false, $post );
 
	$text = strip_shortcodes( $text );
	$text = excerpt_remove_blocks( $text );

	$text = apply_filters( 'the_content', $text );
	$text = str_replace( ']]>', ']]&gt;', $text );
	$excerpt = wp_trim_words( $text, 60);

	// $excerpt = get_the_excerpt();
	$cats = get_the_category();
	$output = '[su_column size="1/2"]';

	$output .= "<h6 class='tt-article-title'><a href='$link'>$title</a></h6>";
	
	if (! empty($cats)) {
		$output .= "<p><span class='tt-article-cat'>{$cats[0]->name}</span></p>";
	}
	$output .= "<p class='tt-article-excerpt'>$excerpt</p>";
	
	$output .= "<p class='tt-article-more-p'><a href='$link'><span style='color: #3366ff;'>
			<span class='tt-article-more'>READ MORE</span></span>
		</a></p>";

	$output .= '[/su_column]';
	return $output;
}
