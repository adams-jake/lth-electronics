<?php

/**
 *  Creates data structure to build your own pagination html
 *  
 *  pagination\items(1, 55, $urlFunction);
 *  pagination\fromQuery();
 */

namespace pagination;


function items(int $current, int $last, callable $filter = null) {
	
	$first = 1;

	// always show at least $range number of items 
	// before and after the current number

	$range = 1;

	// limit current to first <= current <= last

	if ($current > $last) $current = $last;
	if ($current < $first) $current = $first;
	
	// next/previous values

	$next = ($current < $last) ? $current + 1 : null;
	$previous = ($current > $first) ? $current - 1 : null;
	
	// get min and max numbers

	$minRange = min($last, max($first, $current - $range));
	$maxRange = max($first, min($last, $current + $range));
	$numbers = range($minRange, $maxRange);

	// calculate ellipses

	$lowDiff = $minRange - $first;
	$highDiff = $last - $maxRange;

	$after = [];
	if ($highDiff >= 3) $after[] = '…';
	if ($highDiff === 2) $after[] = $maxRange + 1;
	if ($highDiff > 0) $after[] = $last;

	$before = [];
	if ($lowDiff > 0) $before[] = $first;
	if ($lowDiff === 2) $before[] = $minRange - 1;
	if ($lowDiff >= 3) $before[] = '…';


	$page = function($number = null) use ($current, $filter) {
		$url = $filter ?: function($x) { return $x; };
		return (object) [
			'href' => is_int($number) ? $url($number) : '',
			'number' => $number ?? '',
			'current' => $current === $number,
			'disabled' => $current === $number || !is_int($number) || !$number,
		];
	};

	return (object) [
		'previous' => $page($previous),
		'pages' => array_map($page, [
			...$before,
			...$numbers,
			...$after
		]),
		'next' => $page($next),
	];
}


function fromQuery(\WP_Query $query = null) {
	global $paged, $wp_query;
	$query = $query ?? $wp_query;
	$current =  get_query_var('paged') ?: 1;
	$last = $query->max_num_pages ?: $current;
	return items($current, $last, 'get_pagenum_link');
}