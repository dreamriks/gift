<?php
/**
* @version $id: performsPreview.php,v 2.3
 * @package performs
 * @copyright (C) 2007 perForms
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @author David Walters
 * Joomla is Free Software
 */
//Check the mosConfig variables aren't being injected
//At this point nothing should be set.
if (isset($database)) die2 ("Intruder Alert 1!");
if (isset($mosConfig_live_site)) die2 ("Intruder Alert 2!");
if (isset($mosConfig_absolute_path)) die2 ("Intruder Alert 3!");
if (isset($mosConfig_sitename)) die2 ("Intruder Alert 4!");
if (isset($mosConfig_mailfrom)) die2 ("Intruder Alert 5!");
if (isset($mosConfig_debug)) die2 ("Intruder Alert 6!");
if (isset($mosConfig_lang)) die2 ("Intruder Alert 7!");
if (isset($_REQUEST['database'])) die2 ("Intruder Alert 8!");
if (isset($_REQUEST['mosConfig_live_site'])) die2 ("Intruder Alert 9!");
if (isset($_REQUEST['mosConfig_absolute_path'])) die2 ("Intruder Alert 10!");
if (isset($_REQUEST['mosConfig_sitename'])) die2 ("Intruder Alert 11!");
if (isset($_REQUEST['mosConfig_mailfrom'])) die2 ("Intruder Alert 12!");
if (isset($_REQUEST['mosConfig_debug'])) die2 ("Intruder Alert 13!");
if (isset($_REQUEST['mosConfig_lang'])) die2 ("Intruder Alert 14!");

if ( file_exists ( "../../globals.php" ) ) {
  if (count($_GET)) die2 ("Intruder Alert 15!");
  /** Set flag that this is a parent file */
  define( "_VALID_MOS", 1 );
  require_once( "../../globals.php" ); // clears everything
  require_once( "../../configuration.php" ); // mosConfig_absolute_path
  require_once( "../../includes/database.php" ); // $database
  require_once( "../../includes/joomla.php" );// mosCommonHTML
    global $mainframe, $my, $database;
    $mainframe = new mosMainFrame ( $database, '', '.' );
    $mainframe->initSession();
    $my = $mainframe->getUser();
//    @ob_clean();
} else {
  require_once( "../../index2.php" );
//  @ob_clean();
}

global  $database,$mosConfig_live_site,$mosConfig_sitename,$mosConfig_mailfrom, $my, $mosConfig_absolute_path;
require_once( "../../administrator/components/com_performs/lib/myLib.php" );
require_once( "../../administrator/components/com_performs/lib/lib_template.php" );//this lib injects html in ob_
require_once( "../../administrator/components/com_performs/lib/lib_valid.php" );
require_once( "../../administrator/components/com_performs/lib/lib_replace.php" );
require_once( "../../administrator/components/com_performs/lib/lib_phpForm.php" );
require_once( "../../administrator/components/com_performs/class.performs.php");
if (file_exists('../../components/com_performs/language/'.$mosConfig_lang.'.php')) {
  include('../../components/com_performs/language/'.$mosConfig_lang.'.php');
} else {
  include('../../components/com_performs/language/english.php');
}
if ( isJ10() ) {
  //session_name( 'pf_'.md5( $mosConfig_live_site ) );
  @session_start();
  if ($pfDebug) {
   // report_message ("Version is < 1.5", "<ul><li>So we can relax about image paths...</li></ul>");
  }
} else {
  if ($pfDebug) {
    report_message ("1.5 Session Issue...", "<ul><li>We have to pass data in a GET request to 15, because I can't get the session working!</li></ul>");
  }
}

if (!isset($my)) {
	if (isset($_SESSION[md5('my')])) $my = $_SESSION[md5('my')];
}

if ( isJ10() ) {
  if (!isset($_SESSION[md5('form_id')])) {
    report_error (18, PF_ERROR_18, PF_ERROR_18_COMMENT);
    return;
  }
  if (!isset($_SESSION[md5('pdfAvailable')])) die2 ("Intruder Alert 19!");
  //setting $paranoid to true will enable 'messages that self-destruct' ;)
  $paranoid = isset($_SESSION[md5('paranoid')]); // well... sorta
	if (isset($_SESSION[md5('my')])) {
		$my = $_SESSION[md5('my')];
/*		$my->gid = intval($_SESSION[md5('session_gid')]);
		$my->id = intval($_SESSION[md5('session_user_id')]); */
	}
  $formId = intval($_SESSION[md5('form_id')]);
  //one-time pads
  if ($paranoid) {
    $_SESSION = Array();
    if (isset ($_COOKIE[session_name()]) ) {
      setcookie(session_name(), '', time()-4200, '/');
    }
    session_destroy();
  }
} else {
  $formId = intval($_REQUEST['formid']);
}
if (isset($_POST['pdf']) ){
  $printpdf = ( $_POST['pdf'] === 'true' ) ? true : false;
} else {
  $printpdf = false;
}
//do not place tags or code that prints (echo's etc) above the pdf-meister
if ($printpdf) {
  global $mosConfig_absolute_path;
  $html2pdf = "";
  if ( file_exists($mosConfig_absolute_path.'/administrator/components/com_performs/html2fpdf-3.0.2b/html2fpdf.php') ) 
    $html2pdf = $mosConfig_absolute_path.'/administrator/components/com_performs/html2fpdf-3.0.2b/html2fpdf.php';
  if ( file_exists($mosConfig_absolute_path.'/../html2fpdf-3.0.2b/html2fpdf.php') ) 
    $html2pdf = $mosConfig_absolute_path.'/../html2fpdf-3.0.2b/html2fpdf.php';
  if ( file_exists($mosConfig_absolute_path.'/html2fpdf-3.0.2b/html2fpdf.php') ) 
    $html2pdf = $mosConfig_absolute_path.'/html2fpdf-3.0.2b/html2fpdf.php';
  //the version that comes with VirtueMart is the sentimental favourite...
  if ( file_exists($mosConfig_absolute_path.'/administrator/components/com_virtuemart/classes/pdf/html2fpdf.php') ) 
    $html2pdf = $mosConfig_absolute_path.'/administrator/components/com_virtuemart/classes/pdf/html2fpdf.php';
  if ($html2pdf != "") {
    if (ob_get_length() > 0) {
      if ($pfDebug) {
        report_error(31, "Output Buffer Started", "<label for=\"PF_E_31\"><i>Output Buffer Contents</i></label><textarea id=\"PF_E_31\">".ob_get_contents()."</textarea>");
      } else {
        ob_clean();
        require_once($html2pdf);
        ob_start();
      }
    } else {
      require_once($html2pdf);
      ob_start();
    }
  }
}
PFLoadCalendar();
$now = date( "Y-m-d H:i:s", time()+$mosConfig_offset*60*60 );

