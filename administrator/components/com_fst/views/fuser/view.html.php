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

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );



class FstsViewFuser extends JView
{

	function display($tpl = null)
	{
		if (JRequest::getString('task') == "prods")
			return $this->displayProds();
			
//
		
		$user 	=& $this->get('Data');
		$isNew		= ($user->id < 1);

		$db	= & JFactory::getDBO();

		$text = $isNew ? JText::_("NEW") : JText::_("EDIT");
		JToolBarHelper::title(   JText::_("USER").': <small><small>[ ' . $text.' ]</small></small>' , 'fst_users');
		JToolBarHelper::save();
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}
		FSTAdminHelper::DoSubToolbar();
		
		if ($isNew)
		{
			$users =& $this->get("Users");
			$this->assignRef('users',JHTML::_('select.genericlist',  $users, 'user_id', 'class="inputbox" size="1" ', 'id', 'name'));
			
			$groups =& $this->get("Groups");
			$this->assignRef('groups',JHTML::_('select.genericlist',  $groups, 'group_id', 'class="inputbox" size="1" ', 'id', 'name'));

			$this->assignRef('type',  JHTML::_('select.booleanlist', 'type', 
				array('class' => "inputbox",
							'size' => "1", 
							'onclick' => "DoAllTypeChange();"),0, 'Group', 'User' ) );
				
			if (count($users) == 0)
			{
				$this->assign('showtypes',0);
				$this->assign('showusers',0);
				$this->assign('showgroups',1);	
			} else if (count($groups) == 0) {
				$this->assign('showtypes',0);
				$this->assign('showusers',1);
				$this->assign('showgroups',0);				
			} else {
				$this->assign('showtypes',1);
				$this->assign('showusers',1);
				$this->assign('showgroups',0);				
			}
				
		} else {
			$input = "<input type='hidden' name='user_id' id='user_id' value='" . $user->user_id . "' />";
			$this->assign('users',$input.$user->name);	
			
			$this->assign('showtypes',0);
			
			if ($user->user_id > 0)
			{
				$this->assign('showusers',1);
				$this->assign('showgroups',0);
			} else {
				$this->assign('showusers',0);
				$this->assign('showgroups',1);
			}
			
			//$input = "<input type='hidden' name='group_id' id='group_id' value='" . $user->group_id . "' />";
			//$this->assign('groups',$input.$user->groupname);
			$this->groups = "";	
		}


		$artperms = array();
        $artperms[] = JHTML::_('select.option', '0', JText::_("ART_NONE"), 'id', 'title');
        $artperms[] = JHTML::_('select.option', '1', JText::_("AUTHOR"), 'id', 'title');
        $artperms[] = JHTML::_('select.option', '2', JText::_("EDITOR"), 'id', 'title');
        $artperms[] = JHTML::_('select.option', '3', JText::_("PUBLISHER"), 'id', 'title');
        $this->assign('artperms',JHTML::_('select.genericlist',  $artperms, 'artperm', 'class="inputbox" size="1"', 'id', 'title', $user->artperm));

//




		$this->assignRef('user', $user);

		parent::display($tpl);
	}
	
	function displayProds()
	{
		$user_id = JRequest::getInt('user_id',0);
		$db	= & JFactory::getDBO();

		$query = "SELECT * FROM #__fst_user_prod as u LEFT JOIN #__fst_prod as p ON u.prod_id = p.id WHERE u.user_id = '{$db->getEscaped($user_id)}'";
		$db->setQuery($query);
		$products = $db->loadObjectList();
		
		$query = "SELECT * FROM #__fst_user WHERE id = '{$db->getEscaped($user_id)}'";
		$db->setQuery($query);
		$userpermissions = $db->loadObject();
		
		$jid = $userpermissions->user_id;
		
		$query = "SELECT * FROM #__users WHERE id = '{$db->getEscaped($jid)}'";
		$db->setQuery($query);
		$joomlauser = $db->loadObject();
		
		$this->assignRef('userpermissions',$userpermissions);
		$this->assignRef('joomlauser',$joomlauser);
		$this->assignRef('products',$products);
		parent::display();
	}
	
	function displayDepts()
	{
		$user_id = JRequest::getInt('user_id',0);
		$db	= & JFactory::getDBO();

		$query = "SELECT * FROM #__fst_user_dept as u LEFT JOIN #__fst_ticket_dept as p ON u.ticket_dept_id = p.id WHERE u.user_id = '{$db->getEscaped($user_id)}'";
		$db->setQuery($query);
		$departments = $db->loadObjectList();
		
		$query = "SELECT * FROM #__fst_user WHERE id = '{$db->getEscaped($user_id)}'";
		$db->setQuery($query);
		$userpermissions = $db->loadObject();
		
		$jid = $userpermissions->user_id;
		
		$query = "SELECT * FROM #__users WHERE id = '{$db->getEscaped($jid)}'";
		$db->setQuery($query);
		$joomlauser = $db->loadObject();
		
		$this->assignRef('userpermissions',$userpermissions);
		$this->assignRef('joomlauser',$joomlauser);
		$this->assignRef('departments',$departments);
		parent::display();
	}
	
	function displayCats()
	{
		$user_id = JRequest::getInt('user_id',0);
		$db	= & JFactory::getDBO();

		$query = "SELECT * FROM #__fst_user_cat as u LEFT JOIN #__fst_ticket_cat as p ON u.ticket_cat_id = p.id WHERE u.user_id = '{$db->getEscaped($user_id)}'";
		$db->setQuery($query);
		$catogries = $db->loadObjectList();
		
		$query = "SELECT * FROM #__fst_user WHERE id = '{$db->getEscaped($user_id)}'";
		$db->setQuery($query);
		$userpermissions = $db->loadObject();
		
		$jid = $userpermissions->user_id;
		
		$query = "SELECT * FROM #__users WHERE id = '{$db->getEscaped($jid)}'";
		$db->setQuery($query);
		$joomlauser = $db->loadObject();
		
		$this->assignRef('userpermissions',$userpermissions);
		$this->assignRef('joomlauser',$joomlauser);
		$this->assignRef('catogries',$catogries);
		parent::display();
	}
}


