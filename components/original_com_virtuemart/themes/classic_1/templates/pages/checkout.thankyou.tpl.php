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

<h3><?php echo $VM_LANG->_('PHPSHOP_THANKYOU') ?></h3>
<p>
 	<?php 
 	echo vmCommonHTML::imageTag( VM_THEMEURL .'images/button_ok.png', 'Success', 'center', '48', '48' ); ?>
   	<?php echo $VM_LANG->_('PHPSHOP_THANKYOU_SUCCESS')?>
  
	<br /><br />
	<?php echo $VM_LANG->_('PHPSHOP_EMAIL_SENDTO') .": <strong>". $user->user_email . '</strong>'; ?><br />
</p>
  
<!-- Begin Payment Information -->
<?php
if( empty($auth['user_id'])) {
	return;
}
if ($db->f("order_status") == "P" ) {
	// Copy the db object to prevent it gets altered
	$db_temp = ps_DB::_clone( $db );
 /** Start printing out HTML Form code (Payment Extra Info) **/ ?>
 <br />
<table width="100%">
  <tr>
    <td width="100%" align="center">
    	<?php 
	    /**
	     * PLEASE DON'T CHANGE THIS SECTION UNLESS YOU KNOW WHAT YOU'RE DOING
	     */
	    // Try to get PayPal/PayMate/Worldpay/whatever Configuration File
	    @include( CLASSPATH."payment/".$db->f("payment_class").".cfg.php" );
	    
		$vmLogger->debug('Beginning to parse the payment extra info code...' );
		
	    // Here's the place where the Payment Extra Form Code is included
	    // Thanks to Steve for this solution (why make it complicated...?)
	    if( eval('?>' . $db->f("payment_extrainfo") . '<?php ') === false ) {
	    	$vmLogger->debug( "Error: The code of the payment method ".$db->f( 'payment_method_name').' ('.$db->f('payment_method_code').') '
	    	.'contains a Parse Error!<br />Please correct that first' );
	    }
	    else {
	    	$vmLogger->debug('Successfully parsed the payment extra info code.' );
	    }
	    // END printing out HTML Form code (Payment Extra Info)

      	?>
    </td>
  </tr>
</table>
<br />
<?php
$db = $db_temp;
}
?>
<p>
	<a href="<?php $sess->purl(SECUREURL.basename($_SERVER['PHP_SELF'])."?page=account.order_details&order_id=". $order_id) ?>" onclick="if( parent.parent.location ) { parent.parent.location = this.href.replace(/index2.php/, 'index.php' ); };">
 		<?php echo $VM_LANG->_('PHPSHOP_ORDER_LINK') ?>
 	</a>
</p>