<?php 
get_header(); 

modules\render('banner');


?>


<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post() ?>		
		<?php the_content() ?>
	<?php endwhile ?>
<?php endif ?>

<div id="content">
	<?php modules\renderAll('modules') ?>
</div>

<?php get_footer() ?>