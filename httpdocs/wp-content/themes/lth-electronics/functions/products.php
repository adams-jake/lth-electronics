<?php

add_action('init', function() {
	registerProducts();
	registerProductCategories();
});

function registerProducts() {
	register_post_type("products", [
        "label" => "Products",
        "labels" => [
            "name" => "Products",
            "singular_name" => "Product",
        ],
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "has_archive" => false,
        "show_in_menu" => true,
        'show_in_menu' => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => ["slug" => "products", "with_front" => true],
        "query_var" => true,
        "supports" => ["title", "editor", "excerpt", ""],
        "menu_icon" => "dashicons-text" 
    ]);
}


function registerProductCategories() {
    $labels = [
        "name" => __( "Solutions", "custom-post-type" ),
        "singular_name" => __( "Solution", "custom-post-type" ),
    ];
    $args = [
        "label" => __( "Solutions", "custom-post-type" ),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        'rewrite' => ['slug' => 'solution', 'with_front' => true],
        "show_admin_column" => true,
        "show_in_rest" => false,
        "rest_base" => "solution",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => false,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "solutions", [ "products" ], $args );
}

add_rewrite_rule(
    '^products/page/(\d+)/?$',
    'index.php?pagename=products/&paged=$matches[1]',
    'top'
);

function getProducts(array $args = [], int $count = -1) : array {
	return get_posts(array_merge([
		'post_type' => 'products',
		'post_status' => 'publish',
		'posts_per_page' => $count,
		'has_password' => false,
	], $args)) ?: [];
}

function getProductsQuery(array $args = [], int $count = 9) : \WP_Query {
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;
	return new \WP_Query(array_merge([
		'orderby' => 'post_date',
		'order' => 'DESC',
		'post_type' => 'products',
		'posts_per_page' => $count,
		'post_status' => 'publish',
		'has_password' => false,
		'paged' => $paged
	], $args));
}

function getSolutions(array $args = [], int $count = -1): array {
    $defaults = [
        'taxonomy'   => 'solutions',
        'hide_empty' => false,
    ];

    $terms = get_terms(array_merge($defaults, $args));

    return is_array($terms) ? $terms : [];
}

