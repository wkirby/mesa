<?php

function _e($string, $format = "%s") {
	if (!empty($string)) {
		printf($format, $string);
	}
}

function trailingslash($string) {
	return untrailingslash($string) . '/';
}

function untrailingslash($string) {
	return rtrim($string, '/');
}
 
// Get Query

function get_query($key) {
	if ( array_key_exists($key, $_REQUEST) ) {
		if ( !is_array($_REQUEST[$key])) {
			return trim($_REQUEST[$key]);
		} else {
			return clean_array($_REQUEST[$key]);
		}
	}

	return false;
}


// Recursive Glob

function glob_recursive($pattern, $flags = 0) {
    $files = glob($pattern, $flags);
    
    foreach (glob(dirname($pattern).'/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir)
    {
        $files = array_merge($files, glob_recursive($dir.'/'.basename($pattern), $flags));
    }
    
    return $files;
}

// Clean Array

function clean_array($haystack) {
	foreach ($haystack as $key => $value) {
		if (is_array($value)) {
			$haystack[$key] = clean_array($haystack[$key]);
		}

		if (empty($haystack[$key])) {
			unset($haystack[$key]);
		}
	}

	return $haystack;
}

function clean_path($path) {
	return preg_replace('#/+#','/',$path);
}