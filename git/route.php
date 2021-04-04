<?php
$request = $_SERVER['REQUEST_URI'];
$globals = array();

function route($tmpl, $route, $locals=array()) {
	global $request;
	global $globals;
	if (preg_match("|^" . $tmpl . "(?<request>.*)$|", $request, $matches)) {
		$matches = array_filter($matches, fn($k) => !is_numeric($k), ARRAY_FILTER_USE_KEY);
		if (is_callable($route)) {
			$args = array_filter($matches, fn($k) => $k != "request", ARRAY_FILTER_USE_KEY);
			$route = $route(...$args);
		}
		$matches = array_filter($matches, fn($v) => $v);
		$globals = array_merge($globals, $locals, $matches);
		extract($globals);
		chdir(dirname($route));
		require $route;
		exit(0);
	}
}
?>
