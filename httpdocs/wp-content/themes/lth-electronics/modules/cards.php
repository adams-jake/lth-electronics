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

<section class="<?php echo classlist('cards', $backgroundColour, $textColour, $spacing); ?>">
    <div class="page-width">
        <div class="cards__head first-last margin-bottom-4">
            <h2 class="heading-2"><?php echo $title; ?></h2>
            <div class="text-main">
                <?php echo $content; ?>
            </div>
        </div>
        <div class="grid grid--gutter">
            <?php foreach($cards as $card): 
                $cardTitle = $card['card_title'] ?? '';
                $cardContent = $card['card_content'] ?? '';
                $cardImage = new Image($card['card_image'] ?? ''); 
                $cardLink = new Link($card['card_link']);
            ?>
                <div class="<?php echo $columns; ?>@medium">
                    <div class="card">
                        <div class="card__image margin-bottom-3">
                            <?php if ($cardImage->hasImage()) : ?>
                                <img 
                                    class="object-fit" 
                                    src="<?php echo $cardImage->src ?>"
                                    srcset="<?php echo $cardImage->srcset ?>"
                                    sizes="(min-width: 62em) 50vw, 100vw"
                                    role="presentation" 
                                    alt="<?php echo $cardImage->alt ?>"
                                    style="<?php echo $cardImage->style ?>"
                                >
                            <?php endif ?>
                        </div>
                        <div class="card__content first-last">
                            <h4 class="heading-4"><?php echo $cardTitle; ?></h4>
                            <div class="text-main">
                                <?php echo $cardContent; ?>
                            </div>
                            <?php if ($cardLink->hasLink()) : ?>
                                <a class="button" <?php echo $cardLink->attributes; ?>>
                                    <?php echo $cardLink->text; ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
       
    </div>  
</section>