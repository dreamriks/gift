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
<h3><?php echo $mf_name;?></h3>
  
  <table align="center"cellspacing="0" cellpadding="0" border="0">
      <tr valign="top"> 
        <th colspan="2" align="center"class="sectiontableheader">
          <strong><?php echo $VM_LANG->_('PHPSHOP_MANUFACTURER_FORM_INFO_LBL') ?></strong>
        </th>
      </tr>
      <tr valign="top">
        <td align="center"colspan="2"><br />
          <?php echo "&nbsp;" . $mf_name . "<br />"; ?>
          <br /><br />
        </td>
      </tr>
  
      <tr>
        <td valign="top" align="center"colspan="2">
            <br /><?php echo $VM_LANG->_('PHPSHOP_STORE_FORM_EMAIL') ?>:&nbsp;
            <a href="mailto:<?php echo $mf_email; ?>"><?php echo $mf_email; ?></a>
            <br />
            <br /><a href="<?php echo $mf_url ?>" target="_blank"><?php echo $mf_url ?></a><br />
        </td>
      </tr>
      <tr>
        <td valign="top" align="left" colspan="2">
            <br /><?php echo $mf_desc ?><br />
        </td>
      </tr>
    
  </table>