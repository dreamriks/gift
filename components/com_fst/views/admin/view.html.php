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

// no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');
jimport('joomla.utilities.date');
jimport('joomla.filesystem.file');
JHTML::_('behavior.mootools');

//

require_once (JPATH_SITE.DS.'components'.DS.'com_fst'.DS.'helper'.DS.'email.php');
require_once (JPATH_SITE.DS.'components'.DS.'com_fst'.DS.'helper'.DS.'parser.php');
require_once (JPATH_SITE.DS.'components'.DS.'com_fst'.DS.'helper'.DS.'helper.php');
require_once (JPATH_SITE.DS.'components'.DS.'com_fst'.DS.'helper'.DS.'comments.php');


class FstViewAdmin extends JView
{
	var $parser = null;
	var $layoutpreview = 0;

    function display($tpl = null)
    {
		JHTML::_('behavior.modal', 'a.modal');

		$user =& JFactory::getUser();
		$this->userid = $user->get('id');

		// remove any admin open stuff
		$_SESSION['admin_create'] = 0;
		$_SESSION['admin_create_user_id'] = 0;
		$_SESSION['ticket_email'] = "";
		$_SESSION['ticket_name'] = "";

		// set up permissions
        $mainframe = JFactory::getApplication();
        $aparams = $mainframe->getPageParameters('com_fst');
		$this->assignRef('permission',FST_Helper::getPermissions());
		$model = $this->getModel();
		$model->_perm_where = $this->permission['perm_where'];
		
		// sort layout
        $layout = JRequest::getVar('layout',  JRequest::getVar('_layout', ''));
    	$this->assignRef('layout',$layout);
		 	
//
			return $this->displayModerate();
			
//
    }
	
//

	function displayModerate()
	{
		if (!$this->permission['mod_kb'])
			return $this->NoPerm();
		
		$this->GetCounts();
		
		if ($this->comments->Process())
			return;
			
		parent::display();
	}
	
//
	
	function GetCounts()
	{
//
			
		$this->contentmod = 0;
		$this->comments = new FST_Comments(null,null);
		$this->moderatecount = $this->comments->GetModerateTotal();
	}
	
//
	
	function NoPerm()
	{
		//echo "needLogin : Current Layout : " . $this->getLayout() . "<br>";
		if (array_key_exists('REQUEST_URI',$_SERVER))
		{
			$url = $_SERVER['REQUEST_URI'];//JURI::current() . "?" . $_SERVER['QUERY_STRING'];
		} else {
			$option = JRequest::getString('option','');
			$view = JRequest::getString('view','');
			$layout = JRequest::getString('layout','');
			$Itemid = JRequest::getInt('Itemid',0);
			$url = JRoute::_("index.php?option=" . $option . "&view=" . $view . "&layout=" . $layout . "&Itemid=" . $Itemid); 	
		}

		$url = str_replace("&what=find","",$url);
		$url = base64_encode($url);

		$this->assignRef('return',$url);

		$this->setLayout("noperm");
		parent::display();
	}
	
//

}

