<?php

// Security Setup
if (!isset($root)) { die('wallhax'); }
define('MESA', true);

// Universal Setup
require('security.php');
require('utilities.php');

// Require Core Classes
include('config.cls.php');
include('mesa.cls.php');
include('parsedown.cls.php');
include('page.cls.php');
include('query.cls.php');
include('template.cls.php');

// Setup Config
conf::set('root', $root);
conf::set('urlscheme', array_key_exists('HTTPS', $_SERVER) ? 'https://' : 'http://');
conf::set('siteurl', slash( conf::get('urlscheme') . $_SERVER['HTTP_HOST'] ));

// Define Constants
define("ROOT",       slash( $root));
define('URLSCHEME',  conf::get('urlscheme'));
define('SITEURL',    conf::get('siteurl'));
define("ADMINDIR",   slash( ROOT . 'admin'));
define("CONTENTDIR", slash( ROOT . 'content'));
define("UPLOADSDIR", slash( ROOT . 'uploads'));
define("THEMESDIR",  slash( ROOT . 'themes'));

// Load Configuration File
conf::loadFile( ROOT . 'mesa.json');