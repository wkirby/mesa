<?php

// Security Check
if (!defined('MESA')) { die( 'wallhax' ); }

class MesaTemplate {

	public $query;
	public $themePath;
	public $templateFile;

	public function __construct($query) {
		$this->query = $query;
		$this->themePath = THEMESDIR . slash(conf::get('theme'));
		
		$this->getTemplate();
	}

	public function getTemplate() {

		if     ( !empty($this->query->id) && !empty($this->query->type) && $this->query->isSingle && $template = self::getTemplateFile("{$this->query->type}-single.php")) :
		elseif ( !empty($this->query->type) && !$this->query->isSingle && $template = self::getTemplateFile("{$this->query->type}.php")) :
		elseif ( !empty($this->query->id) && $this->query->isSingle && $template = self::getTemplateFile("single.php")) :
		else :
			$template = $this->getTemplateFile("index.php");
		endif;

		$this->templateFile = $template;
	}

	public function getTemplateFile($file) {
		$template = $this->themePath . $file;

		if ( file_exists($template) ) {
			return $template;
		}

		return false;
	}

	public function __toString() {
		return $this->templateFile;
	}

}