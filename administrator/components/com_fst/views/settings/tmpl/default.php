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
	ResetElement('general');
//##NOT_FAQS_START##
//
	ResetElement('test');
//
	ResetElement('visual');
//
	
	document.getElementById('tab_' + tabid).style.display = 'inline';
	document.getElementById('link_' + tabid).style.backgroundColor = '#f0f0ff';
	
	document.getElementById('link_' + tabid).onmouseover = function() {
	}
	document.getElementById('link_' + tabid).onmouseout = function() {
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
}
</style>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<input type="hidden" name="what" value="save">
<input type="hidden" name="option" value="com_fst" />
<input type="hidden" name="task" value="save" />
<input type="hidden" name="view" value="settings" />
<input type="hidden" name="version" value="<?php echo $this->settings['version']; ?>" />
<input type="hidden" name="fsj_username" value="<?php echo $this->settings['fsj_username']; ?>" />
<input type="hidden" name="fsj_apikey" value="<?php echo $this->settings['fsj_apikey']; ?>" />
<input type="hidden" name="content_unpublished_color" value="<?php echo $this->settings['content_unpublished_color']; ?>" />
<div class='ffs_tabs'>

<!--<a id='link_general' class='ffs_tab' href='#' onclick="ShowTab('general');return false;">General</a>-->

<a id='link_general' class='ffs_tab' href='#' onclick="ShowTab('general');return false;"><?php echo JText::_("GENERAL_SETTINGS"); ?></a> 
<?php //##NOT_FAQS_START## ?>
<?php // ?>
<a id='link_test' class='ffs_tab' href='#' onclick="ShowTab('test');return false;"><?php echo JText::_("TESTIMONIALS"); ?></a>
<?php // ?>
<?php //##NOT_FAQS_END## ?>
<a id='link_visual' class='ffs_tab' href='#' onclick="ShowTab('visual');return false;"><?php echo JText::_("VISUAL"); ?></a>
<?php // ?>

</div>

<div id="tab_general" class="col100 width-100">

	<fieldset class="adminform">
		<legend><?php echo JText::_("GENERAL_SETTINGS"); ?></legend>

		<table class="admintable">
			<tr>
				<td align="right" class="key" style="width:250px;">
					<?php echo JText::_("HIDE_POWERED"); ?>:
				</td>
				<td style="width:250px;">
					<input type='checkbox' name='hide_powered' value='1' <?php if ($this->settings['hide_powered'] == 1) { echo " checked='yes' "; } ?>>
				</td>
				<td>
					<div class='fst_help'><?php echo JText::_('SETHELP_hide_powered'); ?></div>
				</td>
			</tr>
		</table>
	</fieldset>
<?php //##NOT_FAQS_START## ?>

	<fieldset class="adminform">
		<legend><?php echo JText::_("PERMISSIONS_SETTINGS"); ?></legend>

		<table class="admintable">
			<tr>
				<td align="right" class="key" style="width:250px;">
					<?php echo JText::_("USE_JOOMLA_PERM_COMMENT"); ?>:
				</td>
				<td style="width:250px;">
					<input type='checkbox' name='perm_mod_joomla' value='1' <?php if ($this->settings['perm_mod_joomla'] == 1) { echo " checked='yes' "; } ?>>
				</td>
				<td>
					<div class='fst_help'><?php echo JText::_('SETHELP_perm_mod_joomla'); ?></div>
				</td>
			</tr>
<?php // ?>
		</table>
	</fieldset>

	<fieldset class="adminform">
		<legend><?php echo JText::_("COMMENTS_SETTINGS"); ?></legend>

		<table class="admintable">
			<tr>
				<td align="right" class="key">
					<?php echo JText::_("CAPTCHA_TYPE"); ?>:
				</td>
				<td style="width:250px;">
					<select name="captcha_type">
						<option value="none" <?php if ($this->settings['captcha_type'] == "none") echo " SELECTED"; ?> ><?php echo JText::_('FNONE'); ?></option>
						<option value="fsj" <?php if ($this->settings['captcha_type'] == "fsj") echo " SELECTED"; ?> ><?php echo JText::_('BUILT_IN'); ?></option>
						<option value="recaptcha" <?php if ($this->settings['captcha_type'] == "recaptcha") echo " SELECTED"; ?> ><?php echo JText::_('RECAPTCHA'); ?></option>
					</select>
				</td>
				<td>
					<div class='fst_help'><?php echo JText::_('SETHELP_captcha_type'); ?></div>
				</td>
			</tr>
			<tr>
				<td align="right" class="key">
					<?php echo JText::_("HIDE_ADD_COMMENT"); ?>:
					
				</td>
				<td>
					<input type='checkbox' name='comments_hide_add' value='1' <?php if ($this->settings['comments_hide_add'] == 1) { echo " checked='yes' "; } ?>>
				</td>
				<td>
					<div class='fst_help'><?php echo JText::_('SETHELP_comments_hide_add'); ?></div>
				</td>
			</tr>
