<?php
/**
 * Installation file for CSVI
 *
 * @package 	CSVI
 * @author 		Roland Dalmulder
 * @link 		http://www.csvimproved.com
 * @copyright 	Copyright (C) 2006 - 2012 RolandD Cyber Produksi
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: script.php 1891 2012-02-11 10:43:52Z RolandD $
 */

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

/**
 * Load the CSVI installer 
 * 
 * @copyright 
 * @author 		RolandD
 * @todo 
 * @see 
 * @access 		public
 * @param 
 * @return 
 * @since 		3.0
 */
class com_csviInstallerScript {
	
	/**
	 * method to install the component
	 *
	 * @return void
	 */
	function install($parent) 
	{
		// $parent is the class calling this method
		$parent->getParent()->setRedirectURL('index.php?option=com_csvi&view=install');
	}
 
	/**
	 * method to uninstall the component
	 *
	 * @return void
	 */
	function uninstall($parent) 
	{
		// $parent is the class calling this method
		echo JText::_('COM_CSVI_UNINSTALL_TEXT');
	}
 
	/**
	 * method to update the component
	 *
	 * @return void
	 */
	function update($parent) 
	{
		// $parent is the class calling this method
		$parent->getParent()->setRedirectURL('index.php?option=com_csvi&view=install');
	}
 
	/**
	 * method to run before an install/update/uninstall method
	 *
	 * @return void
	 */
	function preflight($type, $parent) 
	{
		// $parent is the class calling this method
		// $type is the type of change (install, update or discover_install)
		
		// Check if the PHP version is correct
		if (version_compare(phpversion(), '5.3', '<') == '-1') {
			$app = JFactory::getApplication();
			$app->enqueueMessage(JText::sprintf('COM_CSVI_PHP_VERSION_ERROR', phpversion()), 'error');
			return false;
		}
		
		// Check if the Joomla version is correct
		$version = new JVersion();
		if (version_compare($version->getShortVersion(), '1.7.3', '<') == '-1') {
			$app = JFactory::getApplication();
			$app->enqueueMessage(JText::sprintf('COM_CSVI_JOOMLA_VERSION_ERROR', $version->getShortVersion()), 'error');
			return false;
		}
		return true;
	}
 
	/**
	 * method to run after an install/update/uninstall method
	 *
	 * @return void
	 */
	function postflight($type, $parent) 
	{
		// $parent is the class calling this method
		// $type is the type of change (install, update or discover_install)
	}
}
?>