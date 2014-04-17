<?php

class db {
	private $db = array();
	private $filename = null;

	public function __construct($filename) {
		if ( !empty($filename) && 'json' === strtolower(pathinfo($filename, PATHINFO_EXTENSION)) ) {
			$this->filename = $filename;
			$this->load();
		}
	}

	public function set($key, $value = null) {
		$this->db = array_merge($this->db, array($key => $value));
	}

	public function get($key = null, $value = null) {
		if ( empty($key) ) {
			return $this->db;
		} elseif ( array_key_exists($key, $this->db) ) {
			return $this->db[$key];
		}

		return false;
	}

	private function load() {
		if ( $handle = fopen($this->filename, 'r')) {

			if ( flock($handle, LOCK_EX) ) {
				$this->db = json_decode(fread($handle, filesize($this->filename)), true);
				flock($handle, LOCK_UN);
			}

			return(fclose($handle));
		}

		return false;
	}

	public function save() {

		if ( $handle = fopen($this->filename, 'w+')) {
				
			if ( flock($handle, LOCK_EX) ) {
				fwrite($handle, json_encode((array)$this->db, JSON_PRETTY_PRINT));
				flock($handle, LOCK_UN);
			}

			return(fclose($handle));
		}

		return false;
	}

	public static function getByName($db) {
		return new self($db);
	}

	/**
	 * SQL Helper Functions
	 */

	public static function getIndexForItem( $array, $key, $value ) {
		foreach ( $array as $index => $row ) {
			if ( $row[$key] === $value ) {
				return $index;
			}
		}

		return false;
	}

	public static function __select( $array, callable $cp, $one ) {
		$return = array();

		foreach ( $array as $index => $row ) {
			if ( $cp($row) ) {
				if ( $one ) { return $row; }
				$return[] = $row;
			}
		}

		return count($return) ? $return : false;
	}

	public static function select_equal($array, $key, $value, $one) {
		$func = sprintf('return $row["%s"] === "%s";', $key, $value);
		$cp = create_function('$row', $func);
		return self::__select($array, $cp, $one);
	}

	public static function select_one($array, $key, $value) {
		return self::select_equal($array, $key, $value, true);
	}

	public static function select_all($array, $key, $value) {
		return self::select_equal($array, $key, $value, false);
	}
}