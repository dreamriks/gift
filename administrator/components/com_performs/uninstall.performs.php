<?php
/**
* @version $id: uninstall.performs.php,v 2.0 beta 2005/12/11 22:34:40 asasd Exp $
 * @package performs
 * @copyright (C) 2007 David Walters
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @author David Walters
 * Joomla is Free Software
 */
// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
function com_uninstall() {
  global $database, $mosConfig_absolute_path;
  $err = "";
  $mambots = array('mosperforms');
  foreach ($mambots as $mbot) {
    $query = 'DELETE FROM `#__mambots` WHERE element = \'' . $mbot . '\'';
    $database->setQuery($query);
    $database->query();
    $err .=$database->getErrorMsg()."\n";
  }
	
  $modules = array('mod_performs');
  foreach ($modules as $modul) {
    $query = 'UPDATE `#__modules` SET published = \'0\' WHERE module = \'' . $modul . '\'';
    $database->setQuery($query);
    $database->query();
    $err .=$database->getErrorMsg()."\n";
  }
	
	$unlinks = array (
		array("/mambots/content/", array("mosperforms.php", "mosperforms.xml")),
		array("/modules/", array("mod_performs.php", "mod_performs.xml")) 
	);

	foreach ($unlinks as $unlinkinfo) {
		$elementPath = $mosConfig_absolute_path.$unlinkinfo[0];
		$filenames = $unlinkinfo[1];
  foreach ( $filenames as $fnam) {
    if (file_exists($elementPath.$fnam)) {
      unlink($elementPath.$fnam); 
    } else {
      //echo "No delete!<pre>".$elementPath.$fnam."</pre>";
      //die("Couldnt delete");
    }
  }
	}
  if ($err == "") {
    echo "Thank you for using perForms.  Visit us at http://www.performs.org.au for upgrades and tutorials.";
  } else {
  }
}
?>
