<?php

// add custom styles here

	add_action('admin_head', function() {
		?><style>
		</style><?php 
	});

	add_action('login_head', function() {
		// $logoUrl = get_stylesheet_directory_uri() . '/assets/img/logo.svg';
		if (!isset($logoUrl)) return;
		?>
		<style>
			h1 a {
				width:140px !important;
				height:60px !important;
				background-image: url(<?php echo $logoUrl ?>) !important; 
				background-position:center !important;
				background-size: contain !important;
			}
		</style><?php
	});


// remove h1 from wysiwyg 

	add_filter('tiny_mce_before_init', function($args) {
		$args['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Pre=pre';
		return $args;
	});


// changes acf wysiwyg to be not as tall by default
// adapted from: https://support.advancedcustomfields.com/forums/topic/set-wysiwyg-height/
	
	add_action('acf/render_field_settings', 'acfWysiwygAfter');
	add_filter('acf/render_field/type=wysiwyg', 'acfWysiwygBefore', 0, 1);
	add_action('admin_head', 'acfWysiwygStyles');

	function acfWysiwygBefore($field) {
		ob_start();
		add_filter('acf/render_field/type=wysiwyg', 'acfWysiwygAfter', 20, 1);
	}

	function acfWysiwygAfter($field) {
		if (!ob_get_status()) return;
	    remove_filter('acf/render_field/type=wysiwyg', 'acfWysiwygAfter', 20, 1);
	    $output = ob_get_contents();
	    $output = str_replace('height:300px;', 'height:auto;', $output);
	    ob_clean();
	    echo $output;
	}

	function acfWysiwygStyles() { ?>
		<style>
			.acf-editor-wrap iframe {
				display:none;
			}
			.acf-editor-wrap iframe[id^="acf-editor-"] {
				min-height:120px;
			}
			.acf-editor-wrap .wp-editor-tabs > button {
				margin-top:0;
			}
			.acf-editor-wrap .acf-label {
				margin-bottom:0;
			}
			div.mce-statusbar {
				position:absolute;
				bottom:0; left:0; right:0;
				opacity:0;
				background:transparent !important;
				border-top:none !important;
				transition:all 0.2s ease-out;
			}
			.mce-container-body:hover .mce-statusbar {
				opacity:1;
			}
			.acf-range-wrap input[type="number"] { min-width: 4em; }
		</style>
	<?php }


	add_action('admin_head', 'acfImageUploaderStyles');
		function acfImageUploaderStyles() { ?>
		<style>
			.acf-image-uploader .show-if-value img {
				max-width:150px !important;
				height:auto !important;
			}
		</style>
	<?php }


// move admin bar to bottom of the screen
	add_action('wp_head', function() {
		if (!is_user_logged_in()) return;
		?>
		<style>
		    div#wpadminbar {
		        top: 0;
		        bottom: auto;
		        position: fixed;
		    }
		    .ab-sub-wrapper {
		        top: 32px;
		    }
		    html[lang] {
		        margin-top: 0 !important;
		        margin-top: 32px !important;
		    }
		    @media screen and (max-width: 782px){
		        .ab-sub-wrapper {
		            top: 46px;
		        }
		        html[lang] {
		            margin-top: 46px !important;
		        }
		    }
		</style>
		<?php
	});