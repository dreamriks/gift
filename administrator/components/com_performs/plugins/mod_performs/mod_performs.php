<?php
/**
This is a module inspired by  G Folkers excellent lima show tables modules http://www.limaict.nl.
* @version 2.0:0 display data
* Many thanks to Vince of http://www.jomres.net for his patience and help.
* Revised (ver. 2.0.1) for preForms by Digital Access, USA
* @Revised (2.3 - 2007-04) David Walters
*/
// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );
global $mosConfig_offset, $mosConfig_live_site, $mosConfig_absolute_path,
	$mainframe, $mosConfig_db;

if (!function_exists('cout')) {
	function cout($outstr) {
		echo "<pre>".$outstr."</pre>";
	}
}
if (!function_exists('report_error')) {
	global $mosConfig_absolute_path;
	include ($mosConfig_absolute_path."/administrator/components/com_performs/lib/myLib.php");
}
if (file_exists($mosConfig_absolute_path.'/components/com_performs/language/'.$mosConfig_lang.'.php')) {
	include($mosConfig_absolute_path.'/components/com_performs/language/'.$mosConfig_lang.'.php');
} else {
	include($mosConfig_absolute_path.'/components/com_performs/language/english.php');
}

$perfmodcount = 0;
if (!isset($_REQUEST['perfmod_count'])) {
	$_REQUEST['perfmod_count'] = $perfmodcount;
} else {
	$_REQUEST['perfmod_count']++;
}
$perfmodcount = $_REQUEST['perfmod_count'];


//$db_name  = $params->get( 'dbname');
//$tb_name  = $params->get( 'tbname');
$db_name  = $mosConfig_db;
$showsql = $params->get ( 'show_sql');  //Show query yes / no  

$form_id = $params->get( 'form_id' );
$formquery = "SELECT * from #__performs WHERE id = '$form_id'";
$database->setQuery($formquery);
if (!$database->query()) {
	echo "DB ERROR: " . $database->stderr();
	return;
}
$form = null;
$goodToGo = $database->loadObject($form);
if (!$goodToGo) {
	if (!defined("NO_FORM_FOUND")) {
		if (file_exists($mosConfig_absolute_path.'/components/com_performs/language/'.$mosConfig_lang.'.php')) {
			include($mosConfig_absolute_path.'/components/com_performs/language/'.$mosConfig_lang.'.php');
		} else {
			include($mosConfig_absolute_path.'/components/com_performs/language/english.php');
		}
	}
	echo NO_FORM_FOUND;
	return;
}

$legend = $params->get( "legend" );
$viewMode = $params->get( 'display_mode' );
$width = $params->get( 'width');
if (!isset($width)) $width = "";
if (strlen($width)< 1) 	$width ="inherit";	

$userSql = $params->get('sql_query');
if ($userSql == null) {
	$tb_name  = $form->tablename;
	if ($tb_name == "") {
		echo "No Table!";
		return;
	}
	$max = $params->get( 'max');
//	$clause = $params->get( 'clause');
	$argue = $params->get ( 'argument');
	if (strlen($argue) > 0) {
		$argue = "WHERE $argue";
	}
	$itemList = $params->get( 'item_list' );
	if ($itemList == "") {
		echo "No Items!";
		return;
	}
	$hdr1 = $params->get ( 'hdrone'); //limit the number of records to display
	if (strlen($hdr1) < 1) {
		$hdr1 = "5";
	}
	$hdr2 = $params->get ( 'hdrtwo');  // sort by field name
	$hdr3 = $params->get ( 'hdrthree'); // type of sort ASC or DESC
	$hdr4 = $params->get ( 'hdrfour');  //Show query yes / no  
	$hdr4 = $showsql;
	$fields = mysql_list_fields ($db_name, $tb_name);
	if (count($fields)) {
		$columns = mysql_num_fields ($fields);
	} else {
		return;
	}
	 //sort by query
	if (strlen($hdr2) > 0) {
		$order_by = 'ORDER BY '.$hdr2;
	}
	else {
		$order_by = 'ORDER BY id';
	}
	if ($max > 0)	{
		if ($columns > $max) {
				$columnsmax = $max;
				}else{
				$columnsmax = $columns;
		 } 
	} else {
		$columnsmax = $columns;
	}
	$fieldString=$itemList;
	// query db
	// Determine how many pages there are. 
	$display = $hdr1;
	if (isset($_GET['np'])) { // Already been determined.
		$num_pages = $_GET['np'];
	} else { // Need to determine.
		$sql1 = "SELECT $fieldString
			FROM $tb_name $argue   
			 $order_by $hdr3"; //determines number of records.
		$res1 = mysql_query ($sql1) or die (mysql_error ());
		$num_records = mysql_num_rows ($res1);
	}
	if ($num_records > $display) { // More than 1 page.
		if (($hdr1 > 0) && ($num_records > 0))
			$num_pages = ceil ($num_records/$hdr1);
		else
			$num_pages = 1;
	} /*else {
		$num_pages = 1;
	}*/	
	// Determine where in the database to start returning results.
	if (isset($_GET['s'])) { // Already been determined.
		$start = $_GET['s'];
	} else {
		$start = 0;
	}
	$sql = "SELECT $fieldString
		FROM $tb_name $argue 
		 $order_by $hdr3 LIMIT $hdr1";
} else {
//field sql_query has been filled in -
//	$sql = $userSql;
	$sql = ereg_replace("\\<br /\\>", " ", $userSql);
}

