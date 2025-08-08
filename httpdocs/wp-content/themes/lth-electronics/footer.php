		<footer class="footer">
			<div class="footer-wave__cont relative">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/footer-wave-01.svg" class="footer-wave footer-wave__one">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/footer-wave-02.svg" class="footer-wave footer-wave__two">
			</div>

			<div class="bg--blue text-white">
				<?php modules\render('footer-cta') ?>
				<?php modules\render('footer-bottom') ?>
			</div>
		</footer>		
		
		
		<?php script('/assets/dist/main.js') ?>
		<?php wp_footer(); ?>
	</body>
</html>