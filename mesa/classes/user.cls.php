<?php

// Security Check
if (!defined('MESA')) { die( 'wallhax' ); }

class user {

	public function getGravatar( $email, $size = 80, $default = 'identicon') {
	    $url = conf::get('urlscheme') . 'www.gravatar.com/avatar/';
	    $url .= md5( strtolower( trim( $email ) ) );
	    $url .= "?";
	    $url .= http_build_query( array("s" => $size, "d" => $default));
	    return $url;
	}
}