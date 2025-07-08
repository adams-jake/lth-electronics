<?php


add_action('init', function() {
	hidePasswordProtectedPostsFromSitemap();
	protectedPostsNoIndex();
	setupPasswordProtectionTemplate();
});


function hidePasswordProtectedPostsFromSitemap() {
	add_filter('wp_sitemaps_posts_query_args', function($args) {
		$args['has_password'] = false;
		return $args;
	});
}


function protectedPostsNoIndex() {
	add_filter('wp_robots', function($robots) {
		if (post_password_required()) return [
			'noindex' => true,
			'nofollow' => true
		];
		return $robots;
	});
}


function setupPasswordProtectionTemplate() {
	add_action('template_include', function($template) {
		if (!post_password_required()) return $template;
		return locate_template('page-templates/password.php') ?: $template;
	});
}