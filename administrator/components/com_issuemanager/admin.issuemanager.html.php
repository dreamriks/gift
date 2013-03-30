<?php
/*
    Document   : admin.issuemanager.html.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        File for the view class of the back-end or administration interface
*/
defined( '_JEXEC' ) or die( 'Restricted access' );
/**
 * Class for the administration view, or HTML output
 */
class HTML_issuemanager
{
    /**
     * Shows table row by row with all the tickets obtained. Each one's information is presented in separated columns.
     *
     * @param string $option        Name of current component, which must be the name for the Issue Manager component
     * @param array $rows           Stores all the rows of tickets to list
     * @param JPagination $pageNav  Helper object for pagination of the HTML table
     * @param string $dateStr       Stores the chosen date format
     */
    function show_tickets($option, &$rows, &$pageNav, $dateStr)
    {
        ?>
        <form name="adminForm" action="index.php" method="POST">
            <table class="adminlist">
                <thead>
                    <tr>
                        <th>
                            <!-- Column for the checkbox that selects/deselects all rows at a time -->
                            <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" />
                        </th>
                        <th><?php echo JText::_('ALERTS'); ?></th>
                        <th><?php echo JText::_('TICKETNUMBER'); ?></th>
                        <th><?php echo JText::_('ORDERNUMBER'); ?></th>
                        <th><?php echo JText::_('TICKETSUBJECT'); ?></th>
                        <th><?php echo JText::_('AUTHOR'); ?></th>
                        <th><?php echo JText::_('CREATIONDATE'); ?></th>
                        <th><?php echo JText::_('MODIFICATIONDATE'); ?></th>
                        <th><?php echo JText::_('VIEW'); ?></th>
                        <th><?php echo JText::_('STATUS'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $odds = 0;
                    // Loop through the rows of tickets in order to format each one in an HTML table row
                    for ($i=0, $n=count($rows); $i < $n; $i++)
                    {
                        // Get current row from array
                        $row = &$rows[$i];
                        // Store for further use the necessary HTML to display a checkbox assigned to the given id, by using predefined Joomla method
                        $checked = JHTML::_('grid.id', $i, $row->ticket_id);
                        // Necessary links for 'view ticket in detail', 'open ticket', close ticket'
                        $viewLink = 'index.php?option=' . $option . '&task=view_ticket&cid[]=' . $row->ticket_id;
                        $openLink = 'index.php?option=' . $option . '&task=open_ticket&cid[]=' . $row->ticket_id;
                        $closeLink = 'index.php?option=' . $option . '&task=close_ticket&cid[]=' . $row->ticket_id;
                        $ecommerceLink = "index.php?option=com_virtuemart&page=order.order_print&order_id=";

                        if ($row->open == 0) {
                            $status = "closed ";
                        } else {
                            $status = '';
                        }
                        ?>
                        <tr class="<?php echo $status . "row$odds"; ?>">
                            <td>
                                <?php echo $checked; ?>
                            </td>
                            <td class="<?php
                                        // mark alerts cell provided that there's a message waiting answer from the opposite side (the operators/admins)
                                        if (($row->resolved == 0) && ($row->status == 1 || $row->status == 2)) {
                                            echo "waiting_answer";
                                        }
                            ?>">
                                <?php
                                // If new message from customer, show 'new message' alert
                                if ($row->status == 1) {
                                    echo '<span class="new_post"></span>';
                                }
                                // If ticket marked as resolved and not closed yet, show 'ticket resolved' alert
                                if ($row->resolved == 1 && $row->open != 0) {
                                    echo '<span class="resolved"></span>';
                                }
                                echo (!$row->open) ? '<b>' . JText::_('CLOSED_TICKET') . '</b>' : '';
                                ?>
                            </td>
                            <td>
                                <?php echo $row->ticket_number; ?>
                            </td>
                            <td>
                                <?php 
                                if ($row->order_id) {
                                    echo '<a href="' . $ecommerceLink . $row->order_id . '">' . str_pad($row->order_id, 8, '0', STR_PAD_LEFT) . '</a>';
                                } else {
                                    echo '<span class="no_order"></span>';
                                }
                                ?>
                            </td>
                            <td>
                                <?php echo $row->ticket_subject; ?>
                            </td>
                            <td>
                                <?php echo $row->author; ?>
                            </td>
                            <td>
                                <?php echo JHTML::Date($row->cdate, $dateStr);?>
                            </td>
                            <td>
                                <?php echo JHTML::Date($row->mdate, $dateStr);?>
                            </td>
                            <td>
                                <a href="<?php echo $viewLink; ?>"><img src="components/<?php echo $option; ?>/assets/icons/view_tiny_icon.png" alt="<?php echo JText::_('VIEW'); ?>" title="<?php echo JText::_('VIEW'); ?>" /></a>
                            </td>
                            <td class="status<?php echo $row->status; ?>">
                                <?php
                                if ($row->open == 0) {
                                    // Ticket cerrado
                                    ?>
                                <a href="<?php echo $openLink ?>"><img src="images/publish_x.png" alt="<?php echo JText::_('OPEN_TICKET'); ?>" title="<?php echo JText::_('OPEN_TICKET'); ?>" /></a>
                                    <?php
                                } elseif ($row->open == 1) {
                                    // Ticket abierto
                                    ?>
                                    <a href="<?php echo $closeLink ?>"><img src="images/tick.png" alt="<?php echo JText::_('CLOSE_TICKET'); ?>" title="<?php echo JText::_('CLOSE_TICKET'); ?>" /></a>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                        $odds = 1 - $odds;
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="10"><?php echo $pageNav->getListFooter(); ?></td>
                    </tr>
                </tfoot>
            </table>
            <input type="hidden" name="task" value="display_tickets" />
            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" name="boxchecked" value="0" />
        </form>
        <?php
    }

    /**
     * Shows detailed info of current ticket
     *
     * @param object $row       Object which contains the current ticket details as properties
     * @param string $dateStr   Specifies date format
     */
    function show_ticket_details(&$row, $dateStr) {
        ?>
            <!-- Table to show the ticket aspects -->
            <table class="adminlist">
                <thead>
                    <tr>
                        <th><?php echo JText::_('TICKETNUMBER'); ?></th>
                        <th><?php echo JText::_('ORDERNUMBER'); ?></th>
                        <th><?php echo JText::_('USERNAME'); ?></th>
                        <th><?php echo JText::_('DATEOFORDER'); ?></th>
                        <th><?php echo JText::_('TICKETSUBJECT'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php echo $row->ticket_number; ?>
                        </td>
                        <td>
                            <?php
                            $ecommerceLink = "index.php?option=com_virtuemart&page=order.order_print&order_id=";
                            if ($row->order_id != 0) {
                                echo '<a href="' . $ecommerceLink . $row->order_id . '">' . str_pad($row->order_id, 8, '0', STR_PAD_LEFT) . '</a>';
                            } else {
                                echo JText::_('TICKET_NOT_ASSIGNED_TO_ORDER');
                            }
                            ?>
                        </td>
                        <td>
                            <?php echo $row->username; ?>
                        </td>
                        <td>
                            <?php
                            if ($row->cdate) {
                                echo JHTML::Date($row->cdate, $dateStr);
                            } else {
                                echo '-';
                            }
                            ?>
                        </td>
                        <td>
                            <?php echo $row->ticket_subject; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        <br /><br />
        <?php
    }

    /**
     * Shows table row by row with all the posts for the current ticket
     *
     * @param string $option    Stores component name
     * @param array $rows       Stores all rows of posts of current ticket
     * @param int $ticketid     ticket ID
     * @param string $dateStr   Date format
     */
    function show_ticket_posts($option, &$rows, $ticketid, $dateStr) {
        ?>
        <form name="adminForm" action="index.php" method="POST">
            <!-- HTML table to display post aspects -->
            <table class="adminlist">
                <thead>
                    <tr>
                        <th><?php echo JText::_('AUTHOR'); ?></th>
                        <th><?php echo JText::_('DATE'); ?></th>
                        <th><?php echo JText::_('MESSAGE'); ?></th>
                        <th><?php echo JText::_('USERNAME'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    for ($i=0; $i < count($rows); $i++) {
                        // Get next row
                        $row = &$rows[$i];
                        ?>
                        <tr>
                            <td>
                                <?php echo $row->post_author_id; ?>
                            </td>
                            <td>
                                <?php echo JHTML::Date($row->cdate, $dateStr); ?>
                            </td>
                            <td>
                                <?php echo $row->post_body; ?>
                            </td>
                            <td>
                                <?php echo $row->username; ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <input type="hidden" name="task" value="" />
            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" name="boxchecked" value="0" />
            <input type="hidden" name="cid[]" value="<?php echo $ticketid;?>" />
        </form>
        <br /><br />
        <?php
    }

    /**
     * Shows form for new post
     *
     * @param string $option    Stores component name
     * @param int $ticketid     current ticket ID
     * @param int $num_posts    Specifies number of posts of current ticket.
     *                          Useful in order to pass its value through the form so as to store it with a proper numerical order.
     */
    function show_post_form($option, $ticketid, $num_posts) {
        ?>
        <h3><?php echo JText::_('SEND_NEW_POST'); ?>:</h3>
        <form name="newPost" action="index.php" method="POST">
            <textarea name="post_body" rows="6" cols="100"></textarea><br /><br />
            <input type="submit" value="Send Message" name="submit" />
            <input name="option" type="hidden" value="<?php echo $option; ?>" />
            <input name="ticket_id" type="hidden" value="<?php echo $ticketid; ?>" />
            <input name="post_order" type="hidden" value="<?php echo $num_posts++; ?>" />
            <input name="task" type="hidden" value="add_post" />
        </form>
        <?php
    }

    /**
     * Shows HTML table with a list of the operators/admins of Issue Manager
     *
     * @param string $option        Name of the component
     * @param array $rows           Array which stores all the operators
     * @param int $currentUserid    Current user's ID, intended to prevent the administrator to accidentally do
     *                              certain irreversible actions from back-end, like disabling him/herself
     * @param JPagination $pageNav  Object to help HTML table pagination
     * @param string $dateStr       Date format
     */
    function show_operators($option, &$rows, $currentUserid, &$pageNav, $dateStr) {
        ?>
        <form name="adminForm" action="index.php" method="POST">
            <table class="adminlist">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>
                        <th><?php echo JText::_('OPERATORID'); ?></th>
                        <th><?php echo JText::_('USERID'); ?></th>
                        <th><?php echo JText::_('USERNAME'); ?></th>
                        <th><?php echo JText::_('TOTALPOSTS'); ?></th>
                        <th><?php echo JText::_('LASTPOSTDATE'); ?></th>
                        <th><?php echo JText::_('RANK'); ?></th>
                        <th><?php echo JText::_('STATUS'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $odds = 0;
                    $i = 0;
                    foreach ($rows as $row):
                        // Store for further use the necessary HTML to display a checkbox assigned to given id
                        $checked = JHTML::_('grid.id', $i, $row->operator_id);
                        ?>
                        <tr class="<?php echo "row$odds"; ?>">
                            <td>
                                <?php echo $checked; ?>
                            </td>
                            <td>
                                <?php echo $row->operator_id;  ?>
                            </td>
                            <td>
                                <?php echo $row->user_id; ?>
                            </td>
                            <td>
                                <?php echo $row->username; ?>
                            </td>
                            <td>
                                <?php echo $row->num_posts; ?>
                            </td>
                            <td>
                                <?php
                                if ($row->last_post == '0000-00-00 00:00:00') {
                                    echo '<b>' . JText::_('NEVER') . '</b>';
                                } else {
                                    echo JHTML::Date($row->last_post, $dateStr);
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                $rank = null;
                                $task = null;
                                if ($row->rank == 0) {
                                    $rank = 'operator';
                                    $task = 'operator_to_admin';
                                } elseif ($row->rank == 1) {
                                    $rank = 'administrator';
                                    $task = 'admin_to_operator';
                                }
                                if ($row->status == 1) {
                                    ?>
                                    <a href="index.php?option=<?php echo $option; ?>&task=<?php echo $task; ?>&cid[]=<?php echo $row->user_id; ?>">
                                    <?php echo $rank; ?>
                                    </a>
                                <?php
                                } else {
                                    echo $rank;
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($row->status == 1 && $row->user_id != $currentUserid) {
                                    echo '<a href="index.php?option=' . $option . '&task=disable_operator&cid[]=' . $row->operator_id . '">
                                            <img src="images/tick.png" alt="' . JText::_('DISABLE_OPERATOR') . '" title="' . JText::_('DISABLE_OPERATOR') . '" /></a>';
                                } elseif ($row->status == 1 && $row->user_id == $currentUserid) {
                                    echo '<img src="images/tick.png" alt="' . JText::_('YOU') . '" title="' . JText::_('YOU') . '" />';
                                } elseif ($row->status == 0) {
                                    echo '<a href="index.php?option=' . $option . '&task=enable_operator&cid[]=' . $row->operator_id . '">
                                            <img src="images/publish_x.png" alt="' . JText::_('ENABLE_OPERATOR') . '" title="' . JText::_('ENABLE_OPERATOR') . '" /></a>';
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                        $odds = 1 - $odds;
                        $i++;
                    endforeach
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8"><?php echo $pageNav->getListFooter(); ?></td>
                    </tr>
                </tfoot>
            </table>
            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" name="task" value="display_operators" />
            <input type="hidden" name="boxchecked" value="0" />
        </form>
        <?php
    }

    /**
     * Shows form for creation of new operator/admin for Issue Manager
     *
     * @param string $option    Name of the component
     * @param array $usersList  Associative array with user id (key) and username (value), in order to display them in a dropdown selection box
     */
    function show_operator_form($option, &$usersList) {
        ?>
        <h3><?php echo JText::_('ADD_NEW_OP'); ?></h3>
        <form name="operatorForm" action="index.php" method="POST">
            <fieldset>
                <legend><?php echo JText::_('NEWOP'); ?></legend>
                <label for="user_id"><?php echo JText::_('USERNAME'); ?></label>
                <select name="user_id">
                    <?php
                    foreach ($usersList as $userid => $username) {
                        ?>
                        <option value="<?php echo $userid; ?>"><?php echo $username; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <label for="rank"><?php echo JText::_('RANK'); ?></label>
                <select name="rank">
                    <option value="0" selected><?php echo JText::_('OPERATOR'); ?></option>
                    <option value="1"><?php echo JText::_('ADMINISTRATOR'); ?></option>
                </select>
                <br />
                <input type="submit" value="Add" name="addButton" />
                <input type="hidden" name="option" value="<?php echo $option; ?>" />
                <input type="hidden" name="task" value="save_operator" />
            </fieldset>
        </form>
        <?php
    }
}
?>