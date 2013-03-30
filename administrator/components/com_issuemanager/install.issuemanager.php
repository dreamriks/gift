<?php
/*
    Document   : install.issuemanager.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        It's executed on Issue Manager installation. Its function is, apart from showing a welcome message, to create and assign
        the administrator who is installing the extension as the first administrator of Issue Manager

*/
defined( '_JEXEC' ) or die( 'Restricted access' );
function com_install() {
    ?>
    <div class="header">Issue Manager has been installed!</div>
    <p>
    Congratulations! Issue Manager for Joomla has already been installed.
    </p>
    <?php
}

// Get id of current user
$user =& JFactory::getUser();
if ($user->usertype == 'Administrator' || $user->usertype == 'Super Administrator') {
    $userid = $user->id;
    $db =& JFactory::getDBO();
    $query = "INSERT INTO #__im_operators (user_id, rank) VALUES ($userid, 2)";
    $db->setQuery($query);
    if (!$db->query()) {
        echo $db->getErrorMsg();
    }
} else {
    JError::raiseError('100', 'You are not allowed to install this extension. You must have administrator privileges.');
}
?>
