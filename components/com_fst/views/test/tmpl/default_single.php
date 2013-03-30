<?php
/**
* @Copyright Freestyle Joomla (C) 2010
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
*     
* This file is part of Freestyle Testimonials
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
**/
?>
<?php

// No direct access

defined('_JEXEC') or die('Restricted access'); ?>

<?php echo FST_Helper::PageStyle(); ?>
<?php echo FST_Helper::PageTitle("TESTIMONIALS",$this->product['title']);?>
<?php $hideprodlink = 1; ?>
<?php $product = &$this->product; ?>
<?php include JPATH_SITE.DS.'components'.DS.'com_fst'.DS.'views'.DS.'test'.DS.'snippet'.DS.'_prod.php';
//include "components/com_fst/views/test/snippet/_prod.php" ?>
<div class="fst_spacer"></div>
<div class="fst_clear"></div>
<?php $count = $this->comments->DisplayComments(); ?>
<?php if ($count == 0): ?>
	<?php if ($product['id'] == 0): ?>
		<?php if ($product['title'] != ""): ?>
			<?php echo JText::_('NO_GENERAL_TESTS'); ?>
		<?php else: ?>
			<?php echo JText::_('THERE_ARE_NO_TESTIMONIALS_TO_DISPLAY'); ?>
		<?php endif; ?>
	<?php else :?>
		<?php echo JText::_('NO_TESTS_FOR_PRODUCT'); ?>
	<?php endif; ?>
<?php endif; ?>
<?php include JPATH_SITE.DS.'components'.DS.'com_fst'.DS.'_powered.php'; ?>

<?php echo FST_Helper::PageStyleEnd(); ?>