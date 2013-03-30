<?php
/*
    Document   : default.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        template by default for 'ticket' view
*/

defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<!-- Table to display ticket info -->
<table class="ticket_info">
    <thead>
        <tr>
            <th><?php echo JText::_('ALERTS');?></th>
            <th><?php echo JText::_('TICKETNUMBER');?></th>
            <?php if ($this->virtuemart) echo '<th>' . JText::_('ORDERID') . '</th>';?>
            <th><?php echo JText::_('SUBJECT');?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <?php
                if ($this->ticket->status == 3) {
                    echo '<span class="new_post"></span>';
                }
                // If ticket marked as resolved and not closed, show 'ticket resolved' alert
                if ($this->ticket->resolved == 1 && $this->ticket->open != 0) {
                    echo '<span class="resolved"></span>';
                }
                ?>
            </td>
            <td><?php echo $this->ticket->ticket_number; ?></td>
            
            <?php
            if ($this->virtuemart) {
                echo '<td>';
                if ($this->ticket->order_id) {
                    echo '<span class="order_link" onmouseover="displayAjax(\'' . JRoute::_('index.php?option=' . $option . '&view=order&task=view_order&format=raw&orderid=' . $this->ticket->order_id) . '\');"
                           onmouseout="abortAjax();nd();">' . str_pad($this->ticket->order_id, 8, '0', STR_PAD_LEFT) . '</span>';
                } else {
                    echo '<img src="administrator/images/publish_x.png" alt="' . JText::_('NO_ORDER_RELATED') . '" title="' . JText::_('NO_ORDER_RELATED') . '" />';
                }
                echo '</td>';
            }
            ?>
            
            <td><?php echo $this->ticket->ticket_subject; ?></td>
        </tr>
    </tbody>
</table>
<br /><br />
<!-- Table which lists all posts of current ticket -->
<?php echo $this->loadTemplate('posts'); ?>
<br /><br />
<!-- If ticket is open, show the form for new post -->
<div class="new_form">
    <h4><?php echo JText::_('NEWMESSAGE');?></h4>
    <?php
        if ($this->ticket->open == 1) {
            echo $this->loadTemplate('form');
        }
    ?>
</div>