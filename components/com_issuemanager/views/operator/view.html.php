<?php
/*
    Document   : view.html.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        Main file for 'operator' view, contains class for this view
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.view');
jimport('joomla.html.pagination');

class IssuemanagerViewOperator extends JView {
    function display($tmpl = null) {
        global $option;
        // Get reference to model of current view
        $model = &$this->getModel();
        // Get list of tickets of the model
        $tickets = $model->getList();
        // Get parameter for date format
        $params = &JComponentHelper::getParams( 'com_issuemanager' );
        $virtuemart = intval($params->get('virtuemart'));
        $dateFormatVal = intval($params->get('date_format'));
        $dateFormat = new DateFormat();
        $dateFormatStrArr = $dateFormat->getDateFormat($dateFormatVal);
        // Assign new dynamic properties to this class so that they can be used by the template
        $this->assignRef('virtuemart', $virtuemart);
        $this->assignRef('tickets', $tickets);
        $this->assignRef('dateFormatArr', $dateFormatStrArr);
        $this->assignRef('viewName', $this->getName());
        // Call the overriden method of the parent class, passing as parameter the specified template (if null, use default template)
        parent::display($tmpl);
    }

    public function getPagination() {
        $model = $this->getModel();
        return $model->getPagination();
    }
}

?>
