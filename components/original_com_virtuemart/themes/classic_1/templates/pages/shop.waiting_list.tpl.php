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

?>
<form action="<?php echo $mm_action_url ?>index.php" method="post" name="waiting">
<input type="hidden" name="option" value="<?php echo $option ?>" />
<input type="hidden" name="func" value="waitinglistadd" />
<?php echo $VM_LANG->_('PHPSHOP_WAITING_LIST_MESSAGE') ?>
<br />
<br />

<input type="text" class="inputbox" name="notify_email" value="<?php echo $my->email ?>" />
&nbsp;&nbsp;

<input type="submit" class="button" name="waitinglistadd" value="<?php echo $VM_LANG->_('PHPSHOP_WAITING_LIST_NOTIFY_ME') ?>" />

<input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
<input type="hidden" name="page" value="shop.waiting_thanks" />

</form> 
