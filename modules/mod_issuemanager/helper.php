<?php
/*
    Document   : helper.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        File to help perform the actions of the module
*/
defined('_JEXEC') or die('Restricted access');

/**
 *  Helper class for the module. It follows Joomla name conventions.
 *  It defines the module actions as methods.
 */
class modIssuemanagerHelper {

    static $usertype;

    /**
     * Checks whether current user is logued in
     *
     * @return boolean
     */
    function is_guest() {
        $user =& JFactory::getUser();
        return $user->guest;
    }

    /**
     * Gets and delivers the current user's ID
     *
     * @return int
     */
    function get_userid() {
        $user =& JFactory::getUser();
        $userid = $user->id;
        return $userid;
    }

    /**
     * Having a given user ID, checks whether this user is an operator/admin of Issue Manaer. In this case returns true, otherwise false
     *
     * @param int $userid
     * @return boolean
     */
    function check_operator($userid) {
        @ $session = &JSession::getInstance();
        // Check whether operator session var exists
        if ($session->has('is_op') && $session->get('is_op') == 1) {
            return true;
        }
        $db = JFactory::getDBO();
        $query = "SELECT user_id, status FROM #__im_operators WHERE user_id=" . $userid;
        $db->setQuery($query);
        $result = $db->loadObject();
        if ($result && $result->status == 1) {
            $session->set('is_op', 1);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Returns an array with the menu elements which are specific to the current scenario
     *
     * @return array
     */
    function get_menu_items() {
        // Find out if user is registered
        	$menu_items = null;
            if (!self::is_guest()) {
            $userid = self::get_userid();
            if (self::check_operator($userid)) {
                // It's an operator
                self::$usertype = 'operator';
                $view = JRequest::getVar('view', 'operator');
                // Return items list depending on normal view or detail view
                if ($view == 'ticket') {
                    // detail vew
                    $menu_items = array('display_tickets', 'mark_resolved', 'mark_unresolved');
                } elseif ($view == 'operator') {
                    $menu_items = array('show_ticket', 'mark_resolved', 'mark_unresolved');
                }
                return $menu_items;
            } else {
                // It's a customer
                self::$usertype = 'customer';
                $view = JRequest::getVar('view', 'customer');
                // Return items list depending on normal view or detail view
                if ($view == 'ticket') {
                    // detail vew
                    $menu_items = array('display_tickets', 'mark_resolved', 'mark_unresolved');
                } elseif ($view == 'customer') {
                    $menu_items = array('show_ticket', 'mark_resolved', 'mark_unresolved');
                }
                return $menu_items;
            }
        } else {
            return false;
        }
    }

    /**
     * Builds URL as well as the string of the <a> link for the specified menu option
     *
     * @param string $menuOption
     */
    function build_option($menuOption) {
        $id = null;
        $cid = JRequest::getVar('cid', null);
        $view = JRequest::getVar('view', '');
        switch ($menuOption) {
            case 'display_tickets':
                $link = 'index.php?option=com_issuemanager&view=' . self::$usertype;
                $name = JText::_('DISPLAY_TICKETS');
                break;
            case 'show_ticket':
                $link = 'index.php?option=com_issuemanager&view=ticket&cid[0]=';
                $id = 'show_ticket';
                $name = JText::_('VIEW_LASTS_ELECTED_TICKET');
                break;
            case 'mark_resolved':
                $view = ($view == 'ticket') ? '&view=ticket' : '';
                $link = 'index.php?option=com_issuemanager&task=ticket_resolved' . $view;
                $cid = ($cid) ? ', ' . $cid[0] : '';
                $onclick = 'mark_resolution(this' . $cid . ');';
                $name = JText::_('MARK_RESOLVED');
                break;
            case 'mark_unresolved':
                $view = ($view == 'ticket') ? '&view=ticket' : '';
                $link = 'index.php?option=com_issuemanager&task=ticket_unresolved' . $view;
                $cid = ($cid) ? ', ' . $cid[0] : '';
                $onclick = 'mark_resolution(this' . $cid . ');';
                $name = JText::_('MARK_UNRESOLVED');
                break;
        }
        require(JModuleHelper::getLayoutPath('mod_issuemanager', '_issuemanager'));
    }

}

?>
