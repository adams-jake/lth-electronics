<?php
    // Content
    $title = $data['title'] ?? '';
    $content = $data['content'] ?? '';
    $link = new Link($data['link']);

    // Accordion 
    $accordion = $data['accordion'] ?? [];

    // Options    
    $backgroundColour = $data['background_colour'] ?? '';
    $spacing =  module_row_spacing($backgroundColour);
    $textColour = module_text_color($backgroundColour);

    if (!$accordion) return;
?>

<section class="<?php echo classlist('accordion', $backgroundColour, $textColour, $spacing); ?>">
    <div class="accordion__head page-width--narrow">
        <div class="first-last text-narrow margin-bottom-4">
            <h2 class="heading-2"><?php echo $title; ?></h2>
            <div class="text-main">
                <?php echo $content; ?>
            </div>
            <?php if ($link->hasLink()) : ?>
                <a class="button" <?php echo $link->attributes; ?>>
                    <?php echo $link->text; ?>
                </a>
            <?php endif; ?>
        </div>
        <div class="accordion-group">
            <?php foreach($accordion as $accordionItem): 
                $accordionTitle = $accordionItem['accordion_title'] ?? '';
                $accordionContent = $accordionItem['accordion_content'] ?? '';
                $ariaLabel = lowercaseAndUnderscore($accordionTitle) ?? '';
            ?>
                <div class="<?php echo classlist('accordion', $textColour); ?>">
                    <button type="button" class="accordion__button relative" aria-controls="<?php echo $ariaLabel; ?>">
                        <div class="<?php echo classlist('accordion__title grid', $textColour); ?>">
                            <?php echo $accordionTitle; ?>
                        </div>
                        <div class="accordion__icon">
                            <div class="accordion__icon__inner"></div>
                        </div>
                    </button>
                    <div class="accordion__content" aria-labelledby="<?php echo $ariaLabel; ?>" style="display: none;">
                        <div class="accordion__content__inner first-last">
                            <?php echo $accordionContent; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>