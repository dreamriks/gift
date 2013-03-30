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
<?php defined('_JEXEC') or die('Restricted access'); ?>
<script>
function ResetElement(tabid)
{
	document.getElementById('tab_' + tabid).style.display = 'none';
	document.getElementById('link_' + tabid).style.backgroundColor = '';

	document.getElementById('link_' + tabid).onmouseover = function() {
		this.style.backgroundColor='<?php echo FST_Settings::get('css_hl'); ?>';
	}
	document.getElementById('link_' + tabid).onmouseout = function() {
		this.style.backgroundColor='';
	}

}
function ShowTab(tabid)
{
	ResetElement('visual');
//##NOT_FAQS_START##
//
	ResetElement('comments');
//##NOT_FAQS_END##
	
	document.getElementById('tab_' + tabid).style.display = 'inline';
	document.getElementById('link_' + tabid).style.backgroundColor = '#f0f0ff';
	
	document.getElementById('link_' + tabid).onmouseover = function() {
	}
	document.getElementById('link_' + tabid).onmouseout = function() {
	}
}

window.addEvent('domready', function(){
	ShowTab('visual');
//##NOT_FAQS_START##
	ShowTab('comments');
//
	setup_comments('general');
//
	setup_comments('test');
	setup_comments('testmod');
//##NOT_FAQS_END##
});

function setup_comments(cset)
{
	jQuery('#comments_' + cset + '_reset').click(function (ev) { 
		ev.stopPropagation();
		ev.preventDefault();
		if (confirm("Are you sure you wish to reset this custom template"))
		{
			jQuery('#comments_' + cset).val(jQuery('#comments_' + cset + '_default').val());
		}
	});
	
	jQuery('#comments_' + cset + '_use_custom').change(function (ev) {
		showhide_comments(cset);
	});
	showhide_comments(cset);
}

function showhide_comments(cset)
{
	var value = jQuery('#comments_' + cset + '_use_custom').attr('checked');
	if (value == "checked")
	{
		jQuery('#comments_' + cset + '_row').css('display','table-row');
		
		if (jQuery('#comments_' + cset).val() == "")
			jQuery('#comments_' + cset).val(jQuery('#comments_' + cset + '_default').val());
	} else {
		jQuery('#comments_' + cset + '_row').css('display','none');
	}
}
</script>

<style>
.fst_custom_warn
{
	color: red;
}
.fst_help
{
	border: 1px solid #CCC;
	float: left;
	padding: 3px;
	background-color: #F8F8FF;
}
.admintable td
{
	border-bottom: 1px solid #CCC;
	padding-bottom: 4px;
	padding-top: 2px;
}</style>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<input type="hidden" name="what" value="save">
<input type="hidden" name="option" value="com_fst" />
<input type="hidden" name="task" value="save" />
<input type="hidden" name="view" value="templates" />
<div class='ffs_tabs'>

<!--<a id='link_general' class='ffs_tab' href='#' onclick="ShowTab('general');return false;">General</a>-->

<?php //##NOT_FAQS_START## ?>
<a id='link_comments' class='ffs_tab' href='#' onclick="ShowTab('comments');return false;"><?php echo JText::_("COMMENTS"); ?></a>

<?php // ?>
<?php //##NOT_FAQS_END## ?>

<a id='link_visual' class='ffs_tab' href='#' onclick="ShowTab('visual');return false;"><?php echo JText::_("VISUAL"); ?></a>

</div>

