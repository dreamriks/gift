<?php
/*
    Document   : admin.issuemanager.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        Main file for administration interface
*/

    defined( '_JEXEC' ) or die( 'Restricted access' );
    // Include stylesheet for backend
    $document =& JFactory::getDocument();
    $document->addStyleSheet('components/com_issuemanager/styles/icons.css','text/css');
    // Include view in admin.issuemanager.html.php (follows Joomla name conventions)
    require_once( JApplicationHelper::getPath( 'admin_html' ) );
    // Load controller file
    require_once( JPATH_COMPONENT.DS.'controller.php' );
    // Load clases TableTicket, TablePost y TableOperator
    JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');
    // Create controller instace, and tell it to execute display_tickets() by default if no other action is specified
    $controller = new IssuemanagerController( array('default_task' => 'display_tickets') );
    // Execute action of controller specified by 'task' var. If not present, display_tickets() will be executed
    $controller->execute( JRequest::getVar( 'task' , 'display_tickets' ) );
    $controller->redirect();
?>