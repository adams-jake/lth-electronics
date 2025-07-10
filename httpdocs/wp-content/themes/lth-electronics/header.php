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
	</head>
	<body>
		<header class="site-header">
			<div class="page-width">
				<div class="grid flex-space-between flex-align-center">
					<a href="/" class="site-logo">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.jpg" alt="">
					</a>
					<div class="mobile-nav">
						<span></span>
						<span></span>
						<span></span>
					</div>
					<div class="site-menu">
						<div class="site-menu__nav">
							<?php foreach($menu as $menuItem) :
								$target = $menuItem->target ? "target=\"{$menuItem->target}\"" : "" 
							?>
								<div class="site-menu__item">
									<a <?php echo $target ?> class="site-menu__link" href="<?php echo $menuItem->url ?>">
										<?php echo $menuItem->title ?>
									</a>
									<?php if ($menuItem->children) : ?>
										<div class="site-menu__dropdown">
											<?php foreach($menuItem->children as $child) :
												$target = $child->target ? "target=\"{$child->target}\"" : ""; 
												$childLinkTarget = $child->target ? ' menu-external-link' : '';
											?>
												<div class="site-menu__dropdown__item">
													<a <?php echo $target ?> class="site-menu__dropdown__link<?php echo $childLinkTarget ?>" href="<?php echo $child->url ?>">
														<?php echo $child->title ?>
													</a>
												</div>
											<?php endforeach ?>
										</div>
									<?php endif ?>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</header>