<?php // ?>
			<tr>
				<td align="right" class="key" style="width:250px;">
					<?php echo JText::_("RECAPTCHA_PUBLIC_KEY"); ?>:
				</td>
				<td>
					<input name='recaptcha_public' size="40" value='<?php echo $this->settings['recaptcha_public'] ?>'>
				</td>
				<td rowspan="2">
					<div class='fst_help'><?php echo JText::_('SETHELP_recaptcha_public'); ?></div>
				</td>
			</tr>
			<tr>
				<td align="right" class="key">
					<?php echo JText::_("RECAPTCHA_PRIVATE_KEY"); ?>:
				</td>
				<td>
					<input name='recaptcha_private' size="40" value='<?php echo $this->settings['recaptcha_private'] ?>'>
				</td>
			</tr>
			<tr>
				<td align="right" class="key">
					<?php echo JText::_("RECAPTCHA_THEME"); ?>:
				</td>
				<td>
					<select name="recaptcha_theme">
						<option value="red" <?php if ($this->settings['recaptcha_theme'] == "red") echo " SELECTED"; ?> ><?php echo JText::_('RED'); ?></option>
						<option value="white" <?php if ($this->settings['recaptcha_theme'] == "white") echo " SELECTED"; ?> ><?php echo JText::_('WHITE'); ?></option>
						<option value="blackglass" <?php if ($this->settings['recaptcha_theme'] == "blackglass") echo " SELECTED"; ?> ><?php echo JText::_('BLACK_GLASS'); ?></option>
						<option value="clean" <?php if ($this->settings['recaptcha_theme'] == "clean") echo " SELECTED"; ?> ><?php echo JText::_('CLEAN'); ?></option>
					</select>
				</td>
				<td>
					<div class='fst_help'><?php echo JText::_('SETHELP_recaptcha_theme'); ?></div>
				</td>
			</tr>
		</table>
	</fieldset>
<?php //##NOT_FAQS_END## ?>
</div>

<?php //##NOT_FAQS_START## ?>
<?php // ?>

