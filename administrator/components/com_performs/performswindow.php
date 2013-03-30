<?php
/**
* @version $id: performswindow.php,v 2.3
 * @package performs
 * @copyright (C) 2007 perForms
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @author David Walters
 * @author (original) Ilhami KILIC http://www.tuwitek.at 
 * Joomla is Free Software
 */
/** Set flag that this is a parent file */
define( "_VALID_MOS", 1 );
global $mosConfig_lang, $mainframe;
require_once("../../includes/auth.php");
require_once( "lib/myLib.php" );

require_once( "lib/lib_template.php" );
require_once( "lib/lib_valid.php" );
require_once( "lib/lib_phpForm.php" );
require_once( "class.performs.php");

if (file_exists('../../components/com_performs/language/'.$mosConfig_lang.'.php')) {
  require_once('../../components/com_performs/language/'.$mosConfig_lang.'.php');
} else {
  require_once('../../../components/com_performs/language/english.php');
}

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
}



$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );
$database->debug( $pfDebug );
$sql = "SELECT template FROM #__templates_menu WHERE client_id='0' AND menuid='0'";
$database->setQuery( $sql );
$css = $database->loadResult();
$formId = mosGetParam( $_REQUEST, 'formId', 0 );
$form_data = new mosForm( $database );
$form_data->load($formId);
$theme="performs";
if(!empty($form_data->theme)){
	$theme=substr($form_data->theme,0,strpos($form_data->theme,'.'));
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title><?php echo FORM_PREVIEW?></title>
<link rel="stylesheet" href="../../../templates/<?php echo $css; ?>/css/template_css.css" type="text/css">
<style type="text/css">
body {
	border: none;
}
</style>
</head>
<body>
<table align="center" width="100%" cellspacing="2" cellpadding="2" border="0" >
<tr>
<td class="moduleheading" colspan="2" >
<!-- <table class="contentpaneopen"> -->
<table>
<tbody><tr>
<td class="contentheading" width="100%"><?php echo $form_data->title; ?></td>
</tr>
</tbody></table>
<!-- <table class="contentpane"> -->
<table>
<tr><td>
<?php
if (!empty( $form_data->image )) {
  ?>
  <div style="float: right;">
  <img src="<?php echo $mosConfig_live_site;?>/images/stories/<?php echo $form_data->image; ?>" align="right" alt="Form image" />
  </div>
  <?php
}
?>
<div style="margin:5px"><?php echo parseAuto($form_data->intro); ?></div>
</td></tr>
</table>		
<?php
PFLoadCalendar();
$myArrFields=makeArray($formId,$form_data->includeSubmit,$form_data->submitLabel,$form_data->includeReset,$form_data->resetLabel);
$objMyForm = new phpform( "myForm", $myArrFields );
$objMyForm->strAction = $_SERVER['PHP_SELF'];
$objMyForm->strSkin = $mosConfig_absolute_path."/components/com_performs/skins/".$theme."/tpl_form.html";

if ( $objMyForm ) {
  $objMyForm->bolShowWarnings = true;
  $objMyForm->strMethod = "post";
	$objMyForm->useContainer = $form_data->useContainer;
	$objMyForm->formWidth = $form_data->formWidth;
  $strResult = parseAuto($objMyForm->show());
}
else echo ERROR_OCCURRED;
?>		
</td>
</tr>
<tr>
<td align="center" colspan="4" ><a href="#" onClick="window.close()"><?php echo CLOSE?></a></td>
</tr>
</table>
</body>
</html>
