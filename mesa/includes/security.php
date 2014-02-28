<?php

// Security Check
if (!defined('MESA')) { die( 'wallhax' ); }

// Verify PHP Version
if ( floatval(phpversion()) < 5.4) { die('Please install PHP 5.4 or newer.'); }

// Set Timezone