<?php
defined( '_VALID_MOS' ) or die( 'Restricted access' );
define ("PF_UTF_8", 1);
define ("PF_RECORD_SEPARATOR", chr(31));

//define ("PFDEBUG_ALL_USERS",1);

$pfDebug = false;
global $mainframe, $my, $pfDebug, $mosConfig_lang;
if (!isset($my)) {
	global $database;
	$mainframe = new mosMainFrame ( $database, '', '.' );
	$mainframe->initSession();
	//@ob_clean();
	$usr = $mainframe->getUser();
	if (($usr->gid > 0) || (defined("PFDEBUG_ALL_USERS"))) {
		$pfDebug = $mosConfig_debug;
		error_reporting(E_ALL);
	}
} else {
	global $my;
	$usr = $my;
	if (($usr->gid > 0) || (defined("PFDEBUG_ALL_USERS"))) {
		global $mosConfig_debug;
		$pfDebug = $mosConfig_debug;
		error_reporting(E_ALL);
	}
}
/**
*@author David Walters
 *@date 2007-3
 *Preparation for the switch to utf-8
 */
function isUTF8() {
  return PF_UTF_8;
}

function isJ15 () {
  return ( method_exists( 'JMenuBar', 'title') );
}

function isJ10() {
  global $mosConfig_absolute_path;
  $dnf=$mosConfig_absolute_path.'/globals.php'; 
  return ( file_exists($dnf) );
}

function getEncodingSep() {
  if (isJ15() || PF_UTF_8) {
    return chr(31);
  } else {
    return chr(167);
  }
}
function translateSeparator($sepstr) {
	$sep = "";
	switch ($sepstr)
	{
		case SEP_SPACE: {
			$sep = " ";
			break;
		}
		case SEP_COMMA: {
			$sep = ",";
			break;
		}
		case SEP_COMMASPACE: {
			$sep = ", ";
			break;
		}
		case SEP_HYPHEN: {
			$sep = "-";
			break;
		}
		case SEP_NEWLINE:
		default: {
			$sep = "\n";
			break;
		}
	}
	return $sep;
}


