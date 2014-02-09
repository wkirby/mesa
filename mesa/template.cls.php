<?php

// Security Check
if (!defined('MESA')) { die( 'wallhax' ); }

class MesaTemplate {
	// TODO: Pass Query Object instead of Variables
	public function getTemplate($theme, $id, $type) {
		if (!$theme) { die('no theme defined'); }

		if     ( !empty($id) && !empty($type) && $template = self::getTemplateFile("{$type}-single.php", $theme)) :
		elseif ( !empty($type)                && $template = self::getTemplateFile("{$type}.php", $theme)) :
		elseif ( !empty($id)                  && $template = self::getTemplateFile("single.php", $theme)) :
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