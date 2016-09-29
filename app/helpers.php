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
        $start = starting_school_year();
    }

    return $start . '-' . ($start + 1);
}

/**
 * Get the school year of the current year.
 *
 * @param array
 * @return string
 */
function starting_school_year() {
    // In the Philippines, school starts by June.
    return date('n') <= 5
        ? date('Y') - 1
        : date('Y');
}

/**
 * Get previous and next years startin
 * from the current school year
 *
 * @param array $range
 * @return array
 */
function school_year_range($range = 1) {
    $start = starting_school_year();
    return range($start - $range, $start + $range);
}

/**
 * Make an array with a numeric key
 * (language limitation)
 *
 * @see http://stackoverflow.com/q/4100488/2698227
 *
 * @param number $key
 * @param mixed $value
 * @return array
 */
function numeric_string_key_array($key, $value) {
    $tmp = new \stdClass;
    $tmp->{"$key"} = $value;
    return (array) $tmp;
}

/**
 * Generate full name
 *
 * @param string $first
 * @param string $middle
 * @param string $last
 * @return string
 */
function fullname($first, $middle, $last) {
    $initials = substr($middle, 0 , 1) . '.';
    return "{$first} {$initials} {$last}";
}