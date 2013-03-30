<?php
/*
    Document   : view.html.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        file for the 'ticket' view (to display ticket in detail with all its posts)

*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.view');

class IssuemanagerViewTicket extends JView {
    function display($tmpl = null) {
        // Recover global variable of option in order to use it in the template
        global $option;
        // Get reference to model which corresponds to this view
        $model =& $this->getModel();
        // Get from model the necessary data to be shown from the ticket
        $ticket = $model->getInfo();
        // Get parameter of date format
        $params = &JComponentHelper::getParams( 'com_issuemanager' );
        $virtuemart = intval($params->get('virtuemart'));
        $dateFormatVal = intval($params->get('date_format'));
        $dateFormat = new DateFormat();
        $dateFormatStrArr = $dateFormat->getDateFormat($dateFormatVal);
        // Assign date format variable to use it in the templates
        $this->assignRef('dateFormatArr', $dateFormatStrArr);
        // Create dynamic property for view class in which store ticket data so that the templates can access them
        $this->assignRef('ticket', $ticket);
        // Now get list of posts for given ticket
        $posts = $model->getPosts();
        // Create corresponding property for the view class which stores the post data, so that the templates can access them
        $this->assignRef('posts', $posts);
        // Create property to store ticket id, which also must be accessed by template
        $this->assignRef('ticketid', $model->get_ticketid());
        // Assign value from 'VirtueMart' parameter in general config
        $this->assignRef('virtuemart', $virtuemart);
        // Order to display the saved data in the view with the specified template (if null, use default template)
        parent::display($tmpl);
    }
}
?>
