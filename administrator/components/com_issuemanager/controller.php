<?php
/*
    Document   : controller.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        Controller for administration interface.
*/
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
require_once( JPATH_COMPONENT.DS.'utils'.DS.'class.Mail.php' );
require_once( JPATH_COMPONENT.DS.'utils'.DS.'class.DateFormat.php' );
class IssuemanagerController extends JController
{
    function __construct($default = array())
    {
        parent::__construct($default);
        // If name of any url action doesn't match its corresponding method name, it must be specified here by using registerTask():
        // Most of the actions are channeled through two methods
        $this -> registerTask('ticket_resolved', 'ticket_status');
        $this -> registerTask('ticket_unresolved', 'ticket_status');
        $this -> registerTask('open_ticket', 'ticket_status');
        $this -> registerTask('close_ticket', 'ticket_status');
        $this -> registerTask('enable_operator', 'operator_status');
        $this -> registerTask('disable_operator', 'operator_status');
        $this -> registerTask('operator_to_admin', 'operator_status');
        $this -> registerTask('admin_to_operator', 'operator_status');
    }

    /**
     *  Obtains list of tickets from DB and pass it to the view so as to be displayed
     */
    function display_tickets()
    {
        global $option, $mainframe;
        // Pagination vars
        $limit = JRequest::getVar('limit', $mainframe->getCfg('list_limit'));
        $limitstart = JRequest::getVar('limitstart', 0);
        // Get reference to DB
        $db =& JFactory::getDBO();
        // First get total results to allow pagination
        $query = "SELECT count(*)
                  FROM #__im_tickets t
                  INNER JOIN #__users u
                  ON t.author_id=u.id";
        $db->setQuery( $query );
        $total = $db->loadResult();
        // Now preform real request to get the data of the result
        $query = "SELECT t.*, u.username as author
                  FROM #__im_tickets t
                  INNER JOIN #__users u
                  ON t.author_id=u.id";
        $db->setQuery($query, $limitstart, $limit);
        $rows = $db->loadObjectList();
        if ($db->getErrorNum())
        {
            echo  $db->stderr();
            return false;
        }
        // Set pagination
        jimport('joomla.html.pagination');
        $pageNav = new JPagination($total, $limitstart, $limit);
        // Get parameter for date format
        $params = &JComponentHelper::getParams( 'com_issuemanager' );
        $dateFormatVal = intval($params->get('date_format'));
        $dateFormat = new DateFormat();
        $dateFormatStrArr = $dateFormat->getDateFormat($dateFormatVal);
        // Order view to display paginated data
        HTML_issuemanager::show_tickets($option, $rows, $pageNav, $dateFormatStrArr['strftime']);
    }

