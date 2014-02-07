<?php

// Set $root
$root = dirname(__FILE__);

// Check for Mesa
if ( !file_exists('mesa/mesa.php') ) { die('Mesa is not properly installed.'); }
require('mesa/mesa.php');

// Set Up Base Query
$mesa = new MesaQuery( array('id' => get_query('id'), 'type' => get_query('type')));

// Set Up Theme
$theme = $conf->get('theme');
$template = THEMESDIR . trailingslash($theme) . 'index.php';

// Render Page
include($template);