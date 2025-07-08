<?php 
get_header(); 
?>

<?php if (have_posts()) : ?>
	<h1>Search results:</h1>
	<?php echo $wp_query->found_posts ?> <?php _e('search results found for', 'locale') ?>: "<?php the_search_query() ?>"
	<?php while (have_posts()) : the_post() ?>
		<?php the_excerpt() ?>
	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer() ?>