<?php   
    // Content
    $title = $data['title'] ?? '';
    $content = $data['content'] ?? '';

    // Image
    $image = new Image($data['image'] ?? ''); 

    // Link
    $link = new Link($data['link']);
    
    // Options    
    $backgroundColour = $data['background_colour'] ?? '';
    $spacing =  module_row_spacing($backgroundColour);
    $textColour = module_text_color($backgroundColour);
?>

<section class="<?php echo classlist('introduction', $backgroundColour, $spacing, $textColour); ?>">
    <div class="page-width--large">
        <p class="label">About us</p>
        <div class="grid grid--gutter flex-space-between">
            <div class="introduction__content col-17@medium col-14@large">
                <div class="intro__inner first-last">
                    <h2 class="heading-2"><?php echo $title; ?></h2>
                    <div class="text-main first-last">
                        <?php echo $content; ?>
                    </div>
                    <?php echo renderButton($link); ?>
                </div>
            </div>
            <div class="introduction__image col-14 col-7@medium">
                <?php if ($image->hasImage()) : ?>
                    <img 
                        class="object-fit border-radius" 
                        src="<?php echo $image->src ?>"
                        srcset="<?php echo $image->srcset ?>"
                        sizes="(min-width: 62em) 50vw, 100vw"
                        role="presentation" 
                        alt="<?php echo $image->alt ?>"
                        style="<?php echo $image->style ?>"
                    >
                <?php endif ?>
            </div>
        </div>
        
    </div>
</section>