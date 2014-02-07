<?php

// Security Setup
if (!isset($root)) { die('wallhax'); }
define('MESA', true);

// Universal Setup
require('security.php');
require('utilities.php');

// Require Core Classes
include('config.cls.php');
include('parsedown.cls.php');
include('page.cls.php');
include('query.cls.php');

// Set up Config
$conf = new MesaConfig( trailingslash($root) . 'mesa.json' );
$conf->set('urlscheme', array_key_exists('HTTPS', $_SERVER) ? 'https://' : 'http://');
$conf->set('url', trailingslash( $conf->get('urlscheme') . $_SERVER['HTTP_HOST']));

// Define Constants
define('SITEURL',    $conf->get('url'));
define("ROOT",       trailingslash( $root));
define("ADMINDIR",   trailingslash( ROOT . 'admin'));
define("CONTENTDIR", trailingslash( ROOT . 'content'));
define("UPLOADSDIR", trailingslash( ROOT . 'uploads'));
define("THEMESDIR",  trailingslash( ROOT . 'themes'));