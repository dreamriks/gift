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
<div style="float:left;width:90%;text-align:right;"> 
    <span>
    	<a href="#" onclick="if( submitregistration() ) { document.adminForm.submit(); return false;}">
    		<img border="0" src="administrator/images/save_f2.png" name="submit" alt="<?php echo $VM_LANG->_('CMN_SAVE') ?>" />
    	</a>
    </span>
    <span style="margin-left:10px;">
    	<a href="<?php $sess->purl( SECUREURL."index.php?page=$next_page") ?>">
    		<img src="administrator/images/back_f2.png" alt="<?php echo $VM_LANG->_('BACK') ?>" border="0" />
    	</a>
    </span>
</div>

<?php
ps_userfield::listUserFields( $fields, array(), $db );
?>

<div align="left">	
	<input type="submit" value="<?php echo $VM_LANG->_('CMN_SAVE') ?>" class="button" onclick="return( submitregistration());" />
</div>
  <input type="hidden" name="option" value="<?php echo $option ?>" />
  <input type="hidden" name="page" value="<?php echo $next_page; ?>" />
  <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
  <input type="hidden" name="func" value="shopperupdate" />
  <input type="hidden" name="user_info_id" value="<?php $db->p("user_info_id"); ?>" />
  <input type="hidden" name="id" value="<?php echo $auth["user_id"] ?>" />
  <input type="hidden" name="user_id" value="<?php echo $auth["user_id"] ?>" />
  <input type="hidden" name="address_type" value="BT" />
</form>
