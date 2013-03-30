<?php
/**
* @version $id: admin.performs.php,v 1.0 2005/12/11 22:34:40 asasd Exp $
 * @package performs
 * @copyright (C) 2007 perForms
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @author David Walters
 * @author (original) Ilhami KILIC http://www.tuwitek.at
 * Joomla is Free Software
 */
/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $acl;
//$acl->_mos_add_acl("administration", "ViewSubmission", "users", "Manager", "components", "com_performs");
//$acl->_mos_add_acl("administration", "edit", "users", "manager", "components", "com_performs");

$acl->_mos_add_acl("action", "ViewSubmission", "users", "manager", "components", "com_performs");

//if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' )
//	| $acl->acl_check( 'administration', 'ViewSubmission', 'users', $my->usertype, 'components', 'com_performs' ))) {
//

if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' ) 
	|$acl->acl_check(
	'action', $task, 'users', $my->usertype, 
	'components', 'com_performs' ))) {

	echo "USERTYPE: $my->usertype";
//	die();

	mosRedirect( 'index2.php', _NOT_AUTH );
}

global $mosConfig_absolute_path,$mosConfig_lang;
if (file_exists($mosConfig_absolute_path.'/components/com_performs/language/'.$mosConfig_lang.'.php')) {
  include($mosConfig_absolute_path.'/components/com_performs/language/'.$mosConfig_lang.'.php');
} else {
  include($mosConfig_absolute_path.'/components/com_performs/language/english.php');
}
require_once( $mainframe->getPath( 'admin_html' ) );
require_once( "lib/myLib.php" );
require_once($mosConfig_absolute_path."/administrator/components/com_performs/class.performs.php");
if ($mosConfig_debug) {
echo @"
<style type=\"text/css\">
#debugdiv {
float: none;
position: absolute;
display: none;
}
</style>
<script language=\"javascript\">
function toggleDebugDiv() {
  var dbgdiv = document.getElementById('debugdiv'); 
  var displ = dbgdiv.style.display;
  if ((displ == 'none') || (displ == '')) {
    dbgdiv.style.display = 'block';
  } else {
    dbgdiv.style.display = 'none'; 
  }
}
</script>
";
}
$tabs = new mosTabs(0);//startTab (joomla.php line 4318 version 1.0.11) only ever adds tabs to tabPane1 ... 
if ($mosConfig_debug) {
  echo '<div style="text-align: left;"><a href="javascript: toggleDebugDiv();" />DEBUG:</a></div><div id="debugdiv"><table style="background-color: aliceblue; padding: 8pt; border: thick dotted khaki; width: 700px; margin-top: 24pt;"><tr><td><h2>performs.php</h2></td></tr><tr><td>';
  $tabs->startPane("session");
  report_env ($tabs, 1);
}
$id 	= mosGetParam( $_GET, 'id', 0 );
$itemid = mosGetParam( $_REQUEST, 'itemid', 0 );
$formID = mosGetParam( $_REQUEST, 'formId', 0 );
$cid 	= mosGetParam( $_REQUEST, 'cid', array(0) );
//formrowindex is special, it is only passed from the unbound form to the 
//name your table form.
$formrowindex 	= mosGetParam( $_REQUEST, 'formrowindex', array(0) );
if (!is_array( $cid )) {
	$cid = array( $cid );
}
switch ($task) {
	case 'preview':
		include("performswindow.php");
		break;
    // FORM ITEMS
	case 'itemsA':
		showFormItems( $formID,  $option );
		break;
	case 'items':
		showFormItems( $cid[0],  $option );
		break;
	case 'orderup':
		orderFormItem( $cid[0], -1, $option );
		break;
	case 'orderdown':
		orderFormItem( $cid[0], 1, $option );
		break;
	case 'closeItems':
		mosRedirect('index2.php?option=com_performs');
		break;	
	case 'cancelItem':
		cancelItem();
		break;
	case 'newItem':
		editFormItem($formID,'0', $option);
		break;
	case 'copyitem':
		copyFormItem($cid[0], $option );
		break;
	case 'editItem':
		editFormItem($formID, $cid[0], $option);
		break;
	case 'editItemA':
		editFormItem($formID, $id, $option);
		break;
	case 'saveItem':
		saveFormItem( $option, $task, $itemid );
		break;		
	case 'apply':
		saveFormItem( $option, $task, $itemid );
		break;		
	case 'deleteItem':
		removeFormItem( $formID,$cid, $option );
		break;
	case 'saveorder':
    saveOrder( $cid );
    break;
	case 'reverseorder':
    reverseOrder( $cid );
    break;
  case 'swapsize1and2':
    swapSizeOneAndTwo( $cid );
    break;
    // FORMS
  case 'new':
		editForm( '0', $option);
		break;
	case 'copy':
		copyForm($cid[0], $option );
		break;
	case 'edit':
		editForm( $cid[0], $option );
		break;
	case 'editA':
		editForm( $id, $option );
		break;
	case 'save':
		saveForm( $option, $task );
		break;
	case 'applyform':
		saveForm( $option, $task );
		break;
	case 'remove':
		removeForms( $cid, $option );
		break;
	case 'publish':
		changeForm( $cid, 1, $option );
		break;
	case 'unpublish':
		changeForm( $cid, 0, $option );
		break;
  case 'cancel':
    cancelForm();
		break;
	case 'dbtable':
		editDBTable( $cid[0], $option );
		break;
	case 'assigntable':
		editDBTable( $formrowindex, $option );
		break;
	case 'saveDBTable':
		saveDBTable( $option );
		break;
  case 'showData':
		if (array_key_exists("id", $_REQUEST) ) {
			showBoundTable( NULL, $option, $_REQUEST['id'] );
		} else {
			showBoundTable( $cid[0], $option, $formID );
		}
    break;
  case 'FullExport':
    exportToExcel( $cid[0], $option, $formID );
    break;
	case 'ViewSubmission':
		viewSubmission();
		break;
	default:
		showForms( $option );
		break;
}

