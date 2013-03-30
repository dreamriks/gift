<?php
/**
* @Enterprise:	S&S Media Solutions
* @author:	 Yannick Spang
* @url:	 http://www.joomla-virtuemart-designs.com
* @copyright:	Copyright (C) 2008 - 2009 S&S Media Solutions
* @license GNU/GPL, see on http://www.gnu.org/licenses/gpl-2.0.html
* @product:	SSMedia - Latest Virtuemart Reviews
* @version:	1.0
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$db	=& JFactory::getDBO();
$user =& JFactory::getUser();

$document 	= & JFactory::getDocument();
$document->addStyleSheet(JURI::base(true).'/modules/mod_latest_VM_reviews/tmpl/style.css');

$limit = intval( $params->get( 'limit', 10 ) );


$query =	'SELECT r.product_id, r.user_rating, r.review_id, r.comment, p.product_name, u.username, u.name, r.userid'
		  . ' FROM #__vm_product_reviews r'
		  . ' LEFT JOIN #__vm_product p'
		  . ' ON r.product_id = p.product_id'
		  . ' LEFT JOIN #__users u'
		  . ' ON r.userid = u.id'
		  . ' WHERE published = "Y"'
		  . ' ORDER BY time DESC'
		  . ' LIMIT 0,'.$limit
		  ;
		  
$reviewcount = "http://www.yagendoo.com";		  
$db->setQuery($query);
$rows = $db->loadObjectList();