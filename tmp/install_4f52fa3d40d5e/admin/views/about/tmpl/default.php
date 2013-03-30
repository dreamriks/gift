<?php
/**
 * About page
 *
 * @package 	CSVI
 * @author 		Roland Dalmulder
 * @todo
 * @link 		http://www.csvimproved.com
 * @copyright 	Copyright (C) 2006 - 2012 RolandD Cyber Produksi
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: default.php 1891 2012-02-11 10:43:52Z RolandD $
 */

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
?>
<table class="adminlist">
	<thead>
		<tr>
			<th width="650"><?php echo JText::_('COM_CSVI_FOLDER'); ?></th>
			<th><?php echo JText::_('COM_CSVI_FOLDER_STATUS'); ?></th>
			<th><?php echo JText::_('COM_CSVI_FOLDER_OPTIONS'); ?></th>
		</tr>
	<thead>
	<tfoot>
	</tfoot>
	<tbody>
		<?php
			$i = 1;
			foreach ($this->folders as $name => $access) { ?>
			<tr>
				<td><?php echo $name; ?></td>
				<td><?php if ($access) { echo '<span class="writable">'.JText::_('COM_CSVI_WRITABLE').'</span>'; } else { echo '<span class="not_writable">'.JText::_('COM_CSVI_NOT_WRITABLE').'</span>'; } ?>
				<td><?php if (!$access) { ?>
					<form action="index.php?option=com_csvi&view=about">
						<input type="button" class="button" onclick="Csvi.createFolder('<?php echo $name; ?>', 'createfolder<?php echo $i; ?>'); return false;" name="createfolder" value="<?php echo JText::_('COM_CSVI_FOLDER_CREATE'); ?>"/>
					</form>
					<div id="createfolder<?php echo $i;?>"></div><?php } ?>
				</td>
			</tr>
		<?php $i++;
			} ?>
	</tbody>
</table>
<br />
<table class="adminlist">
<tr><td colspan="2"><?php echo JHtml::_('image', JURI::base().'components/com_csvi/assets/images/csvi_about_32.png', JText::_('COM_CSVI_ABOUT')); ?></td></tr>
<tbody>
<tr><th>Name:</th><td>CSVI</td></tr>
<tr><th>Version:</th><td>4.0.1</td></tr>
<tr><th><form action="index.php?option=com_csvi&view=about"><input type="button" class="button" onclick="Csvi.checkVersion(); return false;" name="checkversion" value="<?php echo JText::_('COM_CSVI_CHECK_VERSION'); ?>"/></form></th><td><div id="checkversion"></div></td></tr>
<tr><th>Coded by:</th><td>RolandD Cyber Produksi</td></tr>
<tr><th>Contact:</th><td>contact@csvimproved.com</td></tr>
<tr><th>Support:</th><td><?php echo JHTML::_('link', 'http://www.csvimproved.com/', 'CSVI Homepage', 'target="_blank"'); ?></td></tr>
<tr><th>Copyright:</th><td>Copyright (C) 2006 - 2012 RolandD Cyber Produksi</td></tr>
<tr><th>License:</th><td><?php echo JHtml::_('link', 'http://www.gnu.org/licenses/gpl-3.0.html', 'GNU/GPL v3'); ?></td></tr>
</tbody>
</table>