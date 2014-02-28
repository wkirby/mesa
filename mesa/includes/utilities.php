<?php

// Security Check
if (!defined('MESA')) { die( 'wallhax' ); }

function conditionalEcho($string, $format = "%s") {
	if (!empty($string)) {
		printf($format, $string);
	}
}

// Alias conditionalEcho
function _e($string, $format = "%s") {
	conditionalEcho($string, $format);
}

function prettyArray($array) {
	if ($array) {
		echo '<pre>' . print_r($array, true) . '</pre>';
	}
}

// Alias prettyArray
function _a($array) {
	prettyArray($array);
}

function slash($string) {
	return unslash($string) . '/';
}

function unslash($string) {
	return rtrim($string, '/');
}

function getQuery($key) {
	if ( array_key_exists($key, $_REQUEST) ) {
		if ( !is_array($_REQUEST[$key])) {
			return trim($_REQUEST[$key]);
		} else {
			return cleanArray($_REQUEST[$key]);
		}
	}

	return false;
}

function cleanArray($haystack) {
	foreach ($haystack as $key => $value) {
		if (is_array($value)) {
			$haystack[$key] = cleanArray($haystack[$key]);
		}

		if (empty($haystack[$key])) {
			unset($haystack[$key]);
		}
	}

	return $haystack;
}

function searchArray($needle, $haystack) {
	foreach ($haystack as $key => $value) {
		if ( $needle === $value || ( is_array($value) && searchArray($needle, $value) !== false )) {
			return $haystack[$key];
		}
	}

	return false;
}

function cleanPath($path) {
	return preg_replace('#/+#','/',$path);
}

function createSalt() {
	return md5(uniqid(rand(1,6)));
}