<?php
/*
    Document   : toolbar.issuemanager.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        File with the logic to display a toolbar in the administration interface depending on the value of variable 'task'
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

// Load the file that loads the output HTML for the toolbars.
// Following a name convention, this file is called toolbar-issuemanager.php and the string provided is 'toolbar_html'.
// So the path to load is the one to the file called toolbar.issuemanager.html.php
require_once( JApplicationHelper::getPath( 'toolbar_html' ) );
switch($task)
{
    case 'view_ticket':
    case 'ticket_resolved':
    case 'ticket_unresolved':
    case 'open_ticket':
    case 'close_ticket':
    case 'add_post':
        TOOLBAR_issuemanager::_TICKET();
        break;
    case 'display_operators':
    case 'add_operator':
    case 'disable_operator':
    case 'enable_operator':
        TOOLBAR_issuemanager::_OPERATORS();
        break;
    case 'display_tickets':
    default:
        TOOLBAR_issuemanager::_DEFAULT();
        break;
}
?>
