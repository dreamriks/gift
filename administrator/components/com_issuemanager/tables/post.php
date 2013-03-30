<?php
/*
    Document   : post.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        Defines class TablePost, which inherits from JTable and allows to use its methods to help managing DB table #__im_posts
*/
defined('_JEXEC') or die('Restricted access');
/**
 * Class TablePosts: extends JTable to handle each row (or post) of the table of posts
 * Extends JTable and adds additional properties for all the columns of the table of posts
 */
class TablePost extends JTable
{
    var $post_id = null;
    var $ticket_id = null;
    var $post_body = null;
    var $post_order = null;
    var $cdate = null;
    var $post_author_id = null;

    /**
     * Builds an instance of TablePost for the table of posts in the database
     *
     * @param JDatabase $db
     */
    function __construct(&$db)
    {
        parent::__construct( '#__im_posts', 'post_id', $db );
    }
}
?>