<?php

// Security Check
if (!isset($root)) { die( 'wallhax' ); }
define('MESA', true);

// Includes
include('includes/security.php');
include('includes/utilities.php');

// Classes
include('classes/conf.cls.php');
include('classes/file.cls.php');
include('classes/json.cls.php');
include('classes/mesa.cls.php');
include('classes/record.cls.php');
include('classes/user.cls.php');
include('classes/uri.cls.php');
include('classes/page.cls.php');
include('classes/parsedown.cls.php');

// Setup Config
conf::loadFile(slash($root) . 'mesa.json');

conf::set('root', slash($root));
conf::set('urlscheme', array_key_exists('HTTPS', $_SERVER) ? 'https://' : 'http://');
conf::set('host', $_SERVER['HTTP_HOST']);
conf::set('siteurl', conf::get('urlscheme') . conf::get('host'));

conf::set('contentPath', conf::get('root') . conf::get('contentDir'));
conf::set('mediaPath', 	 conf::get('root') . conf::get('mediaDir'));
conf::set('pluginsPath', conf::get('root') . conf::get('pluginsDir'));
conf::set('themesPath',  conf::get('root') . conf::get('themesDir'));

// Server Setup
@date_default_timezone_set(conf::get('timezone'));

// Check Installation
if ( !is_dir( conf::get('contentPath'))) { die("The Mesa Content Directory is missing."); }
if ( !is_dir( conf::get('mediaPath')))   { die("The Mesa Media Directory is missing."); }
if ( !is_dir( conf::get('themesPath')))  { die("The Mesa Themes Directory is missing."); }
if ( !is_dir( conf::get('pluginsPath'))) { die("The Mesa Plugins Directory is missing."); }