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
/*****************************
** Checkout Bar Feature
**/

?>
<div class="pathway"><?php echo $vmPathway; ?></div>

<?php
 if ( $next_page=="checkout.index") {
    
     echo "<h3>". $VM_LANG->_('PHPSHOP_CHECKOUT_TITLE') ."</h3>";    
	    
	include_class('checkout');
	ps_checkout::show_checkout_bar();
	echo $basket_html;
    
 }
/**
** End Checkout Bar Feature
*****************************/
?>
<fieldset>
        <legend><span class="sectiontableheader"><?php echo $VM_LANG->_('PHPSHOP_SHOPPER_FORM_SHIPTO_LBL') ?></span></legend>
        
<br />
<?php echo $VM_LANG->_('PHPSHOP_SHIPTO_TEXT') ?>
<br /><br /><br />

<div style="width:60%; float:left">
<?php
ps_userfield::listUserFields( $fields, array(), $db );
?>

  <input type="hidden" name="option" value="com_virtuemart" />
  <input type="hidden" name="Itemid" value="<?php echo $Itemid ?>" />
  <input type="hidden" name="page" value="<?php echo $next_page ?>" />
  <input type="hidden" name="next_page" value="<?php echo $next_page ?>" />
  <input type="hidden" name="vmtoken" value="<?php echo vmspoofvalue( $sess->getSessionId() ) ?>" />
<?php
   if (!empty($user_info_id)) { ?>
      <input type="hidden" name="func" value="userAddressUpdate" />
      <input type="hidden" name="user_info_id" value="<?php echo $user_info_id ?>" />
<?php 
   }
   else { ?>
      <input type="hidden" name="func" value="userAddressAdd" />
<?php 
    } ?>
  <input type="hidden" name="user_id" value="<?php echo $auth["user_id"] ?>" />
  <input type="hidden" name="address_type" value="ST" />
  

    
  <br/>
  <div style="float:left;width:45%;text-align:right;" >
    <input type="submit" class="button" name="submit" value="<?php echo $VM_LANG->_('CMN_SAVE') ?>" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="<?php $sess->purl( SECUREURL."index.php?page=$next_page") ?>" class="button"><?php echo $VM_LANG->_('BACK') ?></a>
  </div>
  </form>
<?php
  if (!empty($user_info_id)) { ?>
    <div style="float:left;width:45%;text-align:center;"> 
      <form action="<?php echo SECUREURL ?>index.php" method="post">
        <input type="hidden" name="option" value="com_virtuemart" />
        <input type="hidden" name="page" value="<?php echo $next_page ?>" />
        <input type="hidden" name="next_page" value="<?php echo $next_page ?>" />
        <input type="hidden" name="func" value="useraddressdelete" />
        <input type="hidden" name="user_info_id" value="<?php echo $user_info_id ?>" />
        <input type="hidden" name="user_id" value="<?php echo $auth["user_id"] ?>" />
        <input type="submit" class="button" name="submit" value="<?php echo $VM_LANG->_('E_REMOVE') ?>" />
      </form>
    </div>
<?php 
  } ?>
  </div>
  </fieldset>
