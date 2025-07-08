<?php

/**
 *  Retrieve menu items in a hierarchical array
 * 
 *  $tree = menu\tree()
 *  $items = menu\items()
 *  $depth = menu\depth($menuItem)
 */ 

namespace menu;


function tree(string $menuName, array $args = []): array {
	$items = items($menuName, $args);
	return buildTree($items);
}


function items(string $menuName, array $args = []): array {

	static $cache;
	if (isset($cache[$menuName])) return $cache[$menuName];

	global $wp_query;
	global $post;

	$locations = get_nav_menu_locations();
	if (empty($locations[$menuName])) return [];

	$navMenu = wp_get_nav_menu_object($locations[$menuName]);
	if (!$navMenu) return [];

	$queriedPostType = get_post_type();
	$menu_items = wp_get_nav_menu_items($navMenu->term_id , $args);
	
    /* the following was taken from wp_nav_menu core function 
	 * line 154–169: https://developer.wordpress.org/reference/functions/wp_nav_menu/
     */

    // set up menu item classes
    _wp_menu_item_classes_by_context($menu_items);

    $sorted_menu_items = $menu_items_with_children = array();
    foreach ( (array) $menu_items as $menu_item ) {
        $sorted_menu_items[ $menu_item->menu_order ] = $menu_item;
        if ( $menu_item->menu_item_parent )
            $menu_items_with_children[ $menu_item->menu_item_parent ] = true;
    }
 
    // Add the menu-item-has-children class where applicable
    if ( $menu_items_with_children ) {
        foreach ( $sorted_menu_items as &$menu_item ) {
            if ( isset( $menu_items_with_children[ $menu_item->ID ] ) )
                $menu_item->classes[] = 'menu-item-has-children';
        }
    }
    /* 
     * end wp_nav_menu
     */

	foreach($menu_items as $key => &$menu_item) {

		// Add isCurrent class to parents or ancestors
		$menu_item->current = false;

    	if ($menu_item->current_item_ancestor) 
    		$menu_item->current = 'ancestor';

    	if ($menu_item->current_item_parent && ($menu_item->type !== 'taxonomy'))
    		$menu_item->current = 'parent ancestor';

    	if ($menu_item->current) 
    		$menu_item->current = 'current';

    	// Add current class, and ancestor classes to custom post type archive menu items
		$currentCustomPostType = isArchive($menu_item, $queriedPostType);

		// if is current
		if ($currentCustomPostType) {
			$menu_item->classes[] = "current-{$queriedPostType}-ancestor";
			$menu_item->current = 'ancestor';
		}

		// if is current and !hierarchical
		if ($currentCustomPostType && !is_post_type_hierarchical($queriedPostType)) {
			$menu_item->classes[] = "current-{$queriedPostType}-parent";
			$menu_item->current = 'parent ancestor';
		}

		// if is current and hierarchical and top level
		if ($post 
			&& $currentCustomPostType 
			&& is_post_type_hierarchical($queriedPostType) 
			&& (count(get_post_ancestors($post->ID)) === 0)
		) {
			$menu_item->classes[] = "current-{$queriedPostType}-parent";
			$menu_item->current = 'parent ancestor';
		}

		$menu_item->href = $menu_item->url ?? '';
		$menu_item->target_value = $menu_item->target ?? '';
		$menu_item->target = $menu_item->target ? "target=\"{$menu_item->target}\"" : "";
		$menu_item = apply_filters('menu/item', $menu_item);
   	}

   	return $cache[$menuName] = $menu_items;
}


function buildTree(array &$elements, int $parentId = 0, int $level = 1): array {
    $branch = [];
    foreach ($elements as &$element) {
        if ($element->menu_item_parent == $parentId) {
        	$subLevel = $level + 1;
        	$element->level = $level;
            $children = buildTree($elements, $element->ID, $subLevel);
            if ($children) {
                $element->children = $children;
            } else {
            	$element->children = [];
            }
            $branch[] = $element;
            unset($element);
        }
    }
    return $branch;
}


function isArchive(\WP_Post $item, $postType = null): bool {

	$isCustomPostType = (
		isset($item->type) 
		&& ($item->type === 'post_type_archive')
		&& (is_post_type_archive(get_post_type()) || is_singular(get_post_type()))
	);
	if (!$postType) return $isCustomPostType;

	$isOfType = (
		$isCustomPostType
		&& isset($item->object)
		&& ($item->object === $postType)
	);
	return $isOfType;
}


function depth(\WP_Post $item): int {
    $max = 0;
    foreach ($item->children as $child) {
        if (is_array($child->children)) {
            $depth = depth($child) + 1;
            if ($depth > $max) $max = $depth;
        }
    }
    return $max;
}