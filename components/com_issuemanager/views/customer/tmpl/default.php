<?php
/*
    Document   : default.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        default template for 'customer' view
*/
defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<form action="index.php" name="adminForm" method="GET">
    <input type="hidden" id="num_rows" name="num_rows" value="<?php echo count($this->tickets);?>" />
<table class="ticket_list">
    <thead>
        <tr>
            <th>
                <!-- Column for checkbox which selects/deselect all rows at a time -->
                <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->tickets);?>); setCheckedAll(this.checked); " />
            </th>
            <th><?php echo JText::_('ALERTS');?></th>
            <th><?php echo JText::_('TICKETNUMBER');?></th>
            <?php if ($this->orders) echo '<th>' . JText::_('ORDERNUMBER') . '</th>';?>
            <th><?php echo JText::_('SUBJECT');?></th>
            <th><?php echo JText::_('CREATIONDATE');?></th>
            <th><?php echo JText::_('LASTMODIFICATIONDATE');?></th>
            <th><?php echo JText::_('VIEW');?></th>
        </tr>
    </thead>
    <?php
    if ($this->tickets) {
        $odds = 0;
        $i = 0;
        foreach ($this->tickets as $ticket) {
            if ($ticket->open == 0) {
                $closed = ' closed';
            } else {
                $closed = '';
            }
            ?>
            <tr class="r<?php echo $odds . $closed; ?>">
                <td><input type="checkbox" id="cb<?php echo $i; ?>" name="cid[]" value="<?php echo $ticket->ticket_id; ?>" onclick="isChecked(this.checked);setChecked(this.checked, this.value);" /></td>
                <td class="<?php
                           // mark alerts cell provided that the current ticket has a non-replied message from the opposite side (the operators)
                           if (($ticket->resolved == 0) && ($ticket->status == 3 || $ticket->status == 4)) {
                                echo "waiting_answer";
                           }
                           ?>">
                    <?php
                        echo (!$ticket->open) ? '<b>' . JText::_('CLOSED_TICKET') . '</b>' : '';
                        // Check 'new message' alert for customer
                        if ($ticket->status == 3) {
                            echo '<span class="new_post"></span>';
                        }
                        // If ticket is marked as resolved and it's not closed, show 'ticket resolved' alert
                        if ($ticket->resolved == 1 && $ticket->open != 0) {
                            echo '<span class="resolved"></span>';
                        }
                    ?>
                </td>
                <td><?php echo $ticket->ticket_number; ?></td>
                
                <?php
                if ($this->orders) {
                    echo '<td style="text-align:center;">';
                    if ($ticket->order_id) {
                        echo '<span class="order_link" onmouseover="displayAjax(\'' . JRoute::_('index.php?option=' . $option . '&view=order&task=view_order&format=raw&orderid=' . $ticket->order_id) . '\');"
                                              onmouseout="abortAjax();nd();">' . str_pad($ticket->order_id, 8, '0', STR_PAD_LEFT) . '</span>';
                    } else {
                        echo '<img src="administrator/images/publish_x.png" alt="' . JText::_('NO_ORDER_RELATED') . '" title="' . JText::_('NO_ORDER_RELATED') . '" />';
                    }
                    echo '</td>';
                }
                ?>
                
                <td><?php echo $ticket->ticket_subject; ?></td>
                <td><?php echo JHTML::Date($ticket->cdate, $this->dateFormatArr['strftime']); ?></td>
                <td><?php echo JHTML::Date($ticket->mdate, $this->dateFormatArr['strftime']); ?></td>
                <td>
                    <a href="<?php echo JRoute::_("index.php?option=" . $option . "&view=ticket&cid[]=" . $ticket->ticket_id);?>">
                        <img src="components/com_issuemanager/assets/icons/view_tiny_icon.png" alt="<?php echo JText::_('VIEW'); ?>" title="<?php echo JText::_('VIEW'); ?>" />
                    </a>
                </td>
            </tr>
            <?php
            $odds = 1 - $odds;
            $i++;
        }
    } else {
        ?>
            <tr class="empty"><td colspan="8"><b><?php echo JText::_('NO_TICKET_CREATED'); ?></b></td></tr>
        <?php
    }
    ?>
    <tr>
        <td colspan="8"><?php echo $this->getPagination()->getListFooter(); ?></td>
    </tr>
</table>
    <input type="hidden" name="view" value="<?php echo $this->viewName; ?>" />
    <input type="hidden" name="option" value="<?php echo $option; ?>">
    <input type="hidden" name="boxchecked" value="0" />
</form>
<br /><br />
<div class="new_form">
    <h4><?php echo JText::_('NEWTICKET'); ?></h4>
    <?php echo $this->loadTemplate('form');?>
</div>