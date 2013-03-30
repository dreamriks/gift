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

require_once( JPATH_SITE.DS.'components'.DS.'com_fst'.DS.'helper'.DS.'helper.php' );
require_once( JPATH_SITE.DS.'components'.DS.'com_fst'.DS.'helper'.DS.'comments.php' );

$css = JRoute::_( "index.php?option=com_fst&view=css&layout=default" );
$document =& JFactory::getDocument();
$document->addStyleSheet($css); 
$document->addScript( JURI::base().'/components/com_fst/assets/js/jquery.1.6.2.min.js' );
$document->addScript( JURI::base().'/components/com_fst/assets/js/jquery.autoscroll.js' );

$db =& JFactory::getDBO();

JHTML::_('behavior.modal', 'a.modal');
JHTML::_('behavior.mootools');

$prodid = $params->get('prodid');
$dispcount = $params->get('dispcount');
$listtype = $params->get('listtype');
$maxlength = $params->get('maxlength');
$showmore = $params->get('show_more');
$showadd = $params->get('show_add');
$maxheight = $params->get('maxheight');

$comments = new FST_Comments("test",$prodid);
$comments->template = "comments_testmod";
if (FST_Settings::get('comments_testmod_use_custom'))
	$comments->template_type = 2;
	
if ($listtype == 0)
	$comments->opt_order = 2;

$comments->opt_no_mod = 1;
$comments->opt_show_add = 0;
$comments->opt_max_length = $maxlength;

require( JModuleHelper::getLayoutPath( 'mod_fst_test' ) );

?>
