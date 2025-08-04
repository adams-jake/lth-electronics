<?php 
	global $query;
	if (!$query) return;
	$pagination = pagination\fromQuery($query);
	$prev = $pagination->previous;
	$next = $pagination->next;
?>

<section class="margin-top-5">
	<div class="page-width">
		<div class="grid space-between flex-space-between">
			<a 
				href="<?php echo $prev->href ?>" 
				class="pagination-prev pagination--arrow <?php echo $prev->disabled ? 'hidden' : '' ?>"
			>← Previous</a>
			<ul class="pagination grid no-list">
				<?php foreach($pagination->pages as $page) : ?>
					<?php if ($page->current) : ?>
						<li class="active"><?php echo $page->number ?></li>
					<?php continue; endif ?>
					<?php if ($page->disabled) : ?>
						<li class="disabled"><?php echo $page->number ?></li>
					<?php continue; endif ?>
					<li>
						<a href="<?php echo $page->href ?>"><?php echo $page->number ?></a>
					</li>
				<?php endforeach ?>
			</ul>
			<a 
				href="<?php echo $next->href ?>" 
				class="pagination-prev pagination--arrow <?php echo $next->disabled ? 'hidden' : '' ?>"
			>Next →</a>
		</div>
	</div>
</section>

