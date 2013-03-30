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
<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<?php echo FST_Helper::PageStyle(); ?>
<?php if (FST_Helper::IsTests()) : ?>
	<?php echo FST_Helper::PageTitle('COMMENT_MODERATION'); ?>
<?php else: ?>
	<?php echo FST_Helper::PageTitle('SUPPORT_ADMIN','COMMENT_MODERATION'); ?>
<?php endif; ?>
<?php // ?>
<?php $this->comments->DisplayModerate(); ?>
<?php include JPATH_SITE.DS.'components'.DS.'com_fst'.DS.'_powered.php'; ?>
<?php echo FST_Helper::PageStyleEnd(); ?>