/**
* List the records
 * @param string The current GET/POST option
 */
function showForms( $option ) {
	global $database, $mainframe, $mosConfig_list_limit, $mosConfig_absolute_path;
	$limit 		= $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );
	$database->setQuery( "SELECT COUNT(*) FROM #__performs" );
	$total = $database->loadResult();
	require_once( $mosConfig_absolute_path . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );
	$query = "SELECT m.*, u.name AS editor , u.name AS user,"
    . "\n COUNT(d.itemId) AS fieldCount"
    . "\n FROM #__performs AS m"
    . "\n LEFT JOIN #__users AS u ON u.id = m.checked_out"
    . "\n LEFT JOIN #__performs_items AS d ON d.formId = m.id "
    . "\n GROUP BY m.id"
    . "\n LIMIT $pageNav->limitstart,$pageNav->limit"
    ;
	$database->setQuery( $query );
	$rows = $database->loadObjectList();
	for ($i=0, $n=count($rows); $i < $n; $i++) {
		$r = "-";
		if(!empty($rows[$i]->tablename)){
			$database->setQuery( "SELECT COUNT(*) FROM ".$rows[$i]->tablename);
			$r = $database->loadResult();
		}		
		$rows[$i]->recordsCount = $r;
	}
	HTML_perform::showForms( $rows, $pageNav, $option);
}

/**
* List the records
 * @param int The current Form
 * @param string The current GET/POST option
 */
function showFormItems( $formId,$option ) {
	global $database, $mainframe, $mosConfig_list_limit;
	$row = new mosForm( $database );
	$row->load($formId);
	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$query = "SELECT * "
    . "\n FROM #__performs_items WHERE formId='$formId' ORDER BY ordering ASC"	;
	$database->setQuery( $query );
	$rows = $database->loadObjectList();
	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( count($rows), 0, 999  );	
	HTML_perform::showFormItems( $rows, $pageNav, $option, $formId, $row->title, ($row->tablename!=""));
}

/**
* Moves the order of a record
 * @param integer The increment to reorder by
 */
function orderFormItem( $uid, $inc, $option ) {
	global $database;
	$row = new mosFormItems( $database );
	$row->load( $uid );
	$row->move( $inc );
	mosRedirect( "index2.php?option=$option&task=itemsA&formId=".$row->formId );
}

/**
* Creates a new or edits and existing user record
 * @param int The id of the record, 0 if a new entry
 * @param string The current GET/POST option
 */
function editForm( $id, $option ) {
	global $database, $my;
	global $mosConfig_absolute_path;
	$row = new mosForm( $database );
	$row->load( $id );
	if ($row->checked_out && $row->checked_out <> $my->id) {
		mosRedirect( 'index2.php?option='. $option, sprintf(FORM_CURRENTLY_EDITED, $row->title ) );
	}
	if ($id) {
		// do stuff for existing records	
		$row->checkout($my->id);		
	} else {
		// do stuff for new records)
		$row->r_url="";
		$row->published = 1;
		$row->mailIt=0;
		$row->mailAlways=0;
		$row->mailAsText=0;
		$row->useintro=0;
    $row->replaceSubmitButton=0;
    $row->replaceResetButton=0;
		$row->includeReset=0;
    $row->appendtimestamp=0;
		$row->submitLabel=SUBMIT_LABEL;
    $row->includePF = 1;
    $row->includePDF = 0;
    $row->enableMailFrom = 0;
    $row->mailToAdmin = 0;
    $row->mailToUser = 0;
    $row->enableMailFrom = 0;
    $row->appendtimestamp = 0;
		$row->use_securityimages = 0;
		$row->showFormTitle = 1;
		$row->formWidth="100%";
		$row->useContainer = 1;
		$row->noAuthMessage=NOT_AUTHORIZED;
	}
	$lists = array();
	$lists['image'] 			= mosAdminMenus::Images( 'image', $row->image );
  $imgfloats = array (
                      mosHTML::makeOption( 'left', FLOAT_LEFT ),
                      mosHTML::makeOption( 'right', FLOAT_RIGHT ),
                      mosHTML::makeOption( 'none', FLOAT_NONE ),
                      mosHTML::makeOption( 'inherit', FLOAT_INHERIT ),
                      );
  $lists['imagefloat'] = mosHTML::selectList($imgfloats, "imagefloat", "", 'value', 'text', $row->imagefloat);
	$lists['published'] 		= mosHTML::yesnoradioList( 'published', '', $row->published );
	$lists['mailIt'] 			= mosHTML::yesnoradioList( 'mailIt', '', $row->mailIt );
	$lists['mailToAdmin'] 			= mosHTML::yesnoradioList( 'mailToAdmin', '', $row->mailToAdmin );
	$lists['mailToUser'] 			= mosHTML::yesnoradioList( 'mailToUser', '', $row->mailToUser );
	$lists['enableMailFrom'] 			= mosHTML::yesnoradioList( 'enableMailFrom', '', $row->enableMailFrom );
  $lists['mailAlways']		= mosHTML::yesnoradioList( 'mailAlways', '', $row->mailAlways );
  $lists['mailAsText']		= mosHTML::yesnoradioList( 'mailAsText', '', $row->mailAsText );
	$lists['useintro'] 			= mosHTML::yesnoradioList( 'useintro', '', $row->useintro );
	$lists['appendtimestamp'] 			= mosHTML::yesnoradioList( 'appendtimestamp', '', $row->appendtimestamp );
	$lists['includeSubmit'] 		= mosHTML::yesnoradioList( 'includeSubmit', '', $row->includeSubmit );
	$lists['replaceSubmit'] 			= mosHTML::yesnoradioList( 'replaceSubmitButton', '', $row->replaceSubmitButton );
	$lists['replaceReset'] 			= mosHTML::yesnoradioList( 'replaceResetButton', '', $row->replaceResetButton );
	$lists['includeReset'] 		= mosHTML::yesnoradioList( 'includeReset', '', $row->includeReset );
	$lists['includePF'] 		= mosHTML::yesnoradioList( 'includePF', '', $row->includePF );
	$lists['includePDF'] 		= mosHTML::yesnoradioList( 'includePDF', '', $row->includePDF );
	$lists['use_securityimages'] 		= mosHTML::yesnoradioList( 'use_securityimages', '', $row->use_securityimages );
	$lists['access'] 			= mosAdminMenus::Access( $row );
	$javascript = "onchange=\"javascript:if (document.forms[0].theme.options[selectedIndex].value!='') {document.themelib.src='../components/com_performs/skins/' + document.forms[0].theme.options[selectedIndex].value} else {document.themelib.src='../images/M_images/blank.png'}\"";
	$lists['themes'] 			= mosAdminMenus::Images( 'theme', $row->theme , $javascript , "/components/com_performs/skins");

	$lists['showFormTitle'] 		= mosHTML::yesnoradioList( 'showFormTitle', '', $row->showFormTitle );
	$lists['useContainer'] 		= mosHTML::yesnoradioList( 'useContainer', '', $row->useContainer );
	$lists['attachXmlFile'] 		= mosHTML::yesnoradioList( 'attachXmlFile', '', $row->attachXmlFile );
	$lists['attachXmlFileUSER'] 		= mosHTML::yesnoradioList( 'attachXmlFileUSER', '', $row->attachXmlFileUSER );

	HTML_perform::editform( $row, $lists, $option, $params );
}

