<?php
/**
* @version $id: class.performs.php,v 2.3
* @package performs
* @copyright (C) 2007 perForms
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @author David Walters
* @author (original) Ilhami KILIC http://www.tuwitek.at
* Joomla is Free Software
*/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
class mosForm extends mosDBTable {
  // INT(11) AUTO_INCREMENT
  var $id=null;
  // TEXT
  var $intro=null;
  //TEXT
  var $note=null;
  //VARCHAR(255)  
	var $r_url=null;  
  //VARCHAR(150)
  var $title=null;
  // DATETIME
  var $start_date=null;
  // DATETIME
  var $finish_date=null;
  // VARCHAR(150)
  var $image=null;
  // VARCHAR(36)
  var $imagefloat=null;
  // VARCHAR(100)
  var $tablename=null;
  // TINYINT(1)
  var $published=null;
  // VARCHAR(50)
  var $theme=null;
  // VARCHAR(100)
  var $from=null;
  // TEXT
  var $emails=null;
  // TINYINT(1)
  var $mailIt=null;
  // TINYINT(1)
  var $mailToAdmin=null;
  // TINYINT(1)
  var $mailToUser=null;
  // TINYINT(1)
  var $enableMailFrom=null;
  // TINYINT(1)
  var $mailAlways=null;
	//TINYINT(1)
	var $mailAsText=null;
  // TINYINT(1)
  var $useintro=null;
  // BOOL
  var $appendtimestamp=null;
   // TINYINT(1)
  var $includeSubmit=null; 
  // VARCHAR(100)
  var $submitLabel=null;
  // BOOL
  var $replaceSubmitButton=null;
  // VARCHAR(255)
  var $submitImageUrl=null;
  // INT(11)
  var $submitImageWidth=null;
  // INT(11)
  var $submitImageHeight=null;
   // TINYINT(1)
  var $includeReset=null; 
  // VARCHAR(100)
  var $resetLabel=null;
  // BOOL
  var $replaceResetButton=null;
  // VARCHAR(255)
  var $resetImageUrl=null;
  // INT(11)
  var $resetImageWidth=null;
  // INT(11)
  var $resetImageHeight=null;
  // BOOL
  var $includePF=null;
  // BOOL
  var $includePDF=null;
  // VARCHAR(255)
  var $mailSubject=null;
	/** @var int */
	var $access=null;
	/** TEXT */
	var $noAuthMessage=null;
	/** @var string */
	var $checked_out=null;
	/** @var time */
	var $checked_out_time=null;
	/** @var boolean */	
	var $strMissingFieldMsg = null;
	var $asub=null; // 1 or 2
	var $use_securityimages=null; // 0 or 1
	var $securityHelpText=null;
	var $securityErrorText=null;
	// TINYINT(1)
	var $showFormTitle=null;
	// varchar(12)
	var $formWidth=null;
	// TINYINT(1)
	var $useContainer=null;
	// TINYINT(1)
	var $attachXmlFile=null;
	var $attachXmlFileUSER=null;
  function mosForm( &$db ) {
    $this->mosDBTable( '#__performs', 'id', $db );
  }
}

class mosFormItems extends mosDBTable {
	// `itemId` int(11) NOT NULL auto_increment,
	var $itemId = null;
	// `formId` int(11) NOT NULL default '0',
	var $formId=null;
	//  `type` varchar(50) collate utf8_bin NOT NULL default '',
	var $type=null;
	//  `name` varchar(50) collate utf8_bin NOT NULL default '',
	var $name=null;
	//  `value` varchar(255) collate utf8_bin default '""',
	var $value=null;
	//  `caption` varchar(255) collate utf8_bin NOT NULL default '',
	var $caption=null;
  //  'accesskey' char(1) collate utf8_bin default ' ',
  var $accesskey=null;
	//  `required` tinyint(1) default '0',
	var $required=null;
	//  `var1` int(11) default NULL,
	var $var1=null;
	//  `var2` int(11) default NULL,
	var $var2=null;
	//  `check` varchar(50) collate utf8_bin default NULL,
	var $check=null;
	//  `help` varchar(255) collate utf8_bin default NULL,
	var $help=null;
	//  `errMsg` varchar(255) collate utf8_bin default NULL,
	var $errMsg=null;
	//  `usecaption` tinyint(1) default '0',
	var $usecaption=null;
	//  `usecaption` tinyint(1) default '0',
	var $showuploadedimage=null;
	//  `disabled` tinyint(1) default '0',
	var $disabled=null;
	//  `readonly` tinyint(1) default '0',
	var $readonly=null;
	//  `multiple` tinyint(1) default '0',
	var $multiple=null;
	//  `captionCssClass` varchar(25) collate utf8_bin NOT NULL default '',
	var $captionCssClass=null;
	//  `valueCssClass` varchar(25) collate utf8_bin NOT NULL default '',
	var $valueCssClass=null;
	//  `infoCssClass` varchar(25) collate utf8_bin NOT NULL default '',
	var $infoCssClass=null;
	//  `errorCssClass` varchar(25) collate utf8_bin NOT NULL default '',
	var $errorCssClass=null;
	//  `separator` varchar(100) collate utf8_bin default NULL,
	var $separator=null;
	//  `checkOrSelect` varchar(50) collate utf8_bin default NULL,
	var $checkOrSelect=null;
	//  `order` int(2) default '0',
	var $ordering=null;

	function mosFormItems(&$db){
		$this->mosDBTable('#__performs_items', 'itemId', $db);
	}
}

?>
