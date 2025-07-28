<?php
    $title = $data['title'] ?? '';
    $link = new Link($data['link']);
    $image = new Image($data['image'] ?? ''); 
?>

<section class="full-image relative bg--dark-blue">
    <div class="page-width--large">
        <div class="full-image__inner grid flex-end"> 
            <div>
                <p class="full-image__label label text-white">About us</p>
                <div class="full-image__content">
                    <h2 class="heading-2 margin-0 text-white col-15@medium"><?php echo $title; ?></h2>
                    <?php echo renderButton($link); ?>
                </div>
            </div>
            
        </div>
    </div>
    <div class="full-image__image">
        <?php if ($image->hasImage()) : ?>
            <img 
                class="object-fit--absolute" 
                src="<?php echo $image->src ?>"
                srcset="<?php echo $image->srcset ?>"
                role="presentation" 
                alt="<?php echo $image->alt ?>"
                style="<?php echo $image->style ?>"
            >
        <?php endif ?>
    </div>
</section>