function makeArray($formId, $incSubmit=1, $submitLabel="", $incReset=0, $resetLabel=""){
	global $database,$mainframe,$my;
	$myUser = new mosUser($database);
	if($my->id!=0)
		$myUser->load( $my->id);
	$item_query = "SELECT * FROM #__performs_items WHERE formId='$formId' ORDER BY `ordering` ASC";
	$database->setQuery( $item_query );
	$item_data = $database->loadObjectList();
	$arrFields = array();
	foreach($item_data as $row){
		$field = array();
		$field["caption"] = parseAuto($row->caption);
		$field["separator"] = $row->separator;
		$field["type"] = $row->type;
		$field["name"] = $row->name;
		$field["class"] = "inputbox" ;
		$field["usecaption"] = $row->usecaption;
		$field["showuploadedimage"] = $row->showuploadedimage;
    if ($row->accesskey) {
      $field["accesskey"] = $row->accesskey;
    }
		if(!empty($row->check))
      $field["check"] = $row->check;
		if(!empty($row->help))
      $field["help"] = parseAuto($row->help);
		if(!empty($row->errMsg))
      $field["errMsg"] = parseAuto($row->errMsg);
		if($row->disabled=="1")
      $field["disabled"] = true;
		if($row->readonly=="1")
      $field["readonly"] = true;
		if($row->required=="1")
      $field["required"] = true;
			
		if ($row->captionCssClass)
			$field["captionCssClass"] = $row->captionCssClass;
		if ($row->valueCssClass)
			$field["valueCssClass"] = $row->valueCssClass;
		if ($row->infoCssClass)
			$field["infoCssClass"] = $row->infoCssClass;
		if ($row->errorCssClass)
			$field["errorCssClass"] = $row->errorCssClass;
			
		if ($row->type == 'file') {
			$tailes = array();
			$options = array();
			$tailes = explode( getEncodingSep(), $row->value);
			foreach($tailes as $tail){
				if(!empty($tail)){
					$op = array();
					$op[] = $tail;
					$options[$tail]=$op;
				}		
			}
			$field["options"] = $options;
    }
		if($row->type=='select' || $row->type=='radio' || $row->type=='checkbox'){
			$field["name"] .='[]';
			$tailes = array();
			$options = array();
			$tailes = explode( getEncodingSep(), $row->value);
			foreach($tailes as $tail){
				if(!empty($tail)){
					$op = array();
					$op[] = $tail;
					if($row->checkOrSelect == $tail){
						if($row->type=='radio' || $row->type=='checkbox')
							$op[] = 'checked';
						else $op[] = 'selected';
					}
					$options[parseAuto($tail)]=$op;
				}		
			}
			$field["options"] = $options;
			if($row->type=='select' && $row->multiple=="1")		
//				@$field["multiple"] = $multiple;
				@$field["multiple"] = $row->multiple;
		}
		else {
//		print "<pre>";
//		print_r($field);
//		print "</pre>";
							//miro's cb edit
					if(preg_match("/(user.)(.*)/i", $field['name'], $tempmatch)) {
						if(preg_match("/(cb.)(.*)/i", $tempmatch[2], $tempmatch2)) {
							$cb_query = "SELECT * FROM #__comprofiler WHERE user_id='".$myUser->id."' LIMIT 1";
							$database->setQuery( $cb_query );
							$cb_data = $database->loadObjectList();
							if (isset($cb_data) && count($cb_data) > 0 ) {
								$cb_vars = get_object_vars($cb_data[0]);
								if(isset($cb_vars[$tempmatch2[2]])) {
									$row->value = $cb_vars[$tempmatch2[2]];
								}
							}
						} else {
							$vars = get_object_vars($myUser);
							if(isset($vars[$tempmatch[2]])) {
								$row->value = $vars[$tempmatch[2]];
							}
						}
					}
					//end miro's cb edit
					
				if ($my->id) {
					$row->value = preg_replace("/(\{name\})/i",$myUser->name,$row->value);
					$row->value = preg_replace("/(\{username\})/i",$myUser->username,$row->value);
					$row->value = preg_replace("/(\{email\})/i",$myUser->email,$row->value);
				}
//
			if(!empty($row->value)){
        $field["value"] = $row->value;
      }
		}
		if($row->type=='textarea'){
			$field["cols"] = $row->var1;				
			$field["rows"] = $row->var2;
		} elseif ($row->type=='file') {
      $field["size"] = $row->var1;
      $field["max"] = $row->var2;
    }
		else $field["size"] = $row->var1;
		$arrFields[] = $field;
	}
	if (count($item_data)) {
		$field = array();
		$field["type"] = "hidden";
		$field["name"] = "formid";
		$field["value"] = $formId;
		$arrFields[] = $field;

		if($incSubmit==1){
			$field = array();
			$field["caption"] = "&nbsp;";
			$field["type"] = "submit";
			$field["name"] = "submit";
			$field["class"] = "button" ;
			$field["id"] = "frmSubmit" ;
			$field["value"] = $submitLabel;
			$field["title"] = $submitLabel;
			$field["alt"] = $submitLabel;
			$arrFields[] = $field;
		}
		if($incReset==1){
			$field = array();
			$field["caption"] = "&nbsp;";
			$field["type"] = "reset";
			$field["name"] = "reset";
			$field["class"] = "button" ;
			$field["id"] = "frmReset" ;
			$field["value"] = $resetLabel;
			$field["title"] = $resetLabel;
			$field["alt"] = $resetLabel;
			$arrFields[] = $field;	
		}
	}
	return $arrFields;
}
/**
* @author David Walters
 * @date 2007-02
 * @return a weird dotted version number number
 */ 
