<?php
    $title = get_field('footer_cta_header', 'option') ?? '';
    $primaryLink = new Link(get_field('footer_cta_primary', 'option') ?? []);
    $secondaryLink = new Link( get_field('footer_cta_secondary', 'option') ?? []);

    if (!$title) return;
?>

<div class="page-width text-center first-last" style="max-width: 800px; padding: 6em 0 10em;">
    <h2 class="heading-2 margin-bottom-2">Do you have a liquid measurement application and need support?</h2>
    <div class="grid flex-center gap-3">
        <?php echo renderButton($primaryLink); ?>
        <a class="" href="http://lth.localhost/">Contact us</a>
    </div>
</div>