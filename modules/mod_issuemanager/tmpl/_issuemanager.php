<?php
/*
    Document   : _issuemanager.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        Template for the HTML necessary for each menu option
        This file is included in the build_option() helper method, which in turn is called from default.php
*/
defined('_JEXEC') or die('Restricted access');
?>
<a href="<?php echo $link;?>" <?php echo ($id) ? 'id="' . $id . '"' : ''; ?> <?php echo ($onclick) ? 'onclick="' . $onclick . '"' : ''; ?>>
    <?php echo $name; ?>
</a><br />