function PFVersionNumber() {
  global $mosConfig_live_site, $mosConfig_absolute_path;
  require_once( $mosConfig_absolute_path . '/includes/domit/xml_domit_lite_include.php' );
  $lv = "2.1.3";
  $xmlDoc = new DOMIT_Lite_Document();
  $xmlDoc->resolveErrors(true);
  if (!$xmlDoc->loadXML( $mosConfig_absolute_path."/administrator/components/com_performs/performs.xml", false, true) ) {
    report_error(19, "Could not load xml document.", "perForms.xml could not be found.");
    echo "perForms2 ".$local_version_str;
  } else {
    $root = &$xmlDoc->documentElement;
    if ($root->getTagName() != 'mosinstall') {
      report_error(25, "Incorrect Schema.", "<ul><li>The 'mosinstall' element could not be found.</li></ul>");
      return;
    }
    if ($root->getAttribute( "type" ) != "component") {
      report_error(26, "Incorrect Type.", "<ul><li>Performs component definition required.</li></ul>");
      return;
    }
    $element 			= &$root->getElementsByPath('version', 1);
    $lv		= $element ? $element->getText() : '';
    return $lv;
  }
}
/**
*@author David Walters
 *@date 2007-3
 *prints a friendly formatted message.
 */
function report_info($info_category, $info_title, $info_text, $info_extra) {
  global $mosConfig_live_site, $mosConfig_absolute_path, $mainframe;
  //  if ( isJ15() ) { 
  //    //someone at joomla15 is messing with mosConfig_live_site
  //    if ($mainframe->isAdmin()) {
  //      $imagepath = $mosConfig_live_site;
  //    } else {
  ////      $imagepath = $mosConfig_live_site."/../..";
  //      $imagepath = $mosConfig_live_site;
  //    }
  //    //what *they* want is mosConfig_requestURL or something...
  //  } else {
  $imagepath = $mosConfig_live_site;
  //  }
  $strReturnValue = @"
<!-- <div style=\"padding: 12pt;\"> -->
<div class=\"module\">
<div style=\"width:90%; padding: 12pt;\">
<table style=\"border: thin maroon solid;\" cellspacing=\"0\">
<tr style=\"background-color: aliceblue;\">
<td rowspan=\"4\" style=\"text-align:center;vertical-align:top; padding:6pt;\">
<img src=\""
    .$imagepath
    .@"/administrator/images/install.png\">
</td>
<td style=\"color: maroon; vertical-align: middle; padding: 8pt;\">
<i>PerForms ".
    PFVersionNumber()
    .@"</i>
</td>
<td></td>
</tr>
<tr>
<td style=\"padding: 6pt; font-style: italic;\">" 
    .$info_category
    .@"</td>
</tr>
<tr><td></td><td></td></tr>
<tr><td style=\"padding:6pt;\"><tt>"
    .$info_title
    .@"</tt></td></tr>
<tr style=\"background-color: lavenderblush; font-style: italic;\">
<td rowspan=\"3\" style=\"text-align:center;vertical-align: top; padding: 6pt;\">
<img src=\""
    .$imagepath
    .@"/administrator/images/support.png\"></td>
<td style=\"padding: 6pt;\">"
    .$info_text
    .@"</td><td></td></tr>
<tr>
<td style=\"padding: 6pt; font-style: italic;\">
<div>"
    .$info_extra
    .@"</div>
<div>"
    .FOR_MORE_HELP
    .@"</div>
</td>
<td rowspan=\"4\" style=\"text-align:center;vertical-align:top; padding:6pt;\">
<img src=\""
    .$imagepath
    .@"/administrator/images/browser.png\">
</td>
</tr>
</table>
</div>
</div>";
  return $strReturnValue;
}
/* Provided in case upload errors are to be displayed differently from 
* other error types
* @author David Walters
*/
function upload_error( $errno, $errdesc, $errcomment) {
  return report_info ( ERROR_OCCURRED, "Error #".$errno.": ".$errdesc, $errcomment, "" );
}
/* Prints a friendly formatted error message to the output buffer
* @author David Walters
*/
function report_error ($errno, $errdesc, $errcomment) {
global $pfDebug;
  echo report_info ( ERROR_OCCURRED, "Error #".$errno.": ".$errdesc, $errcomment, "" );
if ($pfDebug)	trigger_error($errdesc, E_USER_NOTICE);
}
/* Prints a message to the output buffer
* @author David Walters
*/
function report_message($info_title, $info_text) {
  echo report_info ( HELP_TEXT, $info_title, $info_text, "" );
}
/* Prints a message with custom subtitle to output buffer
* @author David Walters
*/
function report_messageEX($subtitle, $info_title, $info_text) {
  echo report_info ( $subtitle, $info_title, $info_text, "" );
}
/** Prepares a notification report if update is available
* @author David Walters
* @date 2007-3
* builds notification report 
*/
function report_update_info ( $local_version_str, $strUpgrade = null, $strUpgradeDetails = null, $strDownloadInfo = null ) {
  $returnValue = @"
<table style=\"width: 100%;\">
<tr>
<td style=\"vertical-align: bottom;\">
<table class=\"adminheading\" >
<tr>
<th>
PerForms "
  .$local_version_str
  ." ";
  $upchk = checkForUpdates(true);
  if ($upchk != "") {
    
    $rvs = explode("\n", $upchk, 2);
    
    $mk = MakePFInfoIcon(
                         $rvs[0]." ".IS_AVAILABLE,
                         $rvs[1]
                         );    
    $returnValue .=$mk;
  } else {
  }
  $returnValue .=  @"
</th>
</tr>
</table>
</td>
</tr>
</table>";
  return $returnValue;
}
/**
* @author David Walters
 * @date 2007-3
 * formats text from an updateinfo file
 */