function getThemes($path) {
  $fileNames = array();
  
  if (is_dir($path)) {
    if ($dh = opendir($path)) {
      while (($file = readdir($dh)) !== false) {
        if ($file == "." || $file == "..") continue;
        $fullpath = $path . "/" . $file;
        $fkey = strtolower($file);
        if(is_dir($fullpath)){
          $fileNames[] = $file;
        }
      }
      closedir($dh);
    } else die ("Cannot open directory:  $path");
  } else die ("Path is not a directory:  $path");
 	asort($fileNames);
  return $fileNames;
}

/** Shows a report of the contents of table bound to a form
* @author David Walters
* @param int The id of the record, 0 if a new entry
*/
function showBoundTable( $id, $option, $formId ) {
	global $database, $mainframe, $mosConfig_list_limit;
		if ($id == null) $id = $formId;
	$formRow = new mosForm( $database );
	$formRow->load( $id );
  HTML_perform::showBoundTable( $id, $formRow, $option, $pageNav );
}

/**
* Exports the contents of a bound table to excel format (text/tab)
 * @param int The id of the record, 0 if a new entry
 */
function exportToExcel( $id, $option, $formid ) {
	global $database;
	if($id==0){
		echo "<script> alert('".NO_FORM_FOUND.'('.$id.')'."'); window.history.go(-1); </script>\n";
		exit();	
	}
	$formRow = new mosForm( $database );
	$formRow->load( $id );
  HTML_perform::exportToExcel( $formRow, $option, $id );
}

/**
* Creates a new or edits and existing user record
 * @author David Walters
 * @param int The id of the record, 0 if a new entry
 * @param string The current GET/POST option
 */
function editDBTable( $id, $option ) {
	global $database, $my;
	global $mosConfig_absolute_path;
	$row = new mosForm( $database );
	$row->load( $id );
	if (empty($row->title)) {
		echo "<script> alert('".NO_FORM_FOUND.'('.$id.')'."'); window.history.go(-1); </script>\n";
		exit();
	}
	HTML_perform::editDBTable( $row, $option);
}

/**
* Creates a new or edits and existing user record
 * @param int The id of the record, 0 if a new entry
 * @param string The current GET/POST option
 */
