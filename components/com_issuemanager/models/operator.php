<?php
/*
    Document   : operator.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        File defining the 'operator' model for the application
*/
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.model' );

class IssuemanagerModelOperator extends JModel {
    var $_tickets_list = null;
    var $_total_tickets = null;
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
     * Obtiene el id del usuario actual
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
     * Delivers the list of tickets stored in property $_tickets_list. If still null, data are retrieved from DB
     *
     * @return array
     */
    function _retrieveList() {
        if (!$this->_tickets_list) {
            // Get reference to DB
            $db =& JFactory::getDBO();
            // Query to retrieve all the open tickets of any customer
            $query = "SELECT t.*, u.username
                    FROM #__im_tickets t
                    INNER JOIN #__users u ON t.author_id=u.id
                    WHERE t.open=1 ORDER BY t.mdate DESC";
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
            $this->_retrieveList();
        }
        return array_slice($this->_tickets_list, $this->_limitstart, $this->_limit);
    }

    function getTotal() {
        return $this->_total_tickets;
    }

}

?>
