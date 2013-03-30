<?php
/*
    Document   : controller.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        Controller for the user interface
*/
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class IssuemanagerController extends JController {

    /**
     * Constructor of controller class. If there's also any action specified whose method name does not match the task name, it is
     * necessary to register it here
     *      
     * @param array $default
     */
    function __construct($default = array())
    {
        parent::__construct($default);
        // If there's any url action (task) whose name is not the same as its corresponding action, specify it with registerTask()
        $this -> registerTask('ticket_resolved', 'ticket_status');
        $this -> registerTask('ticket_unresolved', 'ticket_status');
    }

    /**
     * Checks whether the current user is an operator or not, returning true or false. In addition, if its a disabled operator it
     * will return false, and the $errorMessage parameter, which is passed by reference, will store an error message for whoever
     * invoked the method
     * 
     * @param string $errorMessage
     * @return boolean
     */
    function _check_operator(&$errorMessage) {
        $db = JFactory::getDBO();
        $query = "SELECT user_id, status FROM #__im_operators WHERE user_id=" . $this->_get_userid();
        $db->setQuery($query);
        $result = $db->loadObject();
        if ($result && $result->status == 1) {
            return true;
        } elseif($result && $result->status == 0) {
            $errorMessage = JText::_('NO_PRIVILEGES');
            return false;
        } else {
            return false;
        }
    }

    /**
     * Action that is executed by default, in order to obtain the required view and to order it to display it.
     *
     * @global string $option
     */
    function display() {
        global $option;
        // First off check whether request comes from admin/operator in the following lines
        $errorMessage = null;
        // Get reference to current session. The @ is there to avoid an absurd warning I don't want to see.
        @ $session = &JSession::getInstance();
        // Check whether the session variable for operator exists
        if ($session->has('is_op') && $session->get('is_op') == 1) {
            // Select operator view
            $this->_select_display('operator');
        } elseif ($this->_check_operator($errorMessage)) {
            // There's still no session variable for operator, but this might be a first access and in this case it must be created. So it must be checked
            $session->set('is_op', 1);
            $this->_select_display('operator');
        } elseif ($errorMessage != null) {
            // It's a disabled operator, redirect to index showing the error message
            $this->setRedirect('index.php', $errorMessage);
        } else {
            // It's definitely not an operator. So it's a customer, and the 'customer' view is selected
            $this->_select_display('customer');
        }
    }

    /**
     * Obtains reference to specified view and returns it to its caller
     * 
     * @param string $viewName
     * @return JView
     */
    function _get_view($viewName = null) {
        // Get type of document for the view
        $document =& JFactory::getDocument();
        $viewType = $document->getType();
        // Get reference to view according to the name of the view and type of document
        $view = &$this->getView($viewName, $viewType);
        return $view;
    }

    /**
     * Obtains reference to specified model and resturns it to its caller
     *
     * @param string $viewName
     * @return JModel
     */
    function _get_model($viewName = null) {
        $model = &$this->getModel($viewName);
        return $model;
    }

    /**
     * Protected method called by display(). It performs the real display according to the required view
     * 
     * @param string $viewName
     */
    function _select_display($usertype) {
        global $option;
        // Get view specified in url, and if not exists, the variable will store 'customer' view by default
        $viewName = JRequest::getVar('view', 'customer');
        // If type of current user obtained is 'operator' and the view which has been specified in the url is 'customer', the first one prevails
        // and we are redirected to the 'operator' view
        if ($usertype == 'operator' && $viewName == 'customer') {
            $this->setRedirect('index.php?option=com_issuemanager&view=operator');
        }     
        // Get reference to view from given name
        $view =& $this->_get_view($viewName);
        // Get reference to model which follows same name conventions as the current view
        $model =& $this->_get_model($viewName);
        // Assign model to current view
        if (!JError::isError( $model )) {
            $view->setModel( $model, true );
        }
        // Assign 'default' layout to the view so that it acts as default layout, in case no other layout is explicitly specified in
        // display()
        $view->setLayout('default');
        // Get variable cid
        $cid = JRequest::getVar('cid');
        // Check two additional options depending on which display action selected
        if ($viewName == 'operator') {
            // Main view for operator
            $errorMessage = null;
            if ($this->_check_operator($errorMessage)) {
                $view->display();
            } elseif ($errorMessage) {
                $this->setRedirect(JRoute::_('index.php?option=' . $option), $errorMessage);
            } else {
                $this->setRedirect(JRoute::_('index.php?option=' . $option));
            }
        } elseif ($viewName == 'customer' && $cid == null) {
            // It's the customer view and there is no ticket number defined, the list of tickets for the customer must be displayed
            // So it is passed the user id for the model
            //$model->set_userid($this->_get_userid());
            // Find out if parameter for VirtueMart cooperation is enabled, so as to allow to link orders to tickets
            $params = &JComponentHelper::getParams( 'com_issuemanager' );
            $virtuemart = intval($params->get('virtuemart'));
            if ($virtuemart) $model->set_customer_orders();
            $view->display();
        } elseif ($viewName == 'ticket' && is_numeric($cid[0])) {
            // A ticket id is defined, so the view must be the 'ticket' view (either for a customer or an operator)
            // with the ticket details and its posts.
            // The ticket id is passed to the model
            $model->set_ticketid($cid[0]);
            // If the ticket has a new post to be looked through for the first time, update the ticket status. Two things may be happening:
            // 1- the user is a customer and the previous status is 3 (new message from ops still not read by customer)
            // 2- the uer is an operator and the previous status is 1 (new message from customer still not read by ops)
            $ticketList = $model->getInfo();
            if ($usertype == 'operator' && $ticketList->status == 1) {
                $model->update_status(2, $cid[0]);
            } elseif ($usertype == 'customer') {
                // This is a security check (the ticket corresponding to the cid variable obtained through the URL must belong to the current user)
                $this->_security_check($model);
                if ($ticketList->status == 3) {
                    $model->update_status(4, $cid[0]);
                }
            }
            $view->display();
        } elseif ($cid) {
            // Another security check is to avoid malicious manual introduction of variables in URL
            $this->setRedirect(JRoute::_('index.php?option=' . $option, JText::_('ACTION_NOT_ALLOWED')));
        }
    }

    /**
     * Checks in the model whether the current user is the creator of the requested ticket, in order to prevent any user to
     * view tickets of other users just by changing the ticket reference in the URL. So in this case, the user is redirected and
     * shown a warning message
     *
     * @global string $option
     * @param JModel $model
     */
    function _security_check(&$model) {
        global $option;
        $userid = $this->_get_userid();
        if (!$model->is_user_ticket_creator($userid)) {
            $this->setRedirect(JRoute::_('index.php?option=' . $option, JText::_('TICKET_NOT_BY_USER')));
        }
    }

    /**
     * Adds a new ticket created by the customer together with the first post of the ticket
     *
     * @global string $option
     */
    function add_ticket() {
        global $option;
        // Get an instance of class TableTicket and another one of Table Post following the Joomla name conventions: ('name', 'prefix')
        $ticket =& JTable::getInstance('ticket', 'Table');
        $post =& JTable::getInstance('post', 'Table');
        // Try to match the input variables from form with both instances
        if (!$ticket->bind(JRequest::get('post')) || !$post->bind(JRequest::get('post'))) {
            echo "<script>alert('" . $row->getError() . "'); window.history.go(-1);</script>\n";
            exit();
        }
        // Strip tags from input data for security reasons
        $ticket->ticket_subject = strip_tags(trim($ticket->ticket_subject));
        if (!$ticket->ticket_subject) {
            echo "<script>alert('" . JText::_('FILL_FIELDS') . "'); window.history.go(-1);</script>\n";
            exit();
        }
        $post->post_body = strip_tags(trim($post->post_body));
        if (strlen($post->post_body) < 10) {
            echo "<script>alert('" . JText::_('MESSAGE_BODY_ERROR') . "'); window.history.go(-1);</script>\n";
            exit();
        }
        // Fill in the rest of required columns of table tickets and store the record
        $model =& $this->_get_model('customer');
        do {
            // Generation of a ticket number.
            // If the generated ticket already exists (in the DB) the process is repeated again.
            $ticket->ticket_number = $this->_generate_ticket_number();
        } while ($model->is_duplicated_number($ticket->ticket_number));
        $ticket->cdate = date('Y-m-d H:i:s');
        $ticket->open = 1;
        $ticket->status = 1;
        $ticket->num_posts = 1;
        $ticket->resolved = 0;
        $ticket->author_id = $this->_get_userid();
        if (!$ticket->store()) {
            echo "<script>alert('" . $row->getError() . "'); window.history.go(-1);</script>\n";
            exit();
        }
        // Fill in the rest of required columns for the table of posts and store the record in the DB
        $post->ticket_id = $ticket->ticket_id;
        $post->post_order = 1;
        $post->post_author_id = $ticket->author_id;
        if (!$post->store()) {
            echo "<script>alert('" . $row->getError() . "'); window.history.go(-1);</script>\n";
            exit();
        }
        // Get the parameter for notifications via e-mail (if it's activated)
        $params = &JComponentHelper::getParams( 'com_issuemanager' );
        $mailSend = intval($params->get('send_email'));
        if ($mailSend == 1) {
            // Notify the operators and redirect to the index with a "new ticket" message
            $mail = new MailUtils();
            $mail->send_to_operators($ticket->ticket_number, true);
        }
        $this->setRedirect(JRoute::_('index.php?option=' .  $option, JText::_('NEW_TICKET')));
    }

    /**
     * Obtains id of current user
     *
     * @return int
     */
    function _get_userid() {
        $user =& JFactory::getUser();
        $userid = $user->id;
        return $userid;
    }

    /**
     * Invokes included class UtilsIM (in the utils sirectory of the component). It will generate an alphanumeric random string
     * with a specified length
     *
     * @return string
     */
    function _generate_ticket_number() {
        return UtilsIM::generate_random_string(10);
    }

    /**
     * Adds new post to current ticket
     *
     * @global string $option
     */
    function add_post() {
        global $option;
        $post =& JTable::getInstance('post', 'Table');
        // Try to match input vars from form with the instance of TablePost which represents a row of the table of posts in the DB
        if (!$post->bind(JRequest::get('post'))) {
            echo "<script>alert('Error matching table of posts: " . $row->getError() . "'); window.history.go(-1);</script>\n";
            exit();
        }
        $post->post_body = strip_tags(trim($post->post_body));
        if (strlen($post->post_body) < 10) {
            echo "<script>alert('" . JText::_('MESSAGE_BODY_ERROR') . "'); window.history.go(-1);</script>\n";
            exit();
        }
        // Get 'view' variable passed as hidden var through the form, in order to load reference to corresponding model and view, thus
        // obtaining reference to current ticket
        $viewName = JRequest::getVar('view');
        $ticketid = JRequest::getVar('cid');
        $model =& $this->_get_model($viewName);
        // Get ticket number
        $model->set_ticketid($ticketid[0]);
        $ticketNumber = $model->getInfo()->ticket_number;
        // Get number of tickets to calculate numerical order of new post
        $numPosts = $model->get_num_posts_from_ticket($ticketid[0]);
        // Update numerical order of new post, set its author, and store the post
        $post->ticket_id = $ticketid[0];
        $post->post_order = intval($numPosts) + 1;
        $post->post_author_id = $this->_get_userid();
        if (!$post->store()) {
            echo "<script>alert('Error storing post: " . $row->getError() . "'); window.history.go(-1);</script>\n";
            exit();
        }
        // Update ticket status depending on the user type (customer or operator)
        $errorMessage = null;
        // Get references to mail utility for notifications and also to current session. The @ before is used to avoid an absurd warning.
        // Get the parameter which allows or not e-mail notifications
        $params = &JComponentHelper::getParams( 'com_issuemanager' );
        $mailSend = intval($params->get('send_email'));
        if ($mailSend == 1) $mail = new MailUtils();
        @ $session = &JSession::getInstance();
        if ($session->has('is_op') && $session->get('is_op') == 1) {
            // user is operator
            $model->update_status(3, $ticketid[0]);
            if ($mail) $mail->send_to_user($post->ticket_id);
        } elseif ($this->_check_operator($errorMessage)) {
            // user is operator
            $model->update_status(3, $ticketid[0]);
            if ($mail) $mail->send_to_user($post->ticket_id);
        } else {
            // user is a customer
            $model->update_status(1, $ticketid[0]);
            if ($mail) $mail->send_to_operators($ticketNumber, false);
        }
        // Actions to build URL to redirect to
        $view =& $this->_get_view($viewName);
        $this->setRedirect(JRoute::_('index.php?option=' .  $option . '&view=' . $view->getName() . '&cid[]=' . $ticketid[0], JText::_('NEW_MESSAGE')));
    }

    /**
     *  Changes resolved status of selected ticket or tickets
     */
    function ticket_status() {
        global $option;
        // Set flag of resolution status
        $resolved = 0;
        switch ($this->_task) {
            case 'ticket_resolved':
                $resolved = 1;
                $message = JText::_('TICKETS_RESOLVED');
                break;
            case 'ticket_unresolved':
                $resolved = 0;
                $message = JText::_('TICKETS_UNRESOLVED');
                break;
        }
        // array which will hold values for some columns of the table of tickets
        $list = array('ticket_id' => null, 'resolved' => null);
        // Get ticket Id's from URL
        $ticketids = JRequest::getVar('cid');
        // Go through cid array in order to change the resolved status of each ticket specified within
        if (is_array($ticketids)) {
            // Get reference to instance of class TableTicket which represents a record in table of tickets
            $ticket =& JTable::getInstance('ticket', 'Table');
            foreach ($ticketids as $ticketid) {
                $list['ticket_id'] = $ticketid;
                $list['resolved'] = $resolved;
                // Try to match instance properties with the array $list
                if (!$ticket->bind($list)) {
                    echo "<script>alert('Error matching table of tickets: " . $row->getError() . "'); window.history.go(-1);</script>\n";
                    exit();
                }
                // Try to store the current ticket row in the corresponding table of the database
                if (!$ticket->store()) {
                    echo "<script>alert('Error updating ticket status: " . $row->getError() . "'); window.history.go(-1);</script>\n";
                    exit();
                }
            }
        }
        $view = JRequest::getVar('view', '');
        $gotoURL = ($view == 'ticket') ? 'index.php?option=' .  $option . '&view=ticket&cid[]=' . $ticketid[0] : 'index.php?option=' .  $option;
        $this->setRedirect(JRoute::_($gotoURL, $message));
    }

    /**
     * Displays the information of the specified order
     */
    function view_order() {
        // Get vars of order and view
        $orderid = JRequest::getVar('orderid', '');
        $viewName = 'order';
        // Get reference to view
        $view =& $this->_get_view($viewName);
        // Get reference to model 'order'
        $model =& $this->_get_model($viewName);
        // Assign model to view
        if (!JError::isError( $model )) {
            $view->setModel( $model, true );
        }
        if ($orderid != '') {
            $xmlOutput = $model->getOrderXML($orderid);
            // Parsear xml
            $this->_parse_xml($xmlOutput, $model);
        }
        // Assign 'default' template to view
        $view->setLayout('default');
        $view->display();
    }

    /**
     * Parses the xml string and stores the parsed data conveniently in the model
     *
     * @param string $xmlOutput
     * @param JModel $model
     */
    function _parse_xml($xmlOutput, &$model) {
        // Use the SimpleXML interface of PHP to parse the xml
        $xml = new SimpleXMLElement($xmlOutput);
        // Store the total cost of the order in the model
        $model->set_order_total(intval($xml->order[0]['total']));
        // Retrieve all the items of the order and their quantities and store them in an array
        $products = array();
        foreach ($xml->order[0]->product as $product) {
            $name = (string)($product['name']);
            $quantity = intval($product['quantity']);
            $products[] = array("name" => $name, "quantity" => $quantity);
        }
        $model->set_products_list($products);
    }
}
?>
