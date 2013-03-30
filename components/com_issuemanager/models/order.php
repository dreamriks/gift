<?php
/*
    Document   : order.php
    Created on : 04-feb-2009, 19:30:05
    Author     : Luis Martin
    Description:
        This file defines the model 'order' of the application (it gets the detailed info of an order pointed by the mouse pointer)
*/
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.model' );

class IssuemanagerModelOrder extends JModel {

    private $_products_list = null;
    private $_order_total = null;

    function getOrderXML($orderid) {
        $db =& JFactory::getDBO();
        $query = "SELECT p.order_item_name, p.product_quantity, o.order_total
                  FROM #__vm_orders o
                  INNER JOIN #__vm_order_item p
                  ON o.order_id=p.order_id
                  WHERE o.order_id=" . $orderid;
        $db->setQuery($query);
        $order = $db->loadObjectList();
        if ($db->getErrorNum()) {
            echo "<script>alert('Error trying to get order info from database: " . $db->getError() . "'); window.history.go(-1);</script>\n";
            exit();
        }
        $xmlOutput = '<xml><order total="' . $order[0]->order_total . '">';
        foreach ($order as $product) {
            $xmlOutput .= '<product name="'. $product->order_item_name .'" quantity="'. $product->product_quantity .'" />';
        }
        $xmlOutput .= '</order></xml>';
        return $xmlOutput;
    }

    function set_products_list($products_list) {
        $this->_products_list = $products_list;
    }

    function set_order_total($order_total) {
        $this->_order_total = $order_total;
    }

    function get_products_list() {
        return $this->_products_list;
    }

    function get_order_total() {
        return $this->_order_total;
    }
}

?>
