<?php 

/**
 *  Easily create custom WordPress routes
 *  Any regex groups included in the pattern will be passed to the callback function
 * 
 *  route('^/page/([^/]*)/?', function($page) {
 *      echo $page;
 *  });
 */

function route(string $pattern, ...$arguments) {

	$func = array_pop($arguments);
	$method = count($arguments) ? array_shift($arguments) : "GET";
	$root = parse_url(home_url())['path'] ?? "";
	$request = parse_url($_SERVER['REQUEST_URI'] ?? "")['path'] ?? "";
	$uri = (strpos($request, $root) === 0) ? substr($request, strlen($root)) : $request;

	if (count($arguments))
		throw new Error("Too many arguments. Use route(string \$pattern, string? \$method, callable \$callable)");

	$valid = in_array($method, [
		"CONNECT", "DELETE", "GET", "HEAD", "OPTIONS", "POST", "PUT", "TRACE"
	]);

	if (!is_callable($func)) 
		throw new Error("argument passed to router under \"$pattern\" is not a function");

	if (!$valid)
		throw new Error("\$method must be a valid http verb (e.g. GET, POST, PUT, DELETE)");

	if (strpos($pattern, '#')) 
		throw new Error("Route pattern \"$pattern\" cannot contain character #");

	if ($method !== $_SERVER['REQUEST_METHOD']) 
		return;
	
	if (!preg_match("#$pattern#", $uri, $matches, PREG_UNMATCHED_AS_NULL)) 
		return;

	// remove $1 from regex so we only pass the groups
	array_shift($matches);

	// wait for the init event to initialize wordpress functions
	add_action('init', function() use ($func, $matches) {
		call_user_func_array($func, $matches);
		exit();
	});
}