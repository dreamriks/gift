<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* @version $id: toolbar.performs.php,v 2.0 beta 2005/12/11 22:34:40 asasd Exp $
* @package performs
* @copyright (c) 2007 perForms
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @author David Walters
* @author (original) Ilhami KILIC http://www.tuwitek.at
* Joomla is Free Software
*/
require_once( $mainframe->getPath( 'toolbar_html' ) );
switch ( $task ) {
// FORM ITEMS		
	case 'editItem':
	case 'editItemA':	
	case 'newItem':
		TOOLBAR_performs::_EDITITEM();
		break;	
	case 'itemsA': 
	case 'items':
		TOOLBAR_performs::_ITEMS();
		break;	
// FORMS
	case 'new':
	case 'edit':
	case 'editA':
		TOOLBAR_performs::_EDIT();
		break;
//NOTE: 'dbtable' is being deprecated
	case 'dbtable':	case 'assigntable':
		TOOLBAR_performs::_DBTABLE();
		break;
  case 'showData': 
    TOOLBAR_performs::_SHOWDATA();
    break;
	case 'ViewSubmission':
		break;
	default:
		TOOLBAR_performs::_DEFAULT();
		break;
}
?>
