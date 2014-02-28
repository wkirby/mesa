<?php

$users = array(
	array(
		"firstName" => "Wyatt",
		"lastName" => "Kirby",
		"email" => "wyatt@apsis.io",
		"tags" => array("tomato", "money", "jesus")
	),
	array(
		"firstName" => "Noah",
		"lastName" => "Callaway",
		"email" => "noah@apsis.io",
		"tags" => array("tomato", "money", "jesus")
	),
	array(
		"firstName" => "Test",
		"lastName" => "User",
		"email" => "test@apsis.io",
		"tags" => array("tomato", "money", "jesus")
	)
);


function searchArray($needle, $haystack) {
	foreach ($haystack as $key => $value) {
		if ( $needle === $value || ( is_array($value) && searchArray($needle, $value) !== false )) {
			return $haystack[$key];
		}
	}

	return false;
}

function filterArray($filter, $array) {
	foreach ($array as $key => $value) {
		if ( $filter === $value || ( is_array($value) && filterArray($filter, $value) !== false )) {
			return $array;
		}

		unset($array[$key]);
	}

	return false;
}

echo '<pre>';
print_r(searchArray("noah@apsis.io", $users));
print_r(filterArray("noah", $users));
echo '</pre>';