<?php
/*
    Document   : operator.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        Defines class TableOperator, which inherits from JTable and allows to use its methods in order to help managing the DB table
        #__im_operators
*/
defined('_JEXEC') or die('Restricted access');
/**
 * Class TableOperator: extends JTable to handle each row (or operator) of the operators table in the DB.
 * Extends JTable and adds additional properties representing the columns of the operators table
 */
class TableOperator extends JTable
{
    var $operator_id = null;
    var $user_id = null;
    var $num_posts = null;
    var $last_post = null;
    var $rank = null;
    var $status = null;

    /**
     * Builds instance of TableOperator for the operators table in the DB
     *
     * @param JDatabase $db 
     */
    function __construct(&$db)
    {
        parent::__construct( '#__im_operators', 'operator_id', $db );
    }
}
?>