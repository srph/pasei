<?php

/**
 * Checks if the current route name is active.
 * This is the `Request::is` for route names.
 */
function is_route_active($route, $wildcard = true)
{
	$current = Route::currentRouteName();

	if ( $wildcard ) {
		$routes = explode('.', $current);
		array_pop($routes);
		$current = implode('.', $routes);
	}

	return $route === $current;
}