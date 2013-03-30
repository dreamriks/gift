<?php
/*
    Document   : view.raw.php
    Created on : 03-feb-2009, 19:30:05
    Author     : Luis Martin
    Description:
        main file for view 'order'
*/
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.view');

class IssuemanagerViewOrder extends JView {
    function display($tmpl = null) {
        // Get reference to model assigned for this view
        $model =& $this->getModel();
        // Get data from model
        $orderTotal = $model->get_order_total();
        $productsList = $model->get_products_list();
        // Assign variables to properties to use them in the template
        $this->assignRef('orderTotal', $orderTotal);
        $this->assignRef('productsList', $productsList);
        // Call the overriden method of the parent and pass the template name, if any
        parent::display($tmpl);
    }
}
?>
