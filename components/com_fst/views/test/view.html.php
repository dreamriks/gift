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
jimport( 'joomla.mail.helper' );
require_once (JPATH_SITE.DS.'components'.DS.'com_fst'.DS.'helper'.DS.'paginationex.php');
require_once (JPATH_SITE.DS.'components'.DS.'com_fst'.DS.'helper'.DS.'email.php');

JHTML::_('behavior.mootools');
	
require_once (JPATH_SITE.DS.'components'.DS.'com_fst'.DS.'helper'.DS.'comments.php');

class FstViewTest extends JView
{
	var $product = null;

    function display($tpl = null)
    {
		$mainframe = JFactory::getApplication();
		JHTML::_('behavior.modal', 'a.modal');
		JHTML::_('behavior.mootools');

		$user = JFactory::getUser();
		$userid = $user->id;
		$db =& JFactory::getDBO();
		$query = "SELECT * FROM #__fst_user WHERE user_id = '{$db->getEscaped($userid)}'";
		$db->setQuery($query);
		$this->_permissions = $db->loadAssoc();
		$this->params =& $mainframe->getPageParameters('com_fst');
		$this->test_show_prod_mode = $this->params->get('test_show_prod_mode','accordian');
		$this->test_always_prod_select = $this->params->get('test_always_prod_select','0');
		$layout = JRequest::getVar('layout','');
			
		$this->prodid = JRequest::getVar('prodid');
		if ($this->prodid == "")
			$this->prodid = -1;
		
		$this->products = $this->get('Products');
		//print_p($this->products);
		if (count($this->products) == 0)
			$this->prodid = 0;
		
		$this->comments = new FST_Comments("test",$this->prodid);
		if ($this->prodid == -1)
			$this->comments->opt_show_posted_message_only = 1;
			
		if ($layout == "create")
		{
			$this->setupCommentsCreate();	
		}
			
		if ($this->comments->Process())
			return;
			
		if ($layout == "create")
			return $this->displayCreate();
			
		if ($this->prodid != -1)
		{
			return $this->displaySingleProduct();	
		}

		return $this->displayAllProducts();
		
 	}
	
	function setupCommentsCreate()
	{
		$this->comments->opt_display = 0;
		$this->comments->comments_hide_add = 0;
		$this->comments->opt_show_form_after_post = 1;
		$this->comments->opt_show_posted_message_only = 1;
	}
	
	function displayCreate()
	{
		$this->tmpl = JRequest::getVar('tmpl','');
		parent::display();	
	}
	
	function displaySingleProduct()
	{
		$this->product = $this->get('Product');
		$this->products = $this->get('Products');	
		
        $mainframe = JFactory::getApplication();
		$pathway =& $mainframe->getPathway();
		if (FST_Helper::NeedBaseBreadcrumb($pathway, array( 'view' => 'test' )))	
			$pathway->addItem(JText::_('TESTIMONIALS'), JRoute::_( 'index.php?option=com_fst&view=test' ) );
        $pathway->addItem($this->product['title']);
		
		// no product then general testimonials
		if (!$this->product && count($this->products) > 0)
		{
			$this->product = array();
			$this->product['title'] = JText::_('GENERAL_TESTIMONIALS');	
			$this->product['id'] = 0;
			$this->product['description'] = '';
			$this->product['image'] = '/components/com_fst/assets/images/generaltests.png';
		}
		
		if ($this->test_always_prod_select)
		{
			$this->comments->show_item_select = 1;
		} else {
			$this->comments->show_item_select = 0;
		}
		parent::display("single");
	}
	
	function displayAllProducts()
	{
		$this->products = $this->get('Products');
		if (!is_array($this->products))
			$this->products = array();
		
		$this->showresult = 1;
		
        $mainframe = JFactory::getApplication();
        $pathway =& $mainframe->getPathway();
		if (FST_Helper::NeedBaseBreadcrumb($pathway, array( 'view' => 'test' )))	
			$pathway->addItem(JText::_('TESTIMONIALS'), JRoute::_( 'index.php?option=com_fst&view=test' ) );
 
		if (FST_Settings::get('test_allow_no_product'))
		{
			$noproduct = array();
			$noproduct['id'] = 0;
			$noproduct['title'] = JText::_('GENERAL_TESTIMONIALS');
			$noproduct['description'] = '';
			$noproduct['image'] = '/components/com_fst/assets/images/generaltests.png';
			$this->products = array_merge(array($noproduct), $this->products);
		}
		
		if ($this->test_show_prod_mode != "list")
		{
			$idlist = array();
			if (count($this->products) > 0)
			{
				foreach($this->products as &$prod) 
				{
					$prod['comments'] = array();
					$idlist[] = $prod['id'];	
				}
			}
			
			// not in normal list mode, get comments for each product
			
			$this->comments->itemid = $idlist;
			
			$this->comments->GetComments();
						
			foreach($this->comments->_data as &$data)
			{
				if ($data['itemid'] > 0)
					$this->products[$data['itemid']]['comments'][] =& $data;
			}
		}
		
		parent::display();
	}
}

