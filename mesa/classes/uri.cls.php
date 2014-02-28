<?php

// Security Check
if (!defined('MESA')) { die( 'wallhax' ); }

class uri {

	public $uri;
	public $url;
	public $parts;

	public function __construct() {
		$this->uri = $_SERVER['REQUEST_URI'];
		$this->url = conf::get('siteurl') . $this->uri;
		$this->parts = $this->parseUri($this->uri);
	}

	public function parseUri($uri) {
		return cleanArray(explode('/', $uri));
	}

	public function getDestination() {
		return end($this->parts);
	}

	public function __toString() {
		return $this->uri;
	}
}