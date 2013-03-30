<?php
/**
 * @package AkeebaBackup
 * @copyright Copyright (c)2006-2010 Nicholas K. Dionysopoulos
 * @license GNU General Public License version 3, or later
 * @version $Id: update.php 51 2010-01-30 10:49:58Z nikosdion $
 * @since 2.2
 */

// Protect from unauthorized access
defined('_JEXEC') or die('Restricted Access');

// Load framework base classes
jimport('joomla.application.component.controller');

/**
 * The Live Update controller class
 *
 */
class AkeebaControllerUpdate extends JController
{
	function display()
	{
		parent::display();
	}
}