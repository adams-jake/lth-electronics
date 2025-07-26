<?php


function do404(string $title = "Page not found") {
	global $wp_query;
	$wp_query->set_404();
	title($title);
	status_header(404);
	nocache_headers();
	require get_404_template();
	exit();
}


function title(string $title) {
	$set = function($default) use ($title) { 
		return $title ?: $default;
	};
	add_action('wp_title', $set);
	add_action('the_title', $set);
}


function json(string $id, mixed $value) {
    $json = json_encode($value, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_SLASHES);
    echo  "<script id=\"{$id}\" type=\"application/json\">$json</script>\n";
}


function script(string $path) {
	$hash = @md5(filemtime(get_stylesheet_directory() . $path));
	?><script src="<?php echo get_stylesheet_directory_uri() . $path ?>?v=<?php echo $hash ?>"></script><?php
}


function css(string $path) {
	$hash = @md5(filemtime(get_stylesheet_directory() . $path));
	?><link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . $path ?>?v=<?php echo $hash ?>"><?php
}


function dateRange(int $startYear) { 
	$startYear = $startYear ?: (int) date("Y");
	if ($startYear === (int) date("Y")) return $startYear;
	return $startYear . "–" . date("Y");
} 


function plural(int $count = 0, string $singular = '', string $plural = '') {
	return ($count === 1) ? $singular : $plural;
}


function contentById(int $id = 0) {
	if (!$id) return "";
	return apply_filters('the_content', get_post_field('post_content', $id));
}


function excerpt(int $id = 0, int $limit = 20) {
	return trim(wp_trim_words(strip_shortcodes(get_post_field('post_content', $id)), $limit));
}


function templateIds(string $templateFileName) {
	return get_posts([
		'post_type' => 'page',
		'fields' => 'ids',
		'nopaging' => true,
		'meta_key' => '_wp_page_template',
		'meta_value' => $templateFileName
	]);
}

function templateId(string $templateFileName) : int {
	return templateIds($templateFileName)[0] ?? 0;
}

function templatePage(string $templateFileName) : WP_Post|null {
	$firstID = templateIds($templateFileName)[0] ?? null;
	return $firstID ? get_post($firstID) : null;
}

function camelCase(string $string, array $noStrip = []) {
	// non-alpha and non-numeric characters become spaces
	$string = preg_replace('/[^a-z0-9' . implode("", $noStrip) . ']+/i', ' ', $string);
	$string = trim($string);
	// uppercase the first character of each word
	$string = ucwords($string);
	$string = str_replace(" ", "", $string);
	$string = lcfirst($string);
	return $string;
}


function lowercaseAndUnderscore(string $string) {
	$string = strtolower($string);
	$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
	$string = preg_replace("/[\s-]+/", " ", $string);
	$string = trim($string);
	$string = preg_replace("/[\s_]/", "_", $string);
	return $string;
}


function kebabCase(string $string) {
	$string = strtolower($string);
	$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
	$string = preg_replace("/[\s-]+/", " ", $string);
	$string = trim($string);
	$string = preg_replace("/[\s_]/", "-", $string);
	return $string;
}


function indent($string = '', $number = 2) {
	$tabs = str_repeat("\t", $number);
	return preg_replace("/\n/", "\n" . $tabs, trim($string));
}


function wp_head_indented($tabs = 2) {
	ob_start();
	wp_head();
	$header = ob_get_contents(); ob_end_clean();
	echo indent($header, $tabs);
	echo "\n";
}

function module_text_color($backgroundColour) {
	return ($backgroundColour === 'bg--blue') ? 'text-white' : '';
}

function module_row_spacing($backgroundColour) {
	// return ($backgroundColour === 'bg--white') ? 'margin-y' : 'padding-y';
	return 'padding-y';
}

add_filter( 'upload_mimes', function($allowed) { // Allow SVG upload 
    if ( !current_user_can( 'manage_options' ) )
        return $allowed;
    $allowed['svg'] = 'image/svg+xml';
    return $allowed;
});