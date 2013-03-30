<?php
/*
    Document   : mod_issuemanager.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        Main file for the Issue Manager module
*/
defined('_JEXEC') or die('Restricted access');
// Load helper class in helper.php
require(dirname(__FILE__).DS.'helper.php');
// Display options menu
$menuItems = modIssuemanagerHelper::get_menu_items();
if ($menuItems) {
    // Load template for mod_issuemanager. If none is specified in second parameter, 'default' template is loaded
    require(JModuleHelper::getLayoutPath('mod_issuemanager'));
}
?>
