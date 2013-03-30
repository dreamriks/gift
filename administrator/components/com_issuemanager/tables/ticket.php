<?php
/*
    Document   : ticket.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        Defines class TableTicket, which inherits from JTable and allows to use its methods to help manage DB table #__im_tickets
*/
defined('_JEXEC') or die('Restricted access');
/**
 * Class TableTicket: extends JTable to manage a row (or ticket) of table of tickets in DB
 * Extends JTable and adds additional properties for all the columns require for the tickets table
 */
class TableTicket extends JTable
{
    var $ticket_id = null;
    var $ticket_number = null;
    var $order_id = null;
    var $ticket_subject = null;
    var $cdate = null;
    var $mdate = null;
    var $open = null;
    var $status = null;
    var $num_posts = null;
    var $author_id = null;
    var $resolved = null;

    /**
     * Builds instance of TableTicket for table of tickets of the DB
     *
     * @param JDatabase $db
     */
    function __construct(&$db)
    {
        parent::__construct( '#__im_tickets', 'ticket_id', $db );
    }
}
?>