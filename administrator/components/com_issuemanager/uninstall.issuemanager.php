<?php
/*
    Document   : uninstall.issuemanager.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        It will be executed on uninstallation of component. It will show a goodbye message
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
function com_uninstall() {
    ?>
    <div class="header">Issue Manager is now removed from your system.</div>
    <p>
    We're sorry to see you go! To completely remove the
    software from your system, be sure to also
    uninstall the module if it is still installed.
    </p>
    <?php
}
?>
