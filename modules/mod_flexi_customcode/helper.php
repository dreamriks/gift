<?php
/**
* Flexi Custom Code - Joomla Module
* Version			: 1.0
* Created by		: RBO Team > Project::: RumahBelanja.com, Demo::: MedicRoom.com
* Created on		: v1.0 - December 16th, 2010
* Updated			: n/a
* Package			: Joomla 1.5.x
* License			: http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

//if (!class_exists('mod_flexi_customcode')) {

	class modFlexiCustomCode {
		function parsePHPviaFile($custom) {
			$tmpfname = tempnam("/tmp", "html");
			$handle = fopen($tmpfname, "w");
			fwrite($handle, $custom, strlen($custom));
			fclose($handle);
			include_once($tmpfname);
			unlink($tmpfname);
		}
	}
//}

?>