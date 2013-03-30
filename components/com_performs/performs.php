<?php
/**
* @version $id: performs.php,v 2.3
 * @package performs
 * @copyright (C) 2007 perForms
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @author David Walters
 * @author (original) Ilhami KILIC http://www.tuwitek.at
 * Joomla is Free Software
 */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $mosConfig_absolute_path, $mosConfig_lang, $my;
	if (file_exists($mosConfig_absolute_path.'/components/com_performs/language/'.$mosConfig_lang.'.php')) {
		include($mosConfig_absolute_path.'/components/com_performs/language/'.$mosConfig_lang.'.php');
	} else {
		include($mosConfig_absolute_path.'/components/com_performs/language/english.php');
	}
	require_once( $mosConfig_absolute_path."/administrator/components/com_performs/lib/myLib.php" );
	global $pfConfig;
$formId = -32768;
//-----------get the form id------------
if (isset($_REQUEST[md5('mosperforms_id')])) {
	$formId = $_REQUEST[md5('mosperforms_id')];
	unset($_REQUEST[md5('mosperforms_id')]);
} elseif (isset($_REQUEST['formid'])) {
  if (!is_numeric($_REQUEST['formid'])) {
    report_error ( 22, PF_ERROR_22, PF_ERROR_22_COMMENT );
    return;
  }
  $formId = intval($_REQUEST['formid']);
} elseif (isset($mainframe->menu->params)) {
  $params = array();
  parse_str(strtolower($mainframe->menu->params), $params);
  if (isset($params['formid'])) {
    if (!is_numeric($params['formid'])) {
      report_error ( 22, PF_ERROR_22, PF_ERROR_22_COMMENT );
      return;
    }
    $formId = intval($params['formid']);
  } else {
    report_error( 127, PF_ERROR_127, PF_ERROR_127_COMMENT );
    return;
  }
} else {
  report_error ( 22, PF_ERROR_22, PF_ERROR_22_COMMENT );
  return;
}

if (!defined("LIB_REPLACE")) {
	require_once( $mosConfig_absolute_path."/administrator/components/com_performs/lib/lib_replace.php" );
}

global $database;
$qqq = "SELECT itemId from #__performs_items WHERE formId = '$formId'";
$qarr = null;
$database->setQuery($qqq);
if(!$database->query($qarr)) {
	return;
//	die ("my bad");
}
$preItemCount = count($qarr);

if (!$database->loadResult()) {
	$qsql = @"
	SELECT
	 #__performs.intro, #__performs.title
	FROM
	 #__performs
	WHERE
	 id = '$formId'";
	$database->setQuery( $qsql );
	$qarr = null;
	if(!$database->query($qarr)) {
		die ("my bad");
	}
	$qarr = $database->loadResultArray(1);
	if (!$qarr)  {
	//	require_once( $mosConfig_absolute_path."/administrator/components/com_performs/lib/myLib.php" );
		report_error( 23, PF_ERROR_23, PF_ERROR_23_COMMENTA." <b>$formId</b> ".PF_ERROR_23_COMMENTB."<div>Joomla  Version: ".(isJ15() ? "J15" : (isJ10() ? "J10" : "Not Happening")));
	}
	
//	echo "<pre>".print_r($qarr)."</pre>";
	if (count($qarr) >= 1) {
		$ft = parseAuto($qarr[0]);
		if ($ft != " ") {
			if ($preItemCount == 0) {
				echo $ft;
			} else {
				echo "<span class=\"pfFormTitle\" style=\"color: orange;\">$ft</span>";
			}
		}
	}
	if (count($qarr) == 2) {
		$fint = parseAuto($qarr[1]);
		if ($fint != "") echo "<span class=\"pfFormIntro\">$fint</span>";
	}
	return;
}
global $mosConfig_live_site,$mosConfig_sitename,$mosConfig_mailfrom, $mainframe,
	$my, $mosConfig_offset, $pfDebug;

