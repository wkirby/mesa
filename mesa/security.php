<?php

// Prevent Direct Access
if (!defined('MESA')) { die('Hackerz OMG'); }

// Verify PHP Version
if ( floatval(phpversion()) < 5.4) { die('Please install PHP 5.4 or newer.'); }