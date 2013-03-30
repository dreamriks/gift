<?php
/*
    Document   : default.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        Builds HTML structure of options menu in the module like an unordered list <ul>
        Construye la presentación del menú de opciones del módulo como una lista no ordenada <ul>
*/
defined('_JEXEC') or die('Restricted access');
echo '<ul>';
foreach ($menuItems as $menuOption) {
    echo '<li>';
    modIssuemanagerHelper::build_option($menuOption);
    echo '</li>';
}
echo '</ul>';
?>
