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

echo '<h2>'. $VM_LANG->_('VM_SAVED_CART_TITLE') .'</h2>
<!-- Cart Begins here -->
';
include(PAGEPATH. 'savedbasket.php');
echo $basket_html;
echo '<!-- End Cart --><br />
';

if ($cart["idx"]) {
 	?><div align="center">
 		<div style="float:left;width: 33%;"><?php echo $replaceSaved ?></div>
		<div style="float:left;width: 33%;"><?php echo $mergeSaved ?></div>
		<div style="float:left;width: 33%;"><?php echo $deleteSaved ?></div>
    
    <br style="clear:both;"><br /><hr /><div align="center">
    <?php
    if( $continue_link != '') {
		?>
		 <a href="<?php echo $continue_link ?>" class="continue_link">
		 	<?php echo $VM_LANG->_('VM_SAVED_CART_RETURN'); ?>
		 </a>
		<?php
    }
	  ?>
	</div>
	</div>
	
	<?php
	// End if statement
}
