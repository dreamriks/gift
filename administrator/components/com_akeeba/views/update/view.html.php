<?php
/**
 * @package AkeebaBackup
 * @copyright Copyright (c)2006-2010 Nicholas K. Dionysopoulos
 * @license GNU General Public License version 3, or later
 * @version $Id: view.html.php 71 2010-02-22 22:17:01Z nikosdion $
 * @since 2.2
 */

// Protect from unauthorized access
defined('_JEXEC') or die('Restricted Access');

// Load framework base classes
jimport('joomla.application.component.view');

/**
 * MVC View for Live Update
 *
 */
class AkeebaViewUpdate extends JView
{
	function display()
	{
		$task = JRequest::getCmd('task');
		$force = ($task == 'force');

		// Set the toolbar title; add a help button
		JToolBarHelper::title(JText::_('AKEEBA').':: <small>'.JText::_('LIVEUPDATE')).'</small>';
		JToolBarHelper::back('Back', 'index.php?option='.JRequest::getCmd('option'));

		// Load the model
		$model =& $this->getModel();
		$updates =& $model->getUpdates($force);
		$this->assignRef('updates', $updates);

		$document =& JFactory::getDocument();
		$document->addStyleSheet(JURI::base().'../media/com_akeeba/theme/akeebaui.css');
		parent::display();
	}
}