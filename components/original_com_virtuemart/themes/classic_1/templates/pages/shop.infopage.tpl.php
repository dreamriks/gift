<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/*------------------------------------------------------------------------
# Classic I Theme for VirtueMart 1.1.x - March, 2009
# ------------------------------------------------------------------------
# Copyright (C) 2009-2013 VMJunction.com, Ltd. All Rights Reserved.
# @license - Copyrighted Commercial Software
# Author: VMJunction.com
# Websites:  http://www.VMJunction.com
# Icon Designed by: http://www.dryicons.com
-------------------------------------------------------------------------*/
mm_showMyFileName( __FILE__ );
?>
<h3><?php echo $v_name;?></h3>
<br />
  <div align="center">
    <a href="<?php $db->p("vendor_url") ?>" target="blank">
      <img border="0" src="<?php echo IMAGEURL ?>vendor/<?php echo $v_logo; ?>">
    </a>
  </div>
  <br /><br />
  <table align="center" cellspacing="0" cellpadding="0" border="0">
      <tr valign="top"> 
        <th colspan="2" align="center" class="sectiontableheader">
          <strong><?php echo $VM_LANG->_('PHPSHOP_STORE_FORM_CONTACT_LBL') ?></strong>
        </th>
        </tr>
        <tr valign="top">
	<td align="center" colspan="2"><br />
        <?php echo vmFormatAddress( array('name' => $v_name,
        								'address_1' => $v_address_1,
        								'address_2' => $v_address_2,
        								'zip' => $v_zip,
        								'city' => $v_city
        							), true ); ?>
        <br /><br /></td>
  </tr>

        <tr>
      <td valign="top" align="center" colspan="2">
          <br /><?php echo $VM_LANG->_('PHPSHOP_STORE_FORM_CONTACT_LBL') ?>:&nbsp;<?php echo $v_title ." " . $v_first_name . " " . $v_last_name ?>
          <br /><?php echo $VM_LANG->_('PHPSHOP_STORE_FORM_PHONE') ?>:&nbsp;<?php $db->p("contact_phone_1");?>
          <br /><?php echo $VM_LANG->_('PHPSHOP_STORE_FORM_FAX') ?>:&nbsp;<?php echo $v_fax ?>
          <br /><?php echo $VM_LANG->_('PHPSHOP_STORE_FORM_EMAIL') ?>:&nbsp;<?php echo $v_email; ?><br />
          <br /><a href="<?php $db->p("vendor_url") ?>" target="_blank"><?php $db->p("vendor_url") ?></a><br />
      </td>
        </tr>
        <tr>
      <td valign="top" align="left" colspan="2">
          <br /><?php $db->p("vendor_store_desc") ?><br />
      </td>
        </tr>
</table>