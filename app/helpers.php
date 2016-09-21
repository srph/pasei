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

/**
 * @source http://php.net/manual/en/function.number-format.php#89655
 * @param integer $num
 * @return $string
 */	
function ordinal($num) {
	if ( is_string($num) ) {
		$num = (int) $num;
	}

    // Special case "teenth"
    if ( ($num / 10) % 10 != 1 )
    {
        // Handle 1st, 2nd, 3rd
        switch( $num % 10 )
        {
            case 1: return $num . 'st';
            case 2: return $num . 'nd';
            case 3: return $num . 'rd';  
        }
    }

    // Everything else is "nth"
    return $num . 'th';
}

/**
 * Get the school year of the given year.
 * Defaults to the current year
 *
 * @param integer $start
 * @return string
 */
function school_year($start = null) {
    if ( null == $start ) {
        // In the Philippines, school starts by June.
        $start = date('n') <= 5
            ? date('Y') - 1
            : date('Y');
    }

    return $start . '-' . ($start + 1);
}