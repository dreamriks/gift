<?php
/*
    Document   : toolbar.issuemanager.html.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        Creation of class TOOLBAR_issuemanager, which has several methods, each of them loading the HTML necessary to display
        a different toolbar. This class will be used by toolbar.issuemanager.php
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
class TOOLBAR_issuemanager {
       
    function _TICKET() {
        JToolBarHelper::title( JText::_( 'ISSUEMANAGER_TICKET_DETAIL' ), 'logo.png' );
        JToolBarHelper::custom('display_tickets', 'display-tickets', 'display-tickets-over', JText::_( 'DISPLAYTICKETS' ), false);
        JToolBarHelper::custom('display_operators', 'display-operators', 'display-operators-over', JText::_( 'DISPLAYOPS' ), false);
        JToolBarHelper::custom('ticket_resolved', 'ticket-resolved', 'ticket-resolved-over', JText::_( 'MARKRESOLVED' ), true);
        JToolBarHelper::custom('ticket_unresolved', 'ticket-unresolved', 'ticket-unresolved-over', JText::_( 'MARKUNRESOLVED' ), true);
        // Depending on whether the ticket is open or not, the icon which performs the opposite action is displayed
        $cid = JRequest::getVar('cid', array(0), '', 'array');
        $ticketid = $cid[0];
        $db =& JFactory::getDBO();
        $query = "SELECT open FROM #__im_tickets WHERE ticket_id=" . $ticketid;
        $db->setQuery($query, 0);
        $isOpen = $db->loadResult();
        if ($isOpen == 0) {
            JToolBarHelper::custom('open_ticket', 'open-ticket', 'open-ticket-over', JText::_( 'OPENTICKET' ), true);
        } elseif ($isOpen == 1) {
            JToolBarHelper::custom('close_ticket', 'close-ticket', 'close-ticket-over', JText::_( 'CLOSETICKET' ), true);
        }
        JToolBarHelper::preferences( 'com_issuemanager' );
    }
    function _OPERATORS() {
        JToolBarHelper::title( JText::_( 'ISSUEMANAGER_TICKET_DETAIL' ), 'logo.png' );
        JToolBarHelper::custom('display_tickets', 'display-tickets', 'display-tickets-over', JText::_( 'DISPLAYTICKETS' ), false);
        JToolBarHelper::custom('add_operator', 'add-operator', 'add-operator-over', JText::_( 'ADDOP' ), false);
        JToolBarHelper::custom('disable_operator', 'disable-operator', 'disable-operator-over', JText::_( 'DISABLE' ), true);
        JToolBarHelper::custom('enable_operator', 'enable-operator', 'enable-operator-over', JText::_( 'ENABLE' ), true);
        JToolBarHelper::preferences( 'com_issuemanager' );
    }
    function _DEFAULT() {
        JToolBarHelper::title( JText::_( 'ISSUEMANAGER_LIST_OF_TICKETS' ), 'logo.png' );
        JToolBarHelper::custom('display_operators', 'display-operators', 'display-operators-over', JText::_( 'DISPLAYOPS' ), false);
        JToolBarHelper::custom('view_ticket', 'view-ticket', 'view-ticket-over', JText::_( 'VIEWTICKET' ), true);
        JToolBarHelper::custom('ticket_resolved', 'ticket-resolved', 'ticket-resolved-over', JText::_( 'MARKRESOLVED' ), true);
        JToolBarHelper::custom('ticket_unresolved', 'ticket-unresolved', 'ticket-unresolved-over', JText::_( 'MARKUNRESOLVED' ), true);
        JToolBarHelper::custom('open_ticket', 'open-ticket', 'open-ticket-over', JText::_( 'OPENTICKETS' ), true);
        JToolBarHelper::custom('close_ticket', 'close-ticket', 'close-ticket-over', JText::_( 'CLOSETICKETS' ), true);
        JToolBarHelper::preferences( 'com_issuemanager' );
    }
}
?>