<?php

// utility
include 'functions/utility.php';

// includes
include 'functions/includes/breadcrumbs.php';
include 'functions/includes/menu.php';
include 'functions/includes/modules.php';
include 'functions/includes/pagination.php';
include 'functions/includes/route.php';
include 'functions/includes/seo.php';
include 'functions/includes/classlists.php';
include 'functions/includes/button.php';

// helpers
include 'functions/includes/Image.php';
include 'functions/includes/Link.php';

// setup
include 'functions/setup/setup-404.php';
include 'functions/setup/setup-acf.php';
include 'functions/setup/setup-admin-menus.php';
include 'functions/setup/setup-admin-styles.php';
include 'functions/setup/setup-editor.php';
include 'functions/setup/setup-favicon.php';
include 'functions/setup/setup-head.php';
include 'functions/setup/setup-images.php';
include 'functions/setup/setup-menus.php';
include 'functions/setup/setup-security.php';
include 'functions/setup/setup-visibility.php';

// init
include 'functions/app.php';
include 'functions/products.php';

add_filter('sf_input_object_pre', 'preselect_solutions_taxonomy_filter', 10, 3);

function preselect_solutions_taxonomy_filter($input, $sf_name, $sfid) {
    // Check if we are on a Solutions taxonomy archive page
    if (is_tax('solutions') && $sf_name === 'solutions') {
        $current_term = get_queried_object();
        if ($current_term && isset($current_term->term_id)) {
            // Set the current term as checked
            $input['attributes']['checked'] = 'checked';
            $input['attributes']['value'] = $current_term->term_id;
        }
    }
    return $input;
}

/**
 * Ensure the Search & Filter form respects the current taxonomy archive
 */
add_filter('sf_archive_results_url', 'set_solutions_archive_url', 10, 3);

function set_solutions_archive_url($url, $query_args, $args) {
    if (is_tax('solutions')) {
        $term = get_queried_object();
        if ($term && isset($term->taxonomy) && $term->taxonomy === 'solutions') {
            $url = get_term_link($term);
        }
    }
    return $url;
}