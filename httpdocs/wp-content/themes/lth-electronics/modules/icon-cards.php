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

<section class="<?php echo classlist('icon-card__cont', $backgroundColour, $textColour, $spacing); ?>">
    <div class="page-width">
        <div class="icon-card__head first-last margin-bottom-4">
            <h2 class="heading-2"><?php echo $title; ?></h2>
            <div class="text-main">
                <?php echo $content; ?>
            </div>
        </div>
        <div class="grid grid--gutter">
            <?php foreach($cards as $card): 
                $cardTitle = $card['card_title'] ?? '';
                $cardIcon = $card['icon'] ?? ''; 
                $cardLink = new Link($card['card_link']);
            ?>
                <div class="<?php echo $columns; ?>@medium">
                    <div class="icon-card">
                        <div class="icon-card__image margin-bottom-2">
                            <img src="<?php echo $cardIcon['url']; ?>" alt="<?php echo $cardIcon['alt']; ?>">
                        </div>
                        <div class="icon-card__content first-last">
                            <h4 class="heading-4"><?php echo $cardTitle; ?></h4>
                            <div class="text-main">
                                <?php echo $content; ?>
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