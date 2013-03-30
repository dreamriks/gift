<?php
/**
 * @version 1.5.0 $Id: mod_rsmonials.php
 * @package Joomla 1.5.x
 * @subpackage RS-Monials Modules only for RS-Monials Component
 * @copyright (C) 2009 RS Web Solutions (http://www.rswebsols.com)
 * @license GNU/GPL
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
error_reporting(E_ALL ^ E_NOTICE);

$db =& JFactory::getDBO();
$db->setQuery("select `id` from `#__components` where `name`='RSMonials' and `enabled`='1'");
$cId = $db->loadObject();

if($cId->id > 0) {

	$widthRSM = $params->get('rsm_width', '150');
	$choiceRSM = $params->get('rsm_randchoice', '');
	$displayRSM = $params->get('rsm_display', '0');
	$charRSM = $params->get('rsm_char', '300');
	$alignRSM = $params->get('rsm_align', 'justify');
	$ismoreRSM = $params->get('rsm_moredisplay', '0');
	$morealignRSM = $params->get('rsm_morealign', 'right');
	$moretextRSM = $params->get('rsm_moretext', 'View More &gt;&gt;');
	$moreurlRSM = $params->get('rsm_moreurl', '');
	
	$choiceRSM2 = explode(',', $choiceRSM);
	foreach($choiceRSM2 as $key=>$value) {
		$choiceRSM2[$key] = trim($value);
	}
	$choiceRSM = implode(',', $choiceRSM2);
	
	$displayRSMonials = '';
	if($displayRSM == '1') {
		if($_SESSION['prevDisplayIdRSM'] > 0) {
			$prevId = $_SESSION['prevDisplayIdRSM'];
		}
		else {
			$prevId = 0;
		}
		$displayRSMonials = findProperSerialRSMonials($prevId, ''.$choiceRSM.'');
	}
	else {
		$displayRSMonials = findProperRandomRSMonials(''.$choiceRSM.'');
	}
	if($displayRSMonials['id'] > 0) {
		$RSStripComment = stripslashes($displayRSMonials['comment']);
		$RSDt = explode('-', $displayRSMonials['date']);
		$RSText = '<div id="rsm1" style="width:'.$widthRSM.'px; padding: 0 5px;">';
		$RSText .= '<div id="rsm2" style="text-align:'.$alignRSM.';"><em><strong>'.$displayRSMonials['fname'].' '.$displayRSMonials['lname'].'</strong><br /><small>Date: '.date('M d, Y', mktime(12, 0, 0, $RSDt[1], $RSDt[2], $RSDt[0])).'</small></em><br /><br />'.(($charRSM >0 ) ? ((strlen($RSStripComment) > $charRSM) ? (substr($RSStripComment, 0, ($charRSM-3)).'...') : $RSStripComment) : $RSStripComment).'</div>';
		if($ismoreRSM == '1') {
			$RSText .= '<div id="rsm3" style="padding-top:5px;text-align:'.$morealignRSM.';"><a href="'.$moreurlRSM.'" title="'.$moretextRSM.'">'.$moretextRSM.'</a></div>';
		}
		$RSText .= '<a href="'.base64_decode('aHR0cDovL3d3dy5yc3dlYnNvbHMuY29t').'"></a>';
		$RSText .= '</div>';
		echo $RSText;
		$_SESSION['prevDisplayIdRSM'] = $displayRSMonials['id'];
	}
	else {
		echo '<div id="rsm4" style="padding: 0 5px;">No Testimonial Found.</div>';
	}
}
else {
	$RSText = '<div style="color:red; padding: 0 5px;" id="rsm5">To enable this module please download and install "RS-Monials" component from <a href="http://www.rswebsols.com" target="_blank">Here</a></div>';
	echo $RSText;
}
echo '<div id="rsm6" style="padding-bottom:5px;"></div>';

function findProperSerialRSMonials($prevId=0, $choice) {
	$allRSMonials = fetchAllRSMonials($choice);
	$chkr = 0;
	for($i=0; $i<count($allRSMonials); $i++) {
		if($allRSMonials[$i]['id'] > $prevId) {
			$displayRSMonials = $allRSMonials[$i];
			$chkr = 1;
			break;
		}
	}
	if($chkr == 0) {
		$displayRSMonials = $allRSMonials[0];
	}
	return $displayRSMonials;
}

function findProperRandomRSMonials($choice) {
	$allRSMonials = fetchAllRSMonials($choice);
	$rand = rand(0, count($allRSMonials)-1);
	$displayRSMonials = $allRSMonials[$rand];
	return $displayRSMonials;
}

function fetchAllRSMonials($choice) {
	$db =& JFactory::getDBO();
	if($choice == '') {
		$db->setQuery("select * from `#__rsmonials` where `status`='1' order by `id`");
		$testimonials = $db->loadAssocList();
	}
	else {
		$db->setQuery("select * from `#__rsmonials` where `status`='1' and `id` in (".$choice.") order by `id`");
		$testimonials = $db->loadAssocList();
	}
	for($i=0; $i<count($testimonials); $i++) {
		foreach($testimonials[$i] as $key=>$value) {
			$testimonials[$i][$key] = stripslashes($value);
		}
	}
	return $testimonials;
}
?>