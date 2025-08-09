<?php 
    /* Template Name: Archive: Products */
    get_header();
    
    $query = getProductsQuery([], 12);
    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    

    // var_dump($loop);
?>

<?php if ($query->have_posts()) : ?>
    <section>
        <div class="page-width--large">
            <div class="grid grid--gutter grid--small">
                <?php while ( $query->have_posts() ) : $query->the_post();
                    $ID = get_the_ID()?? 0;
                    $data = get_fields($ID) ?: [];
                    $postImage = new Image($data['image'] ?? []); 
                    $postTitle = get_the_title($ID) ?? '';

                    $postLink = get_the_permalink($ID) ?? '';
                    $label = $data['label'] ?? '';

                    if (!$postLink) return;
                ?>
                    <div class="col-6@medium">
                        <a href="<?php echo $postLink; ?>" class="card">
                            <?php if ($postImage->hasImage()) : ?>
                                <div class="card__image relative">
                                    <img 
                                        class="object-fit--contain" 
                                        src="<?php echo $postImage->src ?>"
                                        srcset="<?php echo $postImage->srcset ?>"
                                        sizes="(min-width: 62em) 50vw, 100vw"
                                        role="presentation" 
                                        alt="<?php echo $postImage->alt ?>"
                                        style="<?php echo $postImage->style ?>"
                                    >
                                </div>
                            <?php endif; ?>
                            <div class="card__content first-last">
                                <div class="card__labels grid label text-pink margin-bottom-1">
                                    <span><?php echo $label; ?></span>
                                </div>
                                <h3 class="heading-4 margin-0"><?php echo $postTitle; ?></h3>
                                <p>Lorem ipsum dolor sit amet consectetur</p>
                            </div>
                        </a>        
                    </div>            
                <?php endwhile; ?>
            </div>
            
        </div>
    </section>

    <section class="margin-y-5">
        <div class="page-width">

        <?php modules\render('pagination') ?>
        </div>

    </section>

<?php endif; ?>

<?php 
get_footer();