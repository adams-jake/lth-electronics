<?php

register_nav_menus([
	'main' => 'Main menu',
	'company' => 'Company menu',
	'solutions' => 'Solutions menu',
	'legal' => 'Legal menu',
]);

// Render footer menus
function renderFooterMenus($menuList = [], $title = '') {
    if (!$menuList) return;

    echo "<div class='footer-menu first-last'><p class='footer-menu__title'>{$title}</p>";
    foreach($menuList as $menuItem) {
        echo "<a class='footer-menu__item' href='{$menuItem->url}' {$menuItem->target}>";
        echo $menuItem->title;
        echo "</a>";
    }
    echo "</div>";
};