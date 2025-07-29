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
    $textColour = module_text_color($backgroundColour);

    // Decoration
    $lineTotal = 7;
?>

<section class="call-to-action bg--white padding-y load">
    <div class="page-width--narrow">
        <div class="<?php echo classlist('bg--blue text-white border-radius', $backgroundColour); ?>">
            <div class="grid">
                <div class="call-to-action__inner col-16@medium relative">
                    <div class="call-to-action__content first-last" style="padding: 3em;">
                        <h2 class="heading-2"><?php echo $title; ?></h2>
                        <div class="text-main">
                            <?php echo $content; ?>
                        </div>
                        <?php echo renderButton($link); ?>
                    </div>
                    <div class="call-to-action__circle" style="--cta-line-total: <?php echo $lineTotal; ?>">
                        <?php foreach (range(1, $lineTotal) as $i) : ?>
                              <div class="call-to-action__line" style="--cta-line-number: <?php echo $i; ?>"></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-8@medium relative hide show@medium" style="background: rgba(0,0,0,0.3);">
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
            
        </div>
    </div>
</section>