function report_update_info_text ( $strNewVersion, $strUpgrade, $strUpgradeDetails, $strDownloadInfo ) {
  $returnValue = $strNewVersion."\n".$strUpgrade.'<br />'.$strUpgradeDetails.'<br />'.$strDownloadInfo;
  return $returnValue;
}
//check for updates
function notifyUpdate() {
  $notify = false;
  $version_checking = true; 
  $local_version_str = PFVersionNumber();
  $old_error_reporting = error_reporting();
  $remote_version_info = false;
  if ($version_checking) {
    error_reporting(0);
		$oldtimeout = ini_get("default_socket_timeout");
		ini_set("default_socket_timeout", 120);
    $remote_version_info = file_get_contents("http://performs.org.au/performs/version");
    $vernum = explode("\n", $remote_version_info, 2);
    $vernums = explode(" ", $vernum[0]);
    $vername = $vernums[0];
    if ($vername != "perForms") {
      unset($remote_version_info);
    }
		ini_set("default_socket_timeout", $oldtimeout);
    error_reporting(old_error_reporting);
  }
  if ($remote_version_info) {
    $remote_version_strs = explode("\n", $remote_version_info, 2);
    $remote_version_str_big = explode(" ", $remote_version_strs[0]);
    $remote_version_str = $remote_version_str_big[1];
    if ($pfDebug) {
      echo "<table><tr><td><b>Local:</b></td><td>".$local_version_str."</td>"
      ."<td><b>Remote:</b></td><td>".(version_checking ? $remote_version_str : "(no checking)")."</td></tr></table>";
    }
  } else {
    if ($pfDebug) {
      if ($version_checking) {
        report_error(15, "Unable to check for updates.", "The versioninfo file is not available.");
      }
    }
  }
  $notify = 
    ($local_version_str < 
     ($version_checking ? $remote_version_str : $local_version_str)
     ) && ($remote_version_info);
  if ($notify) {
    return $remote_version_strs;
  } else {
    return NULL;
  }
}
/* Public function to embed update notification on a page.
* @authod David Walters
* @param infoicon bool If false, the message will be embedded on the page,
* if false the message will be written to the tooltip of an info icon.
*/
function checkForUpdates($infoicon = false) {
  global $mosConfig_live_site, $mosConfig_absolute_path;
  $remote_version_strs = notifyUpdate();
  if ($remote_version_strs != NULL) {
    if ($infoicon) {
      $strUpgrade = $remote_version_strs[0]." ".IS_AVAILABLE.".";
      $strUpgradeDetails = str_replace("\n", "", $remote_version_strs[1]);
      $strDownloadInfo = DOWNLOAD_FROM
        .' <b>http://www.performs.org.au</b>';
      $strNewVersion = $remote_version_strs[0];
      return report_update_info_text( $strNewVersion, $strUpgrade, $strUpgradeDetails, $strDownloadInfo );
    } else {
      $strUpgrade = '<code>Performs <span style=\"color: red;\">'
      .$remote_version_strs[0]
      ."</span> "
      .IS_AVAILABLE
      .".</code>";
      $strUpgradeDetails = "<code>"
      .$remote_version_strs[1]
      ."</code>";
      $strDownloadInfo = DOWNLOAD_FROM
      .' <a href="http://www.performs.org.au/">Performs Home</a>';
    }      
  } else {
    if ( isJ10() ) {
      //echo report_update_info( $local_version_str );
    }
  }
}
/**
* @author David Walters
 * @date 2007-3
 * builds the html to embed a tooltip and info icon
 * on a form 
 */
