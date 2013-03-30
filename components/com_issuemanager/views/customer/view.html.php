<?php
/*
    Document   : view.html.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        File for the 'customer' view
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.view');
jimport('joomla.html.pagination');

class IssuemanagerViewCustomer extends JView {
    function display($tmpl = null) {
        global $option;
        // Get reference to model corersponding to current view
        $model = &$this->getModel();
        // Get list of tickets from model by passing the user id to it
        $tickets = $model->getList();
        // Get currency symbol and date format parameters
        $params = &JComponentHelper::getParams( 'com_issuemanager' );
        $currency = $params->get('currency_symbol');
        $virtuemart = intval($params->get('virtuemart'));
        // Get orders made by customer, if there's any
        if ($virtuemart) $orders = $model->get_customer_orders(); else $orders = null;
        // Date format
        $dateFormatVal = intval($params->get('date_format'));
        $dateFormat = new DateFormat();
        $dateFormatStrArr = $dateFormat->getDateFormat($dateFormatVal);
        // Assign new dynamic properties to the view so that the template can use them
        $this->assignRef('tickets', $tickets);
        $this->assignRef('orders', $orders);
        $this->assignRef('currency', $currency);
        $this->assignRef('dateFormatArr', $dateFormatStrArr);
        $this->assignRef('viewName', $this->getName());
        // Call overriden method from parent passing the specified template (if null, use default template)
        parent::display($tmpl);
    }
	
    public function getPagination() {
        $model = $this->getModel();
        return $model->getPagination();
    }
}

?>
