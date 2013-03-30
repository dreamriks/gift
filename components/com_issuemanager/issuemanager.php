<?php
/*
    Document   : issuemanager.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        Main file of Issue Manager regarding the user interface
*/
defined('_JEXEC') or die('Restricted access');
// Include Javascript and css styles
$document =& JFactory::getDocument();
$document->addScript('components/com_issuemanager/scripts/scripts.js', 'text/javascript');
$document->addScript('includes/js/overlib_mini.js', 'text/javascript');
$document->addStyleSheet('components/com_issuemanager/styles/styles.css','text/css');
// load controller
require_once( JPATH_COMPONENT.DS.'controller.php' );
// Load classes which represent the tables of the database. They are stored in the administration directory tree (/tables)
JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_issuemanager'.DS.'tables');
// Load utility classes
require_once(JPATH_COMPONENT.DS.'utils'.DS.'utils.php');
require_once( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_issuemanager'.DS.'utils'.DS.'class.Mail.php' );
require_once( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_issuemanager'.DS.'utils'.DS.'class.DateFormat.php' );

/**
 * Return true if the user is not logued in
 *
 * @return boolean
 */
function is_guest() {
    $user =& JFactory::getUser();
    return $user->guest;
}

// If the user is logued in, he/she is allowed to enter Issue Manager
if (!is_guest()) {
    // Show title of component
    echo '<div class="componentheading">' . JText::_('ISSUEMANAGER') . '</div>';
    // Create controller
    $controller = new IssuemanagerController();
    // Execute controller passing to it the action specified in URL, and if not present, 'display' by default
    $controller->execute( JRequest::getVar( 'task', 'display' ) );
    $controller->redirect();
}
?>
