<?php
/********************************************************************
Product    : Flexicontact
Date       : 18 April 2011
Copyright  : Les Arbres Design 2010-2011
Contact    : http://extensions.lesarbresdesign.info
Licence    : GNU General Public License
*********************************************************************/

defined('_JEXEC') or die('Restricted Access');

jimport('joomla.application.component.view');

class FlexicontactViewLog_List extends JView
{
function display($tpl = null)
{
	JToolBarHelper::title(LA_COMPONENT_NAME.': <small><small>'.JText::_('COM_FLEXICONTACT_LOG').'</small></small>', 'flexicontact.png');
	JToolBarHelper::deleteList('','delete_log');
	
	if (!$this->logging)
		echo '<span class="flexicontact_error">'.JText::_('COM_FLEXICONTACT_LOGGING').' '.JText::_('COM_FLEXICONTACT_V_DISABLED').'</span>';

// get the order states				

	$app = &JFactory::getApplication();
	$filter_order = $app->getUserStateFromRequest(LA_COMPONENT.'.filter_order', 'filter_order', 'date_time');
	$filter_order_Dir = $app->getUserStateFromRequest(LA_COMPONENT.'.filter_order_Dir', 'filter_order_Dir', 'desc');
	$lists['order_Dir'] = $filter_order_Dir;
	$lists['order'] = $filter_order;
	$search = $app->getUserStateFromRequest(LA_COMPONENT.'.search','search','','string');
	$lists['search'] = JString::strtolower($search);

// get the current filters	
		
	$filter_date = $app->getUserStateFromRequest(LA_COMPONENT.'.filter_date','filter_date',LOG_LAST_28_DAYS,'int');

// make the filter lists

	$date_filters = array(
		LOG_ALL           => JText::_('COM_FLEXICONTACT_LOG_ALL'),
		LOG_LAST_7_DAYS  => JText::_('COM_FLEXICONTACT_LOG_LAST_7_DAYS'),
		LOG_LAST_28_DAYS  => JText::_('COM_FLEXICONTACT_LOG_LAST_28_DAYS'),
		LOG_LAST_12_MONTHS => JText::_('COM_FLEXICONTACT_LOG_LAST_12_MONTHS')
		);

	$lists['date_filters']    = Flexicontact_Utility::make_list('filter_date', $filter_date, $date_filters, 0, 'onchange="submitform( );"');					

// Show the list

	$numrows = count($this->log_list);
	?>
	<form action="index.php" method="post" name="adminForm" id="adminForm">
	<input type="hidden" name="option" value="<?php echo LA_COMPONENT ?>" />
	<input type="hidden" name="task" value="log_list" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="view" value="log_list" />
	<input type="hidden" name="filter_order" value="<?php echo $lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $lists['order_Dir']; ?>" />

	<table>
	<tr>
		<td align="left" width="100%">
			<?php 
			echo ' '.JText::_('COM_FLEXICONTACT_SEARCH').':';
			echo '<input type="text" size="60" name="search" id="search" value="';
			echo $lists['search'];
			echo '" class="text_area" onchange="document.adminForm.submit();" />';
			echo ' <button onclick="this.form.submit();">'.JText::_('COM_FLEXICONTACT_GO').'</button>';
			?>
		</td>
		<td nowrap="nowrap">
			<?php
			echo $lists['date_filters'];
			echo '&nbsp;';
			echo '<button onclick="'."
					this.form.getElementById('filter_date').value='".LOG_LAST_28_DAYS."';
					this.form.getElementById('search').value='';
					this.form.submit();".'">'.JText::_('COM_FLEXICONTACT_RESET').'</button>';
			?>
		</td>
	</tr>
	</table>

	<table class="adminlist">
	<thead>
	<tr>
		<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo $numrows; ?>);" /></th>
		<th class="title" nowrap="nowrap">
			<?php echo JHTML::_('grid.sort', 'COM_FLEXICONTACT_DATE_TIME', 'datetime', $lists['order_Dir'], $lists['order']); ?></th>
		<th class="title" nowrap="nowrap">
			<?php echo JHTML::_('grid.sort', 'COM_FLEXICONTACT_NAME', 'name', $lists['order_Dir'], $lists['order']); ?></th>
		<th class="title" nowrap="nowrap">
			<?php echo JHTML::_('grid.sort', 'COM_FLEXICONTACT_EMAIL', 'email', $lists['order_Dir'], $lists['order']); ?></th>
		<th class="title" nowrap="nowrap">
			<?php echo JHTML::_('grid.sort', 'COM_FLEXICONTACT_SUBJECT', 'subject', $lists['order_Dir'], $lists['order']); ?></th>
		<th class="title" nowrap="nowrap"><?php echo JText::_('COM_FLEXICONTACT_MESSAGE'); ?></th>
		<th class="title" nowrap="nowrap"><?php echo JText::_('COM_FLEXICONTACT_STATUS'); ?></th>
	</tr>
	</thead>

	<tfoot>
	<tr>
		<td colspan="15">
			<?php echo $this->pagination->getListFooter(); ?>
		</td>
	</tr>
	</tfoot>
	
	<tbody>
	<?php
	$k = 0;

	for ($i=0; $i < $numrows; $i++) 
		{
		$row = $this->log_list[$i];
		$link = JRoute::_(LA_COMPONENT_LINK.'&task=log_detail&id='.$row->id);
		$checked = JHTML::_('grid.id', $i, $row->id);
		$date = JHTML::link($link, $row->datetime);
		$name = preg_replace('/[^(a-zA-Z \x27)]*/','', $row->name);				// remove all except a-z, A-Z, and '
		$subject = preg_replace('/[^(a-zA-Z1-9 \x27)]*/','', $row->subject);
		$message = preg_replace('/[^(a-zA-Z1-9 \x27)]*/','', $row->short_message);
		$status_main = $this->_status($row->status_main);
		$status_copy = $this->_status($row->status_copy);

		echo "<tr class='row$k'>
				<td align='center'>$checked</td>
				<td>$date</td>
				<td>$name</td>
				<td>$row->email</td>
				<td>$subject</td>
				<td>$message</td>
				<td>$status_main $status_copy</td>
				</tr>\n";
		$k = 1 - $k;
		}
	?>
	</tbody>
	</table>
	</form>
	<?php
}

function _status($status)
{
	if ($status == '0')		// '0' status means no mail was sent
		return ' ';
	if ($status == '1')		// '1' means email was sent ok
		return '<img src="'.ADMIN_ASSETS_URL.'tick.png" border="0" alt="" />';
	return '<img src="'.ADMIN_ASSETS_URL.'x.png" border="0" alt="" />';	// anything else was an error
}

}