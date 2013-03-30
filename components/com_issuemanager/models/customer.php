<?php
/*
    Document   : customer.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        File that defines the 'customer' model of the application
*/
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.model' );
 
class IssuemanagerModelCustomer extends JModel
{
    var $_userid = null;
    var $_tickets_list = null;
    var $_total_tickets = null;
    var $_user_orders = null;
    var $_limit = null;
    var $_limitstart = null;
    var $_paginacion = null;

    function __construct() {
        global $mainframe;
        // Obtener variables de paginación
        $limit = JRequest::getVar('limit', $mainframe->getCfg('list_limit'));
        $limitstart = JRequest::getVar('limitstart', 0);
        $this->_limit = $limit;
        $this->_limitstart = $limitstart;
        // Obtener userid
        $this->_userid = $this->_get_userid();
        // Crear paginación
        $this->_paginacion = $this->_create_pagination();
        parent::__construct();
    }

    /**
     * Gets the user id of current user
     *
     * @return int
     */
    function _get_userid() {
        $user =& JFactory::getUser();
        $userid = $user->id;
        return $userid;
    }

    function _create_pagination() {
        $this->_retrieveList();
        jimport('joomla.html.pagination');
        $this->_paginacion = new JPagination($this->_total_tickets, $this->_limitstart, $this->_limit);
    }

    /**
     * Returns the list of tickets stored in property $_tickets_list. If still null, the corresponding data are retrieved from DB.
     * Gets all the tickets corresponding to the user whose id was previously stored in property $_userid
     *
     * @return array
     */
    function _retrieveList() {
        if (!$this->_tickets_list) {
            // Get reference to DB
            $db =& JFactory::getDBO();
            // Query to retrieve all the tickets of the current customer
            $query = "SELECT t.*
                      FROM #__im_tickets t
                      WHERE t.author_id=" . $this->_userid . " ORDER BY t.cdate DESC";
//            $query = "SELECT t.*, o.order_number
//                      FROM #__im_tickets t
//                      LEFT JOIN #__vm_orders o
//                      ON t.order_id=o.order_id
//                      WHERE t.author_id=" . $this->_userid . " ORDER BY t.cdate DESC";
            // Query
            $db->setQuery($query);
            $rows = $db->loadObjectList();
            if ($db->getErrorNum()) {
                echo "<script>alert('" . $db->getError() . "'); window.history.go(-1);</script>\n";
                exit();
            }
            $this->_tickets_list = $rows;
            $this->_total_tickets = count($rows);
        }
    }

    function getPagination() {
        if (!$this->_paginacion) {
            $this->_create_pagination();
        }
        return $this->_paginacion;
    }

    function getList() {
        if (!$this->_tickets_list) {
            $this->_create_pagination();
        }
        return array_slice($this->_tickets_list, $this->_limitstart, $this->_limit);
    }

    /**
     * Checks whether the given ticket number already exists in the DB, in order to avoid duplication
     *
     * @param string $ticketNumber
     * @return boolean
     */
    function is_duplicated_number($ticketNumber) {
        $db =& JFactory::getDBO();
        $query = "SELECT ticket_id FROM #__im_tickets WHERE ticket_number='" . $ticketNumber . "'";
        $db->setQuery($query);
        $result = $db->loadResult();
        if ($result) {
            return true;
        }
        return false;
    }

    /**
     * Searches in the orders table of VirtueMart whether the current user has made an order, by using his/her id.
     * In case there are any order made, they will be stored as array elements in a property of the model.
     * In case there's no order made by user, the array will be empty
     *
     */
    function set_customer_orders() {
        $db =& JFactory::getDBO();
        $query = "SELECT * FROM #__vm_orders WHERE user_id=" . $this->_userid . " ORDER BY cdate DESC";
        $db->setQuery($query, 0);
        $rows = array();
        $rows = $db->loadObjectList();
        if ($db->getErrorNum()) {
            echo "<script>alert('" . $db->getError() . "'); window.history.go(-1);</script>\n";
            exit();
        }
        $this->_user_orders = $rows;
    }

    /**
     * Returns the array which contains the rows of orders made by him/her in VirtueMart.
     * If no order made by user, array will be empty
     *
     * @return array
     */
    function get_customer_orders() {
        if (!$this->_user_orders) {
            $this->set_customer_orders();
        }
        return $this->_user_orders;
    }
}
?>