<div id="tab_test" style="display:none;" class="col100 width-100">

	<fieldset class="adminform">
		<legend><?php echo JText::_("TESTIMONIAL_SETTINGS"); ?></legend>
		<table class="admintable">
			<tr>
				<td align="right" class="key" style="width:250px;">
					
						<?php echo JText::_("TESTIMONIALS_ARE_MODERATED_BEFORE_DISPLAY"); ?>:
					
				</td>
				<td style="width:250px;">
					<select name="test_moderate">
						<option value="all" <?php if ($this->settings['test_moderate'] == "all") echo " SELECTED"; ?> ><?php echo JText::_('ALL_TESTIMONIALS_MODERATED'); ?></option>
						<option value="guests" <?php if ($this->settings['test_moderate'] == "guests") echo " SELECTED"; ?> ><?php echo JText::_('GUEST_TESTIMONIALS_MODERATED'); ?></option>
						<option value="registered" <?php if ($this->settings['test_moderate'] == "registered") echo " SELECTED"; ?> ><?php echo JText::_('REGISTERED_AND_GUEST_TESTIMONIALS_MODERATED'); ?></option>
						<option value="none" <?php if ($this->settings['test_moderate'] == "none") echo " SELECTED"; ?> ><?php echo JText::_('NO_TESTIMONIALS_ARE_MODERATED'); ?></option>
					</select>
				</td>
				<td>
					<div class='fst_help'><?php echo JText::_('SETHELP_test_moderate'); ?></div>
				</td>
			</tr>
			<tr>
				<td align="right" class="key">
						<?php echo JText::_("ALLOW_NO_PRODUCT_TESTS"); ?>:
				</td>
				<td>
					<input type='checkbox' name='test_allow_no_product' value='1' <?php if ($this->settings['test_allow_no_product'] == 1) { echo " checked='yes' "; } ?>>
				</td>
				<td>
					<div class='fst_help'><?php echo JText::_('SETHELP_test_allow_no_product'); ?></div>
				</td>
			</tr>
			<tr>
				<td align="right" class="key">
						<?php echo JText::_("HIDE_EMPTY_PROD_WHEN_LISTING"); ?>:
				</td>
				<td>
					<input type='checkbox' name='test_hide_empty_prod' value='1' <?php if ($this->settings['test_hide_empty_prod'] == 1) { echo " checked='yes' "; } ?>>
				</td>
				<td>
					<div class='fst_help'><?php echo JText::_('SETHELP_test_hide_empty_prod'); ?></div>
				</td>
			</tr>
			<tr>
				<td align="right" class="key">
					<?php echo JText::_("WHO_CAN_ADD_TESTIMONIALS"); ?>:
				</td>
				<td>
					<select name="test_who_can_add">
						<option value="anyone" <?php if ($this->settings['test_who_can_add'] == "anyone") echo " SELECTED"; ?> ><?php echo JText::_('ANYONE'); ?></option>
						<option value="registered" <?php if ($this->settings['test_who_can_add'] == "registered") echo " SELECTED"; ?> ><?php echo JText::_('REGISTERED_USERS_ONLY'); ?></option>
						<option value="moderators" <?php if ($this->settings['test_who_can_add'] == "moderators") echo " SELECTED"; ?> ><?php echo JText::_('MODERATORS_ONLY'); ?></option>
					</select>
				</td>
				<td>
					<div class='fst_help'><?php echo JText::_('SETHELP_test_who_can_add'); ?></div>
				</td>
			</tr>
			<tr>
				<td align="right" class="key">
					<?php echo JText::_("EMAIL_ON_SUBMITTED"); ?>:
					
				</td>
				<td>
					<input name='test_email_on_submit' size="40" value='<?php echo $this->settings['test_email_on_submit']; ?>'>
					</td>
				<td>
					<div class='fst_help'><?php echo JText::_('SETHELP_test_email_on_submit'); ?></div>
			</td>
			</tr>
			<tr>
				<td align="right" class="key">
					<?php echo JText::_("TEST_USE_EMAIL"); ?>:
					
				</td>
				<td>
					<input type='checkbox' name='test_use_email' value='1' <?php if ($this->settings['test_use_email'] == 1) { echo " checked='yes' "; } ?>>
				</td>
				<td>
					<div class='fst_help'><?php echo JText::_('SETHELP_test_use_email'); ?></div>
				</td>
			</tr>
			<tr>
				<td align="right" class="key">
					<?php echo JText::_("TEST_USE_WEBSITE"); ?>:
					
				</td>
				<td>
					<input type='checkbox' name='test_use_website' value='1' <?php if ($this->settings['test_use_website'] == 1) { echo " checked='yes' "; } ?>>
				</td>
				<td>
					<div class='fst_help'><?php echo JText::_('SETHELP_test_use_website'); ?></div>
				</td>
			</tr>		</table>
	</fieldset>

</div>
<?php // ?>

