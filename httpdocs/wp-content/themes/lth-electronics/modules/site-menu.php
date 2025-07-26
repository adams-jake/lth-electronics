<?php
	$menu = menu\tree('main');
?>

<div class="<?php echo classlist('site-menu'); ?>">
    <div class="site-menu__nav grid">
        <?php foreach($menu as $menuItem) :
            $target = $menuItem->target ? "target=\"{$menuItem->target}\"" : "";
            $hasChildren = ($menuItem->children) ? 'site-menu__has-children' : '';
        ?>
            <div class="<?php echo classlist('site-menu__item', $hasChildren); ?>">
                <?php if ($menuItem->url): ?>
                    <a <?php echo $target ?> class="site-menu__link" href="<?php echo $menuItem->url ?>">
                        <?php echo $menuItem->title ?>
                    </a>
                <?php else : ?>
                    <span class="site-menu__link site-menu__nolink">
                        <?php echo $menuItem->title ?>
                    </span>
                <?php endif; ?>
                <?php if ($menuItem->children) : 
                    $total = count($menuItem->children);
                    $columns = ($total > 6) ? 'site-menu__dropdown__twocol' : '';
                ?>
                    <div class="<?php echo classlist('site-menu__dropdown', $columns); ?>">
                        <div class="site-menu__dropdown__inner grid">
                            <?php foreach($menuItem->children as $child) :
                                $target = $child->target ? "target=\"{$child->target}\"" : ""; 
                                $childLinkTarget = $child->target ? ' menu-external-link' : '';
                                $childWidth = ($total > 6) ? 'col-12' : 'col-24'
                            ?>
                                <div class="<?php echo classlist('site-menu__dropdown__item', $childWidth); ?>">
                                    <a <?php echo $target ?> class="site-menu__dropdown__link<?php echo $childLinkTarget ?>" href="<?php echo $child->url ?>">
                                        <?php echo $child->title ?>
                                    </a>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>