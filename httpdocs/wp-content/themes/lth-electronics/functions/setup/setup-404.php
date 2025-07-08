<?php


// Send a 404 for unused routes (uncomment as necessary)

add_action('template_redirect', function() {

	$routes = [
		// single post or any type, or specific with $id
		// is_single(/* $id */),

		// any post type archive, or specific with $post_type
		// is_post_type_archive(/* $post_type */),

		// any page, or specific with $id
		// is_page(/* $id */),

		// any category archive, or specific with $ids in array
		// is_category(/* array($id,$id_2) */),

		// any post which has category $id
		// in_category(/* $id */),

		// any tag archive page, or specific with $tagname
		// is_tag(/* $tagname */),

		// any post which has tag $tagname
		// has_tag(/* $tagname */),

		// any taxonomy archive page, or specific with $taxonomy_name
		// is_tax(/* $taxonomy_name */),

		// any post which has $term and $taxonomy name: $term can be blank
		// has_term(/* $term, $taxonomy_name */),

		// any author archive page, or specific with $id
		// is_author(/* $id */),

		// any date archive page
		// is_date(),

		// any archive page
		// is_archive(),

		// search page
		// is_search(),

		// any archive second or more page with pagination
		// is_paged(),

		// any attachment page
		// is_attachment()
	];

	$matches = array_filter($routes);
	if ($matches) do404();
});