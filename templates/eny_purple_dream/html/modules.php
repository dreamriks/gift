<?php
/**
* @Enterprise: S&S Media Solutions
* @author: Yannick Spang
* @creation date: June 2009
* @url: http://www.joomla-virtuemart-designs.com
* @copyright: Copyright (C) 2009 S&S Media Solutions
* @license: Commercial, see LICENSE.php
* @product: Shworoom Mall - Joomla Template
* @version: 1.0
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

function modChrome_eny_default($module, &$params, &$attribs)
{
	// create title
	$pos   = JString::strpos($module->title, ' ');
	$title = ($pos !== false) ? '<span class="precolor">'.JString::substr($module->title, 0, $pos).'</span>'.JString::substr($module->title, $pos) : $module->title;
	if (!empty ($module->content)) : ?>
	
<div class="modulestyle<?php echo $params->get('moduleclass_sfx'); ?>">
	<div class="eny_default">
		<?php if ($module->showtitle != 0) : ?>
		<h3>
		<?php echo $title; ?>
		</h3>
		<?php endif; ?>
		
		<div class="eny_inner">
		<?php echo $module->content; ?>
		</div>
	</div>
</div>
<?php endif;
}


function modChrome_eny_promo($module, &$params, &$attribs)
{
	// create title
	$pos   = JString::strpos($module->title, ' ');
	$title = ($pos !== false) ? '<span class="promoprecolor">'.JString::substr($module->title, 0, $pos).'</span>'.JString::substr($module->title, $pos) : $module->title;
	if (!empty ($module->content)) : ?>
	
<div class="modulestyle<?php echo $params->get('moduleclass_sfx'); ?>">
	<div class="eny_promo">
		<?php if ($module->showtitle != 0) : ?>
		<h3>
		<?php echo $title; ?>
		</h3>
		<?php endif; ?>
		
		<div class="eny_inner">
		<?php echo $module->content; ?>
		</div>
	</div>
</div>
<?php endif;
}


function modChrome_eny_info($module, &$params, &$attribs)
{
	// create title
	$pos   = JString::strpos($module->title, ' ');
	$title = ($pos !== false) ? '<span class="infoprecolor">'.JString::substr($module->title, 0, $pos).'</span>'.JString::substr($module->title, $pos) : $module->title;
	if (!empty ($module->content)) : ?>
	
<div class="modulestyle<?php echo $params->get('moduleclass_sfx'); ?>">
	<div class="eny_info">
		<?php if ($module->showtitle != 0) : ?>
		<h3>
		<?php echo $title; ?>
		</h3>
		<?php endif; ?>
		
		<div class="eny_inner">
		<?php echo $module->content; ?>
		</div>
	</div>
</div>
<?php endif;
}


?>