<div id="tab_visual" style="display:none;" class="col100 width-100">

	<fieldset class="adminform">
		<legend><?php echo JText::_("VISUAL_SETTINGS"); ?></legend>
		<table class="admintable">
			<tr>
				<td align="right" class="key" style="width:250px;">
					
						<?php echo JText::_("USE_SKIN_STYLING_FOR_PAGEINATION_CONTROLS"); ?>:
					
				</td>
				<td style="width:250px;">
					<input type='checkbox' name='skin_style' value='1' <?php if ($this->settings['skin_style'] == 1) { echo " checked='yes' "; } ?>>
					</td>
				<td>
					<div class='fst_help'><?php echo JText::_('SETHELP_skin_style'); ?></div>
			</td>
			</tr>
			<tr>
				<td align="right" class="key" style="width:250px;">
					
					<?php echo JText::_("USE_JOOMLA_SETTING_FOR_PAGE_TITLE_VISIBILITY"); ?>:
					
				</td>
				<td style="width:250px;">
					<input type='checkbox' name='use_joomla_page_title_setting' value='1' <?php if ($this->settings['use_joomla_page_title_setting'] == 1) { echo " checked='yes' "; } ?>>
					</td>
				<td>
					<div class='fst_help'><?php echo JText::_('SETHELP_use_joomla_page_title_setting'); ?></div>
			</td>
			</tr>
		</table>
	</fieldset>
	<fieldset class="adminform">
		<legend><?php echo JText::_("CSS_SETTINGS"); ?></legend>
		<table class="admintable">
			<tr>
				<td align="right" class="key" style="width:250px;">
					
						<?php echo JText::_("HIGHLIGHT_COLOUR"); ?>:
					
				</td>
				<td style="width:250px;">
					<input name='css_hl' value='<?php echo $this->settings['css_hl'] ?>'>
					&nbsp;
					<input type="button" value="Color picker" onclick="showColorPicker(this,document.forms[0].css_hl)">
				</td>
				<td>
					<div class='fst_help'><?php echo JText::_('SETHELP_css_hl'); ?></div>
				</td>
			</tr>
			<tr>
				<td align="right" class="key">
					
						<?php echo JText::_("BORDER_COLOUR"); ?>:
					
				</td>
				<td>
					<input name='css_bo' value='<?php echo $this->settings['css_bo'] ?>'>
					&nbsp;
					<input type="button" value="Color picker" onclick="showColorPicker(this,document.forms[0].css_bo)">
					</td>
				<td>
					<div class='fst_help'><?php echo JText::_('SETHELP_css_bo'); ?></div>
			</td>
			</tr>
			<tr>
				<td align="right" class="key">
					
						<?php echo JText::_("TAB_BACKGROUND_COLOUR"); ?>:
					
				</td>
				<td>
					<input name='css_tb' value='<?php echo $this->settings['css_tb'] ?>'>
					&nbsp;
					<input type="button" value="Color picker" onclick="showColorPicker(this,document.forms[0].css_tb)">
				</td>
				<td>
					<div class='fst_help'><?php echo JText::_('SETHELP_css_tb'); ?></div>
				</td>
			</tr>
		</table>
	</fieldset>
<?php //##NOT_FAQS_START## ?>
	<fieldset class="adminform">
		<legend><?php echo JText::_("SUPPORT_COLOR_SETTINGS"); ?></legend>
		<table class="admintable">
			<tr>
				<td align="right" class="key" style="width:250px;">
						<?php echo JText::_("USER_MESSAGE_COLOR"); ?>:
				</td>
				<td style="width:250px;">
					<input name='support_user_message' value='<?php echo $this->settings['support_user_message'] ?>'>
					&nbsp;
					<input type="button" value="Color picker" onclick="showColorPicker(this,document.forms[0].support_user_message)">
				</td>
				<td>
					<div class='fst_help'><?php echo JText::_('SETHELP_support_user_message'); ?></div>
				</td>
			</tr>
			<tr>
				<td align="right" class="key">
						<?php echo JText::_("HANDLER_MESSAGE_COLOR"); ?>:
				</td>
				<td>
					<input name='support_admin_message' value='<?php echo $this->settings['support_admin_message'] ?>'>
					&nbsp;
					<input type="button" value="Color picker" onclick="showColorPicker(this,document.forms[0].support_admin_message)">
				</td>
				<td>
					<div class='fst_help'><?php echo JText::_('SETHELP_support_admin_message'); ?></div>
				</td>
			</tr>
			<tr>
				<td align="right" class="key">
						<?php echo JText::_("PRIVATE_MESSAGE_COLOR"); ?>:
				</td>
				<td>
					<input name='support_private_message' value='<?php echo $this->settings['support_private_message'] ?>'>
					&nbsp;
					<input type="button" value="Color picker" onclick="showColorPicker(this,document.forms[0].support_private_message)">
				</td>
				<td>
					<div class='fst_help'><?php echo JText::_('SETHELP_support_private_message'); ?></div>
				</td>
			</tr>
		</table>
	</fieldset>
<?php //##NOT_FAQS_END## ?>	
</div>
<?php // ?>

</form>

<script>

function testreference()
{
	$('testref').innerHTML = "<?php echo JText::_('PLEASE_WAIT'); ?>";
	var format = $('support_reference').value
	var url = '<?php echo JRoute::_("index.php?option=com_fst&view=settings&what=testref",false); ?>&ref=' + format;
	
<?php if (FST_Helper::Is16()): ?>
	$('testref').load(url);
<?php else: ?>
	new Ajax(url, {
	method: 'get',
	update: $('testref')
	}).request();
<?php endif; ?>
}

window.addEvent('domready', function(){
	ShowTab('general');
});
 
</script>
