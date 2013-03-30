<?php

require_once (JPATH_SITE.DS.'components'.DS.'com_fst'.DS.'helper'.DS.'settings.php');

class FSTAdminHelper
{
	function PageSubTitle2($title,$usejtext = true)
	{
		if ($usejtext)
			$title = JText::_($title);
		
		return str_replace("$1",$title,FST_Settings::get('display_h3'));
	}
	
	function IsFAQs()
	{
		if (JRequest::getVar('option') == "com_fsf")
			return true;
		return false;	
	}
	
	function IsTests()
	{
		if (JRequest::getVar('option') == "com_fst")
			return true;
		return false;	
	}
	
	function GetVersion($path = "")
	{
		
		global $fsj_version;
		if (empty($fsj_version))
		{
			if ($path == "") $path = JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_fst';
			$file = $path.DS.'fst.xml';
			
			if (!file_exists($file))
				return FST_Settings::get('version');
			
			$xml = simplexml_load_file($file);
			
			$fsj_version = $xml->version;
		}

		if ($fsj_version == "[VERSION]")
			return FST_Settings::get('version');
			
		return $fsj_version;
	}	

	function GetInstalledVersion()
	{
		return FST_Settings::get('version');
	}
	
	function Is16()
	{
		global $fsjjversion;
		if (empty($fsjjversion))
		{
			$version = new JVersion;
			$fsjjversion = 1;
			if ($version->RELEASE == "1.5")
				$fsjjversion = 0;
		}
		return $fsjjversion;
	}

	function DoSubToolbar()
	{
		if (!FST_Helper::Is16())
		{
			JToolBarHelper::divider();
			JToolBarHelper::help("help.php?help=admin-view-" . JRequest::getVar('view'),true);
			return;
		}

		JToolBarHelper::divider();
		JToolBarHelper::help("",false,"http://www.freestyle-joomla.com/comhelp/fst/admin-view-" . JRequest::getVar('view'));

		$vName = JRequest::getCmd('view', 'fsts');
			
		JSubMenuHelper::addEntry(
			JText::_('COM_FST_OVERVIEW'),
			'index.php?option=com_fst&view=fsts',
			$vName == 'fsts' || $vName == ""
			);
			
		JSubMenuHelper::addEntry(
			JText::_('COM_FST_SETTINGS'),
			'index.php?option=com_fst&view=settings',
			$vName == 'settings'
			);

		JSubMenuHelper::addEntry(
			JText::_('COM_FST_TEMPLATES'),
			'index.php?option=com_fst&view=templates',
			$vName == 'templates'
			);

//

		JSubMenuHelper::addEntry(
			JText::_('COM_FST_PRODUCTS'),
			'index.php?option=com_fst&view=prods',
			$vName == 'prods'
			);

		JSubMenuHelper::addEntry(
			JText::_('COM_FST_MODERATION'),
			'index.php?option=com_fst&view=tests',
			$vName == 'tests'
			);

//
		JSubMenuHelper::addEntry(
			JText::_('COM_FST_USERS'),
			'index.php?option=com_fst&view=fusers',
			$vName == 'fusers'
			);
//

		JSubMenuHelper::addEntry(
			JText::_('COM_FST_EMAIL_TEMPLATES'),
			'index.php?option=com_fst&view=emails',
			$vName == 'emails'
			);
//##NOT_FAQS_END##

		JSubMenuHelper::addEntry(
			JText::_('COM_FST_ADMIN'),
			'index.php?option=com_fst&view=backup',
			$vName == 'backup'
			);

	}	
	
	
	function IncludeHelp($file)
	{
		$lang =& JFactory::getLanguage();
		$tag = $lang->getTag();
		
		$path = JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_fst'.DS.'help'.DS.$tag.DS.$file;
		if (file_exists($path))
			return file_get_contents($path);
		
		$path = JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_fst'.DS.'help'.DS.'en-GB'.DS.$file;
		
		return file_get_contents($path);
	}
}