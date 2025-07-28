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
    <div class="page-width">
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
                            <div class="col-1@medium hide show@medium">
                                <svg class="stacked-cards__icon" width="208" height="208" viewBox="0 0 208 208" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="103.744" cy="103.741" r="45.5227" stroke="#001F5A" stroke-width="3.5"/>
                                    <circle cx="104" cy="104" r="102.25" stroke="#001F5A" stroke-width="3.5"/>
                                    <circle cx="103.955" cy="103.958" r="92.7955" stroke="#001F5A" stroke-width="3.5"/>
                                    <circle cx="103.916" cy="103.913" r="83.3409" stroke="#001F5A" stroke-width="3.5"/>
                                    <circle cx="103.873" cy="103.871" r="73.8864" stroke="#001F5A" stroke-width="3.5"/>
                                    <circle cx="103.829" cy="103.829" r="64.4318" stroke="#001F5A" stroke-width="3.5"/>
                                    <circle cx="103.786" cy="103.784" r="54.9773" stroke="#001F5A" stroke-width="3.5"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>