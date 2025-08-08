<?php
    $company = menu\tree('company');
	$solutions = menu\tree('solutions');
	$legal = menu\tree('legal');
?>

<div class="page-width--large">
    <div class="padding-y-5">
        <div class="grid flex-space-between">
            <div class="col-12@medium">
                <div class="footer-menus grid">
                    <div class="footer-menu__cont col-8@medium">
                        <?php renderFooterMenus($company, 'Company'); ?>
                    </div>
                    <div class="footer-menu__cont col-8@medium">
                        <?php renderFooterMenus($legal, 'Legal'); ?>
                    </div>
                  <div class="footer-menu__cont col-8@medium">
                        <?php renderFooterMenus($solutions, 'Solutions'); ?>
                    </div>
                </div>
            </div>
            <div class="col-8@medium">
                <div class="footer-details grid">
                    <div class="first-last">
                        <p class="footer-menu__title">Solutions</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