function MakePFinfoIcon( $heading, $text ) {
  global $mosConfig_live_site;
  $hover = "onMouseOver=\"return overlib('"
    .$text 
    ."', CAPTION, '"
    .$heading
    ."', BELOW, LEFT);\" onMouseOut=\"return nd();\"";
  $returnVal = @"
<img src=\""
    .$mosConfig_live_site
    ."/images/M_images/con_info.png\""
    .$hover
    ."alt=\"".$heading."\""
    ." style=\"float: right;\">";
  return $returnVal;
}
function PFinfoIcon( $heading, $text ) {
  echo MakePFInfoIcon( $heading, $text );
}
/**
* @author David Walters
 * @date 2007-3
 * writes out a small script to make the first form element in (elementarray) 
 * on form (fnam) get the focus ... 
 */
function buildaccscript( $fnam, $elementArray ) {
  global $my;
  $arr_i = -1;
  $arrcnt = count($elementArray);
  while (++$arr_i < $arrcnt) {
    if (in_array ( $elementArray[$arr_i]['name'], array("replyto", "replytoName") ) ) {
      if ( $my->id != 0) { //dont use replyto for logged in users (its a hidden field)
        continue;
      }
    }
    //we can't activate date fields yet...
    if (in_array($elementArray[$arr_i]['type'], array('text', 'textarea', 'checkbox', 'radio', 'select', 'file', 'image') )) {
      $accnam = $elementArray[$arr_i]['name'];
      if (strstr($accnam, "[]")) continue;
      $arr_i = $arrcnt;
      break;
    }
  }
  
  if ( isset($accnam) ) {
    $rplc = str_replace("[]", "", $accnam);
    $retval = '<script language="javascript">'
    .'document.'.$fnam.'.'.$rplc.'.focus();'
      .'</script>';
    return $retval;    
  } else {
    return "";
  }
  return "";
}

/*
	* Loads all necessary files for JS Calendar
 * which joomla calendar wasn't doing at 1.0.12
 * @author David Walters / Joomla Team
	*/
function PFLoadCalendar() {
	global  $mosConfig_live_site, $mosConfig_locale, $mosConfig_absolute_path,
		$mainframe;
  //  if ( file_exists ( $mosConfig_absolute_path."/globals.php" ) ) {
  if ( isJ10() ) {
    //j10
    //  mosCommonHTML::loadCalendar(); // this call injects html into ob_
    //    PFLoadCalendar();
    // echo "<div>Loading calendar for j10</div>";
		$langcode = "en";
		if (isset($mosConfig_locale)) {
			list ( $langCode, $countryCode ) = split("_", $mosConfig_locale);
		}
    if (!file_exists($mosConfig_absolute_path.'/includes/js/calendar/lang/calendar-'.$langCode.'.js')) {
      $langCode = "en"; //TODO config default langcode
    } 
//		 $mainframe->addCustomHeadTag( @"
//      <!-- importing calendar module -->
//      <link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"".$mosConfig_live_site.@"/includes/js/calendar/calendar-mos.css\" title=\"green\" />
//      <!-- import the calendar script -->
//      <script type=\"text/javascript\" src=\"".$mosConfig_live_site.@"/includes/js/calendar/calendar_mini.js\"></script>
//      <!-- import the language module -->
//      <script type=\"text/javascript\" src=\"".$mosConfig_live_site."/includes/js/calendar/lang/calendar-".$langCode.@".js\"></script>
//			");
?>
<!-- importing calendar module -->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $mosConfig_live_site; ?>/includes/js/calendar/calendar-mos.css" title="green" />
<!-- import the calendar script -->
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/includes/js/calendar/calendar_mini.js"></script>
<!-- import the language module -->
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/includes/js/calendar/lang/calendar-<?php echo $langCode; ?>.js"></script>
<?php

  } else {
    //j15
    // echo "<div>Loading calendar for j15</div>";
    require_once( $mosConfig_absolute_path.'/libraries/loader.php' );
    jimport( 'joomla.html.html' );
    JCommonHTML::loadCalendar();
  }
  
  }

