<?php   
    // Content
    $title = $data['title'] ?? '';
    $content = $data['content'] ?? '';

    // Link
    $link = new Link($data['link']);

    // Options    
    $backgroundColour = $data['background_colour'] ?? '';
    $textColour = module_text_color($backgroundColour);
?>

<section class="call-to-action margin-y">
    <div class="page-width--narrow">
        <div class="<?php echo classlist('first-last box-padding', $backgroundColour, $textColour); ?>">
            <h2 class="heading-2"><?php echo $title; ?></h2>
            <div class="text-main">
                <?php echo $content; ?>
            </div>
            <?php if ($link->hasLink()) : ?>
                <a class="button" <?php echo $link->attributes; ?>><?php echo $link->text; ?></a>
            <?php endif; ?>
        </div>
    </div>
</section>
