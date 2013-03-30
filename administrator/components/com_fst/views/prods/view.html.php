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


class FstsViewProds extends JView
{
    function display($tpl = null)
    {
        JToolBarHelper::title( JText::_("PRODUCTS"), 'fst_prods' );
        JToolBarHelper::deleteList();
        JToolBarHelper::editListX();
        JToolBarHelper::addNewX();
		JToolBarHelper::divider();
		JToolBarHelper::custom('import','copy','copy','IMPORT_FROM_VIRTUEMART',false);
        JToolBarHelper::cancel('cancellist');
		FSTAdminHelper::DoSubToolbar();

        $this->assignRef( 'lists', $this->get('Lists') );
        $this->assignRef( 'data', $this->get('Data') );
        $this->assignRef( 'pagination', $this->get('Pagination'));

		$categories = array();
		$categories[] = JHTML::_('select.option', '-1', JText::_("IS_PUBLISHED"), 'id', 'title');
		$categories[] = JHTML::_('select.option', '1', JText::_("PUBLISHED"), 'id', 'title');
		$categories[] = JHTML::_('select.option', '0', JText::_("UNPUBLISHED"), 'id', 'title');
		$this->lists['published'] = JHTML::_('select.genericlist',  $categories, 'ispublished', 'class="inputbox" size="1" onchange="document.adminForm.submit( );"', 'id', 'title', $this->lists['ispublished']);

		$what = JRequest::getVar('what');
		if ($what == "togglefield")
			return $this->toggleField();

        parent::display($tpl);
    }

	function toggleField()
	{
		$id = JRequest::getVar('id');
		$field = JRequest::getVar('field');			
		$val = JRequest::getVar('val');	

		if ($field == "")
			return;
		if ($id < 1)
			return;
		if ($field != "inkb" && $field != "insupport" && $field != "intest")
			return;

		$db =& JFactory::getDBO();

		$qry = "UPDATE #__fst_prod SET {$db->getEscaped($field)} = {$db->getEscaped($val)} WHERE id = {$db->getEscaped($id)}";
		$db->setQuery($qry);
		$db->Query();

		echo FST_GetYesNoText($val);
		exit;
	}
}



