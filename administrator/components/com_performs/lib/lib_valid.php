<?php
defined( '_VALID_MOS' ) or die( 'Restricted access' );

/**
*	@description preveri, � format URL naslova ustreza standardu
	*	@author1 Simon Sander, simon@vizija.si
	*/
function isValidUrl( $strMach ) {
		error_reporting( 0 );
		$arrTmp = parse_url( $strMach );
		error_reporting( 7 );
		if ( $arrTmp["scheme"] && $arrTmp["host"] && $arrTmp["path"] ) {
			return true;
		} else {
			return false;
		}
}
/** Checks an email address for security purposes
* @author marcelonada@gmail.com (and developaid_dave)
* @date 2007-07
* @param emailAddress the email address to check
* @return true if email address looks okay, false if not
*/
function isEmail( $emailAddress ) {
	$bolRes = 
		eregi( "^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})",
			$emailAddress, $arrPat ); 
	return $bolRes !== false; 
} 

/**
*	@description preveri, � format $strInput ustreza stringu
 *	@author1 Simon Sander, simon@vizija.si
 */
function isString( $strInput ) {
	$bolRes = eregi( "(^.*$)", $strInput, $arrPat );
	return $bolRes !== false;
}
/**
*	@description preveri, � format $strInput sestavljen samo iz cifer
 *	@author1 Simon Sander, simon@vizija.si
 */
function isInteger( $strInput ) {
	$bolRes = eregi( "(^[0-9]+$)", $strInput, $arrPat );
	return $bolRes !== false;
}
/**
*	@description preveri, � format $strInput ustreza float tipu (realno tevilo brez e)
 *	@author1 Simon Sander, simon@vizija.si
 */
function isFloat( $strInput ) {
	$bolRes = eregi( "^([0-9]*)(\.)([0-9]+$)", $strInput, $arrPat );
	return $bolRes !== false;
}
/**
*	@description preveri, � format $strInput ustreza imenu (ne za�e se s tevilko)
 *	@author1 Simon Sander, simon@vizija.si
 */
function isName( $strInput ) {
	$bolRes = eregi( "(^[^0-9])([a-z0-9]*)", $strInput, $arrPat );
	return $bolRes !== false;
}
/** Checks a filename for security purposes
* @author developaid_dave
* @date 2007-04
* @return true if file extension looks okay, false if not
* @param filename The filename to check
* @param caution If true, extensions not on either list will not be allowed
* if false, extensions not on either list will be allowed - default is true
*/
function IsValidFile( $filename, $caution = true) {
	if ($filename == "") return false;
//	if ($filename == "") return true;
	$inf = pathinfo($filename);
	$extension = strtolower($inf['extension']);
	$allowed_extensions = 
		array( "jpg", "jpeg", "gif", "png", "zip", "txt", "mpg", "mpeg", "mov", 
			"avi", "mp3", "wav", "pdf", "doc", "docx", "xls", "xml" );
			
	$naughty_extensions = 
		array( "php", "pl", "sh", "exe", "py", "csh", "cgi", "asp", "htm", "html" );

	if (in_array($extension, $allowed_extensions)) return true;
	
	if (in_array($extension, $naughty_extensions)) return false;
	
	if ($caution) {
		return false;
	} else {
	  return true;
	}
}

?>
