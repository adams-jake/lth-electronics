<?php

// stop automatic favicon generation

	add_action('do_faviconico', function() {
		exit;
	});