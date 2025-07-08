<?php 

/**
 *  Render ACF flexible content layouts using distinct templates
 *  (templates loaded from modules/{layout-name}.php)
 *  
 *  To render all modules:
 *  modules\renderAll('field_name');
 *  
 *  To render a single module:
 *  modules\render('module_name', $data);
 */


namespace modules;


add_action('init', function() {
	add_filter('acf/fields/flexible_content/layout_title', 'modules\filter', PHP_INT_MAX, 4);
	add_action('admin_head', 'modules\styles');
});


function render(string $layout, $data = null) {
	$filename = kebabCase($layout);
	$template = locate_template("$filename.php") 
		?: locate_template("$layout.php")
		?: locate_template("modules/$filename.php")
		?: locate_template("modules/$layout.php");
	if (!$template) throw new \Exception("No template found for \"{$layout}\" using \"$filename.php\"");
	
	(function() use ($template, $data) {
		include($template);	
	})();
}


function links(string $field) {
	$links = [];
	$rows = get_field($field);
	while (have_rows($field)) {
		the_row();
		$data = $rows[get_row_index() - 1] ?? [];
		$title = $data['title'] ?? '';
		$link = kebabCase($title);
		if (!$title || !$link) continue;
		$links[] = [
			'title' => $title,
			'link' => "#$link",
		];
	}
	return $links;
}


function renderAll(string $field, bool $withMarker = true) {
	$rows = get_field($field);
	while (have_rows($field)) {
		the_row();
		$data = $rows[get_row_index() - 1] ?? [];
		$link =  kebabCase($data['title'] ?? "");
		if ($link && !!$withMarker) echo "<div class=\"marker\" id=\"$link\"></div>\n"; 
		render(get_row_layout(), $data);
	}
}


function filter($title, $field, $layout, $i) {
	$html = '';	
	$image = get_sub_field('image') ?: get_sub_field('image_background');
	$text = get_sub_field('title') ?: get_sub_field('subtitle');
	$text = str_replace('*', '', $text);
	$text = str_replace('<br>', '', $text);
	$thumbnail = $image['sizes']['thumbnail'] 
		?? $image['image_background']['sizes']['thumbnail'] 
		?? null;
	if ($thumbnail)
		$html = "<div class='acf-bar-thumbnail'><img src='$thumbnail' height='30px'></div>";
	$html = $html . $title;
	if ($text) $html = $html . ": $text";
	return $html;
}


function styles() {
	?>
	<style>
		.acf-bar-thumbnail {
		    display:inline-block;
	        width:30px; height:30px;
	        margin:-4px 10px -4px 2px;
	        border-radius:100%;
	        overflow:hidden;
	        vertical-align:middle;
	        background:white;
		}
		.acf-bar-thumbnail img {
			display:block;
			max-height:100%;
			border-radius:100%;
			overflow:hidden;
		}

		.acf-fc-layout-order {
			display:none !important;
		}
	    
    </style>
    <?php 
}