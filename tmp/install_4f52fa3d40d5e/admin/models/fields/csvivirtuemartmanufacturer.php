<?php
/**
 * List the VirtueMart manufacturers
 *
 * @package 	CSVI
 * @author 		Roland Dalmulder
 * @link 		http://www.csvimproved.com
 * @copyright 	Copyright (C) 2006 - 2012 RolandD Cyber Produksi
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: csvivirtuemartmanufacturer.php 1891 2012-02-11 10:43:52Z RolandD $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.helper');
JFormHelper::loadFieldClass('CsviForm');

/**
 * Select list form field with manufacturers
 *
 * @package CSVI
 */
class JFormFieldCsviVirtuemartManufacturer extends JFormFieldCsviForm {

	protected $type = 'CsviVirtuemartManufacturer';

	/**
	 * Specify the options to load based on default site language
	 *
	 * @copyright
	 * @author 		RolandD
	 * @todo
	 * @see
	 * @access 		protected
	 * @param
	 * @return 		array	an array of options
	 * @since 		4.0
	 */
	protected function getOptions() {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select($db->quoteName('id').','.$db->quoteName('name'));
		$query->from($db->quoteName('#__csvi_template_settings'));
		$query->where($db->quoteName('type').' = '.$db->quote('export'));
		$query->where($db->quoteName('settings').' LIKE '.$db->Quote('%"export_frontend":"1"%'));
		$db->setQuery($query);
		$templates = $db->loadObjectList();
		return $templates;
	}
}
?>
