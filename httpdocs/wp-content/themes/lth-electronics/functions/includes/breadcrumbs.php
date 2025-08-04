<?php

/** 
 *  breadcrumbs\links(bool $includeRoot);
 *  breadcrumbs\render();
 *  breadcrumbs\createLink(string $text, string $href, bool $isCurrent, bool $isRoot);
 */

namespace breadcrumbs;


function links(bool $includeRoot = false): array {

    global $post;
    $crumbs = [];
    $query = get_queried_object();
    $post = $post ?: sanitize_post($query);
    
    $root = createLink('Home', home_url(), false, true);

    if (is_404()) {
        $crumbs[] = createLink('404', null);
        if ($includeRoot) $crumbs[] = $root;
    }

    if (!$post) return $crumbs;

    // current page

    if (is_singular() && !is_front_page()) {
        $crumbs[] = createLink($post->post_title, get_permalink($post->ID), true);
    }

    // ancestors
    
    $parent = (int) apply_filters("breadcrumbs/post_parent", $post->post_parent);
        $category = get_queried_object($post);


    if (is_tax('solutions')) {
        $category = categoryAncestors($category->term_id, 'solutions');
        $crumbs = array_merge($category, $crumbs);
    } elseif ($parent !== 0) {
        $ancestors = ancestors($parent);
        $crumbs = array_merge($crumbs, $ancestors);
    }

    // custom post type archive (customize with 'breadcrumbs/post_type/{post_type}' hook)

    if ($post->post_type && !in_array($post->post_type, ['post', 'page', 'attachment'])) {
        $name = get_post_type_object($post->post_type)->label ?? "";
        $link = get_post_type_archive_link($post->post_type) ?? "";
        $crumb = createLink($name, $link);
        $crumb = apply_filters("breadcrumbs/post_type/" . $post->post_type, $crumb);
        if ($crumb) $crumbs[] = $crumb;
    }

    // filter and include root

    $crumbs = array_filter(apply_filters("breadcrumbs/crumbs", $crumbs));
    if ($includeRoot) $crumbs[] = $root;
    
    return array_reverse($crumbs);
}


function ancestors(int $id, array $links = []): array {
    while ($id) {
        $post = get_post($id);

        if (!$post || $id === 0) return $links;
        if ((int) get_option('page_on_front') === (int) $post->ID) return $links;

        $links[] = createLink(
            $post->post_title, 
            get_permalink($post->ID)
        );
        $id = $post->post_parent;
    }
    return $links;
}

function categoryAncestors(int $id, string $term = '', array $links = []): array {
    $active = $id;

    while ($id) {
        $currentTerm = get_term($id, $term);
        
        if (!$currentTerm || $id === 0) return $links;
        if ((int) get_option('page_on_front') === (int) $currentTerm->ID) return $links;

        $links[] = createLink(
            $currentTerm->name, 
            get_term_link($id, $term),
            ($active === $id && is_tax($term))
        );
        $id = $currentTerm->parent;
    }

    return $links;
}


function createLink(string $text, string $href, bool $isCurrent = false, bool $isRoot = false) {
    $link = new \stdClass();
    $link->text = $text;
    $link->href = $href;
    $link->isRoot = $isRoot ? true : false;
    $link->isCurrent = $isCurrent ? true : false;
    return $link;
}

function render() {
    ?>
    <div class="breadcrumbs grid">
        <a class="breadcrumbs__link breadcrumbs__link--is-home" href="<?php echo home_url() ?>">Home</a>
        <?php foreach(links() as $breadcrumb) : ?>
            <div class="breadcrumb__link grid flex-align-center">
                <span class="breadcrumbs__separator"></span>
                <?php if ($breadcrumb->href && $breadcrumb->text) : ?>
                    <a href="<?php echo $breadcrumb->href ?>"><?php echo $breadcrumb->text ?></a>
                <?php elseif ($breadcrumb->text) : ?>
                    <span><?php echo $breadcrumb->text ?></span>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
}
