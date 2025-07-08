<?php


// remove menus for all users

add_action('admin_menu', function() {
	remove_menu_page('edit.php'); 
	remove_menu_page('edit-comments.php');
	remove_submenu_page('themes.php', 'theme-editor.php');
	remove_submenu_page('plugins.php', 'plugin-editor.php');
}, PHP_INT_MAX);


// remove menus for non-admin users

add_action('admin_menu', function() {
	if (current_user_can('install_plugins')) return;
	remove_menu_page('options-general.php');
	remove_menu_page('plugins.php');
	remove_menu_page('tools.php');
	remove_menu_page('settings.php');
	remove_menu_page('edit.php?post_type=acf-field-group');
}, PHP_INT_MAX);


/*
add_action('admin_menu', function() {
	global $submenu;
	global $menu;

	// rename 'Pages' to 'Content'
	foreach($menu as &$menuitem) {
		if ($menuitem[1] === 'edit_pages' && $menuitem[2] === 'edit.php?post_type=page') {
			$menuitem[0] = 'Content';
			continue;
		}
	}

	// rename 'All pages' menu title
	$submenu['edit.php?post_type=page'][5][0] = "Pages";
	
	// remove 'Add pages'
	unset($submenu['edit.php?post_type=page'][10]);
});
*/