/** a map for displaying localised item type names.
* @author David Walters
* @date 2007-03
*/
function LocaliseTypeName ( &$itemtypename ) {
  $returnval = $itemtypename;
  switch ($itemtypename) {
    case 'button': {
      $returnval = ITEMTYPE_BUTTON;      
      break;
    }
    case 'checkbox': {
      $returnval = ITEMTYPE_CHECKBOX;      
      break;
    }
    case 'date': {
      $returnval = ITEMTYPE_DATE;      
      break;
    }
    case 'file': {
      $returnval = ITEMTYPE_FILE;      
      break;
    }
    case 'hidden': {
      $returnval = ITEMTYPE_HIDDEN;      
      break;
    }
    case 'image': {
      $returnval = ITEMTYPE_IMAGE;      
      break;
    }
    case 'password': {
      $returnval = ITEMTYPE_PASSWORD;      
      break;
    }
    case 'pagebreak': {
      $returnval = ITEMTYPE_PAGEBREAK;      
      break;
    }
    case 'radio': {
      $returnval = ITEMTYPE_RADIO;      
      break;
    }
    case 'select': {
      $returnval = ITEMTYPE_SELECT;      
      break;
    }
    case 'text': {
      $returnval = ITEMTYPE_TEXT;      
      break;
    }
    case 'textarea': {
      $returnval = ITEMTYPE_TEXTAREA;      
      break;
    }
    case 'textual': {
      $returnval = ITEMTYPE_TEXTUAL;      
      break;
    }
  }
  return $returnval;
}
//comment the line below in production
//as report_env prints sensitive information
//define('PF_TRACE', 1);
/**
*@author David Walters
 *@date 2007-3
 *Used when joomla is debugging, to trace values etc.
 */
function report_env($tabs = null, $report_depth = 1) {
  global $mainframe, $my;
  switch ($report_depth) {
    case 1: {
      $superglobals = array('$_REQUEST', '$_SESSION', '$_FILES', '$_COOKIE');
//      if (defined('PF_TRACE')) {
//        $superglobals = array('$_POST', '$mainframe', '$my', '$_REQUEST', '$_SESSION', '$GLOBALS', '$_FILES', '$_COOKIE');
//      }
      $suprset = '0';
      foreach ($superglobals as $supr) {
        $tabs->startTab( $supr, 'session' );
        echo "<pre>";
        eval( "if (isset($supr)) print_r($supr);" );
        echo "</pre>";
        $tabs->endTab();
      }
      $tabs->endPane();
      echo "</td></tr></table></div>";    
      break;
    }
    case 2: {
      $superglobals = array('$_REQUEST', '$_SESSION', '$_FILES', '$_COOKIE');
//      if (defined('PF_TRACE')) {
//        $superglobals = array('$_POST', '$mainframe', '$my', '$GLOBALS', '$_REQUEST', '$_SESSION', '$_GET', '$_SERVER', '$_COOKIE', '$_ENV', '$_FILES');
//      }
      foreach ($superglobals as $supr) {
        echo '<h1>'.$supr.'</h1>';
        echo "<pre>";
        eval( "print_r($supr);" );
        echo "</pre>";
      }
      break;
    }
  }
}
?>
