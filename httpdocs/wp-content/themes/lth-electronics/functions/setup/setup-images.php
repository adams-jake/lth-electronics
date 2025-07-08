<?php

add_action('after_setup_theme', function() {
	add_image_size('2000w', 2000);
	add_image_size('1500w', 1500);
	add_image_size('1000w', 1000);
	add_image_size('500w', 1000);
});