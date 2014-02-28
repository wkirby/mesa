<?php

// Security Check
if (!defined('MESA')) { die( 'wallhax' ); }

class file {

	static function read($file) {
		if (!file_exists($file)) { return false; }
		return @file_get_contents($file);
	}

	static function write($file, $content) {
		return (@file_put_contents($file, $content) && @chmod($file, 0666)) ? true : false;
	}

	static function delete($file) {
		if (!file_exists($file)) { return false; }
		return @unlink($file);
	}

	static function move($source, $dest) {
		if ( !file_exists($source) ) { return false; }
		return (@rename($source, $dest) && file_exists($dest)) ? true : false;
	}

	static function copy($source, $dest) {
		if ( !file_exists($source) ) { return false; }
		return (@copy($source, $dest) && file_exists($dest)) ? true : false;
	}

	static function getBasename() {
		if (!file_exists($file)) { return false; }
		return basename($file);
	}

	static function getPath($file) {
		if (!file_exists($file)) { return false; }
		return realpath(dirname($file));
	}

	static function getFilename() {
		if (!file_exists($file)) { return false; }
		return pathinfo($file, PATHINFO_FILENAME);	
	}

	static function getExtension() {
		if (!file_exists($file)) { return false; }
		return pathinfo($file, PATHINFO_EXTENSION);
	}
}