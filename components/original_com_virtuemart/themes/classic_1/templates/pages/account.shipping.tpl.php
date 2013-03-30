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

?>
<div class="pathway"><?php echo $vmPathway; ?></div>
<fieldset>
   <legend class="sectiontableheader"><?php echo $VM_LANG->_('PHPSHOP_USER_FORM_SHIPTO_LBL') ?></legend>
   <br/><br/>
   <div><?php echo $VM_LANG->_('PHPSHOP_ACC_BILL_DEF'); ?></div>
   <br />
<?php
  while( $db->next_record() ) {
?>
   <div>
   - <a href="<?php $sess->purl(SECUREURL . "index.php?next_page=account.shipping&page=account.shipto&user_info_id=" . $db->f("user_info_id")); ?>">
   <?php echo $db->f("address_type_name"); ?></a>
   </div>
   <br />
<?php
  }
?>
   <br /><br />
   <div>
      <a class="button" href="<?php $sess->purl(SECUREURL . "index.php?page=account.shipto&next_page=account.shipping"); ?>"><?php echo $VM_LANG->_('PHPSHOP_USER_FORM_ADD_SHIPTO_LBL') ?></a>
   </div>
</fieldset>
<!-- Body ends here -->
