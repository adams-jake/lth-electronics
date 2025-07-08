<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php wp_title('·', true, 'right'); ?></title>
		<?php seo\render() ?>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/main.css">
		<?php wp_head_indented(2); ?>
	</head>
	<body>
		<?php 
			// $logoUrl = get_stylesheet_directory_uri() . '/assets/img/logo.svg';
		?>
		<div class="">
			<?php if (isset($logoUrl)) : ?>
				<img class="" width="160" height="auto" src="<?php echo $logoUrl ?>">
			<?php endif; ?>
			<div class="password-protection-form">
				<?php echo get_the_password_form(); ?>	
			</div>
		</div>
	</body>
</html>