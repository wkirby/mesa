<?php

// Security Check
if (!defined('MESA')) { die( 'wallhax' ); }

class MesaConfig {
	
	/**
	 * The Config Array
	 * @var array
	 */
	public $config = array();
	private $config_file;

	/**
	 * Optionally Construct Config Array from File
	 *
	 * Allow the instantiation of config arrays from an existing JSON file.
	 * 
	 * @param string $file Path to config file.
	 */
	public function __construct($file = '') {
		if ( !empty($file) && file_exists($file) ) {
			$this->add_config_file($file);
			$this->config_file = $file;
		}
	}

	/**
	 * Set Config Parameter
	 *
	 * Set a config parameter with a $key->$value pair.
	 * 
	 * @param string $key   Config parameter key.
	 * @param any    $value Config parameter value.
	 */
	public function set($key, $value) {
		$temp_array = array($key => $value);
		$this->config = array_merge($this->config, $temp_array);
	}

	/**
	 * Get Config Parameter
	 *
	 * Search for a config parameter and return the value if it exists.
	 * If it does not exist, return false.
	 * 
	 * @param  string $key Config param key.
	 * @return string Config param value.
	 */
	public function get($key) {
		if ( array_key_exists($key, $this->config) ) {
			return $this->config[$key];
		}

		return false;
	}

	/**
	 * Merge a JSON Config File with Config Array
	 *
	 * Safely merge an existing config file with the config array; checks
	 * for the existence of the config file and the proper formatting.
	 * 
	 * @param string $file Path to config file.
	 */
	public function add_config_file($file) {
		if ( file_exists($file) && 'json' === strtolower(pathinfo($file, PATHINFO_EXTENSION)) ) {
			$config_array = json_decode(file_get_contents($file), true);
			$this->config = array_merge($this->config, $config_array);
		}

		return false;
	}

	/**
	 * Save Config File
	 *
	 * Safely save config file, keeping a backup copy just in case?
	 *
	 * @param  bool $backup Set whether or not to backup the config file.
	 */
	public function save_config_file($backup = false) {
		if ( isset($this->config_file) && !empty($this->config_file) ) {
			if ( $backup && !copy($this->config_file, $this->config_file . '.backup') ) {
				return false;
			}

			file_put_contents($this->config_file, json_encode($this->config, JSON_PRETTY_PRINT));
		}

		return false;
	}
}