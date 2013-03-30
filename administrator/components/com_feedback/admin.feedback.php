<?php
/**
 * @version		1.2 feedback $
 * @package		feedback
 * @copyright	Copyright © 2010 Mertonium. All rights reserved.
 * @license		GNU/GPL
 * @author		Mertonium
 * @author mail	john@mertonium.com
 * @website		http://mertonium.com
 *
 *
 * @MVC architecture generated by MVC generator tool at http://www.alphaplug.com
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// Require the base controller
require_once (JPATH_COMPONENT.DS.'controller.php');

// Require specific controller if requested
if($controller = JRequest::getWord('controller','feedback')) {
	$path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
	if (file_exists($path)) {
		require_once $path;
	} else {
		$controller = '';
	}
}
// Create the controller
$classname    = 'feedbackController'.$controller;	
$controller   = new $classname( );

// Perform the Request task
$controller->execute(JRequest::getVar('task', null, 'default', 'cmd'));
$controller->redirect();
?>