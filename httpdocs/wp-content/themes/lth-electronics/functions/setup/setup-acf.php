<?php

// ensure ACF is installed

	if (!function_exists('get_field')) return false;


// save to & load from ACF field data json file

	add_filter('acf/settings/save_json', function($path) {
	    return get_stylesheet_directory() . '/fields';
	});

	add_filter('acf/settings/load_json', function($paths) {
	    $paths[] = get_stylesheet_directory() . '/fields';
	    return $paths;
	});


// hide updates from ACF

	// add_filter('acf/settings/show_updates', function() {
	//     return false;
	// });


// hide admin panel from non-super users

	add_filter('acf/settings/show_admin', function($show) {
	    return current_user_can('manage_options');
	});


// add options page
	
	add_action('acf/init', function() {
		if (function_exists('acf_add_options_page')) {
			acf_add_options_page('Site options');
		}
	});


// remove 'Name:' prefixes from metaboxes on post pages
// just for sanity / ability to organize by type in field groups UI

	function metabox_title_edit() {

		// edits global meta box definition at last priority (PHP_INT_MAX)
		// because acf/get_field_group or acf/load_field_group don't work

		global $wp_meta_boxes;
		$metaboxes = &$wp_meta_boxes[get_current_screen()->id];

		foreach ($metaboxes as &$level1) {
			foreach ($level1 as &$level2) {
				foreach ($level2 as &$item) {
					$id = $item['id'] ?? null; 
					if (!$id) continue;
					if (strpos($id, 'acf-group_') > -1) {
						$item['title'] = ucfirst(preg_replace('/^.*\:\s+/', '', $item['title']));
					}
				}
			}
		}
	}
	add_action('add_meta_boxes', 'metabox_title_edit', PHP_INT_MAX, 2);


// register google maps API key

	/*
	add_filter('acf/settings/google_api_key', function () {
	    return 'API_KEY';
	});
	*/
