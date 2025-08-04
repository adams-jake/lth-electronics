<?php    
    // Content
    $title = $data['title'] ?? '';
    $content = $data['content'] ?? '';

    // Image
    $image = new Image($data['image'] ?? ''); 

    // Link
    $link = new Link($data['link']);

    // Options    
    $imagePosition = ($data['image_position'] === 'right') ? 'image-text--flip' : '';
    $backgroundColour = $data['background_colour'] ?? '';
    $spacing =  module_row_spacing($backgroundColour);
    $textColour = module_text_color($backgroundColour);
?>

<section class="<?php echo classlist('image-text', $backgroundColour, $textColour, $spacing, $imagePosition); ?>">
    <div class="page-width">
        <div class="grid grid--gutter flex-end">
            <div class="image-text__image__cont col-12@medium">
                <div class="image-text__image border-radius relative">
                    <?php if ($image->hasImage()) : ?>
                        <img 
                            class="object-fit--absolute" 
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
            
            <div class="col-12@medium first-last">
                <h2 class="heading-2"><?php echo $title; ?></h2>
                <div class="text-main">
                    <?php echo $content; ?>
                </div>
                <?php echo renderButton($link); ?>
            </div>
        </div>
    </div>
</section>

