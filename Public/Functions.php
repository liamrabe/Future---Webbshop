<?php
/**
 * Check if array is multidimensional
 */
function is_multidimensional(array $array): bool {
	return count($array) !== count($array, COUNT_RECURSIVE);
}

/**
 * Check if array contains x items
 */
function array_count(array $array, int $items): bool {
	return count($array) === $items;
}

/**
 * Alias for vsprintf with htmlspecialchars
 */
function __(): string {
	$args = func_get_args();
	$format = array_shift($args);

	/* Run htmlspecialchars on every array-item */
	array_walk($args, 'htmlspecialchars');

	return vsprintf($format, $args);
}

/**
 * Extended string repeat function
 */
function ext_str_repeat(string $string, int $repeats = 0, string $separator = '', string $prefix = ''): string {
	for ($i = 1; $i <= $repeats; $i++) {
		if ($prefix !== '' && $i > 1 && $i !== $repeats) {
			$prefix .= $separator;
		}

		$prefix .= str_replace('#', $i, $string);
	}

	return $prefix;
}