require_once( $mosConfig_absolute_path."/administrator/components/com_performs/lib/myLib.php" );
require_once( $mosConfig_absolute_path."/administrator/components/com_performs/lib/lib_template.php" );
require_once( $mosConfig_absolute_path."/administrator/components/com_performs/lib/lib_valid.php" );
require_once( $mosConfig_absolute_path."/administrator/components/com_performs/lib/lib_phpForm.php" );
require_once( $mosConfig_absolute_path."/administrator/components/com_performs/class.performs.php");

if (file_exists($mosConfig_absolute_path.'/administrator/components/com_securityimages/server.php')) {
  include ($mosConfig_absolute_path.'/administrator/components/com_securityimages/server.php');
}
$pdfAvailable = file_exists($mosConfig_absolute_path.'/administrator/components/com_virtuemart/classes/pdf');
if (!$pdfAvailable) $pdfAvailable = file_exists($mosConfig_absolute_path.'/administrator/components/com_performs/html2fpdf-3.0.2b');
if (!$pdfAvailable) $pdfAvailable = file_exists($mosConfig_absolute_path.'/../html2fpdf-3.0.2b');
if (!$pdfAvailable) $pdfAvailable = file_exists($mosConfig_absolute_path.'/html2fpdf-3.0.2b');
//TODO: post-once forms
$now = date( "Y-m-d H:i:s", time()+$mosConfig_offset*60*60 );
$accesslevel = 0;
$form_query = "SELECT * FROM #__performs WHERE id='$formId' AND published='1'"
. "\n AND ( start_date = '0000-00-00 00:00:00' OR start_date <= '$now'  )"
. "\n AND ( finish_date = '0000-00-00 00:00:00' OR finish_date >= '$now' )"
;
$database->setQuery( $form_query );
$form_data = null;
if(!$database->loadObject($form_data)) {
  report_error( 23, PF_ERROR_23, PF_ERROR_23_COMMENTA." <b>$formId</b> ".PF_ERROR_23_COMMENTB."<div>Joomla  Version: ".(isJ15() ? "J15" : (isJ10() ? "J10" : "Not Happening")));
		return;
} else {
	if (intval($form_data->access) <= intval($my->gid)) {
	} else {
		if ($pfDebug) {
			echo $form_data->noAuthMessage;
//			report_error(566, "Not Authorized.", "You are not allowed to view this resource.\nYou could try registering ;)");
			return;
		} else {
			echo $form_data->noAuthMessage;
			return;
		}
	}
}
$strFrmTitle = $form_data->title;
if ( empty($myArrFields )) {
	$myArrFields=makeArray($formId,$form_data->includeSubmit, $form_data->submitLabel,$form_data->includeReset,$form_data->resetLabel);
}

$theGUID = uniqid($formId);

$objMyForm = new phpform( $strFrmTitle, $myArrFields, $theGUID, $form_data->tablename );
$objMyForm->formid = $formId;

//XSS fix
//$objMyForm->strAction = $_SERVER['REQUEST_URI'];
$mytmpURI = htmlentities($_SERVER['REQUEST_URI'], ENT_QUOTES);
$objMyForm->strAction = $mytmpURI;
//end XSS fix
$theme="performs";
if(!empty($form_data->theme)){
		$theme=substr($form_data->theme,0,strpos($form_data->theme,'.'));
}

