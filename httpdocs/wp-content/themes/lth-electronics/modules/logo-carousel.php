<?php 
    // Content
    $title = $data['title'] ?? '';
    $content = $data['content'] ?? '';

    // Logos
    $logos = $data['logos'] ?? '';

    // Options    
    $backgroundColour = $data['background_colour'] ?? '';
    $spacing =  module_row_spacing($backgroundColour);
    $textColour = module_text_color($backgroundColour);
    if (!$logos) return;
?>

<section 
	class="<?php echo classlist('logo-carousel__row', $backgroundColour, $textColour, $spacing); ?>"
>
    <div class="page-width--large">
        <div class="logo-carousel__head grid flex-space-between flex-end margin-bottom-4">
            <div class="logo-carousel__head__inner text-narrow first-last">
                <h2 class="heading-2"><?php echo $title; ?></h2>
                <div class="text-main first-last">
                    <?php echo $content; ?>
                </div>
            </div>
            <div class="swiper-carousel__navigation grid">
                <div class="swiper-carousel__arrow swiper-carousel__prev">
                   prev
                </div>
                <div class="swiper-carousel__arrow swiper-carousel__next">
                    next
                </div>
            </div>
        </div>

        <div class="logo-carousel swiper">
            <div class="logo-carousel__inner swiper-wrapper">
                <?php foreach($logos as $logo): 
                    $image = new Image($logo['logo'] ?? ''); 
                ?>
                    <div class="logo-carousel__slide swiper-slide">
                        <div class="logo-carousel__slide__inner">
                            <?php if ($image->hasImage()): ?>
                                <div class="relative">
                                    <img 
                                        class="logo-carousel__logo object-fit" 
                                        src="<?php echo $image->src ?>"
                                        srcset="<?php echo $image->srcset ?>"
                                        sizes="(min-width: 62em) 50vw, 100vw"
                                        role="presentation" 
                                        alt="<?php echo $image->alt ?>"
                                        style="<?php echo $image->style ?>"
                                    >
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- <div class="swiper-pagination"></div> -->
        </div>
    </div>
</section>