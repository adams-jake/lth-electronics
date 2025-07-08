<?php

// set responsive styles on iframe oembeds


function dom(string $html) {
	// hide errors and use UTF-8 for $html string
	$errorLevel = libxml_use_internal_errors(true);
	$dom = new \DOMDocument('1.0', 'UTF-8');
	$dom->substituteEntities = false;
	// load html
	$dom->loadHTML($html);
	// back to previous error state
	libxml_use_internal_errors($errorLevel);
	return $dom;
}


add_filter('embed_oembed_html', function($html) {

	$dom = dom($html);
	$iframe = $dom->getElementsByTagName('iframe')->item(0);
	
	if (!$iframe) return $html;
	$width = (int) $iframe->getAttribute('width');
	$height = (int) $iframe->getAttribute('height');
	if (!$width || !$height) return $html;
	$percent = round($height/$width * 100, 2);
	$percent = $percent - 2;
	$iframe->setAttribute('style', "position:absolute; top:0; right:0; bottom:0; left:0; width:100%; height:100%;");

	return output(function() use ($percent, $iframe) {
		?>
			<div class="wp-responsive-embed" style="margin:2.5em 0; position:relative; padding-bottom:<?php echo $percent ?>%;">
				<?php echo $iframe->C14N() ?: "" ?>
			</div>
		<?php
	});
});