<?php //##NOT_FAQS_START## ?>
<div id="tab_comments" style="display:none;" class="col100 width-100">

	<fieldset class="adminform">
		<legend><?php echo JText::_("MODERATION_COMMENTS"); ?></legend>
		<table class="admintable">
			<tr>
				<td align="right" class="key" style="width:150px;">
						<?php echo JText::_("Use_Custom_Template"); ?>:
				</td>
				<td width="370">
					<input type='checkbox' name='comments_general_use_custom' id='comments_general_use_custom' value='1' <?php if ($this->settings['comments_general_use_custom'] == 1) { echo " checked='yes' "; } ?>>
				</td>
				<td rowspan="2"><div class="fst_help"><?php echo JText::_('TMPLHELP_comments_general_use_custom'); ?></div></td>
			</tr>

			<tr id="comments_general_row">
				<td valign="top" align="right" class="key" style="width:150px;">
					<?php echo JText::_("Custom_Template"); ?>:<br />
					<button id='comments_general_reset' style='float:none;'><?php echo JText::_('Reset');?></button><br />
					<span class='fst_custom_warn'>
						<?php echo JText::_('TMPLHELP_WARN1'); ?>
					</span>
				</td>
				<td valign="top" width="370" id="comments_general_row">
					<textarea name='comments_general' id="comments_general" rows="12" cols="80" style="float:none;"><?php echo $this->settings['comments_general']; ?></textarea><br>
					<textarea id="comments_general_default" rows="12" cols="80" style="display:none;"><?php echo $this->settings['comments_general_default']; ?></textarea><br>
				</td>
			</tr>
		</table>
	</fieldset>
	
<?php // ?>
	
	<fieldset class="adminform">
		<legend><?php echo JText::_("TESTIMONIAL_TEMPLATES"); ?></legend>
		<table class="admintable">
			<tr>
				<td align="right" class="key" style="width:150px;">
						<?php echo JText::_("Use_Custom_Template"); ?>:
				</td>
				<td width="370">
					<input type='checkbox' name='comments_test_use_custom' id='comments_test_use_custom' value='1' <?php if ($this->settings['comments_test_use_custom'] == 1) { echo " checked='yes' "; } ?>>
				</td>
				<td rowspan="2"><div class="fst_help"><?php echo JText::_('TMPLHELP_comments_test_use_custom'); ?></div></td>
			</tr>

			<tr id="comments_test_row">
				<td valign="top" align="right" class="key" style="width:150px;">
					<?php echo JText::_("Custom_Template"); ?>:<br />
					<button id='comments_test_reset' style='float:none;'><?php echo JText::_('Reset');?></button><br />
					<span class='fst_custom_warn'>
						<?php echo JText::_('TMPLHELP_WARN1'); ?>
					</span>
				</td>
				<td valign="top" width="370" id="comments_test_row">
					<textarea name='comments_test' id="comments_test" rows="12" cols="80" style="float:none;"><?php echo $this->settings['comments_test']; ?></textarea><br>
					<textarea id="comments_test_default" rows="12" cols="80" style="display:none;"><?php echo $this->settings['comments_test_default']; ?></textarea><br>
				</td>
			</tr>
		</table>
		<table class="admintable"> 
			<tr>
				<td align="right" class="key" style="width:150px;">
						<?php echo JText::_("Use_Custom_Module_Template"); ?>:
				</td>
				<td width="370">
					<input type='checkbox' name='comments_testmod_use_custom' id='comments_testmod_use_custom' value='1' <?php if ($this->settings['comments_testmod_use_custom'] == 1) { echo " checked='yes' "; } ?>>
				</td>
				<td rowspan="2"><div class="fst_help"><?php echo JText::_('TMPLHELP_comments_testmod_use_custom'); ?></div></td>
			</tr>

			<tr id="comments_testmod_row">
				<td valign="top" align="right" class="key" style="width:150px;">
					<?php echo JText::_("Custom_Template"); ?>:<br />
					<button id='comments_testmod_reset' style='float:none;'><?php echo JText::_('Reset');?></button><br />
					<span class='fst_custom_warn'>
						<?php echo JText::_('TMPLHELP_WARN1'); ?>
					</span>
				</td>
				<td valign="top" width="370" id="comments_testmod_row">
					<textarea name='comments_testmod' id="comments_testmod" rows="12" cols="80" style="float:none;"><?php echo $this->settings['comments_testmod']; ?></textarea><br>
					<textarea id="comments_testmod_default" rows="12" cols="80" style="display:none;"><?php echo $this->settings['comments_testmod_default']; ?></textarea><br>
				</td>
			</tr>
		</table>
	</fieldset>
</div>


<?php // ?>

