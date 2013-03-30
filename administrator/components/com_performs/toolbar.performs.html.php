<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
* @version $id: toolbar.performs.html.php,v 2.3
 * @package performs
 * @copyright (C) 2007 perForms
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @author David Walters
 * @author (original) Ilhami KILIC http://www.tuwitek.at
 * Joomla is Free Software
 */
/** ensure this file is being included by a parent file */
require_once("lib/myLib.php");
class TOOLBAR_performs {
	function _EDIT() {
		global $id;
    if ( isJ15() ) {
      //mosMenuBar::title( 'Performs '.PFVersionNumber() );
    }
		mosMenuBar::startTable();
		mosMenuBar::spacer();
		mosMenuBar::custom('performswindow', 'preview.png', 'preview_f2.png', PREVIEW, false);    
    mosMenuBar::custom('showData', '../components/com_performs/images/query.png', '../components/com_performs/images/query.png', BOUNDDATA, false);
		mosMenuBar::apply('applyform');
		mosMenuBar::save();
		mosMenuBar::spacer();
		if ( $id ) {
			mosMenuBar::cancel( 'cancel', CLOSE );
		} else {
			mosMenuBar::cancel();
		}
		mosMenuBar::endTable();
	}
	function _DEFAULT() {
    if ( isJ15() ) {
		/*
      $upchk = checkForUpdates(true);
      if ($upchk != "") {
        $rvs = explode("\n", $upchk, 2);
        
        $mk = MakePFInfoIcon(
                             'Performs '.$rvs[0]." ".IS_AVAILABLE,
                             $rvs[1]
                             );    
        mosMenuBar::title( 'Performs '.PFVersionNumber().$mk );
      } else {
			*/
        mosMenuBar::title( 'Performs '.PFVersionNumber() );
				/*
      }
			*/
    }
		mosMenuBar::startTable();
		mosMenuBar::custom('copy', 'copy.png', 'copy_f2.png', COPY_RECORD, true);		
		mosMenuBar::addNewX();
		mosMenuBar::spacer();
		mosMenuBar::publish();
		mosMenuBar::spacer();
		mosMenuBar::unpublish();		
		mosMenuBar::spacer();		
		mosMenuBar::editListX();
		mosMenuBar::spacer();
		mosMenuBar::custom('performswindow', 'preview.png', 'preview_f2.png', PREVIEW, false);    
    mosMenuBar::custom('items', '../components/com_performs/images/items_s.png', '../components/com_performs/images/items_f.png', ITEMS, true);
    mosMenuBar::custom('showData', '../components/com_performs/images/query.png', '../components/com_performs/images/query.png', BOUNDDATA, true);
		mosMenuBar::spacer();		
		mosMenuBar::deleteList();
		mosMenuBar::endTable();
	}
	function _ITEMS() {			
    if ( isJ15() ) {
    //  mosMenuBar::title( 'Performs '.PFVersionNumber() );
    }
		mosMenuBar::startTable();	
    mosMenuBar::custom('showData', '../components/com_performs/images/query.png', '../components/com_performs/images/query.png', BOUNDDATA, false);
		mosMenuBar::spacer();				
		mosMenuBar::custom('performswindow', 'preview.png', 'preview_f2.png', PREVIEW, false);
		mosMenuBar::spacer();				
		mosMenuBar::addNew('newItem',NEW_ITEM);
		mosMenuBar::spacer();		
		mosMenuBar::custom('copyitem', 'copy.png', 'copy_f2.png', COPY_RECORD, true);		
		mosMenuBar::spacer();		
		mosMenuBar::editListX('editItem',EDIT_ITEM);
		mosMenuBar::spacer();	
		mosMenuBar::deleteList(DELETE_ITEM_CONFIRM,'deleteItem', DELETE);
		mosMenuBar::spacer();
		mosMenuBar::cancel('closeItems',CLOSE);
		mosMenuBar::endTable();
	}
	function _EDITITEM() {
		global $id;
    if ( isJ15() ) {
     // mosMenuBar::title( 'Performs '.PFVersionNumber() );
    }
		mosMenuBar::startTable();
		mosMenuBar::custom('performswindow', 'preview.png', 'preview_f2.png', PREVIEW, false);    
		mosMenuBar::save('saveItem',SAVE);
		mosMenuBar::apply();
		mosMenuBar::spacer();
		if ( $id ) {
			mosMenuBar::cancel( 'cancelItem', CLOSE );
		} else {
			mosMenuBar::cancel('cancelItem',CANCEL);
		}
		mosMenuBar::endTable();
	}	
	function _DBTABLE(){
    if ( isJ15() ) {
     // mosMenuBar::title( 'Performs '.PFVersionNumber() );
    }
		global $tablename;
		mosMenuBar::startTable();
		mosMenuBar::save('saveDBTable',SAVE);		
		mosMenuBar::spacer();
		mosMenuBar::cancel('cancel',CANCEL);
		mosMenuBar::endTable();	
	}
  function _SHOWDATA() {
    if ( isJ15() ) {
     // mosMenuBar::title( 'Performs '.PFVersionNumber() );
    }
		global $tablename;
		mosMenuBar::startTable();
		mosMenuBar::custom('assigntable', 'tool.png', 'tool_f2.png', BINDING, false);
		mosMenuBar::custom('FullExport', 'download.png', 'download_f2.png', EXPORTTOEXCEL, false);
		mosMenuBar::cancel('back',_BACK);
		mosMenuBar::endTable();	
  }
}
?>
