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

global $VM_LANG;

if( $ok ) {
	echo '<h3>'.$VM_LANG->_('PHPSHOP_WAITING_LIST_THANKS').'</h3>';
}
?>
<br />
<br />
<?php 
  	echo '<a class="previous_page" href="'.$sess->url( $_SERVER['PHP_SELF']."?page=shop.product_details&product_id=$product_id" ). '">'
      . $VM_LANG->_('PHPSHOP_BACK_TO_DETAILS').'</a>';
?> 
