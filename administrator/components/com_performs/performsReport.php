<?php
/**
* @version $id: performsReport.php,v 2.3
 * @package performs
 * @copyright (C) 2007 perForms
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @author David Walters
 * @author (original) Ilhami KILIC http://www.tuwitek.at
 * Joomla is Free Software
 */
/** Set flag that this is a parent file */
if ( file_exists( "../../includes/auth.php" ) ) {
  define( "_VALID_MOS", 1 );
  require_once("../../includes/auth.php");
} else {
  define( "_JEXEC", 1 );
  require_once( "../../index2.php" );
}
global $mosConfig_absolute_path, $mosConfig_lang, $database;
require_once("lib/myLib.php");
require_once($mosConfig_absolute_path."/administrator/components/com_performs/class.performs.php");
if (file_exists($mosConfig_absolute_path.'/components/com_performs/language/'.$mosConfig_lang.'.php')) {
  include($mosConfig_absolute_path.'/components/com_performs/language/'.$mosConfig_lang.'.php');
} else {
  include($mosConfig_absolute_path.'/components/com_performs/language/english.php');
}
$database->debug( $pfDebug );
$sql = "SELECT template FROM #__templates_menu WHERE client_id='1' AND menuid='0'";
$database->setQuery( $sql );
$css = $database->loadResult();
$formId = mosGetParam( $_REQUEST, 'formId', 0 );
$action = mosGetParam( $_REQUEST, 'show', 0 );
$form_data = new mosForm( $database );
// load the row from the db table
$form_data->load($formId);
$t = mosGetParam( $_REQUEST, 't', "" );
if($t){
  $headers="";
  $data = "";
		$fields = explode(",",$t);
		$selectFields = "";
		for ($i=0, $n=count($fields); $i < $n; $i++) {	
			if($fields[$i]=="date_time"){
				$selectFields .= " UNIX_TIMESTAMP( date_time ) as date_time ";
//				$headers .= '"'.DATE_TIME.'"'."\t";
				$headers .= '"'.DATE_TIME.'"';
      }
			else{
				$selectFields .= "`".$fields[$i]."`";
//				$headers .= '"'.ucfirst($fields[$i]).'"'."\t";
				$headers .= '"'.ucfirst($fields[$i]).'"';
      }
			if($i!=$n-1) {
				$selectFields .= ',';	
				$headers .=",";
			}
		}
		$sql = "SELECT $selectFields FROM `".$form_data->tablename."`";
		$database->setQuery( $sql );
		$rows = $database->loadObjectList();
		
    for ($i=0, $n=count($rows); $i < $n; $i++) {
      $row = $rows[$i];
      $line = "";
      foreach($fields as $fieldName){ 
        $value = "";
        if ((!isset($row->$fieldName)) OR ($row->$fieldName == "")) {
//          $value = "\t";	
//          $value = ", ";	
				} else if($fieldName=="date_time"){
//					$value = '"'.date("Y-m-d H:i:s",$row->$fieldName).'"'."\t";
					$value = '"'.date("Y-m-d H:i:s",$row->$fieldName).'"';
        }
        else{
          $value = str_replace('"', '""', $row->$fieldName); 
//          $value = '"' . $value . '"' . "\t";  
          $value = '"' . $value . '"';  
        }
				$line .= ', ' . $value;
      } 
			if ($line[0] == ",") {
				$line = substr($line, 1, strlen($line)-1);
			}
      $data .= trim($line)."\n";
    } 
/*    $data = str_replace("\r","",$data);*/
    if ($data == "") { 
      $data = "\n".NO_RECORDS_FOUND."\n";                         
    }
    //ob_end_clean();
    @ob_clean();
    header("Content-Type: application/vnd.ms-excel; name='excel'");
//    header("Content-Type: text/csv; name='TEXT'");
//    header("Content-Disposition: attachment; filename=".$form_data->title.".xls"); 
    header("Content-Disposition: attachment; filename=".$form_data->title.".csv"); 
//    header("Content-Disposition: attachment; filename=".$form_data->title.".txt"); 
    header("Pragma: no-cache"); 
    header("Expires: 0"); 
    print "$headers\n$data";
    exit();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Form Report -<?php echo $form_data->title; ?></title>
<link rel="stylesheet" href="<?php echo $mosConfig_live_site;?>/administrator/templates/<?php echo $css; ?>/css/template_css.css" type="text/css">
<link rel="stylesheet" href="<?php echo $mosConfig_live_site;?>/administrator/templates/<?php echo $css; ?>/css/theme.css" type="text/css">
<script language="javascript" src="<?php echo $mosConfig_live_site;?>/administrator/components/com_performs/selectbox.js" > </script>
</head>
<body>
<table align="center" width="100%" cellspacing="2" cellpadding="2" border="0" >
<tr>
<td><table class="adminheading">
<tr>
<th> <?php echo $form_data->title; ?> </th>
<?php if($action) { ?>
		<td align="right" style="padding-right:15px">
  <a href="<?php echo $_SERVER['PHP_SELF'];?>?formId=<?php echo $formId;?>&t=<?php echo implode(",",$_POST['fields']);?>&show=1"><img src="images/xls.png" alt="Export to Excel" border="0"></a>
		<td>
		<?php } ?>       
</tr>
</table></td>
</tr>
<tr>
<td><?php if($action){ 
		$fields = $_POST['fields'];
		$selectFields = "";
		for ($i=0, $n=count($fields); $i < $n; $i++) {	
			if($fields[$i]=="date_time")
				$selectFields .= " UNIX_TIMESTAMP( date_time ) as date_time ";
			else
				$selectFields .= "`".$fields[$i]."`";
			if($i!=$n-1)
				$selectFields .= ',';	
		}
		$sql = "SELECT $selectFields FROM `".$form_data->tablename."`";
		$database->setQuery( $sql );
		$rows = $database->loadObjectList();
    ?>
      <table class="adminlist">
      <tr>
      <?php foreach($fields as $fieldName){ ?>
        <th class="title"> <?php echo ucfirst($fieldName); ?></th>
          <?php } ?>
      </tr>
      <?php
      $k = 0;
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];
      ?>	
        <tr class="<?php echo "row$k"; ?>">
        <?php foreach($fields as $fieldName){ ?>
          <td> <?php 
			  	if($fieldName=="date_time"){
            echo date("Y-m-d H:i:s",$row->$fieldName);
					}
          else
			  		echo $row->$fieldName; 
          ?></td>
            <?php } ?>
        </tr>
        <?php  } ?>
      </table>
      <?php } else { 
        $fieldsNames =	$database->getTableFields( array($form_data->tablename));
        $fNames = $fieldsNames[$form_data->tablename];
				$opList = "";
        foreach ($fNames as $fName=>$type) {
          $opList .= '<option value="'.$fName.'">'.ucfirst($fName).'</option>'."\n";
        }
        ?>
          <?php echo SELECT_FIELDS?>
          <form action="performsReport.php" method="post" >
          <TABLE BORDER=0>
          <TR>
          <TD>
          <strong><?php echo FIELD_NAMES?></strong><br>
          <SELECT NAME="list11" MULTIPLE SIZE=10 class="inputbox" onDblClick="moveSelectedOptions(this.form['list11'],this.form['fields'],false)">
          <?php  echo $opList; ?>
            </SELECT>
            </TD>
            <TD VALIGN=MIDDLE ALIGN=CENTER><A HREF="#" onClick="moveSelectedOptions(document.forms[0]['list11'],document.forms[0]['fields[]'],false);return false;">&gt;&gt;</A><BR>
              <BR>
              <A HREF="#" onClick="moveAllOptions(document.forms[0]['list11'],document.forms[0]['fields[]'],false); return false;"><?php echo ALL?> &gt;&gt;</A><BR>
                <BR>
                <A HREF="#" onClick="moveSelectedOptions(document.forms[0]['fields[]'],document.forms[0]['list11'],false); return false;">&lt;&lt;</A><BR>
                  <BR>
                  <A HREF="#" onClick="moveAllOptions(document.forms[0]['fields[]'],document.forms[0]['list11'],false); return false;"><?php echo ALL?> &lt;&lt;</A> </TD>
                    <TD>
                    <strong><?php echo INCLUDED_FIELDS?></strong><br>
                    <SELECT NAME="fields[]" MULTIPLE SIZE=10 class="inputbox" onDblClick="moveSelectedOptions(this.form['fields[]'],this.form['list11'],false)">
                    </SELECT>
                    </TD>
                    <td>
                    <INPUT TYPE="button" VALUE="<?php echo UP?>" name="up" class="button"  onClick="moveOptionUp(this.form['fields[]'])">
                    <br /><br />
                    <INPUT TYPE="button" name="down" VALUE="<?php echo DOWN?>" class="button"  onClick="moveOptionDown(this.form['fields[]'])">		  
                    </td>
                    </TR>
                    <tr><td colspan="4">
                    <input type="hidden" value="1" name="show">
                    <input type="hidden" value="<?php echo $formId; ?>" name="formId">		
                    <input type="button" onClick="selectAllOptions(this.form['fields[]']); this.form.submit();" class="button" value="<?php echo SUBMIT_LABEL?>">
                    </td></tr>
                    </TABLE>
                    </form>
                    <?php  } ?>
</td>
</tr>
<tr>
<td align="left" ><a href="#" onClick="window.close()"><?php echo CLOSE?></a>&nbsp;&nbsp; <a href="javascript:;" onClick="window.print(); return false"><?php echo _PRINT?></a></td>
</tr>
</table>
</body>
</html>
