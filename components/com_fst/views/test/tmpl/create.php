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

<?php echo $this->tmpl ? FST_Helper::PageStylePopup() : FST_Helper::PageStyle(); ?>


	<?php echo $this->tmpl ? FST_Helper::PageTitlePopup("TESTIMONIALS","ADD_A_TESTIMONIAL") : FST_Helper::PageTitle("TESTIMONIALS","ADD_A_TESTIMONIAL"); ?>
	<div class='fst_kb_comment_add' id='add_comment'>
		<?php $this->comments->DisplayAdd(); ?>
	</div>

	<div id="comments"></div>
<?php if ($this->tmpl): ?>
	<div class='fst_comments_result'></div>
<?php endif; ?>
<?php $this->comments->IncludeJS() ?>

<?php include JPATH_SITE.DS.'components'.DS.'com_fst'.DS.'_powered.php'; ?>

<?php echo $this->tmpl ? FST_Helper::PageStylePopupEnd() : FST_Helper::PageStyleEnd(); ?>