$form_query = "SELECT * FROM #__performs WHERE id='$formId' AND published='1'"
. "\n AND ( start_date = '0000-00-00 00:00:00' OR start_date <= '$now'  )"
. "\n AND ( finish_date = '0000-00-00 00:00:00' OR finish_date >= '$now' )"
;
$database->setQuery( $form_query );
$form_data = null;
if(!$database->loadObject($form_data)){
  report_error( 23, PF_ERROR_23, PF_ERROR_23_COMMENTA." <b>$formId</b> ".PF_ERROR_23_COMMENTB."<div>Joomla  Version: ".(isJ15() ? "J15" : (isJ10() ? "J10" : "Not Happening")));
		die(NO_FORM_FOUND);
}
if ( empty($myArrFields )) {
  $myArrFields=makeArray($formId,$form_data->includeSubmit,$form_data->submitLabel,$form_data->includeReset,$form_data->resetLabel);
}
$objMyForm = new phpform( $form_data->title, $myArrFields );
//XSS fix
//$objMyForm->strAction = $_SERVER['REQUEST_URI'];
$mytmpURI = htmlentities($_SERVER['REQUEST_URI'], ENT_QUOTES);
$objMyForm->strAction = $mytmpURI;
//end XSS fix
$theme="performs";
if(!empty($form_data->theme)){
		$theme=substr($form_data->theme,0,strpos($form_data->theme,'.'));
}
$objMyForm->strSkin = $mosConfig_absolute_path."/components/com_performs/skins/$theme/tpl_form.html";
if($form_data->use_securityimages==1 && $my->id==0){
  //		$objMyForm->use_securityimages = true;
  $objMyForm->use_securityimages = file_exists($mosConfig_absolute_path."/components/com_securityimages");
	$objMyForm->securityImageHelp =  $form_data->securityHelpText;
	$objMyForm->securityImageError =  $form_data->securityErrorText;
}
if($form_data->strMissingFieldMsg)
	$objMyForm->strMissingFieldMsg = $form_data->strMissingFieldMsg;
$objMyForm->intro = $form_data->intro;
$objMyForm->useContainer = $form_data->useContainer;
$objMyForm->formWidth = $form_data->formWidth;

if (!empty( $form_data->image )) {
  if ( isJ10() ) {
    $objMyForm->formImage=$mosConfig_live_site.'/images/stories/'.$form_data->image;
  } else {
    $objMyForm->formImage=$mosConfig_live_site.'../../../images/stories/'.$form_data->image;
  }
}
if ( $objMyForm ) {
	$objMyForm->bolShowWarnings = false;
	$objMyForm->strMethod = "post";
  $_REQUEST['printing'] = true;
if ($pfDebug) {
	
  echo @"
<style type=\"text/css\">
#debugdiv {
float: none;
position: absolute;
/*top: 120;
left: 500;*/
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

  echo '<div style="text-align: left;"><a href="javascript: toggleDebugDiv();" />DEBUG:</a></div><div id="debugdiv"><table style="background-color: aliceblue; padding: 8pt; border: thick dotted khaki; width: 700px; margin-top: 24pt;"><tr><td><h2>performs.php</h2></td></tr><tr><td>';
  $tabs = new mosTabs(0);//startTab (joomla.php line 4318 version 1.0.11) only ever adds tabs to tabPane1 ... 
    $tabs->startPane("session");
    report_env ($tabs, 1);
   // $tabs->startTab("MAKE", 'session');
}
/*============================================================================*/
$strResult = $objMyForm->make();
if ($pfDebug) {
	$tabs->endTab();
	$tabs->endPane();
}
if ($printpdf) {
  $pdf = new HTML2FPDF();
  $pdf->DisplayPreferences('HideWindowUI');
  $pdf->AddPage();
  $pdf->WriteHTML($strResult);
  ob_end_clean();
  $pdf->Output('doc.pdf', 'D');
} else {
  echo $strResult;
}
}
function die2( $dietxt ) {
  global $pfDebug;
  die( $dietxt );
}
?>
