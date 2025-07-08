<?php 

/**
 *  Use seo\render() to generate meta description and open graph tags in <head>
 *  (Tweak the `meta` and `image` methods below)
 */

namespace seo;


function title() {
	if (is_front_page() || is_home()) return get_bloginfo();
	return wp_title('·', false, 'right');
}

function meta() {
	if (is_front_page() || is_home()) {
		return get_field('og_description')
			?: get_bloginfo('description');
	} else {
		$options = [
			// edit as appropriate
			get_field('og_description'),
			get_field('title'),
			get_field('subtitle'),
			get_field('content'),
			(get_field('modules')[0]['content'] ?? ''),
			get_the_content()
		];
		foreach($options as $option) {
			if ($option && $option !== get_the_title()) 
				return wp_trim_words(strip_shortcodes($option), 25, '…');
		}
		return "";
	}
}

function image(): \Image {
	$field = get_field('og_image') 
		// edit as appropriate
		?: get_field('image')
		?: (get_field('modules')[0]['image'] ?? null)
		?: get_field('og_image', 'option');

	return new \Image($field);
}

function type() {
	return (is_front_page() || is_home()) ? 'website' : 'article';
}

function render() {
	$image = image();
	html('<meta name="description" content="{content}"/>', meta(), 0);
	html('<meta property="og:title" content="{content}"/>', title());
	html('<meta property="og:description" content="{content}"/>', meta());
	html('<meta property="og:type" content="{content}"/>', type());
	html('<meta property="og:url" content="{content}"/>', get_the_permalink());
	html('<meta property="og:site_name" content="{content}"/>', get_bloginfo());
	html('<meta property="og:image" content="{content}"/>', $image->url('large'));
	html('<meta property="og:image:width" content="{content}"/>', $image->width('large'));
	html('<meta property="og:image:height" content="{content}"/>', $image->height('large'));
	html('<meta name="twitter:card" content="summary_large_image"/>');
	html('<meta name="twitter:title" content="{content}"/>', title());
	html('<meta name="twitter:image" content="{content}"/>', $image->url('large'));
}

function html($html, $replace = '', $tabs = 2) {
	if ((func_get_args()[1] ?? false) && !$replace) return;
	$html = str_replace('{content}', trim(strip_tags($replace)), $html);
	echo str_repeat("\t", $tabs) . $html . "\n";
}
