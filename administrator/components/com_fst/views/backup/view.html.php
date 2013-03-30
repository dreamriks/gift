<?php
/**
* @Copyright Freestyle Joomla (C) 2010
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
*     
* This file is part of Freestyle Testimonials
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
**/
?>
<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );
jimport('joomla.filesystem.file');
require_once (JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_fst'.DS.'updatedb.php');

class FstsViewBackup extends JView
{
    function display($tpl = null)
    {
        JToolBarHelper::title( JText::_("ADMINISTRATION"), 'fst_admin' );
        JToolBarHelper::cancel('cancellist');
		FSTAdminHelper::DoSubToolbar();
		
		$this->log = "";
		
		$task = JRequest::getVar('task');
		$updater = new FSTUpdater();
			
		if ($task == "saveapi")
		{
			return $this->SaveAPI();
				
		}
		if ($task == "cancellist")
		{
			$mainframe = JFactory::getApplication();
			$link = JRoute::_('index.php?option=com_fst&view=fsts',false);
			$mainframe->redirect($link);
			return;			
		}
		if ($task == "update")
		{
			$this->assignRef('log',$updater->Process());
			parent::display();
			return;
		}
				
		if ($task == "backup")
		{
			$this->assignRef('log',$updater->BackupData('fst'));
		}
		
		if ($task == "restore")
		{
			// process any new file uploaded
			$file = JRequest::getVar('filedata', '', 'FILES', 'array');
			if (array_key_exists('error',$file) && $file['error'] == 0)
			{
				$data = file_get_contents($file['tmp_name']);
				$data = unserialize($data);
				
				global $log;
				$log = "";
				$log = $updater->RestoreData($data);
				$this->assignRef('log',$log);
				parent::display();
				return;
			}
			
		}
		
        parent::display($tpl);
    }
	
	function SaveAPI()
	{
		$username = JRequest::getVar('username');
		$apikey = JRequest::getVar('apikey');

		$db = & JFactory::getDBO();
		
		$qry = "REPLACE INTO #__fst_settings (setting, value) VALUES ('fsj_username','{$db->getEscaped($username)}')";
		$db->setQuery($qry);
		$db->Query();
		
		$qry = "REPLACE INTO #__fst_settings (setting, value) VALUES ('fsj_apikey','{$db->getEscaped($apikey)}')";
		$db->setQuery($qry);
		$db->Query();
		
		// update url links
		if (FSTAdminHelper::Is16())
		{
			$updater = new FSTUpdater();
			$updater->SortAPIKey($username, $apikey);
		}
		
		$mainframe = JFactory::getApplication();
		$link = JRoute::_('index.php?option=com_fst&view=backup',false);
		$mainframe->redirect($link);
	}
}
