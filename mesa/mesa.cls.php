<?php

// Security Check
if (!defined('MESA')) { die( 'wallhax' ); }

class Mesa {

	public $query;
	public $template;

	public function __construct() {
		$requestArray = array(
			'id' => getQuery('id'),
			'type' => getQuery('type')
		);
		$this->query    = new MesaQuery( $requestArray );
		$this->template = new MesaTemplate( $this->query );
	}

	public function load() {
		$mesa = $this;
		$query = $this->query;
		$config = conf::get();
		
		include( $this->template->templateFile );
	}
}