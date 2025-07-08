<?php

// stop username enumeration for author=1… query vars

	if (!is_admin()) {
		// default URL format
		if (preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING'])) die();
		add_filter('redirect_canonical', function($redirect, $request) {
			// permalink URL format
			if (preg_match('/\?author=([0-9]*)(\/*)/i', $request)) die();
			else return $redirect;
		}, 10, 2);
	}


// remove users from /wp-sitemap.xml

	add_filter('wp_sitemaps_add_provider', function($provider, $name) {
		if (preg_match('/user/', $name)) return null;
		return $provider;
	}, 10, 2);


// remove rss feed to stop user enumeration

		add_action('do_feed', 'wp_die', 1);
		add_action('do_feed_rdf', 'wp_die', 1);
		add_action('do_feed_rss', 'wp_die', 1);
		add_action('do_feed_rss2', 'wp_die', 1);
		add_action('do_feed_atom', 'wp_die', 1);
		add_action('do_feed_rss2_comments', 'wp_die', 1);
		add_action('do_feed_atom_comments', 'wp_die', 1);


// removes users endpoints from wp-api

	add_filter('rest_endpoints', function($endpoints) {
		if (is_user_logged_in()) return $endpoints;
		unset($endpoints['/wp/v2/users']);
		unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
		unset($endpoints['/wp/v2/users/me']);
	    return $endpoints;
	});


// only allow rest API from same origin
	
	add_action('rest_api_init', function() {
		remove_filter('rest_pre_serve_request', 'rest_send_cors_headers');
		add_filter('rest_pre_serve_request', function($value) {
			header('Access-Control-Allow-Origin: ' . esc_url_raw(site_url()));
			return $value;
		});
	}, 15);


// set password error to a standard message

	add_filter('login_errors', function() {
		return 'The username or password is incorrect.';
	});


// set lost password form to always display 'Check your email for the confirmation link' message
	
	add_action('lost_password', function($errors) {
		$fail = is_wp_error($errors) && $errors->has_errors();
		if ($fail) {
			$redirect_to = !empty($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : 'wp-login.php?checkemail=confirm';
			wp_safe_redirect($redirect_to);
			exit();
		}
	});


// disable xml-rpc and other header items

	add_filter('xmlrpc_enabled', '__return_false');

	// Hide xmlrpc.php in HTTP response headers
	add_filter('wp_headers', function($headers) {
	    unset($headers['X-Pingback']);
	    return $headers;
	}); 


// remove wp version number from scripts and styles
	
	function removeSrcVersion($src) {	
		if (is_admin()) return $src;
		return strpos($src, '?ver=') ? remove_query_arg('ver', $src) : $src;
	}
	add_filter('style_loader_src', 'removeSrcVersion', PHP_INT_MAX);
	add_filter('script_loader_src', 'removeSrcVersion', PHP_INT_MAX);