function editFormItem( $formId, $id, $option ) {
	global $database, $my;
	global $mosConfig_absolute_path;
	$row = new mosFormItems( $database );
	$row->load( $id );
	$values = array();
	if ($id) {
		// do stuff for existing records
		$row->checkout($my->id);
		if($row->type=='select' || $row->type=='checkbox' || $row->type=='radio')	{	
			$tailes = array();
			$tailes = explode( getEncodingSep(), $row->value);
			foreach($tailes as $tail){
				if(!empty($tail))
					$values[] = mosHTML::makeOption( $tail );	
			}
			$row->value = "";
		}	
	} else {
		// do stuff for new records
		$row->required = "0";
		$row->disabled = "0";
		$row->readonly = "0";
		$row->multiple = "0";
		$row->usecaption = "1";
		
		$row->captionCssClass = "pfCaption";
		$row->valueCssClass = "pfValue";
		$row->infoCssClass = "pfInfo";
		$row->errorCssClass = "pfError";
		
		$row->formId = $formId;
		$row->type = "text";
    $query = "SELECT * FROM #__performs_items WHERE formId = ".$formId;
    $database->setQuery( $query );
    $itemcount = 0;
    if ($database->query()) {
      $itemcount = $database->getNumRows();
    } else {
      $itemcount = 0;
    }
    $row->ordering = $itemcount+1;
    $TI = 1;
    $row->caption = ucfirst($row->type)." Item ".($TI);
    $row->name = $row->type."Item".$TI;
    $foundnewname = false;
    while ($TI < 100) {
      $unique_name_query = "SELECT name from #__performs_items WHERE name = '" 
      . $row->name . "' AND formId = ".$row->formId;
      $database->setQuery($unique_name_query);
      $foundnewname = !$database->query();
      $foundnewname = $database->getNumRows();
      if ($foundnewname == 0) {
        $TI = 101;
        break;
      }
      $TI++;
      $row->caption = ucfirst($row->type)." Item ".($TI);
      $row->name = $row->type."Item".($TI);
    }
  }
	$arrInputTypes = array( 
                          /* 'button' ,*/
                          'checkbox', 
                          'file', 
                          'hidden',
                          /* 'image', */
                          'select',
                          'password',
                          /* 'pagebreak', */
                          'radio',
                          'date',
                          'text',
                          'textarea',
                          'textual'
                          );
	$arrInputTypesL = array( 
                           /* ITEMTYPE_BUTTON ,*/
                           ITEMTYPE_CHECKBOX,
                           ITEMTYPE_FILE, 
                           ITEMTYPE_HIDDEN,
                           /* ITEMTYPE_IMAGE, */
                           ITEMTYPE_SELECT, 
                           ITEMTYPE_PASSWORD, 
                           /* ITEMTYPE_PAGEBREAK, */
                           ITEMTYPE_RADIO, 
                           ITEMTYPE_DATE,
                           ITEMTYPE_TEXT,
                           ITEMTYPE_TEXTAREA,
                           ITEMTYPE_TEXTUAL
                           );
	asort($arrInputTypes);
	$types = array();
	for ($typeinc = 0; $typeinc < count ($arrInputTypes); ++$typeinc) {
		$types[] = mosHTML::makeOption( $arrInputTypes[$typeinc], ucfirst($arrInputTypesL[$typeinc]) );
  }
	$arrValuesTypes = array( TY_STRING,
                           TY_NAME,
                           TY_FLOAT,
                           TY_INTEGER,
                           TY_EMAIL );
	asort($arrValuesTypes);
	$checks = array();
	$checks[] = mosHTML::makeOption( "" );
	foreach($arrValuesTypes as $check)
		$checks[] = mosHTML::makeOption( $check,ucfirst($check) );
	$arrSepTypes = array( 
                        SEP_COMMA,
                        SEP_COMMASPACE,
                        SEP_HYPHEN,
                        SEP_NEWLINE,
                        SEP_SPACE
                        );
	$separators = array();
	foreach($arrSepTypes as $separator)
		$separators[] = mosHTML::makeOption( $separator,ucfirst($separator) );
	$lists = array();
	$lists['required'] 		= mosHTML::yesnoradioList( 'required',   '', $row->required   );
	$lists['disabled'] 		= mosHTML::yesnoradioList( 'disabled',   '', $row->disabled   );
	$lists['readonly'] 		= mosHTML::yesnoradioList( 'readonly',   '', $row->readonly   );
	$lists['multiple'] 		= mosHTML::yesnoradioList( 'multiple',   '', $row->multiple   );
	$lists['usecaption']	= mosHTML::yesnoradioList( 'usecaption', '', $row->usecaption );
	$lists['showuploadedimage']	= mosHTML::yesnoradioList( 'showuploadedimage', '', $row->showuploadedimage );
	$lists['types'] 		= mosHTML::selectList( $types, 'type', 'size="1" class="inputbox"  onChange="setSize();"', 'value', 'text', $row->type);
	$lists['checks'] 		= mosHTML::selectList( $checks, 'check', 'size="1" class="inputbox"', 'value', 'text', $row->check);
	$lists['values'] 		= mosHTML::selectList( $values , 'values[]', 'size="10" class="inputbox"  multiple="true" id="values"', 'value', 'text', $row->checkOrSelect);
	$lists['separators']	= mosHTML::selectList( $separators, 'separator', 'size="1" class="inputbox"', 'value', 'text', $row->separator);
	HTML_perform::editformitem( $row, $lists, $option );
}


/**
* Saves the record from an edit form submit
 * @param string The current GET/POST option
 * @author David Walters
 * @date 2007-02
 */
