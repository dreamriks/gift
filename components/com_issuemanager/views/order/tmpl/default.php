<?php
/*
    Document   : default.php
    Created on : 03-feb-2009, 19:30:05
    Author     : Luis Martin
    Description:
        template for view 'order'
*/
defined( '_JEXEC' ) or die( 'Restricted access' );
ob_end_clean();
ob_start();
?>
<table id="order">
    <?php
    foreach ($this->productsList as $product) {
    ?>
    <tr>
        <td>
            <?php echo $product['quantity']; ?>
        </td>
        <td>
           x
        </td>
        <td>
            <b><?php echo $product['name']; ?></b>
        </td>
    </tr>
    <?php
    }
    ?>
    <tr>
        <td colspan="3" align="right" style="border-top:1px solid">Total: <b><?php echo $this->orderTotal; ?></b></td>
    </tr>
</table>
<?php
ob_end_flush();
?>