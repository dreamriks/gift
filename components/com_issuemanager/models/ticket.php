<?php
/*
    Document   : ticket.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        File that defines the 'ticket' model for the application (the model that allows to get the info of the ticket in detail and its posts)
*/
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.model' );

/**
 * class which defines 'ticket' model
 */
class IssuemanagerModelTicket extends JModel {
    var $_ticketid = null;
    var $_ticket_info = null;
    var $_posts_list = null;

    /**
     * Sets and stores id of current ticket for the model
     *
     * @param int $ticketid
     */
    function set_ticketid($ticketid) {
        $this->_ticketid = $ticketid;
    }

    /**
     * Returns, if stored, the id of current ticket of model
     *
     * @return int
     */
    function get_ticketid() {
        return $this->_ticketid;
    }

    /**
     * Returns the object with the columns of information about current ticket of model. If still null, the data is retrieved from DB
     *
     * @return Object
     */
    function getInfo() {
        // If data is not stored yet, retrieve it from DB
        if (!$this->_ticket_info) {
            // Get reference to DB
            $db =& JFactory::getDBO();
            // Request to obtain info from specified ticket and (if applicable) its corresponding order number of purchase
//            $query = "SELECT t.*, o.order_number
//                      FROM #__im_tickets t
//                      LEFT JOIN #__vm_orders o
//                      ON t.order_id=o.order_id
//                      WHERE ticket_id=" . $this->_ticketid;
            $query = "SELECT t.* 
                      FROM #__im_tickets t
                      WHERE ticket_id=" . $this->_ticketid;
            // Set query stored and ready to go
            $db->setQuery($query, 0, 1);
            // Carry on the query and get and store the resulting object, eventually returning it to the caller
            $ticket = $db->loadObject();
            if ($db->getErrorNum()) {
                echo "<script>alert('Error trying to get ticket info from database: " . $db->getError() . "'); window.history.go(-1);</script>\n";
                exit();
            }
            $this->_ticket_info = $ticket;
        }

        return $this->_ticket_info;
    }

    /**
     * Returns the array with the posts of the current ticket of this model, and if still null, its data is retrieved from DB
     *
     * @return array
     */
    function getPosts() {
        // If posts list still null, retrieve the corresponding data from DB
        if (!$this->_posts_list) {
            // Get reference to DB
            $db =& JFactory::getDBO();
            // Query to obtain all the posts of a given ticket
            $query = "SELECT p.*, u.username
                      FROM #__im_posts p, #__users u
                      WHERE u.id=p.post_author_id
                      AND p.ticket_id=" . $this->_ticketid . "
                      ORDER BY post_order DESC";
            // Set the query
            $db->setQuery($query, 0);
            // Execute the query and store the resulting rows
            $posts = $db->loadObjectList();
            if ($db->getErrorNum()) {
                echo "<script>alert('" . $db->getError() . "'); window.history.go(-1);</script>\n";
                exit();
            }
            $this->_posts_list = $posts;
        }

        return $this->_posts_list;
    }

    /**
     *  Updates the ticket status
     */
    function update_status($status, $ticketid) {
        $db = &JFactory::getDBO();
        $query = "UPDATE #__im_tickets SET status=" . $status . " WHERE ticket_id=" . $ticketid;
        $db->setQuery($query);
        if (!$db->query()) {
            echo "<script>alert('" . $db->getError() . "'); document.history.go(-1);</script>\n";
            exit();
        }
    }

    /**
     * Calculates and returns number of posts of the current ticket of this model
     *
     * @param int $ticketid
     * @return int
     */
    function get_num_posts_from_ticket($ticketid = null) {
        $ticketid = ($ticketid == null) ? $this->_ticketid : $ticketid;
        $db = &JFactory::getDBO();
        $query = "SELECT COUNT(*) FROM #__im_posts WHERE ticket_id=" .  $ticketid;
        $db->setQuery($query);
        $total = $db->loadResult();
        if ($db->getErrorNum()) {
            echo "<script>alert('" . $db->getError() . "'); document.history.go(-1);</script>\n";
            exit();
        }
        return $total;
    }

    /**
     * Security method that checks whether the specified user is the author of the requested ticket
     *
     * @param int $userid
     * @return boolean
     */
    function is_user_ticket_creator($userid) {
        $db = &JFactory::getDBO();
        $query = "SELECT author_id FROM #__im_tickets WHERE ticket_id=" . $this->_ticketid;
        $db->setQuery($query);
        $authorid = $db->loadResult();
        if ($db->getErrorNum()) {
            echo "<script>alert('" . $db->getError() . "'); document.history.go(-1);</script>\n";
            exit();
        }
        if ($userid != $authorid) {
            return false;
        }
        return true;
    }
}

?>
