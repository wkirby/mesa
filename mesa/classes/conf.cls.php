<?php

// Security Check
if (!defined('MESA')) { die( 'wallhax' ); }

class conf {
	
	private static $config = array();

	private function __construct() { die(); }

	public static function set($key, $value = null) {
		self::$config = array_merge(self::$config, array($key => $value));
	}

	public static function get($key = null) {
		if ( empty($key) ) {
			return self::$config;
		} else if ( array_key_exists($key, self::$config) ) {
			return self::$config[$key];
		}

		return false;
	}

	public static function loadFile($file) {
		if ( file_exists($file) && 'json' === strtolower(pathinfo($file, PATHINFO_EXTENSION)) ) {
			$configArray = json_decode(file_get_contents($file), true);
			self::$config = array_merge(self::$config, $configArray);
		}

		return self::$config;
	}
}