function saveForm( $option, $task ) {
	global $database;
	$row = new mosForm( $database );
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	if(empty($row->theme)){
		$row->theme="performs.jpg";
	}
	if (!$row->check()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	$row->checkin();
	$row->updateOrder();
  switch ($task) {
    case SAVE: case "save": case "Save": {
      echo "SAVE";
      mosRedirect( "index2.php?option=$option" );
      break;
    }
    default: {
      echo $task;
      mosRedirect( "index2.php?option=$option&task=editA&id=".$row->id );
      break;
    }
  }
}

/**
* Saves the record from an edit form submit
 * @param string The current GET/POST option
 * @author David Walters
 */
function saveFormItem( $option, $task ) {
	global $database;
	$row = new mosFormItems( $database );
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	if($row->type=='select' || $row->type=='checkbox' || $row->type=='radio')	{
		$values =  $_POST['values'];
    //refactor: implodeValues( $values )
    $row->value = implode( getEncodingSep(), $values );
	}
	if (!$row->check()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	$row->checkin();
  $row->updateOrder( "formId='$row->formId'" );
  echo "<div style=\"text-align: left; width: 100%; float: none;\"><h1>Updating Bound Table</h1>\n";
  $itemchanged = true;
  $qry = "SELECT * FROM #__performs WHERE id = '".$_POST['formId']."'";
  $database->setQuery($qry);
  $data = $database->query();
  if (!data) {
    echo "DB ERROR: \n";
    $database->stderr(true);
		exit();
  }
  $frmlist = $database->loadObjectList();
  $tablename = $frmlist[0]->tablename;
  $tablerow = $frmlist[0];
  $table_id = $tablerow->id;
  $altertable = false;
  $alterquery = "ALTER TABLE " . $database->NameQuote($tablename) . "\n";
  if ($tablename != "") {
    $qry = "SELECT * FROM #__performs_items WHERE itemid = ".$row->itemId;
    $database->setQuery($qry);
    $data = $database->query();
    if (!data) {
      echo "DB ERROR: \n";
      $database->stderr(true);
      exit();
    }
    $objlist = $database->loadAssocList();
    $objitem = new mosFormItems($database);
    $objitem->bind($objlist[0]);
    $itemvars = get_object_vars($objitem);
    $rowvars = $_POST;
    $addcomma = false;
    foreach ($itemvars as $itemvarname => $itemvarval) {
      if (!is_a($itemvarval, "database")) {
        switch ($itemvarname) {
          case "name": {
            $newschema = "text";
						//TODO: set the schema according to gui "item->binding" tab
						//TODO: "item->binding" tab (!)
						
            switch ($row->type) {
              case "password": {
                $newschema = "varchar(255)";
                break;
              }
//              case "date": {
//								$newschema = "timestamp NOT NULL default CURRENT_TIMESTAMP";
//                break;
//              }
							/*
              case "textarea": case "text": case "hidden": case "file": {
                $newschema = "text";
                break;
              }
              case "checkbox": case "select": case "radio": {
                $newschema = "text";
                break;
              }
							*/
            }
						
            $newschema = " " . $newschema;
            $altertable = true;
            $_qry = "DESCRIBE ".$tablename;
            $database->setQuery($_qry);
            $columnexists = false;
            if (!$database->query()) {
              echo "<script> alert('".$database->getErrorMsg(true)."'); window.history.go(-1); </script>\n";
              exit();
            }
            echo "<pre>".print_r($database->loadObjectList())."</pre>";
            foreach ($database->loadObjectList() as $obj) {
              if ($obj->Field == $row->name) {
                $columnexists = true;
              }
            }
            $alterquery .= ($addcomma ? ",\n " : " ")
              . (($columnexists) ? "CHANGE ".$database->NameQuote($itemvarval) . " " : "ADD ") 
              . $database->NameQuote($rowvars[$itemvarname])
              . $newschema
              . (($row->required) ? " NOT NULL" : "");
            $addcomma = true;
          }
          default: {
          }
        }
      }
    }
    $alterquery .= ";\n";
  }
  if ($altertable) {
    $database->setQuery($alterquery);
    if (!$database->query()) {
      echo "<script> alert('".$database->getErrorMsg(true)."'); window.history.go(-1); </script>\n";
      exit();
    }
  }
  switch ($task) {
    case "saveItem": {
      mosRedirect( "index2.php?option=$option&task=itemsA&formId=".$row->formId );
      break;
    } 
    default: {
      echo $task;
      mosRedirect( "index2.php?option=$option&task=editItemA&hidemainmenu=1&formId=".$row->formId."&id=".$row->itemId);
      break;
    }
  }
}
/** Duplicates a form item.
* @author David Walters
* @date --
*/
function copyFormItem( $id, $option ) {
  //coming soon!  
	echo "<h2>id</h2>";
	print_r($id);
	echo "<h2>option</h2>";
	print_r($option);
	echo "<h2>POST</h2>";
	print_r($_POST);
	die("Coming Soon...");
//      echo "<script> alert('Coming Soon!'); window.history.go(-1); </script>\n";
}
function copyForm( $id, $option ) {
	global $database;
	if ($id ) {
/*		$database->setQuery( "INSERT INTO #__performs(`intro`, `note`, `title`, `published`, `start_date`, `finish_date`, `image`, `tablename`, `theme`, `emails`, `mailIt`, `mailAlways`, `submitLabel`, `includeReset`, `resetLabel`, `mailSubject`, `access`, `checked_out`, `checked_out_time`, `r_url`, `asub`,`strMissingFieldMsg`,`use_securityimages`,`securityHelpText`,`securityErrorText`) SELECT `intro`, `note`, `title`, 0, `start_date`, `finish_date`, `image`, NULL, `theme`, `emails`, `mailIt`, `mailAlways`, `submitLabel`, `includeReset`, `resetLabel`, `mailSubject`, `access`, `checked_out`, `checked_out_time`, `r_url`, `asub`,`strMissingFieldMsg`,`use_securityimages`, `securityHelpText`,`securityErrorText` FROM #__performs WHERE id='$id'" ); */
		$database->setQuery( @"
		INSERT INTO #__performs(`intro`, `note`, `title`, `published`, `start_date`, `finish_date`, `image`, `imagefloat`, `tablename`, `theme`, `emails`, `mailIt`, `mailToAdmin`, `mailToUser`, `mailAsText`, `useintro`, `appendtimestamp`, `includeSubmit`, `submitLabel`, `includeReset`, `resetLabel`, `mailSubject`, `access`, `noAuthMessage`, `checked_out`, `checked_out_time`, `r_url`, `asub`,`strMissingFieldMsg`, `use_securityimages`, `securityHelpText`,`securityErrorText`, `showFormTitle`, `formWidth`, `useContainer`) 
		SELECT `intro`, `note`, `title`, 0, `start_date`, `finish_date`, `image`, `imagefloat`, NULL, `theme`, `emails`, 0, 0, 0, `mailAsText`, `useintro`, `appendtimestamp`, `includeSubmit`, `submitLabel`, `includeReset`, `resetLabel`, `mailSubject`, `access`, `noAuthMessage`, `checked_out`, `checked_out_time`, `r_url`, `asub`,`strMissingFieldMsg`, `use_securityimages`, `securityHelpText`, `securityErrorText`, `showFormTitle`, `formWidth`, `useContainer` 
		FROM #__performs WHERE id='$id'" );
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}
    $mysql_last_insert_id = $database->insertid();
    $query = "SELECT * FROM #__performs_items WHERE formId ='$id'";
    $database->setQuery( $query );
    $rows = $database->loadObjectList();
    for ($i=0, $n=count($rows); $i < $n; $i++) {
//      $insert = @"INSERT INTO `#__performs_items` 
//			( `formId` , `type` , `name` , `value` , `caption` , `required` , `var1` , `var2` , `check` , `help` , `errMsg` , `usecaption`, `showuploadedimage`, `disabled` , `readonly` , `multiple` , `checkOrSelect` , `ordering` )  
//			SELECT $mysql_last_insert_id , `type` , `name` , `value` , `caption` , `required` , `var1` , `var2` , `check` , `help` , `errMsg` , `usecaption`, `showuploadedimage`, `disabled` , `readonly` , `multiple` , `checkOrSelect` , `ordering` 
      $insert = @"INSERT INTO `#__performs_items` 
			( `formId` , `type` , `name` , `value` , `caption` , `required` , `var1` , `var2` , `check` , `help` , `errMsg` , `usecaption`, `showuploadedimage`, `disabled` , `readonly` , `multiple` , `captionCssClass` , `valueCssClass` , `infoCssClass` , `errorCssClass` , `checkOrSelect` , `ordering` )  
			SELECT $mysql_last_insert_id , `type` , `name` , `value` , `caption` , `required` , `var1` , `var2` , `check` , `help` , `errMsg` , `usecaption`, `showuploadedimage`, `disabled` , `readonly` , `multiple` , `captionCssClass` , `valueCssClass` , `infoCssClass` , `errorCssClass` , `checkOrSelect` , `ordering` 
			FROM `#__performs_items`  WHERE `itemId` ='".$rows[$i]->itemId."'";
      $database->setQuery($insert);
      if (!$database->query()) {
        echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
        exit();
      }
    }
	}
	mosRedirect( "index2.php?option=$option" );
}

/**
* Removes records
 * @param array An array of id keys to remove
 * @param string The current GET/POST option
 */
function removeForms( &$cid, $option ) {
	global $database;
	if (count( $cid )) {
		foreach($cid as $id){
			$formRow = new mosForm( $database );
			$formRow->load( $id );
			if(!empty($formRow->tablename)){
				$drop = 'DROP TABLE IF EXISTS `'.$formRow->tablename .'`';
				$database->setQuery( $drop );
				if (!$database->query()) {
					echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
					exit();
				}
			}
		}
		$cids = implode( ',', $cid );
		$database->setQuery( "DELETE FROM #__performs WHERE id IN ($cids)" );
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		}
    $database->setQuery( "DELETE FROM #__performs_items WHERE formId IN ($cids)" );
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		}
	}
	mosRedirect( "index2.php?option=$option" );
}

