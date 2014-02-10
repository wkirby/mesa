<?php

function _e($string, $format = "%s") {
	if (!empty($string)) {
		printf($format, $string);
	}
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

function cleanPath($path) {
	return preg_replace('#/+#','/',$path);
}