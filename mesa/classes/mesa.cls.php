<?php

// Security Check
if (!defined('MESA')) { die( 'wallhax' ); }

class Mesa {

	public $uri;

	public function __construct() {
		if( stripos($_SERVER['REQUEST_URI'], 'index.php')) {
			$redirect = str_ireplace("index.php", "", $_SERVER['REQUEST_URI']);
			$redirect = realpath($redirect);
			header('Location:' . $redirect);
			exit();
		}

		 $this->uri = new uri();
	}

	public function load() {
		$this->findContent();
		$this->getTemplate();
		$this->render();
	}

	public function render() {
		$page = $this->page;
		$mesa = $this;
		include( $this->template );
	}

	public function findContent() {
		$path = slash( conf::get('contentPath') . $this->uri );

		if ( is_dir($path) ) {
			$file = $this->uri->getDestination() . '.txt';
			if( file_exists($path . $file) ) {
				$page = $path . $file;
			} elseif ( file_exists($path . 'home.txt') ) {
				$page = $path . 'home.txt' ;
			} elseif ( file_exists($path . 'index.txt') ) {
				$page = $path . 'index.txt' ;
			} else {
				$page = "404";
			}
		} elseif ( file_exists(unslash($path) . '.txt' ) ) {
			$page = unslash($path) . '.txt';
		} else {
			$page = "404";
		}

		$this->page = new page($page);
	}

	public function getTemplate() {
		$this->template = slash(conf::get('themesPath')) . slash(conf::get('theme')) . 'index.php';
	}

	public function getChildren() {

	}
}