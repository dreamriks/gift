<?php
/** @Revised (2.3 - 2007-04-24) David Walters */
 
/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
global $mosConfig_absolute_path, $mosConfig_lang, $mosConfig_live_site;
require_once($mosConfig_absolute_path."/administrator/components/com_performs/lib/myLib.php");

define ("PF_MAMBOT_REGEX", '/{(mosperforms)\s*formid=\s*(.*?)\s*}/i');

//define ("PF_MAMBOT_REGEX", '/{mosperforms\s*formid=\s*(.*?)\s*}/i');
//if (file_exists($mosConfig_absolute_path.'/components/com_performs/language/'.$mosConfig_lang.'.php')) {
//	include($mosConfig_absolute_path.'/components/com_performs/language/'.$mosConfig_lang.'.php');
//} else {
//	include($mosConfig_absolute_path.'/components/com_performs/language/english.php');
//}
 
$_MAMBOTS->registerFunction( 'onPrepareContent', 'botMosPerforms' );

/**
* <b>Usage:</b>
* <code>{mosperforms formid=X}</code>
*/
 
function botMosPerforms( $published, &$row, $mask=0, $page=0  ) {

	global $mosConfig_absolute_path;

	// simple performance check to determine whether bot should process further
	if ( strpos( $row->text, 'mosperforms' ) === false ) {
		return true;
	}

 	// expression to search for
 	$regex = PF_MAMBOT_REGEX;

	if (!$published) { // when unpublished remove mambot tags from content
		$row->text = preg_replace( $regex, '', $row->text );
		return true;
	}

//  print "<pre><h1>ROW</h1>\n";
//	print_r($row);
//	print "</pre>";
//	die();

	ob_start();
	// perform the replacement
	$mymatches = array();
	preg_match_all(PF_MAMBOT_REGEX, $row->text, $mymatches);

	$matchindex = -1;
	foreach ($mymatches[0] as $match) {
		$matchindex++;
			$pfregex = PF_MAMBOT_REGEX;
			$regex = str_replace("(.*?)", "("
				.preg_replace('/{(mosperforms)\s*formid=\s*(.*?)}/i', '$2',$match)
				.")", $pfregex);
				
//		$row->text = preg_replace_callback( "[".$match."]", 'botMosPerforms_replacer', $row->text );
		$row->text = preg_replace_callback( $regex, 'botMosPerforms_replacer', $row->text );

		
//		$row->introtext = preg_replace_callback( $regex, 'botMosPerforms_replacer', $row->introtext );
//		$row->text = preg_replace_callback( $regex, 'botMosPerforms_replacer', $row->text );
//		if (isset($row->fulltext))
//			$row->text = preg_replace_callback( $regex, 'botMosPerforms_replacer', $row->fulltext );
//	ob_end_clean();
	}
	
		
//	$row->introtext = preg_replace_callback( $regex, 'botMosPerforms_replacer', $row->introtext );
//	$row->text = preg_replace_callback( $regex, 'botMosPerforms_replacer', $row->text );
//if (isset($row->fulltext))
//	$row->text = preg_replace_callback( $regex, 'botMosPerforms_replacer', $row->fulltext );
	
 
  return true;
}


function botMosPerforms_replacer( &$matches ) {
	global $mosConfig_absolute_path, $mosConfig_live_site;
//	$forms = preg_match('/{mosperforms\s*formid=\s*(.*?)}/i', $matches[0]);
//  print "<pre>";
//	print_r($matches);
//	print "</pre>";
//	die();
	$id = preg_replace('/{(mosperforms)\s*formid=\s*(.*?)}/i', '$2', $matches[0]);
	
//	$id = $matches[2];
	
	$retval = '';
	@ob_start();
	$preForms = ob_get_contents();
	ob_end_clean();
	$_REQUEST[md5('mosperforms_id')] = $id;
	require ( $mosConfig_absolute_path."/components/com_performs/performs.php" );
	$retun = ob_get_contents();
	$retval = str_replace($matches[0], $retun, $preForms).$retun;
	ob_clean();
	return $retval;
}
?>