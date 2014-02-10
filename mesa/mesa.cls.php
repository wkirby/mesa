<?php

// Security Check
if (!defined('MESA')) { die( 'wallhax' ); }

class Mesa {

	public $config;
	public $query;

	public function __construct() {
		$this->config   = new MesaConfig( trailingslash(ROOT) . 'mesa.json' );
		$this->query    = new MesaQuery( array('id' => get_query('id'), 'type' => get_query('type')));
		$this->template = new MesaTemplate($this->query, $this->config->get('theme'));
	}

	public function load() {
		$mesa = $this;
		$query = $this->query;
		$config = $this->config;
		
		include($this->template->templateFile);
	}
}