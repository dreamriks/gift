<?php
/**
 * About model
 *
 * @package 	CSVI
 * @author 		Roland Dalmulder
 * @link 		http://www.csvimproved.com
 * @copyright 	Copyright (C) 2006 - 2012 RolandD Cyber Produksi
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: about.php 1891 2012-02-11 10:43:52Z RolandD $
 */

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

jimport( 'joomla.application.component.model' );

/**
 * About Model
 *
* @package CSVI
 */
class CsviModelAbout extends JModel {

	/**
	* Check folder permissions
	*
	* @author RolandD
	* @since 2.3.10
	* @access public
	* @return array of folders and their permissions
	*/
	public function getFolderCheck() {
		$config = JFactory::getConfig();
		$tmp_path = JPath::clean($config->getValue('config.tmp_path'), '/');
		$folders = array();
		$root = JPath::clean(JPATH_ROOT, '/');
		$folders[$tmp_path] = JFolder::exists($tmp_path);
		$folders[CSVIPATH_TMP] = JFolder::exists(CSVIPATH_TMP);
		$folders[CSVIPATH_DEBUG] = JFolder::exists(CSVIPATH_DEBUG);

		return $folders;
	}

	/**
	 * Check the latest version of CSVI VirtueMart
	 *
	 * @copyright
	 * @author 		RolandD
	 * @todo
	 * @see
	 * @access 		public
	 * @param
	 * @return 		string	the status of the version check
	 * @since 		3.0
	 */
	public function checkVersion() {
		// Read the version file
		$cur_version = file_get_contents('http://www.csvimproved.com/csvi.ver');
		$this_version = JText::_('COM_CSVI_CSVI_VERSION');
		if (version_compare($cur_version, $this_version) == '1') return JText::sprintf('COM_CSVI_NEW_VERSION_AVAILABLE', $this_version, $cur_version);
		else return JText::sprintf('COM_CSVI_VERSION_UPTODATE', $cur_version);
	}

	/**
	 * Create missing folders
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
	public function createFolder() {
		$app = JFactory::getApplication();
		jimport('joomla.filesystem.folder');
		$folder = str_ireplace(JPATH_ROOT, '', JRequest::getVar('folder'));
		return JFolder::create($folder);
	}
}
?>