/**
* Removes records
 * @param array An array of id keys to remove
 * @param string The current GET/POST option
 */
function removeFormItem( $formId, &$cid, $option ) {
	global $database;
  $form = new mosForm($database);
  $frmsql = "SELECT * FROM #__performs WHERE id = ".$formId;
  $database->setQuery($frmsql);
  if (!$database->query()) {
    echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
  }
  $frms = $database->loadAssocList();
  $form->bind($frms[0]);
	if (count( $cid )) {
    foreach ( $cid as $itemid ) {
      $formitem = new mosFormItems($database);
      $frmsql = "SELECT * from #__performs_items WHERE itemId = ".$itemid;
      $database->setQuery($frmsql);
      if (!$database->query()) {
        echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
        return;
      }
      if ($form->tablename != "") { 
        $formitems = $database->loadAssocList();
        $formitem->bind($formitems[0]);
        $itemqry = "ALTER TABLE ".$database->NameQuote($form->tablename)
          . "\n DROP " . $database->NameQuote($formitem->name) . ";";
        $database->setQuery($itemqry);
        if (!$database->query()) {
          echo "<script> alert('".$database->getErrorMsg(true)."'); window.history.go(-1); </script>\n";
          return;
        }
      }
    }
		$cids = implode( ',', $cid );
		$database->setQuery( "DELETE FROM #__performs_items WHERE itemId IN ($cids)" );
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg(true)."'); window.history.go(-1); </script>\n";
		}
	}
		mosRedirect( "index2.php?option=$option&task=itemsA&formId=".$formId );
}

/**
* Changes the state of one or more content pages
 * @param array An array of unique category id numbers
 * @param integer 0 if unpublishing, 1 if publishing
 * @param string The current option
 */
