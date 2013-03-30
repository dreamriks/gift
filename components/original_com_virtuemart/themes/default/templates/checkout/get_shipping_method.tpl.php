<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version $Id: get_shipping_method.tpl.php 1140 2008-01-09 20:44:35Z soeren_nb $
* @package VirtueMart
* @subpackage templates
* @copyright Copyright (C) 2007 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/

ps_checkout::show_checkout_bar();

echo $basket_html;

// Start delivery date time
$delivery_date_time = vmGet( $_REQUEST, 'delivery_date_time');
JHTML::_('behavior.calendar');
echo '<br />';
echo '<strong>' . strtoupper($VM_LANG->_('PHPSHOP_CHECKOUT_DELIVERY_DATE_TIME')) . ':&nbsp;&nbsp;</strong>';
?>

<input type="text" class="inputbox" size="40" name="delivery_date_time" id="delivery_date_time_input" value="<?php echo $delivery_date_time; ?>"/>
<script type="text/javascript">
    Calendar.setup({
        inputField		:	"delivery_date_time_input",
        ifFormat		:	"<?php echo $vendor_date_format; ?>",
        showsTime		:	true,
		timeFormat		:	"12",
		singleClick		:	false,
		dateStatusFunc  :   function (date) {
                              var myDate = new Date();
							  if (date.getTime() < myDate.setDate(myDate.getDate() - 1)) return true;
							  }
	});
</script>
<?php
// End delivery date time


echo '<br />';
$varname = 'PHPSHOP_CHECKOUT_MSG_' . CHECK_OUT_GET_SHIPPING_METHOD;
echo '<h4>'. $VM_LANG->_($varname) . '</h4>';

ps_checkout::list_shipping_methods($ship_to_info_id, $shipping_rate_id );

?>
