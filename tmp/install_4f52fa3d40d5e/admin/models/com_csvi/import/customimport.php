<?php
/**
 * Custom import
 *
 * @package		CSVI
 * @subpackage 	Import
 * @author 		Roland Dalmulder
 * @link		http://www.csvimproved.com
 * @copyright 	Copyright (C) 2006 - 2012 RolandD Cyber Produksi
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: customimport.php 1891 2012-02-11 10:43:52Z RolandD $
 */

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

/**
 * Processor for custom imports
 *
* @package CSVI
 */
class CsviModelCustomimport extends CsviModelImportfile {

	// Private tables
	private $_custom_table = null;

	// Public variables

	/**
	 * Constructor
	 *
	 * @copyright
	 * @author 		RolandD
	 * @todo
	 * @see
	 * @access 		public
	 * @param
	 * @return
	 * @since 		3.4
	 */
	public function __construct() {
		parent::__construct();
		// Load the tables that will contain the data
		$this->_loadTables();
		$this->loadSettings();
    }

	/**
	 * Here starts the processing
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
	public function getStart() {
		// Load the data
		$this->loadData();

		// Get the logger
		$jinput = JFactory::getApplication()->input;
		$csvilog = $jinput->get('csvilog', null, null);

		// Process data
		foreach ($this->csvi_data as $name => $value) {
			// Check if the field needs extra treatment
			switch ($name) {
				default:
					$this->$name = $value;
				break;
			}
		}

		// All good
		return true;
	}

	/**
	 * Process each record and store it in the database
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
	public function getProcessRecord() {
		$jinput = JFactory::getApplication()->input;
		// Get the imported values
		$csvilog = $jinput->get('csvilog', null, null);
		$db = JFactory::getDBO();

		// Clean the tables
		$this->cleanTables();

		// Bind the data
		$this->_custom_table->bind($this);

		// Store the data
		if ($this->_custom_table->store()) {
			if ($this->queryResult() == 'UPDATE') $csvilog->AddStats('updated', JText::_('COM_CSVI_UPDATE_CUSTOM_FIELD'));
			else $csvilog->AddStats('added', JText::_('COM_CSVI_ADD_CUSTOM_FIELD'));
		}
		else $csvilog->AddStats('incorrect', JText::sprintf('COM_CSVI_CUSTOM_FIELD_NOT_ADDED', $this->_custom_table->getError()));

		// Store the debug message
		$csvilog->addDebug(JText::_('COM_CSVI_CUSTOM_FIELD_QUERY'), true);
	}

	/**
	 * Load the custom related tables
	 *
	 * @copyright
	 * @author		RolandD
	 * @todo
	 * @see
	 * @access 		private
	 * @param
	 * @return
	 * @since 		3.0
	 */
	private function _loadTables() {
		$this->_custom_table = $this->getTable('custom_table');
	}

	/**
	 * Cleaning the custom related tables
	 *
	 * @copyright
	 * @author 		RolandD
	 * @todo
	 * @see
	 * @access 		protected
	 * @param
	 * @return
	 * @since 		3.0
	 */
	protected function cleanTables() {
		$this->_custom_table->reset();

		// Clean local variables
		$class_vars = get_class_vars(get_class($this));
		foreach ($class_vars as $name => $value) {
			if (substr($name, 0, 1) != '_') {
				$this->$name = $value;
			}
		}
	}
}
?>
