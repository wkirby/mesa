<?php

// Security Check
if (!defined('MESA')) { die( 'wallhax' ); }

class Mesa {

	public $config;
	public $query;

	public function __construct() {
		$this->config = new MesaConfig( trailingslash(ROOT) . 'mesa.json' );
		$this->query = new MesaQuery( array('id' => get_query('id'), 'type' => get_query('type')));
		$this->template = MesaTemplate::getTemplate($this->config->get('theme'), $this->query->id, $this->query->type);
	}

	public function load() {
		$mesa = $this;
		$query= $this->query;
		$conf = $this->config;
		include($this->template);
	}
}