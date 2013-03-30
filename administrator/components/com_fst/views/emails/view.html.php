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


class FstsViewEmails extends JView
{
 
    function display($tpl = null)
    {
        JToolBarHelper::title( JText::_("EMAIL_TEMPLATE_MANAGER"), 'fst_emails' );
        //JToolBarHelper::deleteList();
        JToolBarHelper::editListX();
        //JToolBarHelper::addNewX();
        JToolBarHelper::cancel('cancellist');
		FSTAdminHelper::DoSubToolbar();

        $this->assignRef( 'data', $this->get('Data') );

        parent::display($tpl);
    }
}


