<?php
    // Content
    $title = $data['title'] ?? '';
    $content = $data['content'] ?? '';
    $videoURL = $data['video_url'] ?? '';

    // Thumbnail
    $image = new Image($data['thumbnail'] ?? ''); 

    // Options    
    $backgroundColour = $data['background_colour'] ?? '';
    $spacing =  module_row_spacing($backgroundColour);
    $textColour = module_text_color($backgroundColour);

    if (!$videoURL) return;
?>

<div class="<?php echo classlist('video', $backgroundColour, $spacing, $textColour); ?>">
    <div class="page-width--narrow">
        <div class="video__head first-last margin-bottom-4">
            <h2 class="heading-2"><?php echo $title; ?></h2>
            <div class="text-main">
                <?php echo $content; ?>
            </div>
        </div>
        <a href="<?php echo $videoURL ?>" class="video__link mediabox">
            <?php if ($image->hasImage()) : ?>
                <img 
                    class="video__image object-fit" 
                    src="<?php echo $image->src ?>"
                    srcset="<?php echo $image->srcset ?>"
                    sizes="100vw"
                    role="presentation" 
                    alt="<?php echo $image->alt ?>"
                    style="<?php echo $image->style ?>"
                >
            <?php endif ?>
        </a>
    </div>
</div>