$tabs = NULL;
if ($pfDebug) {
	echo @"
		<style type=\"text/css\">
		#pf-debugdiv {
			float: none;
			position: absolute;
/*			top: 120;
			left: 500;*/
			display: none;
		}
		</style>
		<script language=\"javascript\">
			function togglePFDebugDiv() {
				var dbgdiv = document.getElementById('pf-debugdiv'); 
				var displ = dbgdiv.style.display;
				if ((displ == 'none') || (displ == '')) {
					dbgdiv.style.display = 'block';
				} else {
					dbgdiv.style.display = 'none'; 
				}
			}
		</script>
		<div style=\"text-align: left;\">
		<a href=\"javascript: togglePFDebugDiv();\" />DEBUG:</a></div>
		<div id=\"pf-debugdiv\">
			<table style=\"background-color: aliceblue; padding: 8pt; border: thick dotted khaki; width: 700px; margin-top: 24pt;\">
				<tr><td><h2>performs.php</h2></td></tr>
				<tr><td>";
	$tabs = new mosTabs(0);//startTab (joomla.php line 4318 version 1.0.11) only ever adds tabs to tabPane1 ... 
	$tabs->startPane("session");
	$tabs->startTab('make()', 'session');
	echo "<h1>Make</h1>";
}

//are we protecting against bots that pretend to log into joomla too?
//if($form_data->use_securityimages==1 && $my->id==0){ // we should
if($form_data->use_securityimages==1){
	$objMyForm->use_securityimages = file_exists($mosConfig_absolute_path."/components/com_securityimages");
	if ($objMyForm->use_securityimages) {
		$objMyForm->securityImageHelp =  $form_data->securityHelpText;
		if ( $objMyForm->formSubmited() ) {
			if (isset($_REQUEST['PFSecurity_refid'])) {
				$security_refid = $_REQUEST['PFSecurity_refid'];
				$security_try = $_REQUEST['PFSecurity_try'];
				$security_reload = $_REQUEST['PFSecurity_reload'];
				if ($pfDebug) {
					echo "<h1>1REFID: $security_refid</h1>";
					echo "<h1>1TRY: $security_try</h1>";
					echo "<h1>1RELOAD: $security_reload</h1>";
				}
				//$securityOK = checkSecurityImage($security_refid, $security_try);
				if (!isset ($securityImagesLet3rdpartyOverideChoosenPlugin)) {
				 $securityImagesLet3rdpartyOverideChoosenPlugin = false;
				}
				$securityOK = @checkSecurityImage($security_refid, $security_try, $security_reload);
				if(!$securityOK){
					unset($_REQUEST['submit']);
					$objMyForm->securityImageError =  $form_data->securityErrorText;
				} else {
					$objMyForm->securityImageError = "";
				}
			}
		}	
	}
}
$objMyForm->strSkin = $mosConfig_absolute_path."/components/com_performs/skins/$theme/tpl_form.html";
$objMyForm->replaceSubmitButton = $form_data->replaceSubmitButton;
$objMyForm->submitImageUrl = $form_data->submitImageUrl;
$objMyForm->submitImageWidth = $form_data->submitImageWidth;
$objMyForm->submitImageHeight = $form_data->submitImageHeight;
$objMyForm->replaceResetButton = $form_data->replaceResetButton;
$objMyForm->resetImageUrl = $form_data->resetImageUrl;
$objMyForm->resetImageWidth = $form_data->resetImageWidth;
$objMyForm->resetImageHeight = $form_data->resetImageHeight;
if($form_data->strMissingFieldMsg)
	$objMyForm->strMissingFieldMsg = $form_data->strMissingFieldMsg;
$objMyForm->intro = $form_data->intro;
if (!empty( $form_data->image )) {
		$objMyForm->formImage=$mosConfig_live_site.'/images/stories/'.$form_data->image;
  $objMyForm->imageFloat = $form_data->imagefloat;
}	
$objMyForm->showFormTitle = $form_data->showFormTitle;
$objMyForm->formWidth = $form_data->formWidth;
$objMyForm->useContainer = $form_data->useContainer;
$objMyForm->attachXmlFile = $form_data->attachXmlFile;
$objMyForm->attachXmlFileUSER = $form_data->attachXmlFileUSER;
$objMyForm->mailAsText = $form_data->mailAsText;
//if ( $objMyForm ) {
$objMyForm->bolShowWarnings = false;
$objMyForm->strMethod = "post";

