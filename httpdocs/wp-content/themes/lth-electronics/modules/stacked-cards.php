<?php
    // Content
    $title = $data['title'] ?? '';
    $content = $data['content'] ?? '';

    // Accordion 
    $cards = $data['cards'] ?? [];

    // Options    
    $columns = $data['columns'] ?? '';
    $backgroundColour = $data['background_colour'] ?? '';
    $spacing =  module_row_spacing($backgroundColour);
    $textColour = module_text_color($backgroundColour);

    if (!$cards) return;
?>

<section class="<?php echo classlist('stacked-cards', $backgroundColour, $textColour, $spacing); ?>">
    <div class="page-width--large">
        <div class="section-head margin-bottom-5">
            <div class="grid">
                <div class="col-7@medium first-last">
                    <p>Useful links</p>
                </div>
                <div class="col-17@medium first-last">
                    <h2 class="heading-2"><?php echo $title; ?></h2>
                    <div class="text-main">
                        <?php echo $content; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="stacked-cards__cont">
            <?php foreach($cards as $card): 
                $cardTitle = $card['card_title'] ?? '';
                $cardContent = $card['card_content'] ?? '';
                $cardImage = new Image($card['card_image'] ?? ''); 
                $cardLink = new Link($card['card_link']);
            ?> 
                 <div class="stacked-cards__item grid">
                    <div class="col-7@medium first-last">
                        <div class="stacked-cards___item__image relative border-radius">
                            <?php if ($cardImage->hasImage()) : ?>
                                <img 
                                    class="object-fit--absolute" 
                                    src="<?php echo $cardImage->src ?>"
                                    srcset="<?php echo $cardImage->srcset ?>"
                                    sizes="(min-width: 62em) 50vw, 100vw"
                                    role="presentation" 
                                    alt="<?php echo $cardImage->alt ?>"
                                    style="<?php echo $cardImage->style ?>"
                                >
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="col-17@medium first-last">
                        <div class="grid flex-space-between">
                            <div class="col-14@medium first-last">
                                <h3 class="heading-4 text-blue"><?php echo $cardTitle; ?></h3>
                                <div class="text-main">
                                    <p><?php echo $cardContent; ?></p>
                                </div>
                                <?php echo renderButton($cardLink, 'small', true); ?>
                            </div>
                            <div class="col-1@medium hide show@medium">][</div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>