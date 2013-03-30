<?php
defined( '_VALID_MOS' ) or die( 'Restricted access' );
define("LIB_REPLACE", 1);
require_once("myLib.php");

function parseAutoEX( $auto ) {
global $my;
$retval = $auto;
	switch ($auto) {
		case PFAUTO_USERNAME: { 
			$retval = $my->username;
			break;
		}
		case PFAUTO_NAME: { 
			$retval = $my->name;
			break;
		}
		case PFAUTO_USERTYPE: { 
			$retval = $my->usertype;
			break;
		}
		case PFAUTO_REGISTERDATE: { 
			$retval = $my->registerDate;
			break;
		}
		case PFAUTO_LASTVISITDATE: { 
			if (isset($my->lastvisitDate)) {
				$retval = $my->lastvisitDate;
			} else {
				$retval = "";
			}
			break;
		}
		case PFAUTO_USEREMAIL: { 
			$retval = $my->email;
			break;
		}
//		case SOMETHING_ELSE_USEFUL: { 
//			$retval = $THE_USEFUL_VAR;
//			break;
//		}
	}
return $retval;
}
function cb_replace( $re, $retval, $pfauto = false ) {
global $_PFAUTO, $my, $database;
$matches = array();
$matchCount = preg_match_all($re, $retval, $matches[]);
	foreach ($matches as $m) {
		$matchCount = count($m);
		for ($mi = 0; $mi < $matchCount; ++$mi) {
			if ((isset($m[$mi][0])) && ($m[$mi][0] != "")) {
				$smatch = count($m[$mi]);
					for ($mitch = 0; $mitch < $smatch; ++$mitch) {
						$repl = "";
						
					$tempmatch = array();
//					print_r($m[$mi]);
//					die();
					//miro's cb edit - with my-> replacements
					if(preg_match("/\{(user.)(.*)\}/i", $m[$mi][$mitch], $tempmatch)) {
//							die("Found comm part");
						if(preg_match("/(cb.)(.*)/i", $tempmatch[2], $tempmatch2)) {
//							$cb_query = "SELECT * FROM #__comprofiler WHERE user_id='".$myUser->id."' LIMIT 1";
							$cb_query = "SELECT * FROM #__comprofiler WHERE user_id='".$my->id."' LIMIT 1";
							$database->setQuery( $cb_query );
							$cb_data = $database->loadObjectList();
							if (isset($cb_data) && count($cb_data) > 0) {
								$cb_vars = get_object_vars($cb_data[0]);
								if(isset($cb_vars[$tempmatch2[2]])) {
									$repl = $cb_vars[$tempmatch2[2]];
								}
							}
						} else {
							$vars = get_object_vars($my);
//							$vars = get_object_vars($myUser);
							if(isset($vars[$tempmatch[2]])) {
								$repl = $vars[$tempmatch[2]];
							}
						}
					}
					//end miro's cb edit
						
						$retval =	str_replace($m[$mi][$mitch], $repl, $retval);
						
					}
			}
		$mi++;
		}
	}
return $retval;
}

function pf_replace( $re, $retval, $pfauto = false ) {
global $_PFAUTO;
$matches = array();
$matchCount = preg_match_all($re, $retval, $matches[]);
	foreach ($matches as $m) {
		$matchCount = count($m);
		for ($mi = 0; $mi < $matchCount; ++$mi) {
			if ((isset($m[$mi][0])) && ($m[$mi][0] != "")) {
				$smatch = count($m[$mi]);
					for ($mitch = 0; $mitch < $smatch; ++$mitch) {
						$repl = "";
						if (!$pfauto) {
							$repl = parseAutoEX($m[$mi+1][$mitch]);
						} else {
							if (isset($_PFAUTO[$m[$mi+1][$mitch]])) {
								$repl = $_PFAUTO[$m[$mi+1][$mitch]];
							} else {
								$repl = $m[$mi][$mitch];
							}
						}
						$retval =	str_replace($m[$mi][$mitch], $repl, $retval);
					}
			}
		$mi++;
		}
	}
return $retval;
}
/**
* @author David Walters
* @date 2007-3
* mini-bot for replacing "Auto Fields"
*/
function parseAuto( $intro ) {
global $my, $_PFAUTO;
	if (is_array($intro)) {
		for ($i = 0; $i < count($intro); $i++) {
			$intro[$i] = parseAuto($intro[$i]);
		}
		return $intro;
	}
	$retval = "";
	$retval = cb_replace("/{user.cb.([A-Za-z_]+)\}/", $intro, true);
	$retval = pf_replace("/{([A-Za-z]+)\}/", $retval);
	$retval = pf_replace("/{=([A-Za-z_]+)\}/", $retval, true);
	return $retval;
}
?>