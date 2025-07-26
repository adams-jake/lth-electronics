<?php 
	$menu = menu\tree('main');
?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php wp_title('·', true, 'right'); ?></title>
		<?php seo\render() ?>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php css('/assets/dist/main.css') ?>
		<?php wp_head_indented(2); ?>

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=DM+Mono&family=DM+Sans:opsz,wght@9..40,100..1000&display=swap" rel="stylesheet">		

		<script src="https://cdn.jsdelivr.net/npm/gsap@3.13/dist/gsap.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/gsap@3.13/dist/ScrollTrigger.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/gsap@3.13/dist/SplitText.min.js"></script>
	</head>
	<body>
		<header class="site-header">
			<div class="page-width--large">
				<div class="grid flex-space-between flex-align-center">
					<div class="site-header__leftcol grid">
						<a href="/" class="site-logo">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/lth-logo.svg" alt="LTH Electronics">
						</a>
						<?php modules\render('site-menu') ?>
					</div>
					<div class="site-header__rightcol grid flex-align-center">
						<div class="site-menu__item">
							<a href="#" class="site-menu__link">
								Login
							</a>
						</div>
						<a class="button" href="http://lth.localhost/">
							Contact us
							<div class="button__arrow">
								<svg class="button__arrow__icon button__arrow__first" width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M11.9652 0.00561523C11.9757 0.00579198 11.9861 0.00511382 11.9965 0.00561523L12.0502 0.010498C12.0528 0.0107648 12.0554 0.0111877 12.058 0.0114746C12.0822 0.0141461 12.1063 0.0177733 12.1303 0.0222168C12.1387 0.0237782 12.1473 0.0243507 12.1557 0.026123C12.179 0.031077 12.202 0.0380283 12.225 0.0446777C12.2315 0.046544 12.2381 0.0475681 12.2445 0.0495605C12.2462 0.0500803 12.2478 0.0509854 12.2494 0.0515137C12.2731 0.0590185 12.2965 0.0675811 12.3197 0.0769043C12.3252 0.0790951 12.3309 0.0804801 12.3363 0.0827637C12.4214 0.118718 12.5022 0.167583 12.5766 0.228271C12.5782 0.229588 12.5798 0.230851 12.5815 0.232178C12.6305 0.272705 12.6757 0.317844 12.7162 0.366943C12.7669 0.428372 12.8092 0.496593 12.8441 0.569092C12.8641 0.610601 12.882 0.652673 12.8959 0.696045C12.9098 0.739336 12.9193 0.784186 12.9272 0.829834C12.9359 0.880332 12.9419 0.931078 12.9428 0.982178C12.9429 0.988026 12.9438 0.993884 12.9438 0.999756V9.21069C12.9438 9.76024 12.4981 10.2056 11.9486 10.2058C11.399 10.2058 10.9535 9.76037 10.9535 9.21069V3.4021L1.70352 12.6521C1.31485 13.0406 0.684929 13.0407 0.296295 12.6521C-0.0923324 12.2635 -0.092221 11.6336 0.296295 11.2449L9.5463 1.99487H3.73672C3.18717 1.99472 2.74161 1.54934 2.74161 0.999756C2.74174 0.450281 3.18726 0.0047916 3.73672 0.00463867H11.9486C11.9542 0.00464245 11.9597 0.00552105 11.9652 0.00561523Z" fill="#001F5A"></path>
								</svg>
								<svg class="button__arrow__icon button__arrow__second" width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M11.9652 0.00561523C11.9757 0.00579198 11.9861 0.00511382 11.9965 0.00561523L12.0502 0.010498C12.0528 0.0107648 12.0554 0.0111877 12.058 0.0114746C12.0822 0.0141461 12.1063 0.0177733 12.1303 0.0222168C12.1387 0.0237782 12.1473 0.0243507 12.1557 0.026123C12.179 0.031077 12.202 0.0380283 12.225 0.0446777C12.2315 0.046544 12.2381 0.0475681 12.2445 0.0495605C12.2462 0.0500803 12.2478 0.0509854 12.2494 0.0515137C12.2731 0.0590185 12.2965 0.0675811 12.3197 0.0769043C12.3252 0.0790951 12.3309 0.0804801 12.3363 0.0827637C12.4214 0.118718 12.5022 0.167583 12.5766 0.228271C12.5782 0.229588 12.5798 0.230851 12.5815 0.232178C12.6305 0.272705 12.6757 0.317844 12.7162 0.366943C12.7669 0.428372 12.8092 0.496593 12.8441 0.569092C12.8641 0.610601 12.882 0.652673 12.8959 0.696045C12.9098 0.739336 12.9193 0.784186 12.9272 0.829834C12.9359 0.880332 12.9419 0.931078 12.9428 0.982178C12.9429 0.988026 12.9438 0.993884 12.9438 0.999756V9.21069C12.9438 9.76024 12.4981 10.2056 11.9486 10.2058C11.399 10.2058 10.9535 9.76037 10.9535 9.21069V3.4021L1.70352 12.6521C1.31485 13.0406 0.684929 13.0407 0.296295 12.6521C-0.0923324 12.2635 -0.092221 11.6336 0.296295 11.2449L9.5463 1.99487H3.73672C3.18717 1.99472 2.74161 1.54934 2.74161 0.999756C2.74174 0.450281 3.18726 0.0047916 3.73672 0.00463867H11.9486C11.9542 0.00464245 11.9597 0.00552105 11.9652 0.00561523Z" fill="#001F5A"></path>
								</svg>
							</div>
						</a>
						<div class="mobile-nav">
							<span></span>
							<span></span>
							<span></span>
						</div>
					</div>
				</div>
			</div>
		</header>