<?php

// create a nicely formatted <title> tag

	add_filter('wp_title', function($title, $sep) {

		global $paged, $page;
		$site = get_bloginfo('name');
		$description = get_bloginfo('description');
		
		if (is_front_page()) {
			return $site . ($description ? " $sep $description" : "");
		}

		$parts = array_filter(explode(" $sep ", $title));
		
		if ($paged > 2 || $page >= 2) {
			$parts[] = sprintf(__('Page %s'), max($paged, $page));
		}
		
		$parts[] = $site;
		return implode(" $sep ", $parts);

	}, PHP_INT_MAX, 2);


// remove gutenberg styles

	add_action('wp_enqueue_scripts', function() {
		wp_dequeue_style('global-styles');
		wp_dequeue_style('wp-block-library');
		wp_dequeue_style('wc-block-style');
	}, PHP_INT_MAX);


// remove emoji

	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_styles', 'print_emoji_styles');


// remove unnecessary <link> tags

	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'wp_resource_hints', 2);
	remove_action('wp_head', 'rest_output_link_wp_head', 10);
	remove_action('wp_head', 'wp_oembed_add_discovery_links');
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'wp_shortlink_wp_head');


// remove rss links

	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'feed_links', 2);


