<?php
/*
    Document   : default_form.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        template for new ticket form
*/

defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<form name="newTicket" action="index.php" method="POST" onsubmit="return validate_form()">
    <?php
    if ($this->orders) {
    ?>
        <table class="form ticket">
            <tr><td valign="top"><label for="order_select"><?php echo JText::_('SELECT_ORDER') . ' <i>(' . JText::_('IF_APPLICABLE') . ')</i>';?>:</label></td></tr>
            <tr>
                <td>
                    <div class="orders">
                        <table>
                            <tr>
                                <th></th><th><?php echo JText::_('ORDERNUMBER');?></th><th><?php echo JText::_('ORDERTOTAL');?></th><th><?php echo JText::_('DATE');?></th>
                            </tr>
                            <tr><td><input type="radio" name="order_id" value="null" /></td><td colspan="3"><?php echo JText::_('DESELECT');?></td></tr>
                            <?php
                            foreach ($this->orders as $order) {
                            ?>
                                <tr>
                                    <td><input type="radio" name="order_id" value="<?php echo $order->order_id; ?>" /></td>
                                    <td><span class="order_link" onmouseover="displayAjax('<?php echo JRoute::_('index.php?option=' . $option . '&view=order&task=view_order&format=raw&orderid=' . $order->order_id); ?>');"
                                              onmouseout="abortAjax();nd();"><?php echo str_pad($order->order_id, 8, '0', STR_PAD_LEFT);?></span></td>
                                    <td align="right"><?php echo round($order->order_total, 2) . ' ' . $this->currency;?></td>
                                    <td align="right"><?php echo date($this->dateFormatArr['date'], $order->cdate);?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
     <?php
    }
    ?>

    <table class="form ticket">
        <tr>
            <td valign="top"><label for="ticket_subject"><?php echo JText::_('TICKETSUBJECT');?>:</label></td>
            <td><input type="text" name="ticket_subject" id="ticket_subject" value="" size="26" /></td>
        </tr>
        <tr>
            <td valign="top"><label for="post_body"><?php echo JText::_('MESSAGE');?>:</label></td>
            <td><textarea id="post_body" name="post_body"></textarea></td>
        </tr>
        <tr>
            <td colspan="2" align="right"><input type="submit" value="<?php echo JText::_('SENDNEWTICKET');?>" name="submitButton" /></td>
        </tr>
    </table>
    
    <input type="hidden" name="option" value="<?php echo $option; ?>" />
    <input type="hidden" name="task" value="add_ticket" />
    <input type="hidden" name="view" value="<?php echo $this->getName(); ?>" />
</form>