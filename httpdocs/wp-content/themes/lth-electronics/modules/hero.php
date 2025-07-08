<?php
    $data = get_fields() ?? [];
    
    $title = $data['title'] ?? '';
    $content = $data['content'] ?? '';
    $link = new Link($data['link']);
    $image = new Image($data['image'] ?? '');
?>

<div class="hero bg--soft-grey padding-y">
    <div class="page-width">
        <div class="grid grid--gutter flex-align-center">
            <div class="hero__content col-6@medium first-last">
                <h1 class="heading-1"><?php echo $title; ?></h1>
                <p><?php echo $content; ?></p>
                <?php if ($link->hasLink()) : ?>
                    <a class="button" <?php echo $link->attributes; ?>>
                        <?php echo $link->text; ?>
                    </a>
                <?php endif; ?>
            </div>
            <div class="hero__image col-6@medium">
                <?php if ($image->hasImage()) : ?>
                    <img 
                        class="object-fit" 
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