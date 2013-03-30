<?php
/*
    Document   : default_form.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        template for the new post form
*/

  defined( '_JEXEC' ) or die( 'Restricted access' ); 
?>
<form name="newPost" action="index.php" method="POST" onsubmit="return validate_form()">
    <table class="form">
        <tr>
            <td valign="top"><label for="post_body"><?php echo JText::_('NEWMESSAGE');?>:</label></td>
            <td><textarea id="post_body" name="post_body" rows="6" cols="20"></textarea></td>
        </tr>
        <tr>
            <td colspan="2" align="right"><input type="submit" value="<?php echo JText::_('SENDNEWMESSAGE');?>" name="submitButton" /></td>
        </tr>
    </table>
    <input type="hidden" name="option" value="<?php echo $option; ?>" />
    <input type="hidden" name="task" value="add_post" />
    <input type="hidden" name="view" value="<?php echo $this->getName(); ?>" />
    <input type="hidden" name="cid[]" value="<?php echo $this->ticketid; ?>" />
</form>