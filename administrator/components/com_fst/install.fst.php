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

defined('_JEXEC') or die(';)');
jimport('joomla.application.component.controller');
jimport('joomla.application.component.model');
jimport('joomla.installer.installer');
jimport('joomla.installer.helper');
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.archive');
jimport('joomla.filesystem.path');


class Status {
	var $STATUS_FAIL = 'Failed';
	var $STATUS_SUCCESS = 'Success';
	var $infomsg = array();
	var $errmsg = array();
	var $status;
}
$install_status = array();
global $install_status;

function InstallExtras()
{
	global $install_status;
	
	$pkg_path = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_fst'.DS.'extensions'.DS;
	
	if ($dir = opendir($pkg_path))
	{
		while (($file = readdir($dir)) !== false) 
		{
			if ($file == "." || $file == "..") continue;
			if (stripos($file,".zip") < 1) continue;
			
			$installer = new JInstaller();
			$installer->setOverwrite(true);	
			
			$status = new Status();
			$status->file = $pkg_path.$file;
			$status->status = $status->STATUS_FAIL;

			$package = JInstallerHelper::unpack( $pkg_path.$file );
			$status->package = print_r($package,true);
			if( $installer->install( $package['dir'] ) )
			{
				$status->status = $status->STATUS_SUCCESS;
			}
			else
			{
				$status->errmsg[]="Unable to install $file";
			}
		
			$install_status[$file] = $status;
		
			JInstallerHelper::cleanupInstall( $pkg_path.$file, $package['dir'] );
		}
	}
}

function com_install()
{
	require_once (JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_fst'.DS.'updatedb.php');
	
	$updater = new FSTUpdater();
	$updater->Process();
	
	// think this has to be done last
	InstallExtras();
	
	FST_Done();
}

function FST_Done()
{
	global $install_status;
?>

<h1>Freestyle Testimonials Installation Completed</h1>
<?php if (count($install_status) > 0): ?>
<table class="adminlist">
	<thead>
		<tr>
			<th class="title">Sub Component</th>
			<th width="60%">Status</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
	</tfoot>
	<tbody>
	<?php
		$i=0; 
		foreach ( $install_status as $component => $status ) {?>
		<tr class="row<?php echo $i; ?>">
			<td class="key"><?php echo $component; ?></td>
			<td>
				<?php echo ($status->status == $status->STATUS_SUCCESS)? '<strong>Installed</strong>' : '<em>Not Installed</em>'?>
				<?php if (count($status->errmsg) > 0 ) {
						foreach ( $status->errmsg as $errmsg ) {
       						echo '<br/>Error: ' . $errmsg;
						}
				} ?>
				<?php if (count($status->infomsg) > 0 ) {
						foreach ( $status->infomsg as $infomsg ) {
       						echo '<br/>Info: ' . $infomsg;
						}
				} ?>
			</td>
		</tr>	
	<?php
			if ($i=0){ $i=1;} else {$i = 0;}; 
		}?>
		
	</tbody>
</table>
<?php endif; ?>	

<?php
}
?>



