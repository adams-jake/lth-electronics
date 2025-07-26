<?php
    $data = get_fields(); 

    $title = $data['hero_title'] ?? '';
    $content = $data['hero_content'] ?? '';

    // Image
    $image = new Image($data['hero_image'] ?? ''); 
?>

<section class="banner">
    <div class="page-width--large">
        <?php breadcrumbs\render(); ?>
        <h1 class="heading-1 banner__title col-15@medium col-13@large"><?php echo $title; ?></h1>

        <div class="grid flex-space-between flex-end">
            <p class="margin-0 text-blue p--large col-9@medium"><?php echo $content; ?></p>
            <a href="#" class="hide show@medium">Scroll for more</a>
        </div>
    </div>
    <div class="banner__image relative">
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
</section>