<?php

// Security Check
if (!defined('MESA')) { die( 'wallhax' ); }

class MesaTemplate {

	public function getTemplate($query, $theme) {
		if (!$theme) { die('no theme defined'); }

		if     ( !empty($query->id) && !empty($query->type) && $query->isSingle && $template = self::getTemplateFile("{$query->type}-single.php", $theme)) :
		elseif ( !empty($query->type) && !$query->isSingle && $template = self::getTemplateFile("{$query->type}.php", $theme)) :
		elseif ( !empty($query->id) && $query->isSingle && $template = self::getTemplateFile("single.php", $theme)) :
		else :
			$template = self::getTemplateFile("index.php", $theme);
		endif;

		return $template;
	}

	public function getTemplateFile($file, $theme) {
		$template = THEMESDIR . trailingslash($theme) . $file;

		if ( file_exists($template) ) {
			return $template;
		}

		return false;
	}

}