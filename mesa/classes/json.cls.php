<?php

// Security Check
if (!defined('MESA')) { die( 'wallhax' ); }

class json {
	
	public $config = array();
	public $jsonFile;

	public function __construct($file = '') {
		if (!empty($file)) {
			$this->jsonFile = $file;
			$this->loadFile($this->jsonFile);
		}

	}

	public function set($key, $value = null) {
		$this->config = array_merge($this->config, array($key => $value));
	}

	public function get($key = null) {
		if ( empty($key) ) {
			return $this->config;
		} else if ( array_key_exists($key, $this->config) ) {
			return $this->config[$key];
		}

		return false;
	}

	public function loadFile($file) {
		if ( file_exists($file) && 'json' === strtolower(pathinfo($file, PATHINFO_EXTENSION)) ) {
			$configArray = json_decode(file_get_contents($file), true);
			$this->config = array_merge($this->config, $configArray);
		}

		return $this->config;
	}

	public function saveFile($backup = false) {
		if ( isset($this->jsonFile) && !empty($this->jsonFile) ) {
			if ( true === $backup ) {
				$backupTime = date("Ymd", time());
				$backupPath = slash(pathinfo($this->jsonFile, PATHINFO_DIRNAME));
				$backupName = pathinfo($this->jsonFile, PATHINFO_BASENAME);

				if ( !copy($this->jsonFile, $backupPath . $backupTime . $backupName ) ) {
					return false;
				}
			}

			file_put_contents($this->jsonFile, json_encode($this->config, JSON_PRETTY_PRINT));
		}

		return false;
	}
}