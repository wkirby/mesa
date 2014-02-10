<?php

// Set $root
$root = dirname(__FILE__);

// Check for Mesa
if ( !file_exists('mesa/mesa.php') ) {
	die('Mesa is not properly installed.');
}

// Run Mesa
require('mesa/mesa.php');
$mesa = new Mesa();
$mesa->load();