    /**
     *  Show operators
     */
    function display_operators()
    {
        global $option, $mainframe;
        // Pagination variables
        $limit = JRequest::getVar('limit', $mainframe->getCfg('list_limit'));
        $limitstart = JRequest::getVar('limitstart', 0);
        // First off get total results of request to allow pagination
        $db =& JFactory::getDBO();
        // Consulta para obtener totales para paginación
        $query = "(
                    SELECT count(*)
                    FROM #__im_operators o
                    INNER JOIN #__users u ON o.user_id = u.id
                    INNER JOIN #__im_posts p ON o.user_id = p.post_author_id
                    GROUP BY o.operator_id
                    )
                    UNION (

                        SELECT count(*)
                        FROM #__im_operators o
                        INNER JOIN #__users u ON o.user_id = u.id
                        WHERE o.user_id NOT
                        IN (

                            SELECT post_author_id
                            FROM #__im_posts
                        )
                    )";
        $db->setQuery( $query );
        $total = $db->loadResult();
        // Now perform real request, to which apply pagination
        $query = "(
                    SELECT o. * , u.username, count( * ) AS num_posts, MAX( p.cdate ) AS last_post
                    FROM #__im_operators o
                    INNER JOIN #__users u ON o.user_id = u.id
                    INNER JOIN #__im_posts p ON o.user_id = p.post_author_id
                    GROUP BY o.operator_id
                    )
                    UNION (

                        SELECT o. * , u.username, 0 AS num_posts, '0000-00-00 00:00:00' AS last_post
                        FROM #__im_operators o
                        INNER JOIN #__users u ON o.user_id = u.id
                        WHERE o.user_id NOT
                        IN (

                            SELECT post_author_id
                            FROM #__im_posts
                        )
                    )";
        $db->setQuery($query, $limitstart, $limit);
        $rows = $db->loadObjectList();
        if ($db->getErrorNum())
        {
            echo  $db->stderr();
            return false;
        }
        // Set the pagination
        jimport('joomla.html.pagination');
        $pageNav = new JPagination($total, $limitstart, $limit);
        // Get current user's id to compare with table of operators (we must know who the current user is, and pass to the view, in order to avoid certain bad use)
        $currentUser =& JFactory::getUser();
        $currentUserid = $currentUser->id;
        // Get parameter of date format
        $params = &JComponentHelper::getParams( 'com_issuemanager' );
        $dateFormatVal = intval($params->get('date_format'));
        $dateFormat = new DateFormat();
        $dateFormatStrArr = $dateFormat->getDateFormat($dateFormatVal);
        HTML_issuemanager::show_operators($option, $rows, $currentUserid, $pageNav, $dateFormatStrArr['strftime']);
    }

    /**
     * Selects all the registered users with a rank higher than Registered (from Author upwards) in order to display them in a form
     * as candidates for new operators/admins. Another requirement is not to be in the operators table yet.
     *
     * @global string $option
     */
    function add_operator()
    {
        global $option;
        // Obtain registered isers with privileges (>Registered) and still not in operators table.
        $db =& JFactory::getDBO();
        $query = "SELECT username, id FROM #__users WHERE usertype<>'Registered' AND id NOT IN
                (SELECT user_id FROM #__im_operators)";
        $db->setQuery($query, 0);
        $rows = $db->loadObjectList();
        if ($db->getErrorNum()) {
            echo "<script>alert('" . $db->getError() . "'); window.history.go(-1);</script>\n";
            exit();
        }
        if (empty($rows)) {
            echo "<script>alert('" . JText::_('NO_USER_REMAINING') . "'); window.history.go(-1);</script>\n";
            exit();
        }
        // Loop through obtained rows in order to build an array whose elements will represent a new potential operator to be added.
        // This array is passed to the view
        $usersList = array();
        foreach ($rows as $row) {
            $usersList[$row->id] = $row->username;
        }
        // Display form to add new operator including fields for operator's id and operator's name
        HTML_issuemanager::show_operator_form($option, $usersList);
    }

    /**
     * Stores the selected user as new operator/administrator of Issue Manager
     *
     * @global string $option
     */
    function save_operator() {
        global $option;
        // Get instance of class TableOperator
        $row =& JTable::getInstance('operator', 'Table');
        // Try to bind, that is to assign any match between POST ($_POST) variables and the properties of TableOperator
        if (!$row->bind(JRequest::get('post'))) {
            echo "<script>alert('" . $row->getError() . "'); window.history.go(-1);</script>\n";
            exit();
        }
        $row->status = 1;
        $message = ($row->rank == 1) ? JText::_('NEW_ADMIN_ADDED') : JText::_('NEW_OP_ADDED');
        // Try to store the data
        if (!$row->store()) {
            echo "<script>alert('" . $row->getError() . "'); window.history.go(-1);</script>\n";
            exit();
        }
        // Redirect to the place we previously were
        $this->setRedirect('index.php?option=' . $option . '&task=display_operators' , $message);
    }

    /**
     *  Disable/Enable operator
     */
    function operator_status()
    {
        global $option;
        $db = JFactory::getDBO();
        $cid = JRequest::getVar('cid', array(0), '', 'array');
        switch($this->_task) {
            case 'enable_operator':
                $status = 1;
                $message = JText::_('OPS_ENABLED');
                $query = "UPDATE #__im_operators SET status=$status WHERE operator_id IN (" . implode(',', $cid) . ")";
                break;
            case 'disable_operator':
                $status = 0;
                $message = JText::_('OPS_DISABLED');
                $query = "UPDATE #__im_operators SET status=$status WHERE operator_id IN (" . implode(',', $cid) . ")";
                break;
            case 'operator_to_admin':
                $rank = 1;
                $message = JText::_('OP_TO_ADMIN');
                $query = "UPDATE #__im_operators SET rank=$rank WHERE user_id=" . $cid[0];
                break;
            case 'admin_to_operator':
                $rank = 0;
                $message = JText::_('ADMIN_TO_OP');
                $query = "UPDATE #__im_operators SET rank=$rank WHERE user_id=" . $cid[0];
                break;
        }
        $db->setQuery($query);
        if (!$db->query()) {
            echo "<script>alert('" . $db->getErrorMsg() . "'); </script>\n";
            exit();
        }
        // Redirect to the page we previously were
        $this->setRedirect('index.php?option=' . $option . '&task=display_operators' , $message);
    }

    /**
     * View selected ticket in detail
     */
    function view_ticket()
    {
        global $option;
        // Get reference to DB
        $db =& JFactory::getDBO();
        // Get ticket id
        $cid = JRequest::getVar('cid', array(0), '', 'array');
        $ticketid = $cid[0];
        // Request data of selected ticket
        $query = "SELECT t.ticket_number, t.order_id, u.username, t.ticket_subject, t.status, t.open
                  FROM #__im_tickets t
                  INNER JOIN #__users u
                  ON t.author_id=u.id
                  WHERE t.ticket_id=" . $ticketid;
        $db->setQuery($query, 0);
        $row = $db->loadObject(); // delivers just a row (an object whose properties will represent the ticket columns)
        if ($db->getErrorNum())
        {
            echo  $db->stderr();
            return false;
        }
        $isOpen = ($row->open == 1) ? true : false;
        // If ticket status says ticket has new message and waiting for reply (status==1)
        // update it to ticket still waiting for reply but new message already read (status==2)
        if ($row->status == 1) {
            $query = "UPDATE #__im_tickets SET status=2 WHERE ticket_id=" . $ticketid;
            $db->setQuery($query);
            if (!$db->query()) {
                echo "<script>alert('" . $db->getErrorMsg() . "'); </script>\n";
                exit();
            }
        }
        // check whether ticket has a number of purchase order assigned, if so, retrieve data from order
        if ($row->order_id != 0) {
            $query = "SELECT order_number, cdate FROM #__vm_orders WHERE order_id=" . $row->order_id;
            $db->setQuery($query, 0);
            $order = $db->loadObject();
            if ($db->getErrorNum())
            {
                echo  $db->stderr();
                return false;
            }
            // Add to object which represents current ticket the data which corresponds to the assigned order
            $row->order_number = $order->order_number;
            $row->cdate = $order->cdate;
        }
        // Get parameter of date format
        $params = &JComponentHelper::getParams( 'com_issuemanager' );
        $dateFormatVal = intval($params->get('date_format'));
        $dateFormat = new DateFormat();
        $dateFormatStrArr = $dateFormat->getDateFormat($dateFormatVal);
        // Show useful data of current ticket
        HTML_issuemanager::show_ticket_details($row, $dateFormatStrArr['strftime']);
        // Request the posts of the selected ticket
        $query = "SELECT p.*, t.num_posts, u.username FROM #__im_posts p
                  INNER JOIN #__im_tickets t
                  ON t.ticket_id=p.ticket_id
                  INNER JOIN #__users u
                  ON u.id=p.post_author_id
                  WHERE t.ticket_id=" . $ticketid .
                  " ORDER BY p.post_order DESC";
        $db->setQuery($query, 0);
        $rows = $db->loadObjectList();
        if ($db->getErrorNum())
        {
            echo  $db->stderr();
            return false;
        }
        
        // Show posts
        HTML_issuemanager::show_ticket_posts($option, $rows, $ticketid, $dateFormatStrArr['strftime']);
        // Display new post form, only if ticket is open
        if ($isOpen) {
            HTML_issuemanager::show_post_form($option, $ticketid, $rows[0]->num_posts);
        }
    }

    /**
     * Retrieves from database total number of posts of specified ticket
     *
     * @param int $ticketid
     * @return int
     */
    function _get_num_posts_from_ticket($ticketid) {
        $db =& JFactory::getDBO();
        $query = "SELECT COUNT(*) FROM #__im_posts WHERE ticket_id=" . $ticketid;
        $db->setQuery($query);
        $total = $db->loadResult();
        return $total;
    }

    /**
     * Adds new post to current ticket
     *
     * @global string $option
     */
    function add_post() {
        global $option;
        // Get reference to instance of class TablePost
        $row =& JTable::getInstance('post', 'Table');
        // Try to match any coincidence between POST ($_POST) vars retrieved from form sent, and the properties of TablePost
        if (!$row->bind(JRequest::get('post'))) {
            echo "<script>alert('" . $row->getError() . "'); window.history.go(-1);</script>\n";
            exit();
        }
        // Assign rest of necessary properties to be stored in table of posts which were not retrieved from the previously sent form:
        // Assign current user as post author (in this particular case, as we are in the backend, the user will always be an admin)
        $user =& JFactory::getUser();
        $userid = $user->id;
        $row->post_author_id = $userid;
        // Assign date of creation
        $row->cdate = date('Y-m-d H:i:s');
        // Assign numerical order of current post
        $row->post_order = intval($this->_get_num_posts_from_ticket($row->ticket_id)) + 1;
        // Try to store the post
        if (!$row->store()) {
            echo "<script>alert('" . $row->getError() . "'); window.history.go(-1);</script>\n";
            exit();
        }
        // Update num_posts field in table of tickets, and status field must be 3 (new message for customer still not read by him/her)
        $ticket =& JTable::getInstance('ticket', 'Table');
        $num_posts = $row->post_order;
        $updateList = array(num_posts=>$num_posts, status=>1, mdate=>$row->cdate, ticket_id=>$row->ticket_id);
        if (!$ticket->bind($updateList)) {
            echo "<script>alert('" . $ticket->getError() . "'); window.history.go(-1);</script>\n";
            exit();
        }
        if (!$ticket->store()) {
            echo "<script>alert('" . $ticket->getError() . "'); window.history.go(-1);</script>\n";
            exit();
        }
        // Update ticket so that num_posts gets incremented by one.
        $db =& JFactory::getDBO();
        $query = 'UPDATE #__im_tickets SET num_posts=' . $row->post_order . ", status=3, mdate='" . $row->cdate . "'
                    WHERE ticket_id=" . $row->ticket_id;
        $db->setQuery($query);
        if (!$db->query()) {
            echo "<script>alert('" . $db->getErrorNum() . ': ' . $db->getErrorMsg() . "'); </script>\n";
            //exit();
        }
        // Get parameter for sending e-mail notifications
        $params = &JComponentHelper::getParams( 'com_issuemanager' );
        $mailSend = intval($params->get('send_email'));
        if ($mailSend == 1) {
            // If notifications via e-mail are activated, get the id of the ticket creator in order to send him/her the notification
            $mail = new MailUtils();
            $mail->send_to_user($row->ticket_id);
        }
        /* TODO: later on fields num_posts and last_post of operator might be useful, but so far they're not necessary, because
         * checking DB tables for tickets and posts we can easily retrieve both */
        // Redirect to the page where we previously were, now showing the new message added
        $this->setRedirect('index.php?option=' . $option . '&task=view_ticket&cid[]=' . $row->ticket_id , JText::_('NEW_POST_ADDED'));
    }

    /**
     * Change ticket status to that specified. Works both for fields 'open' and 'resolved'
     *
     * @global string $option
     */
    function ticket_status()
    {
        global $option;
        $db = JFactory::getDBO();
        $cid = JRequest::getVar('cid', array(0), '', 'array');
        // Perform the operation which corresponds to the one specified by '_task' property of the controller (this is in turn retrieved via GET or POST)
        switch ($this->_task) {
            case 'open_ticket':
                $query = "UPDATE #__im_tickets SET open=1 WHERE ticket_id IN (" . implode(',', $cid) . ")";
                $message = JText::_('TICKETS_OPENED');
                break;
            case 'close_ticket':
                $query = "UPDATE #__im_tickets SET open=0, status=4 WHERE ticket_id IN (" . implode(',', $cid) . ")";
                $message = JText::_('TICKETS_CLOSED');
                break;
            case 'ticket_resolved':
                $query = "UPDATE #__im_tickets SET resolved=1 WHERE ticket_id IN (" . implode(',', $cid) . ")";
                $message = JText::_('TICKETS_MARKED_RESOLVED');
                break;
            case 'ticket_unresolved':
                $query = "UPDATE #__im_tickets SET resolved=0 WHERE ticket_id IN (" . implode(',', $cid) . ")";
                $message = JText::_('TICKETS_MARKED_UNRESOLVED');
                break;
        }
        print_r($query);
        $db->setQuery($query);
        if (!$db->query()) {
            echo "<script>alert('" . $db->getErrorMsg() . "'); </script>\n";
            exit();
        }
        // Redirect to the previus page
        $this->setRedirect('index.php?option=' . $option . '&task=display_tickets' , $message);
    }
}
?>
