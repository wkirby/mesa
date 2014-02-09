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

// Define Constants
define("ROOT",       trailingslash( $root));
define('URLSCHEME',  array_key_exists('HTTPS', $_SERVER) ? 'https://' : 'http://');
define('SITEURL',    trailingslash( URLSCHEME . $_SERVER['HTTP_HOST']));
define("ADMINDIR",   trailingslash( ROOT . 'admin'));
define("CONTENTDIR", trailingslash( ROOT . 'content'));
define("UPLOADSDIR", trailingslash( ROOT . 'uploads'));
define("THEMESDIR",  trailingslash( ROOT . 'themes'));