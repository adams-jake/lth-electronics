<?php   
    // Content
    $title = $data['title'] ?? '';
    $content = $data['content'] ?? '';

    // Options    
    $backgroundColour = $data['background_colour'] ?? '';
    $spacing =  module_row_spacing($backgroundColour);
    $textColour = module_text_color($backgroundColour);
?>

<section class="<?php echo classlist('intro', $backgroundColour, $spacing, $textColour); ?>">
    <div class="page-width">
        <div class="intro__inner first-last">
            <h2 class="heading-2"><?php echo $title; ?></h2>
            <div class="text-main first-last">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
</section>