function changeForm( $cid=null, $state=0, $option ) {
	global $database, $my;
	if (count( $cid ) < 1) {
		$action = $state == 1 ? PUBLISH : UNPUBLISH;
		echo "<script> alert('".sprintf(SELECT_A_RECORD_TO,$action)."'); window.history.go(-1);</script>\n";
		exit;
	}
	$cids = implode( ',', $cid );
	$database->setQuery( "UPDATE #__performs SET published='$state'"
                       . "\nWHERE id IN ($cids)"
                       );
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}
	if (count( $cid ) == 1) {
		$row = new mosForm( $database );
		$row->checkin( intval( $cid[0] ) );
	}
	mosRedirect( "index2.php?option=$option" );
}
/** Binds a form to the given table in the database.
* @author David Walters (orig Kilmic)
* @date 2007-02
*/
function saveDBTable( $option ) {
	global $database;
	$id =  mosGetParam( $_POST, 'id', 0 );
	$delete = mosGetParam( $_POST, 'delete', 0 );
//	$tablename = mosGetParam( $_POST, 'tablename', 0 );
	$tablename = mosGetParam( $_POST, 'tablename', "" );
	if($id==0){
		echo "<script> alert('".NO_FORM_FOUND."'); window.history.go(-1); </script>\n";
		exit();	
	}
	$formRow = new mosForm( $database );
	$formRow->load( $id );
	if(empty($delete)){
		$tables = $database->getTableList();
		foreach($tables as $table){
			if($table==$tablename){
				echo "<script> alert('".sprintf(ALREADY_TABLE_EXISTS,$tablename)."'); window.history.go(-1); </script>\n";
				exit();			
			}
		}
		$query = "SELECT * "
      . "\n FROM #__performs_items WHERE formId='$id' ORDER BY ordering"	;
		$database->setQuery( $query );
		$rows = $database->loadObjectList();
		$insert = 'CREATE TABLE `'.$tablename."` ( `id` int(11) NOT NULL auto_increment, ";
    for ($i=0, $n=count($rows); $i < $n; $i++) {
      $row = $rows[$i];
	if (in_array($row->type, array("text", "hidden", "password", "date", "file"))) {
        $insert .= '`'.$row->name.'` ';
        $insert .= ' varchar';
        if(!empty($row->var1) && intval($row->var1)>0)
          $insert .= '('.$row->var1.') ';
else $insert .= '(100) ';
if($row->required)
$insert .= 'NOT NULL ';
if(!empty($row->value))
$insert .= "default '".$row->value."'";
$insert .= ",";
			}
else if($row->type=="textarea"){
  $insert .= '`'.$row->name.'` ';
  $insert .= ' text ';
  if($row->required)
    $insert .= 'NOT NULL ';
  $insert .= ",";			
}
else if($row->type=="checkbox" || $row->type=="select" || $row->type=="radio"){
  $insert .= '`'.$row->name.'` ';
  $insert .= ' varchar(255) ';
  if($row->required)
    $insert .= 'NOT NULL ';
  $insert .= ",";
}
		}		
$insert .= '`date_time` timestamp NOT NULL, `UserIp` varchar(20) NOT NULL, `GUID` text NOT NULL,'
.'PRIMARY KEY  (`id`))';
$database->setQuery( $insert );
if (!$database->query()) {
  echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
  exit();
}
$formRow->tablename = $tablename;
	}else {
		if(!empty($formRow->tablename)){
			$drop = 'DROP TABLE IF EXISTS `'.$formRow->tablename .'`';
			$database->setQuery( $drop );
			if (!$database->query()) {
				echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
			}		
		}
		$formRow->tablename = "";
	}
if (!$formRow->store()) {
		echo "<script> alert('".$formRow->getError()."'); window.history.go(-1); </script>\n";
		exit();
}
mosRedirect( "index2.php?option=$option");
}
/** PT
* Cancels editing and checks in the record
*/
function cancelForm() {
	global $database;
	$row = new mosForm( $database );
	$row->bind( $_POST );
	$row->checkin();
	mosRedirect('index2.php?option=com_performs');
}
function cancelItem() {
	global $database;
	$row = new mosFormItems( $database );
	$row->bind( $_POST );
	$row->checkin();
	mosRedirect('index2.php?option=com_performs&task=itemsA&formId='.$row->formId);
}
function saveOrder( &$cid ) {
	 global $database;
	 $total          = count( $cid );
	 $order          = josGetArrayInts( 'order' );
	 $row            = new mosFormItems( $database );
	 $conditions = array();
	 for ( $i=0; $i < $total; $i++ ) {
     $row->load( (int) $cid[$i] );
     if ($row->ordering != $order[$i]) {
       $row->ordering = $order[$i];
       if (!$row->store()) {
         echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
         exit();
       } // if
       $condition = "formId=" . (int) $row->formId;
       $found = false;
       foreach ( $conditions as $cond )
         if ($cond[1]==$condition) {
           $found = true;
           break;
         } // if
       if (!$found) $conditions[] = array($row->id, $condition);
     } // if
	 } // for
	 foreach ( $conditions as $cond ) {
     $row->load( $cond[0] );
     $row->updateOrder( $cond[1] );
	 } // foreach
	 mosCache::cleanCache( 'com_perForms' );
	 $msg    = NEW_ORDERING_SAVED;
	 mosRedirect( 'index2.php?option=com_performs&task=itemsA&formId=' . $row->formId, $msg );
}
function reverseOrder( &$cid ) {
	 global $database;
	 $total          = count( $cid );
	 $order          = josGetArrayInts( 'order' );
	 $row            = new mosFormItems( $database );
	 $conditions = array();
	 // update ordering values
	 for ( $i=0; $i < $total; $i++ ) {
     $row->load( (int) $cid[$i] );
     $row->ordering = $total - $order[$i];
     if (!$row->store()) {
       echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
       exit();
     } // if
     $condition = "formId=" . (int) $row->formId;
     $found = false;
     foreach ( $conditions as $cond )
       if ($cond[1]==$condition) {
         $found = true;
         break;
       } // if
     if (!$found) $conditions[] = array($row->id, $condition);
     //     } // if
} // for
foreach ( $conditions as $cond ) {
  $row->load( $cond[0] );
  $row->updateOrder( $cond[1] );
} // foreach
mosCache::cleanCache( 'com_perForms' );
$msg    = NEW_ORDERING_SAVED;
mosRedirect( 'index2.php?option=com_performs&task=itemsA&formId=' . $row->formId, $msg );
}
/** Swaps the value of the Size 1 and Size 2 fields.
* @author David Walters
* @date 2007-02
*/
function swapSizeOneAndTwo( &$cid ) {
	 global $database;
	 $total          = count( $cid );
	 $order          = josGetArrayInts( 'order' );
	 $row            = new mosFormItems( $database );
	 $conditions = array();
	 for ( $i=0; $i < $total; $i++ ) {
     $row->load( (int) $cid[$i] );
     $sz1 = $row->var1;
     $sz2 = $row->var2;
     if ($row->type == "textarea") {
       $row->var1 = $sz2;
       $row->var2 = $sz1;
     }
     if (!$row->store()) {
       echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
       exit();
     } // if
	 } // for
     // clean any existing cache files
	 mosCache::cleanCache( 'com_perForms' );
	 $msg    = NEW_SIZEVARS_SAVED;
	 mosRedirect( 'index2.php?option=com_performs&task=itemsA&formId=' . $row->formId, $msg );
}