PFLoadCalendar();
/*TODO: if form submitted, call objMyForm->Fill() for mod_performs*/
$strResult = $objMyForm->make();
if ($pfDebug) {
	$tabs->endTab();
}
$message = "";
$dberror = 0;
if ($pfDebug) {
	$tabs->startTab('Mail State', 'session');
	echo "<code>Determining Submittal</code><hr>";
	if ($objMyForm->bolFrmSubmited) {
		echo "<br />Submitted!";
	} else {
		echo "<br />Not Submitted!";
	}
	if ($objMyForm->bolFormOK) {
		echo "<br />OK!";
	} else {
		echo "<br />Not OK!";
	}
}

$showPrintButtons =  !($objMyForm->bolFrmSubmited && $objMyForm->bolFormOK);
if ( $objMyForm->bolFrmSubmited && $objMyForm->bolFormOK ) {
	//See if we should insert a row into the bound table
	if(!empty($form_data->tablename)){
//	$sqlinsert = $objMyForm->formToSQLInsert( $form_data->tablename);
	$sqlinsert = $objMyForm->formToSQLInsert();
		$database->setQuery($sqlinsert);
		if (!$database->query()) {
			echo $objMyForm->formToSQLInsert( $form_data->tablename)."<br>";
			echo "<script> alert('".DB_ERROR_OCCURRED."\n" . $sqlinsert 
				. "'); window.history.go(-1); </script>\n" ;
			$dberror = 1;
		}
	} 
	if ($pfDebug){
		echo "<code>Sending with Mail</code><hr>";
		echo "<div><b>form_data->mailIt</b> = ".$form_data->mailIt."</div>";
		echo "<div><b>form_data->mailAlways</b> = ".$form_data->mailAlways."</div>";
		echo "<div><b>dberror</b> = ".$dberror."</div>";
		echo "<div><b>mosConfig_mailfrom</b> = ".$mosConfig_mailfrom."</div>";
		echo "<div><b>form_data->from</b> = ".$form_data->from."</div>";
		echo "<div><b>form_data->emails</b> = ".$form_data->emails."</div>";
		echo "<div><b>form_data->mailSubject</b> = ".$form_data->mailSubject."</div>";
		echo "<div><b>my->email</b> = ".$my->email."</div>";
	}
	// See if we should send an email
	$goMail = (($form_data->mailIt) &&
	($form_data->mailAlways=="1" || ($form_data->mailAlways=="0" && !$dberror)));
	
	if ($goMail) {
		$strCC = "";
		$strBCC = "";
		global $mosConfig_mailfrom, $mosConfig_sitename;
		$goodToGo = true;
//																															 -----TO--------
		$strToEmails = "";
		if ($form_data->mailIt) {
			$strToEmails = $form_data->emails;
		}
		if ($strToEmails == "") {
			if ($form_data->mailToUser) {
				if (isset($my->email)) {
//					$strToEmails = $my->name."<".$my->email.">";
					$strToEmails = $my->email;
				}
			}
			if ($form_data->mailToAdmin) {
				if ($form_data->mailToUser) {
					//$strBCC = $mosConfig_mailfrom;
				} else {
					//$strToEmails = $mosConfig_mailfrom;
				}
			}
		} else {
			if ($form_data->mailToAdmin) {
//					$strBCC = $mosConfig_mailfrom;
			}
		}
		$strToEmail = "";
		$strToEmail = $objMyForm->resolveEmailAddress("","name","mailto",false,false,false);
		if ($strToEmail == "") {
			$strToEmail = $objMyForm->resolveEmailAddress("","name","replyto",false,false,false);
		}
	//	if ($strToEmail != "") $strToEmails = $strToEmail . ($strToEmails != "" ? ",".$strToEmails : "");
if ($strToEmail != "") $strToEmails = $strToEmail;
//																															 -----FROM------
		$strFromEmail = $form_data->from;
		$strFromName = $form_data->title;
		if (strlen($form_data->from) == 0) {
			$strFromName = $mosConfig_sitename;
			$strMailFrom = $mosConfig_mailfrom;
			if ($form_data->enableMailFrom == 1) {
				$strFromEmail = $objMyForm->resolveEmailAddress($strMailFrom,"name","mailfrom",false,false,false);
			} else {
				if ($strFromEmail == "") $strFromEmail = $mosConfig_mailfrom;
			}
		} else {
				$strFromName = $form_data->from;
				$strFromEmail = $form_data->from;
		}
		if ($pfDebug){
			echo '<div style="background-color:aliceblue;">';
		}
//																															 -----REPLYTO---
		$strReplyToName = UNKNOWN_SENDER;
		$strReplyToEmail = $objMyForm->resolveEmailAddress($my->email,"name","replyto",false,false,true);
		$strReplyToName = $my->name;
		foreach($objMyForm->arrForm as $strKey => $strVal){
			if ( in_array( $objMyForm->arrForm[$strKey]['type'], array ( 'text', 'select', 'textarea', 'hidden' ) )){
				if ($pfDebug) {
					echo '<div style="background-color: silver; color: maroon;">'.$objMyForm->arrForm[$strKey]['name']."</div>";
				}
				if ( $objMyForm->arrForm[$strKey]['name'] == 'replytoName' ) {
					$strReplyToName = str_replace(EMAIL_MASH, "@", $objMyForm->arrForm[$strKey]['value']);
					unset ( $objMyForm->arrForm[$strKey] );
					break;
				}
				if ( $objMyForm->arrForm[$strKey]['name'] == 'cc' ) {
					if (strlen($strCC)) $strCC .= ",";
					$strCC .= $objMyForm->arrForm[$strKey]['value'];
					unset ( $objMyForm->arrForm[$strKey] );
					break;
				}
				if ( $objMyForm->arrForm[$strKey]['name'] == 'bcc' ) {
					if (strlen($strCC)) $strCC .= ",";
					$strBCC .= $objMyForm->arrForm[$strKey]['value'];
					unset ( $objMyForm->arrForm[$strKey] );
					break;
				}
			}
		}
		
//																															 -----SUBJECT---
// Check for any fields called "subject" and substitue/append them as the new subject
		$strSubject = $objMyForm->subsituteEmailElement($form_data->mailSubject,"name","subject",false,true,true);
		if ($strSubject == "") $strSubject = $form_data->title;
//																															 -------Intro---
		if ( $form_data->useintro ) {
				$form_intro = parseAuto($form_data->intro);
		} else {
				$form_intro = "";
		}
		
		if ($goodToGo) {
			if ($form_data->mailToAdmin) {
				$mailSuccess = $objMyForm->formToEmail( 
					$strFromName,
					$strFromEmail,
					$strReplyToName,
					$strReplyToEmail,
					(($form_data->emails == "") ? $mosConfig_mailfrom : $form_data->emails),
					$strSubject,
					$form_intro,
					($form_data->appendtimestamp == 1),
					$form_data->emails,
					"",
					true,
					($form_data->attachXmlFile == 1)
				);
			}
			
			if (($strToEmails != NULL) && ($strToEmails != "")) {
			if ($pfDebug) {
			echo "strToEmails: '$strToEmails'";
			}
				$mailSuccess = $objMyForm->formToEmail( 
					$strFromName,
					$strFromEmail,
					$strReplyToName,
					$strReplyToEmail,
					$strToEmails,
					$strSubject,
					$form_intro,
					($form_data->appendtimestamp == 1),
					$strCC,
					$strBCC,
					false,
				  ($form_data->attachXmlFileUSER == 1)
				);
				
				if ($pfDebug) {
					if (!$mailSuccess) {
						report_error(96, "Unable to send!", "Unable to send the email.");
					} else {
						echo "\n<br />Mail Success!\n";
					}
				}
				
			}
		} else {
					report_error(97, "Not Good To Go!", "Unable to prepare the email.");
		}
		
} else {
	if ($pfDebug){
		echo '<h1 style="color:red;">Not Ok</h1>';
		$tabs->endTab();
	}
}
	if($form_data->asub=="1"){
		header("Location: ".$form_data->r_url);
		exit();
	}
	if ($pfDebug) {
		$tabs->endTab();
		$tabs->startTab('ReplaceVars', "session");
	}
	$strResult = $objMyForm->replaceVars($form_data->note);
	if ($pfDebug){
		echo '<div><b>strResult</b> = '.$strResult.'</div>';      
		echo "<hr />";
		$tabs->endTab();
	}
}// if submitted
if ($pfDebug) {
	$tabs->endTab();
	report_env ($tabs, 1);
  $tabs->endPane();
  echo '</div>';
}
if ($form_data->useContainer) { ?>
	<table class="contentpaneopen" width="<?php echo $form_data->formWidth;?>">
	<tbody>
	<tr>
	<td class="contentheading" width="100%">
	<?php
	if ($form_data->showFormTitle)
		echo parseAuto($form_data->title); 
	?>
	</td>
	<td>
<?php
	if ($showPrintButtons) {
//-----------set the session variables------------
if ( isJ10() ) {
  $ssid = session_id();
  if ($ssid == "") {
    //$oldname = session_name( 'pf_'.md5( $mosConfig_live_site ) );
//		$oldname = session_name( md5( $mosConfig_live_site ) );
    @session_start();
  }
}
$_SESSION[md5('session_gid')] 		= $my->gid;
$_SESSION[md5('form_id')]         = $formId;
$_SESSION[md5('pdfAvailable')]    = $pdfAvailable;
$_SESSION[md5('session_user_id')] = $my->id;
$_SESSION[md5('my')]							= $my;
	
	?>
		<table><tr>
		<td>
<?php
		if ($form_data->includePF == 1) {
			if ( isJ10() ) {
				$strHref = $mosConfig_live_site.'/components/com_performs/performsPreview.php';
			} else {
				$strHref = $mosConfig_live_site
				.'/components/com_performs/performsPreview.php?formid='.$form_data->id
				.'&session_gid='.$my->gid;
			}
			$strPostURL = $mosConfig_live_site.'/components/com_performs/performsPreview.php';
			$strDownload = PRINTER_FRIENDLY;
			$strImageLoc = $mosConfig_live_site.'/images/html_f2.png';
			?>
			<input type="image" accesskey="h" title="<?php echo $strDownload; ?> (h)" alt="<?php echo $strDownload; ?>" 
				onclick="window.open('<?php echo $strHref; ?>', 'win1', 
				'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=yes');" 
				src=<?php echo '"'.$mosConfig_live_site.'/images/html_f2.png"'; ?> />
		</td>
<?php
	}
	if ($pdfAvailable && ($form_data->includePDF == 1)) {
		$strPostURL = $mosConfig_live_site.'/components/com_performs/performsPreview.php';
		$strDownload = DOWNLOAD_PDF;
		$strImageLoc = $mosConfig_live_site.'/administrator/components/com_performs/images/acroread.png';
	?>
	<td>
		<form name="viewpdf" action="<?php echo $strPostURL; ?>" method="POST">
			<input type="hidden" name="printing" value="true">
			<!--          <input type="hidden" name="formId" value="<?php echo $form_data->id; ?>"> -->
			<input type="hidden" name="pdf" value="<?php echo $pdfAvailable ? 'true' : 'false' ; ?>">  
			<input type="image" accesskey="p" title="<?php echo $strDownload; ?> (p)" value="<?php echo $strDownload; ?>" src="<?php echo $strImageLoc; ?>" onclick="viewpdf.submit();" >
		</form>
	</td>
<?php
	} ?>
	</tr>
	</table>
<?php 
	} ?>
	</td>
	</tr>
	<tr>
	<td colspan="3">
	<?php
	echo $strResult;
	?>
	</td></tr>
	</tbody>
	</table>
<?php 
} else {
	echo $strResult;
}


?>
