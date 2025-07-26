<?php 
get_header(); 

modules\render('banner');


?>


<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post() ?>		
		<?php the_content() ?>
	<?php endwhile ?>
<?php endif ?>

<?php modules\renderAll('modules') ?>

<?php get_footer() ?>