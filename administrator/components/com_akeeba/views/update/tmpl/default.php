<?php
/**
 * @package AkeebaBackup
 * @copyright Copyright (c)2006-2010 Nicholas K. Dionysopoulos
 * @license GNU General Public License version 3, or later
 * @version $Id: default.php 71 2010-02-22 22:17:01Z nikosdion $
 * @since 2.2
 */

defined('_JEXEC') or die('Restricted access');
?>
	<?php if($this->updates->update_available):?>

	<!-- An upgrade has been found -->
	<h2><?php echo JText::_('UPDATE_LABEL_UPGRADEFOUND') ?></h2>
	<?php
	$yourversion = '<span style="font-weight: bold; color: #990000">'.$this->updates->current_version.'</span>';
	$latestversion = '<span style="font-weight: bold; color: #009900">'.$this->updates->latest_version.'</span>';
	$string1 = JText::sprintf('UPDATE_LABEL_VERSIONINFO1',$yourversion,$this->updates->current_date);
	switch($this->updates->status)
	{
		case 'stable':
			$status = JText::_('UPDATE_STATUS_STABLE');
			break;

		case 'beta':
			$status = JText::_('UPDATE_STATUS_BETA');
			break;

		case 'svn':
		default:
			$status = JText::_('UPDATE_STATUS_SVN');
			break;
	}
	$string2 = JText::sprintf('UPDATE_LABEL_VERSIONINFO2',$latestversion,$this->updates->latest_date,$status);
	?>
	<p><?php echo JText::_('UPDATE_LABEL_UPGRADEFOUND_INFO'); ?></p>
	<p>
		<?php echo $string1; ?><br />
		<?php echo $string2; ?><br />
		<?php echo JText::_('UPDATE_LABEL_PACKAGELOCATION'); ?>
		<a href="<?php echo $this->updates->package_url ?>">
			<?php echo htmlentities($this->updates->package_url); ?>
		</a>
	</p>

	<form enctype="multipart/form-data" action="index.php" method="post" name="adminForm">
		<input type="hidden" id="install_url" name="install_url" value="<?php echo $this->updates->package_url; ?>" />
		<input type="hidden" name="type" value="" />
		<input type="hidden" name="installtype" value="url" />
		<input type="hidden" name="task" value="doInstall" />
		<input type="hidden" name="option" value="com_installer" />
		<input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
		<input type="submit" class="button"	value="<?php echo JText::_('UPDATE_LABEL_UPDATENOW'); ?>" />
	</form>
	<p>&nbsp;</p>
	<form enctype="multipart/form-data" action="index.php" method="post" name="adminForm">
		<input type="hidden" name="option" value="com_akeeba" />
		<input type="hidden" name="view" value="update" />
		<input type="hidden" name="task" value="force" />
		<?php echo JHTML::_('tooltip', JText::_('UPDATE_LABEL_FORCE_TIP'));?>
		<input type="submit" class="button"	value="<?php echo JText::_('UPDATE_LABEL_FORCE'); ?>" />
	</form>

	<?php elseif($this->updates->supported):?>
	<!-- No upgrades found -->
	<?php
	$yourversion = '<span style="font-weight: bold; color: #009900">'.$this->updates->current_version.'</span>';
	$latestversion = '<span style="font-weight: bold; color: #009900">'.$this->updates->latest_version.'</span>';
	$string1 = JText::sprintf('UPDATE_LABEL_VERSIONINFO1',$yourversion,$this->updates->current_date);
	switch($this->updates->status)
	{
		case 'stable':
			$status = JText::_('UPDATE_STATUS_STABLE');
			break;

		case 'beta':
			$status = JText::_('UPDATE_STATUS_STABLE');
			break;

		case 'svn':
		default:
			$status = JText::_('UPDATE_STATUS_SVN');
			break;
	}
	$string2 = JText::sprintf('UPDATE_LABEL_VERSIONINFO2',$latestversion,$this->updates->latest_date,$status);
	?>

	<h2><?php echo JText::_('UPDATE_LABEL_NOUPGRADESFOUND') ?></h2>
	<p>
		<?php echo $string1; ?><br />
		<?php echo $string2; ?><br />
		<?php echo JText::_('UPDATE_LABEL_PACKAGELOCATION'); ?>
		<a href="<?php echo $this->updates->package_url ?>">
			<?php echo htmlentities($this->updates->package_url); ?>
		</a>
	</p>
	<?php
	AEPlatform::load_version_defines();
	if( substr(AKEEBA_VERSION,0,3) == 'svn' ):
	?>
	<p><?php echo JText::_('UPDATE_LABEL_NOUPGRADESFOUND_INFO_SVN') ?></p>
	<?php else: ?>
	<p><?php echo JText::_('UPDATE_LABEL_NOUPGRADESFOUND_INFO') ?></p>
	<?php endif; ?>

	<form enctype="multipart/form-data" action="index.php" method="post" name="adminForm">
		<input type="hidden" name="option" value="com_akeeba" />
		<input type="hidden" name="view" value="update" />
		<input type="hidden" name="task" value="force" />
		<?php echo JHTML::_('tooltip', JText::_('UPDATE_LABEL_FORCE_TIP'));?>
		<input type="submit" class="button"	value="<?php echo JText::_('UPDATE_LABEL_FORCE'); ?>" />
	</form>

	<?php else: ?>

	<!-- Update service is not compatible with server setup -->
	<h2><?php echo JText::_('UPDATE_LABEL_NOTAVAILABLE') ?></h2>
	<p><?php echo JText::_('UPDATE_LABEL_NOTAVAILABLE_INFO') ?></p>
	<?php endif; ?>