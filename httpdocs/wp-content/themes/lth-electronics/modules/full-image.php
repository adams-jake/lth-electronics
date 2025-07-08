<?php
    $image = new Image($data['image'] ?? ''); 
    $height = $data['height'] ?? '50';

?>

<section class="full-image relative margin-y" style="height:<?php echo $height . 'vh';?>">
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
</section>