function viewSubmission() {
		global $database;
//	$tablename = $_REQUEST['table'];
	$rowname = $_REQUEST['GUID'];
	
	$_formsql = "SELECT * FROM #__performs WHERE id = " . $_REQUEST['formid'];
	$database->setQuery($_formsql);
	if (!$database->query($_formsql)) {
	}
	$theForms = $database->loadObjectList();
	$theForm = $theForms[0];

	$_itemsql = "SELECT * FROM #__performs_items WHERE formid = " .$_REQUEST['formid']
	. " ORDER BY ordering;";
	$database->setQuery($_itemsql);
	if (!$database->query($_itemsql)) {
	}
	$theItems = $database->loadAssocList();
//	echo "<h1>theItems</h1><PRE>" . print_r($theItems) . "</PRE><hr>";
	

	$tablename = $theForm->tablename;
	$_tablesql = "SELECT * FROM $tablename WHERE GUID = '$rowname'";
	$database->setQuery($_tablesql);
	if (!$database->query($_tablesql)) {
	}
	$theRows = $database->loadObjectList();
	$theRow = $theRows[0];
	
//------------------------------------------------------------------------------
//	echo "<h1>theRow</h1><PRE>" . print_r($theRow) . "</PRE>\n<hr>";
//------------------------------------------------------------------------------

//------------------------------------------------------------------------------
	echo @"<table border=1 width=100%>
	<tr><td>USERIP</td><td>DateTime</td><td>GUID</td></tr>
	<tr>
		<td>$theRow->UserIp</td>
		<td>$theRow->date_time</td>
		<td>$theRow->GUID</td>
	</tr>
	</table>
";
	$theData = $database->loadAssocList();
	if (count($theData) == 0) return;
	$tabletext = "";
//	foreach ($theData[0] as $theName => $theValue) {
//		if ($theName != "GUID" && $theName != "date_time" && $theName != "UserIp") {
//			$tabletext .= "[tr]"
//				."[td][b]".$theName."[/b][/td]"
//				."[td]".$theValue."[/td]"
//				."[/tr]\n";
//		}
//	}
//------------------------------------------------------------------------------

//------------------------------------------------------------------------------
echo '<div style="border: thin red solid;">';
echo "<table border=0>";
	foreach ($theItems as $theItem) {
		//$theItem = $theItems[0];
		$theName = strip_tags($theItem["caption"]);
		$theValue = ((array_key_exists($theItem["name"], $theData[0])) 
			? stripslashes( stripslashes($theData[0][$theItem["name"]]) )
			: "" );
		$theValue = str_replace(PF_RECORD_SEPARATOR, ", ", $theValue);
		
		
		switch ($theItem["type"]) {
			case "textual": {
				if ($theName == " ") {
					echo "<tr><td colspan=\"2\" height=\"6px\" valign=\"middle\">"
						.$theName."</td></tr>";
				} else {
					echo "<tr><td colspan=\"2\" height=\"42px\" valign=\"middle\"><b><u>"
						.$theName."</u></b></td></tr>";
				}
				$tabletext .= "[/table]" . "\n\n" . "[table][tr]"
					."[td][b][u]".$theName."[/u][/b][/td]"
					."[/tr][/table]".(($theName == " ") ? "" : "\n")."[table]\n";
				break;
			}
			default: {
				echo "<tr><td valign=\"top\"><b>".$theName."</b></td><td valign=\"top\">"
				. (($theItem["check"] == "email") ? "<a href=\"mailto:" : "")
				. $theValue
				. (($theItem["check"] == "email") ? "\">$theValue</a>" : "")
				. "</td></tr>";
				$tabletext .= "[tr]"
					."[td][b]".$theName."[/b][/td]"
					."[td]".$theValue."[/td]"
					."[/tr]\n";
				break;
				}
		}
			
	}
echo "</table>";
echo "</div>";
//------------------------------------------------------------------------------

	$tabletext = "[table]\n$tabletext\n[/table]";
	echo "<textarea rows=20 cols=80>$tabletext</textarea>";

}

?>