if ($showsql) {
	echo @"
<style type=\"text/css\">
#pfm".$perfmodcount.@"-debugdiv {
	float: none;
	display: none;
	position: absolute;
	padding: 20px;
	background-color: beige;
}
</style>
<script language=\"javascript\">
	function togglePFM".$perfmodcount.@"DebugDiv() {
		var dbgdiv = document.getElementById('pfm".$perfmodcount.@"-debugdiv'); 
		var displ = dbgdiv.style.display;
		if ((displ == 'none') || (displ == '')) {
			dbgdiv.style.display = 'block';
		} else {
			dbgdiv.style.display = 'none'; 
		}
	}
</script>
<span style=\"text-align: left;\">
<a href=\"javascript: togglePFM".$perfmodcount.@"DebugDiv();\" />SQL:</a></span>
<div id=\"pfm".$perfmodcount.@"-debugdiv\"><span class=\"pf-sql\"><pre>$sql</pre></span></div>
	";
}
global $database;
$database->setQuery($sql);
if (!@$database->query()) {
	report_error(203, "QUERY BAD", "A BAD QUERY HAS BEEN REJECTED...<pre>".$sql."</pre>");
	return;
} else {
	$stuff = $database->loadAssocList();
	if ($viewMode == "R") {
	//(or pie mode, or bar mode, histogram, etc)
		echo @"
<style type=\"text/css\">
div.pf-mod {
	width: $width;
	display: block;
	padding: 12pt;
}
div.pf-legend {
	margin-bottom: 12px;
	font-weight: bolder;
	height: 14pt;
}
div.pf-report-row1 {
		clear: both;
		height: 14pt;
}
div.pf-report-row2 {
		clear: both;
		height: 14pt;
}
span.pf-item {
padding: 2px;
float: left;
clear: left;
}
span.pf-value {
padding: 2pt;
float: right;
clear: right;
}
</style>
";
		echo "<div class=\"pf-mod\">\n"; 
		if ((isset($legend) && $legend != "")) echo "<div class=\"pf-legend\">$legend</div>\n";
		$altrow = 0;
		foreach ($stuff[0] as $myFieldName => $myFieldValue) {
			echo "<div class=\"pf-report-row".(($altrow % 2 == 0) ? "1" : "2")."\">\n";
			echo "<span class=\"pf-item\">".$myFieldName."</span>";
			echo "<span class=\"pf-value\">".$myFieldValue."</span>";
			echo "</div>\n";
			++$altrow;
		}
		echo "</div>\n";
		return;
		
	} else {
	//summary mode 
		$stuff = $database->loadAssocList();
		if (count($stuff) == 0) {
			return;
		}
		$headers = array_keys($stuff[0]);
		echo @"
<table class=\"poll\" style=\"width: $width;\">
	<thead><tr>
	";
	//print headers
	foreach ($headers as $headr) {
	 echo "<td align=\"center\"><div class=\"sectiontableheader\">".$headr."</div></td>";
	}
	echo @"
	</tr></thead>
	<tbody>
	";
	$altrow = 0;

	foreach ($stuff as $row) {
		//print the table body
		if (count($row) > 0) {
			echo "<tr>";
				foreach ($row as $itm => $vl) {
					echo "<td class=\"sectiontableentry".(($altrow % 2 == 0) ? "1" : "2")."\" align=\"left\">";
					echo $vl;
					echo '</td>';
				}
			echo "</tr>\n";
			++$altrow;
		}
	}
	echo @"
	</tbody>
</table>
	";
	return;		
	}
}
?>