<div id="tab_visual" style="display:none;" class="col100 width-100">


	<fieldset class="adminform">
		<legend><?php echo JText::_("CSS_SETTINGS"); ?></legend>
		<table class="admintable">
			<tr>
				<td align="right" class="key" style="width:250px;">	
						<?php echo JText::_("MAIN_CSS"); ?>:
				</td>
				<td>
					<textarea name="display_style" rows="10" cols="60"><?php echo $this->settings['display_style'] ?></textarea>
				</td>
				<td>
					<div class="fst_help"><?php echo JText::_('TMPLHELP_display_style'); ?>
					

					</div>
				</td>
			</tr>
			<tr>
				<td align="right" class="key">	
						<?php echo JText::_("POPUP_CSS"); ?>:
				</td>
				<td>
					<textarea name="display_popup_style" rows="10" cols="60"><?php echo $this->settings['display_popup_style'] ?></textarea>
				</td>
				<td>
					<div class="fst_help"><?php echo JText::_('TMPLHELP_display_popup_style'); ?>
					
					</div>
				</td>
			</tr>
			<tr>
				<td align="right" class="key">	
						<?php echo JText::_("PAGE_HEADER"); ?>:
				</td>
				<td>
					<textarea name="display_head" rows="10" cols="60"><?php echo $this->settings['display_head'] ?></textarea>
				</td>
				<td>
					<div class="fst_help"><?php echo JText::_('TMPLHELP_display_head'); ?>
						
					</div>
				</td>
			</tr>
			<tr>
				<td align="right" class="key">	
						<?php echo JText::_("PAGE_FOOTER"); ?>:
				</td>
				<td>
					<textarea name="display_foot" rows="10" cols="60"><?php echo $this->settings['display_foot'] ?></textarea>
				</td>
				<td>
					<div class="fst_help"><?php echo JText::_('TMPLHELP_display_foot'); ?></div>
				</td>
			</tr>
		</table>
	</fieldset>

	<fieldset class="adminform">
		<legend><?php echo JText::_("PAGE_TITLE_SETTINGS"); ?></legend>
		<table class="admintable">
			<tr>
				<td align="right" class="key" style="width:250px;">
					
						<?php echo JText::_("H1_STYLE"); ?>:
					
				</td>
				<td>
					<textarea name="display_h1" rows="5" cols="60"><?php echo $this->settings['display_h1'] ?></textarea>
				</td>
				<td>
					<div class="fst_help"><?php echo JText::_('TMPLHELP_display_h1'); ?></div>
				</td>
			</tr>
			<tr>
				<td align="right" class="key">
					
						<?php echo JText::_("H2_STYLE"); ?>:
					
				</td>
				<td>
					<textarea name="display_h2" rows="5" cols="60"><?php echo $this->settings['display_h2'] ?></textarea>
				</td>
				<td>
					<div class="fst_help"><?php echo JText::_('TMPLHELP_display_h2'); ?></div>
				</td>
			</tr>
			<tr>
				<td align="right" class="key">
					
						<?php echo JText::_("H3_STYLE"); ?>:
					
				</td>
				<td>
					<textarea name="display_h3" rows="5" cols="60"><?php echo $this->settings['display_h3'] ?></textarea>
				</td>
					<td>
					<div class="fst_help"><?php echo JText::_('TMPLHELP_display_h3'); ?></div>
				</td>
			</tr>
			<tr>
				<td align="right" class="key">	
						<?php echo JText::_("POPUP_STYLE"); ?>:	
				</td>
				<td>
					<textarea name="display_popup" rows="5" cols="60"><?php echo $this->settings['display_popup'] ?></textarea>
				</td>
				<td>
					<div class="fst_help"><?php echo JText::_('TMPLHELP_display_popup'); ?></div>
				</td>
			</tr>
		</table>
	</fieldset>
</div>

</form>

<form action="<?php echo JURI::root(); ?>/index.php?view=admin&layout=support&option=com_fst&preview=1" method="post" name="adminForm2" id="adminForm2" target="_blank">
<input type="hidden" name="list_template" id="list_template" value="" />
<textarea style='display:none;' name="list_head" id="list_head"></textarea>
<textarea style='display:none;' name="list_row" id="list_row"></textarea>
</form>

<script>

//

</script>
