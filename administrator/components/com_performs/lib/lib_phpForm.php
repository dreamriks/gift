<?php
defined( '_VALID_MOS' ) or die( 'Restricted access' );
/***********************************************************
 *****   Copyright and author information about phpForm   ***
 ************************************************************
 ***
 **   perForms Author:        David Walters
 **   Original Author:        Simon ander
 **   Copyright by:  Simon ander
 **   Authors email: simons@email.si
 **
 **   This program is free for commercial and noncommercial
 **   use. (Hope to get some credit at St. Peter's gate:)
 **   It's licensed under GNU license.
 **
 ***
 ************************************************************
 *****                 Why to use phpForm?                ***
 ************************************************************
 ***
 **   Because I guarantee you that it will save you
 **   a lot of time, money and your nerves :). For more
 **   goodies read features section.
 ***
 ************************************************************
 *****                  Testing platforms                 ***
 ************************************************************
 ***
 **   Program was tested with folowing browsers:
 **
 **   Internet explorer 5.5
 **   Netscape Navigator 6.0
 **   Netscape Navigator 4.61
 **
 **   Works yust fine with all of them ;)
 **
 **   For beter performance and look of your forms I
 **   recomend you to use Netscape Navigator 6.x or
 **   Microsoft Internet Explorer 5.x.
 ***
 ************************************************************
 *****                      Features                      ***
 ************************************************************
 ***
 **   phpForm gives you all the freedom to create forms
 **   of your dreams :) without writing any line of PHP code
 **   to process it. It do not limit your creativity in any
 **   way.
 **
 **   - write once use manny times
 **   - easy to use
 **   - authomatic form HTML code generation from PHP array
 **   - authomatic required field checking
 **   - authomatic field content checking
 **   - HTML 4 form field syntax checking
 **   - full code separation from design
 **   - authomatic advance to ACTION page when form is
 **     entered correctly
 **   - support both POST and GET submit method
 ***
 ***********************************************************/
global $mosConfig_live_site;

require_once( "myLib.php" );
global $mosConfig_absolute_path;
if (file_exists($mosConfig_absolute_path.'/administrator/components/com_securityimages/client.php')) {
  include ($mosConfig_absolute_path.'/administrator/components/com_securityimages/client.php');
}
global $pfConfig;

if (!defined("LIB_REPLACE")) {
  require( "lib_replace.php" );
}

define ("EMAIL_MASH", "_!!_");

class phpform {
  // PUBLIC properties
  var $debug;
  var $arrForm;
  var $strMethod;
  var $strAction;
  var $strRequiredFieldMark;
  var $strMissingFieldMsg;
  var $strSkin;
  var $bolShowWarnings;
  var $strBreakOptionFields;
  var $bolIgnoreHidden;
  var $use_securityimages;
  var $securityImageHelp;
  var $securityImageError;
  var $formImage;
  var $imageFloat;
  var $replaceSubmitButton;
  var $submitImageUrl;
  var $submitImageWidth;
  var $submitImageHeight;
  var $replaceResetButton;
  var $resetImageUrl;
  var $resetImageWidth;
  var $resetImageHeight;
  var $intro;
  var $showFormTitle;
  var $captionCssClass;
  var $valueCssClass;
  var $infoCssClass;
  var $errorCssClass;
  var $GUID;
  var $tablename;
  var $formid;
  var $strFormName;

  // Constructor
  function phpform( $strFormName, $arrForm, $guid = NULL, $tableName = NULL ) {
    global $mosConfig_debug;
    // PRIVATE properties
    $this->tablename = $tableName;
    $this->GUID = $guid;
    $this->debug = $mosConfig_debug;
    $this->bolFormOK = false;
    $this->arrInputTypes = array( 'button', 'checkbox', 'file', 'hidden', 'image','select', 'password', 'radio', 'reset', 'submit', 'text', 'textarea', 'textual','date','pagebreak' );
    //		$this->arrAttrWithValues = array( 'accesskey', 'align', 'alt', 'class', 'dynsrc', 'id', 'lang', 'language', 'lowsrc', 'maxlength', 'name', 'size', 'src', 'style', 'tabindex', 'title', 'type', 'value', 'event', "rows", "cols", "wrap" );
    $this->arrAttrWithValues = array( 'accesskey', 'align', 'alt', 'class', 'dynsrc', 'id', 'lang', 'language', 'lowsrc', 'maxlength', 'name', 'size', 'src', 'captionCssClass', 'valueCssClass', 'infoCssClass', 'errorCssClass', 'style', 'tabindex', 'title', 'type', 'value', 'event', "rows", "cols", "wrap" );
    $this->arrAttrEvents = array( 'onabort','onafterupdate','onbeforeunload','onbeforeupdate','onblur','onbounce','onchange','onclick','ondataavailable','ondatasetchanged','ondatasetcomplete','ondblclick','ondragstart','onerror','onerrorupdate','onfilterchange','onfinish','onfocus','onhelp','onkeydown','onkeypress','onkeyup','onload','onmousedown','onmousemove','onmouseout','onmouseover','onmouseup','onreadystatechange','onreset','onresize','onrowenter','onrowexit','onscroll','onselect','onselectstart','onstart','onsubmit','onunload' );
    $this->arrAttrWithoutValues = array( 'disabled', 'readonly', 'multiple', 'checked', 'selected' );
    $this->arrPHPFormAttr = array( 'caption', 'separator', 'required', 'usecaption', 'showuploadedimage', 'useintro', 'options', 'help', 'check', 'minlength', 'lCellAtt', 'rCellAtt', 'errMsg', 'accesskey', );
    $this->arrInputSelectType = array( 'radio' => 'checked', 'select' => 'selected', 'checkbox' => 'checked' );
    $this->arrValuesTypes = array( 'string', 'name', 'float', 'integer', 'email', 'url' );
    $this->bolFrmSubmited = false;
    $this->strAuthorName	= "Simon ander";			// please never change this!! aww - ok :)
    $this->strAuthorEmail	= "simon@vizija.si";  // please never change this!!
    $this->strVersion			= "1.0.9";						// please never change this!!
    $this->strHomePage		= "http://phpform.sourceforge.net";		// please never change this!!

    // PUBLIC properties
    $this->arrForm = $arrForm;
    $this->strMethod = "post";
    $this->strRequiredFieldMark = '<span class="performs_required"> *</span>';
    $this->strMissingFieldMsg = PLEASE_FILL_OUT;
    $this->strFormName = $strFormName;
    $this->bolShowWarnings = true;
    $this->strBreakOptionFields = true;
    $this->bolIgnoreHidden = false;
    $this->use_securityimages=false;
    //		$this->securityImageHelp="Enter what you see";
    //		$this->securityImageError="The code is wrong";
    $this->formImage="";
    $this->imageFloat="";
    $this->intro="";
  }

  // Displays warning message and terminate program if it's necessary
  function warning( $strMessage, $strLevel = 1 ) {
    $this->bolFormOK = false;
    if ( $this->bolShowWarnings ) {
      echo "Warning: $strMessage\n<br>";
    }
    if ( $strLevel == 0 ) {
      exit;
    }
  }

  // generate HTML 4 atribute list for input field
  function attributes( $arrAttributes ) {
    //    global $mosConfig_debug, $my;
    $strAttributes = "";
    foreach( $arrAttributes as $strAttrName => $strAttrValue ) {
      if ( in_array( $strAttrName, $this->arrAttrWithValues ) ) {
        $strAttributes .= " $strAttrName=\"$strAttrValue\"";
      } elseif ( in_array( $strAttrName, $this->arrAttrWithoutValues ) ) {
        $strAttributes .= " $strAttrName";
      } elseif ( in_array( $strAttrName, $this->arrAttrEvents ) ) {
        $strAttributes .= " $strAttrName=\"$strAttrValue\"";
      } elseif ( !in_array( $strAttrName, $this->arrPHPFormAttr ) ) {
        $this->warning( "Wrong/unknown attribute '".$strAttrName."'.", 0 );
      }
    }
    return $strAttributes;
  }

  // generate option list
  function options( $arrAttr, &$acc_id ) {
    $strOptions = "";
    switch( $arrAttr['type'] ) {
      case "select":
        foreach( $arrAttr['options'] as $strOptionName => $arrAttributes ) {
          if ( count( $arrAttributes ) > 1 ) {
            $strOptions .= "<option value=\"$arrAttributes[0]\" $arrAttributes[1]>$strOptionName</option>\n";
          } else {
            $strOptions .= "<option value=\"$arrAttributes[0]\">$strOptionName</option>\n";
          }
        }
        break;
      case "radio": case "checkbox":
        $strAttributes = $this->attributes( $arrAttr );
        $attrcnt = 0;
        foreach( $arrAttr['options'] as $strRadioName => $arrRadioAttributes ) {
          $attrcnt++;
          if ( $this->strBreakOptionFields ) {
            $strBR = "<br>";
          } else {
            $strBR = "";
          }
          $strOptions .=
            '<input'.$strAttributes.' id="PF'.$acc_id.'" '
            .(($arrAttr['type'] === 'checkbox') ? 'tabindex="'.$acc_id.'"' :
            (($attrcnt > 0) ? 'tabindex="'.$acc_id.'"' : ""))
            .' value="'.$arrRadioAttributes[0].'" '
            .((count($arrRadioAttributes) > 1) ? $arrRadioAttributes[1] : "")
            .'><label for="PF'.$acc_id.'"><span class="'.$arrAttr['type'].'accesskey">'
            .substr($strRadioName,0,1).'</span>'.substr($strRadioName,1)
            .'</label>'.$strBR."\n";
            $acc_id++;
        }
        if ( $this->strBreakOptionFields ) {
          $strOptions = substr( $strOptions, 0, -5 );
        }
        break;
      default:
        $this->warning( "Invalid type ".$arrAttr['type'], 0 );
        break;
    }
    return $strOptions;
  }

  // checks if the required fields are filed in and if they are filed in correctly
  function checkField( $arrAttributes ) {
    $strRes = "";
    switch ( $arrAttributes['type'] ) {
      case "select": case "radio": case "checkbox":
        if ( array_key_exists('required', $arrAttributes) ) {
          $strTmp = $this->getFieldName( $arrAttributes['name'] );
          $strVal = array();
          if ( isset( $strTmp ) ) {
            $strVal = $this->arrSubmitedFields[$strTmp];
          }
          if ( count( $strVal ) == 0 ) {
            $strRes = parseAuto($arrAttributes['errMsg']);
            if ($strRes == "") $strRes = $this->strMissingFieldMsg;
            $this->warning( "Missing value in this field '".$arrAttributes['name']."'." );
          }
        }
        break;
      case 'file':
        //must check the file type isn't a naughty file
        if (!IsValidFile($_FILES[$arrAttributes['name']]['name'])) {
          $strRes = "File Type not allowed!";
          $this->warning( "Naughty value in this field '".$arrAttributes['name']."'." );
        }
        // file items don't have a value, we need to check the $_FILES array
        if ( isset( $arrAttributes['required'] ) && ($_FILES[$arrAttributes['name']]['error'] > 0) ) {
          $strRes = $this->strMissingFieldMsg;
          $this->warning( "Missing value in this field '".$arrAttributes['name']."'." );

          switch ($_FILES[$arrAttributes['name']]['error']) {
            case 0:
              break;
            case 1:
              $strRes =  UPLOAD_ERROR_1;
              break;
            case 2:
              $strRes =  UPLOAD_ERROR_2;
              break;
            case 3:
              $strRes =  UPLOAD_ERROR_3;
              break;
            case 4:
              $strRes =  UPLOAD_ERROR_4;
              break;
            case 5:
              $strRes =  UPLOAD_ERROR_5;
              break;
            case 6:
              $strRes =  UPLOAD_ERROR_6;
              break;
            case 7:
              $strRes =  UPLOAD_ERROR_7;
              break;
            default:
              $strRes = $this->strMissingFieldMsg;
              $this->warning( "Missing value in this field '".$arrAttributes['name']."'." );
              break;
          }
        }

        break;
            case 'textual':
              // ignore textual fields
              break;
            default:
              //        if ( isset( $arrAttributes['required'] ) && empty( $arrAttributes['value'] ) ) {
              //					$strRes = $this->strMissingFieldMsg;
              if ( isset( $arrAttributes['required'] ) && empty( $arrAttributes['value'] ) ) {
                $strRes = $arrAttributes['errMsg'];
                if ($strRes == "") $strRes = $this->strMissingFieldMsg;
                $this->warning( "Missing value in this field '".$arrAttributes['name']."'." );
              }
              break;
    }
    $strCheck = "";
    if ( isset( $arrAttributes['check'] ) && !empty( $arrAttributes['value'] ) ) {
      switch( $arrAttributes['check'] ) {
        case TY_STRING:
          if ( !isString( $arrAttributes['value'] ) ) {
            $strCheck = $arrAttributes['errMsg'];
          }
          break;
        case TY_NAME:
          if ( !isName( $arrAttributes['value'] ) ) {
            $strCheck = $arrAttributes['errMsg'];
            $this->warning( "Wrong value in this field '".$arrAttributes['name']."'." );
          }
          break;
        case TY_FLOAT:
          if ( !isFloat( $arrAttributes['value'] ) ) {
            $strCheck = $arrAttributes['errMsg'];
            $this->warning( "Wrong value in this field '".$arrAttributes['name']."'." );
          }
          break;
        case TY_INTEGER:
          if ( !isInteger( $arrAttributes['value'] ) ) {
            $strCheck = $arrAttributes['errMsg'];
            $this->warning( "Wrong value in this field '".$arrAttributes['name']."'." );
          }
          break;
        case TY_EMAIL:
          if ( !isEmail( str_replace(EMAIL_MASH, "@", $arrAttributes['value']) ) ) {
            $strCheck = $arrAttributes['errMsg'];
            $this->warning( "Wrong value in this field '".$arrAttributes['name']."'." );
          }
          break;
        case TY_URL:
          if ( !isValidUrl( $arrAttributes['value'] ) ) {
            $strCheck = $arrAttributes['errMsg'];
            $this->warning( "Wrong value in this field '".$arrAttributes['name']."'." );
          }
          break;
        default:
          $this->warning( "Invalid checking type '".$arrAttributes['check']."'." );
          break;
      }
    }
    if ( !empty( $strRes ) ) {
      $strRes = "<div class=\"performs_error\" >$strRes</div>";
    }
    if ( !empty( $strCheck ) ) {
      $strCheck = "<div class=\"performs_error\" >$strCheck</div>";
    }
    $parsedStr = parseAuto($strRes.$strCheck);
    return $parsedStr;
    //		return $strRes.$strCheck;
  }

  // Checks for submit button in the form, and returns it's position in array
  function checkForSubmitBtn( &$strSubmitBtnName ) {
    $bolRes = false;
    foreach( $this->arrForm as $arrAttributes ) {
      if ( strcasecmp( $arrAttributes['type'], "submit" ) == 0 ) {
        // submit button found
        $strSubmitBtnName = $arrAttributes['name'];
        $bolRes = true;
        break;
      }
    }
    if ( !$bolRes ) {
      $this->warning( "There is no submit button in this form." );
    }
    return $bolRes;
  }

  // convert form results into PHP array
  function formToArray() {
    //global $pfDebug;
    $pfDebug = false;
    $arrRes = array();
    if ($pfDebug) print '<hr><div style="padding: 24pt;"><h1>formToArray</h1>';
    foreach( $this->arrForm as $strKey => $arrAttributes ) {
      $rawelementname = $arrAttributes['name']; //element name may contain []
      $elementname = $rawelementname;//remove []
      if (isset($arrAttributes['separator'])) $arrAttributes['separator'] = translateSeparator($arrAttributes['separator']);
      if ($pfDebug) {
        echo '<hr><div style="border: thin solid black; background-color: gray; color: white;"><div><span><code><b>name:</b></code></span> <span><code>'.$elementname.'</code></span></div></div>';
        echo '<div style="border: thin black dashed;"><div>type='.$arrAttributes['type'].'</div>';
      }
      switch( $arrAttributes['type'] ) {
        case "select": case "radio": case "checkbox":
          $strFieldName = $this->getFieldName( $elementname );
          if (array_key_exists($strFieldName, $this->arrSubmitedFields)) {
            $arrRes[$strFieldName] =	array(
                                            "type"   => $arrAttributes['type'],
                                              "value"		=> parseAuto($this->arrSubmitedFields[$strFieldName]),
                                              "separator"	=> strip_tags( $arrAttributes['separator'] ),
                                              "caption"	=> strip_tags( $arrAttributes['caption'] ),
                                              "usecaption"=> $arrAttributes['usecaption'],
																							"captionCssClass" => $arrAttributes['captionCssClass']
            );
            if ($pfDebug) {
              echo "<div style=\"color:red; background-color: wheat;\">formToArray: TYPE: ".$arrAttributes['type']." VALUE: ".array_values($this->arrSubmitedFields[$strFieldName])."</div>";
              echo "formToArray: (ELEMENT VALUE EXISTS) TYPE: ".$arrAttributes['type']." VALUE: ".$this->arrSubmitedFields[$strFieldName];
            }
          } else {
            if ($pfDebug) {
              echo "<div style=\"color:red; background-color: wheat;\">formToArray: TYPE: ".$arrAttributes['type']." VALUE: <tt>(null)</tt></div>";
            }
            $arrRes[$strFieldName] =	array(
                                            "type"   => $arrAttributes['type'],
                                              "value"		=> "",
                                              "separator"	=> strip_tags( $arrAttributes['separator'] ),
                                              "caption"	=> strip_tags( $arrAttributes['caption'] ),
                                              "usecaption"=> $arrAttributes['usecaption'],
																							"captionCssClass" => $arrAttributes['captionCssClass']
            );
            if ($pfDebug) {
              echo "formToArray: (ELEMENT VALUE DOES NOT EXIST) TYPE: ".$arrAttributes['type']." VALUE: <tt>(null)</tt>";
            }
          }
          break;
        case "submit": case "reset": case "button":	/*case 'textual':*/
          // ignore those fields
          break;
        case "text":
          if ($pfDebug) {
            echo '<div>strCaption='.strip_tags( $arrAttributes['caption'] ).'</div>';
            echo '<div>value='.$this->arrSubmitedFields[$elementname].'</div>';
          }
          $strCaption = strip_tags( $arrAttributes['caption'] );
          $theVal = isset($this->arrSubmitedFields[$elementname]) ? parseAuto($this->arrSubmitedFields[$elementname]) : "";
          $arrRes[$arrAttributes['name']] =	array(
                                            "type"   => $arrAttributes['type'],
                                                    "value"		=> $theVal,
                                                    "caption"	=> strip_tags( parseAuto($strCaption) ),
                                                    "separator"	=> strip_tags( $arrAttributes['separator'] ),
                                                    "usecaption"=> $arrAttributes['usecaption'],
																							"captionCssClass" => $arrAttributes['captionCssClass']
          );
          break;
        case "file":
          $strCaption = strip_tags( $arrAttributes['caption'] );
          $tmpfilename = basename($_FILES[$arrAttributes['name']]['name']);
          global $mosConfig_live_site, $my;
          if (!$_FILES[$arrAttributes['name']]['error']) {
            $uploaddir = $mosConfig_live_site.'/media/uploads/';
            if (isset($arrAttributes['value'])) {
              global $mosConfig_absolute_path;
              $uploaddir =
              str_replace($mosConfig_absolute_path, $mosConfig_live_site, $arrAttributes['value']);
            }
            $uploadfile = $uploaddir
            . date('Y-m-d-H-i') . "-" . ($my->name == "" ? "Unknown-" : $my->name . "-")
            . $tmpfilename;
            if ($arrAttributes['showuploadedimage']) {
              $tmpfilename =
                "<img src=\""
                . $uploadfile . '" alt="'.$tmpfilename.'" style="width:100%;"/>';
            } else {
              $tmpfilename =
                '<a href="'
                . $uploadfile . '">' . $uploadfile . "</a>";
            }
          } else {
            $tmpfilename = "Failed to upload!";
            switch ($_FILES[$arrAttributes['name']]['error']) {
              case 1:
                $tmpfilename =  upload_error($_FILES[$arrAttributes['name']]['error'], UPLOAD_ERROR_1, UPLOAD_ERROR_1_INFO);
                break;
              case 2:
                $tmpfilename =  upload_error($_FILES[$arrAttributes['name']]['error'], UPLOAD_ERROR_2, UPLOAD_ERROR_2_INFO);
                break;
              case 3:
                $tmpfilename =  upload_error($_FILES[$arrAttributes['name']]['error'], UPLOAD_ERROR_3, UPLOAD_ERROR_3_INFO);
                break;
              case 4:
                //                  $tmpfilename =  upload_error($_FILES[$arrAttributes['name']]['error'], UPLOAD_ERROR_4, UPLOAD_ERROR_4_INFO);
                $tmpfilename =  UPLOAD_ERROR_4;
                break;
              case 5:
                $tmpfilename =  upload_error($_FILES[$arrAttributes['name']]['error'], UPLOAD_ERROR_5, UPLOAD_ERROR_5_INFO);
                break;
              case 6:
                $tmpfilename =  upload_error($_FILES[$arrAttributes['name']]['error'], UPLOAD_ERROR_6, UPLOAD_ERROR_6_INFO);
                break;
              case 7:
                $tmpfilename =  upload_error($_FILES[$arrAttributes['name']]['error'], UPLOAD_ERROR_7, UPLOAD_ERROR_7_INFO);
                break;
              default:
                break;
            }
          }
          $arrRes[$arrAttributes['name']] =	array(
                                            "type"   => $arrAttributes['type'],
                                        "value"		=> $tmpfilename,
                                        "caption"	=> strip_tags( $strCaption ),
                                        "separator"	=> strip_tags( $arrAttributes['separator'] ),
                                        "usecaption"=> $arrAttributes['usecaption'],
																							"captionCssClass" => $arrAttributes['captionCssClass']
          );
          break;
              default:
                if ($pfDebug) {
                  echo '<hr><h3>default:</h3><div style="background-color:wheat;color:maroon;padding:12pt;">';
                  echo $arrAttributes['type'];
                  echo '</div>';
                }
                if ( ( $arrAttributes['type'] == 'hidden' ) && $this->bolIgnoreHidden ) {
                  # ignore hidden fields
                  continue;
                }
                if ( $arrAttributes['type'] == 'hidden' ) {
                  $strCaption = $arrAttributes['name'];
                } else {
                  //$strCaption = parseAuto(strip_tags( $arrAttributes['caption'] ));
                }
                $strSeparator = '';
                $strUseCaption = '';
                if (array_key_exists("separator", $arrAttributes)) {
                  $strSeparator = strip_tags( $arrAttributes["separator"] );
                }
                if (array_key_exists("usecaption", $arrAttributes)) {
                  $strUseCaption = $arrAttributes['usecaption'];
                }

                $val = "";
                if (isset($this->arrSubmitedFields[$elementname])) {
                  $val = $this->arrSubmitedFields[$elementname];
                }

                $arrRes[$arrAttributes['name']] =	array(
                                            "type"   => $arrAttributes['type'],
                                            "value"		=> parseAuto($val),
                                            "caption"	=> strip_tags( (($arrAttributes['type']!="hidden") ? $arrAttributes['caption'] : "") ),
                                            "separator"	=> $strSeparator,
                                            "usecaption"=> $strUseCaption
                );

                break;
      }
      if ($pfDebug) {
        echo "</div>";
      }
    }
    if ($pfDebug) {
      echo "</div>";
    }
    return $arrRes;
  }

  // Convert form results into HTML table
  function formToTable() {
    global $pfDebug, $mosConfig_live_site;
    $strStyle = "<style type=\"text/css\">";
    $strStyle .= "td { padding-right: 12pt; }";
    $strStyle .= "th { background-color: aliceblue; color: navy; }";
    $strStyle .= "</style>";
    $strRes = $strStyle."<table border=\"1\">";
    $sep="";
    $sep2="";
    $strRes .= "<tr><th>Item</th><th>Value</th></tr>\n";

    $arr = $this->formToArray();
//    if ($pfDebug) {
//      echo "<pre>";
//      print_r($arr);
//      echo "</pre>";
//    }
    foreach( $arr as $strKey => $strVal ) {
      if (isset($strVal['value'])) $strRes .= '<tr>';
      $sep2=$sep;
      if($strKey=="formid")
      continue;
      if (isset ($strVal['type'])) {
        if ($strVal['type'] == "textual") {
          $strRes .= "<td colspan=2 style=\"background-color: lavenderblush;\">".parseAuto($strVal['caption'])."</td>";
        }
      }
      $caption = strip_tags( $strVal['caption'] );
      $endline = SEP_NEWLINE;
      if ( is_array( $strVal['value'] ) ) {
        if ( $strVal['usecaption'] ) {
          $strRes .= '<td>'.$caption."</td>";
        }
        $endline = $strVal['separator'];
        $sep = $strVal['separator'];
        //        switch ($endline)
        //        {
        //          case SEP_SPACE:
        //            $sep = " ";
        //            break;
        //          case SEP_COMMA:
        //            $sep = ",";
        //            break;
        //          case SEP_COMMASPACE:
        //            $sep = ", ";
        //            break;
        //          case SEP_HYPHEN:
        //            $sep = "-";
        //            break;
        //          case SEP_NEWLINE:
        //          default:
        //            $sep = "\n";
        //            break;
        //        }
        $strRes .= '<td style="text-align:right;"><pre>'.implode( $sep, $strVal['value'] ).'</pre></td>';
        }
        else {
          if ( !empty( $strVal['value'] ) ) {
            if ( $strVal['usecaption'] ) {
              $strRes .= '<td>'.$caption."</td>";
            } else {
              $strRes .= "<td></td>";
            }
            $endline = $strVal['separator'];
            $strRes .= '<td>'.parseAuto($strVal['value']).'</td>';
          }
        }
        $strRes .="</tr>\n";
      }
      $strRes .= '</table>';

      return stripslashes($strRes);
    }

    function formToXml() {
      $itemsXML = "<items>".PHP_EOL;
      foreach ($this->formToArray() as $itemname => $ite) {
        if ($itemname == "formid") continue;
        if (!isset($ite['value'])) continue;
        $itemtype = $ite['type'];
        if ($itemtype == 'textual') continue;
        $itemval = $ite['value'];
        $itemsXML .= "    <" . $itemname . ">";
        if (is_array($itemval)) {
          $sep = $ite['separator'];
          $cnt = count($itemval);
          foreach ($itemval as $itm) {
            $cnt--;
            $itemsXML .= $itm;
            if ($cnt > 0) $itemsXML .= $sep;
          }
        } else {
          $itemsXML .= $itemval;
        }
        $itemsXML .= "</" . $itemname . ">" . PHP_EOL;
      }
      $itemsXML .= "  </items>".PHP_EOL;

      $submitdate = date("Y-m-d H:i:s");
      //$submitdate = date(DATE_ATOM);

      return sprintf(
'<form id="%s" submitDate="%s" userIP="%s">%s  %s</form>', $this->formid, $submitdate, $_SERVER['REMOTE_ADDR'], PHP_EOL, $itemsXML, PHP_EOL);
    }


    // Convert form results into plain text
    function formToText() {
      $strRes = "";
      $sep="";
      $sep2="";
      $arr = $this->formToArray();
      foreach( $arr as $strKey => $strVal ) {
        $sep2=$sep;
        if($strKey=="formid")
        continue;
        $caption = strip_tags( $strVal['caption'] );
        $endline = "newline";
        if ( is_array( $strVal['value'] ) ) {
          if ( $strVal['usecaption'] ) {
            $strRes .= $caption.": ";
          }
          $endline = $strVal['separator'];
          $strRes .= implode( ",", $strVal['value'] );
        }
        else {
          if ( !empty( $strVal['value'] ) ) {
            if ( $strVal['usecaption'] ) {
              $strRes .= $caption.": ";
            }
            $endline = $strVal['separator'];
            $strRes .= $strVal['value'];
          }
        }
        switch ($endline)
        {
          case SEP_SPACE:
            $sep = " ";
            break;
          case SEP_COMMA:
            $sep = ",";
            break;
          case SEP_COMMA_SPACE:
            $sep = ", ";
            break;
          case SEP_HYPHEN:
            $sep = "-";
            break;
          case SEP_NEWLINE:
          default:
            $sep = "\n";
            break;
        }
        $strRes .=$sep2."\n";
      }
      return stripslashes($strRes);
    }

    // Convert form results into CSV text
    function formToCSV( $strDelimiter = ";", $strText = '"' ) {
      foreach( $this->formToArray() as $strKey => $strVal ) {
        if ( is_array( $strVal['value'] ) ) {
          $strRes .= $strText.implode( ",", $strVal['value'] ).$strText;
        } else {
          if ( !isset( $strVal['value'] ) && empty( $strVal['value'] ) ) {
            $strRes .= $strText.$strText;
          } else {
            $strRes .= $strText.$strVal['value'].$strText;
          }
        }
        $strRes .= $strDelimiter;
      }
      $strRes = substr( $strRes, 0, -1 );
      return $strRes;
    }

    // save form results into plain text file
    function formToFile( $strFileName ) {
      if ( empty( $strFileName ) || !isset( $strFileName ) ) {
        $this->warning( "You must set the name of the file to save form result to.", 0 );
      }
      if ( $objFile = fopen( $strFileName, 'w+' ) ) {
        fwrite( $objFile, $this->formToText() );
        fclose( $objFile );
        return true;
      } else {
        return false;
      }
    }

    // generate SQL insert query from form result
    //function formToSQLInsert( $strTableName ) {
    function formToSQLInsert() {
      //		if ( empty( $strTableName ) || !isset( $strTableName ) ) {
      if ( empty( $this->tablename ) || !isset( $this->tablename ) ) {
        $this->warning( "You must set the name of the table into which the form data will be inserted.", 0 );
      }
      $arr = $this->formToArray();
      $strFields = "";
      $strValues = "";
      foreach( $arr as $strKey => $strVal ) {
        if($strKey=="formid")
        continue;

        if ($strVal['type'] == "textual") continue;
         
        if (isset($strVal['check'])) {
          if ($strVal['check'] == "email") {
            $mashedval = $strVal['value'];
            $strVal['value'] = str_replace(EMAIL_MASH, "@", $mashedval);
          }
        }
         
        if ($strKey == "replyto") {
          $mashedval = $strVal['value'];
          $strVal['value'] = str_replace(EMAIL_MASH, "@", $mashedval);
        }
         
        $strFields .= "`$strKey`,";
         
        if ( is_array( $strVal['value'] ) ) {
          //				$strValues .= "'".mysql_escape_string(implode( ",", $strVal['value'] ))."',";
          $strValues .= "'".mysql_escape_string(implode( PF_RECORD_SEPARATOR, $strVal['value'] ))."',";
        } else {
          $strValues .= "'".mysql_escape_string($strVal['value'])."',";
        }
      }
      $strFields .=" `UserIp`, ";
      $strValues .= " '".$_SERVER['REMOTE_ADDR']."',";

      $strFields .=" `GUID` ";
      $strValues .= " '".$this->GUID."'";
      return "INSERT INTO `$this->tablename` ( $strFields ) VALUES ( $strValues );";
    }

    // generate SQL UPDATE query from form result
    function formToSQLUpdate() {
      if ( empty( $this->tablename ) || !isset( $this->tablename ) ) {
        $this->warning( "You must set the name of the table in which the form data will be updated.", 0 );
      }
      foreach( $this->formToArray() as $strKey => $strVal ) {
        if ($strVal['type'] == "textual") continue;
        if ( is_array( $strVal['value'] ) ) {
          //				$strValues = implode( ",", $strVal['value'] );
          $strValues = implode( PF_RECORD_SEPARATOR, $strVal['value'] );
        } else {
          $strValues = $strVal['value'];
        }
        $strFields .= "$strKey='$strValues',";
      }
      $strFields = substr( $strFields, 0, -1 );
      $strValues = substr( $strValues, 0, -1 );
      return "UPDATE $this->tablename SET $strFields;";
    }

    // sends form to email
    function formToEmail( $strFromName, $strFromEmail,
    $strReplyToName, $strReplyToEmail,
    $strToEmail, $strSubject, $strMessage,
    $appendTimeStamp, $strCC=NULL, $strBCC=NULL, $showLink=false, $attachXmlFile = false ) {
      global $pfDebug, $mosConfig_live_site;
      $strReplyToEmail = str_replace(EMAIL_MASH, "@", $strReplyToEmail);
      $strToEmail = str_replace(EMAIL_MASH, "@", $strToEmail);
      if ($strCC == "") $strCC = NULL;
      if ($strBCC == "") $strBCC = NULL;
      //Add the date and time to create something unique
      if ($appendTimeStamp == 1) {
        $strSubject .= " - ".date('Y-m-d H:i:s');
      }
      if ($pfDebug) {
        echo
    '<br /><span style="color: maroon; font-size: x-large;">formToEmail</span><hr>'
    .'<div>strFromName = '.$strFromName.'</div>'
    .'<div>strFromEmail = '.$strFromEmail.'</div>'
    .'<div>strReplyToEmail = '.$strReplyToEmail.'</div>'
    .'<div>strReplyToName = '.$strReplyToName.'</div>'
    .'<div>strToEmail = '.$strToEmail.'</div>'
    .'<div>strSubject = '.$strSubject.'</div>';
      }
      $strToEmail = explode( ',', str_replace( ' ', '', $strToEmail ) );
      $message = strtr($strMessage, array_flip(get_html_translation_table(HTML_SPECIALCHARS, ENT_QUOTES)));
      $sendHTMLMail = ! $this->mailAsText;
      if ($sendHTMLMail) {
        $form2text = parseAuto($strMessage).$this->formToTable();
      } else {
        $form2text = parseAuto($strMessage).$this->formToText();
      }

      if ($showLink) {
        $dataHref = $mosConfig_live_site
        . @"/administrator/index2.php?option=com_performs&task=ViewSubmission&hidemainmenu=1&GUID="
        .$this->GUID."&formid=".$this->formid;
        $form2text .= @"
		<hr><pre>
		To view the database data for this submission, follow the link below:
		<a href=" . '"' . $dataHref .'"> ' 
		. $this->tablename . "["
		. $this->GUID . "]"
		.' </a></pre>';
      }
      if ($pfDebug) {
        echo '<hr><div>$formToTable = <div style="padding:24pt;"><pre>';
        echo $form2text;
        echo '</pre></div></div>';
      }

      $fnam = NULL;
      if ($attachXmlFile) {
        $xmlFileContents = $this->formToXml();
        if ($pfDebug) {
          echo '<hr /><div style="padding:24pt;"><pre>';
          echo htmlentities($xmlFileContents);
          echo '</pre></div>';
        }
        //			$fnam = tempnam("/tmp", "form-") . ".xml";
        $fnam = "/tmp/" . $this->strFormName . ".xml";
        $fid = fopen($fnam, 'w');
        fwrite($fid, $xmlFileContents);
        fclose($fid);
      }

      if ($pfDebug) {
        echo
    '<br /><span style="color: maroon; font-size: x-large;">/formToEmail</span><hr>'
    .'<div>strFromName = '.$strFromName.'</div>'
    .'<div>strFromEmail = '.$strFromEmail.'</div>'
    .'<div>strReplyToEmail = '.$strReplyToEmail.'</div>'
    .'<div>strReplyToName = '.$strReplyToName.'</div>'
    .'<div>strToEmail = '.print_r($strToEmail, TRUE).'</div>'
    .'<div>strSubject = '.$strSubject.'</div>';
      }

      $mailret = mosMail( $strFromEmail, $strFromName, $strToEmail, $strSubject, $form2text, $sendHTMLMail, $strCC, $strBCC, $fnam, $strReplyToEmail, $strReplyToName );

      if ($fnam != NULL) unlink($fnam);

      return $mailret;
    }

    // get's the array of submited fields
    function getSubmitArray() {
      return $_REQUEST;
    }

    // Checks if form was submited
    function formSubmited() {
      $this->checkForSubmitBtn( $strSubmitBtnName );
      $this->bolFrmSubmited = false;
      $this->arrSubmitedFields = $this->getSubmitArray();
      if ( isset( $this->arrSubmitedFields[$strSubmitBtnName] ) ) {
        $this->bolFrmSubmited = true;
      }
      return $this->bolFrmSubmited;
    }

    // get plain field name without [] for example.
    function getFieldName( $strFieldName ) {
      if ( eregi( "(.*)(\[\])", $strFieldName, $arrPat ) ) {
        return $arrPat[1];
      } else {
        $this->warning( "getFieldName - Field name mismatch '".$strFieldName."'.", 0 );
        return false;
      }
    }

    /**
     *	@description returns the value of specified field
     * @param $strFieldName - name of the form field
     * @return mixed - value of the field
     */
    function getFieldValue( $strFieldName ) {
      $arrData = $this->formToArray();
      foreach( $arrData as $strKey => $strValue ) {
        if ( strcmp( strtolower($strKey), strtolower($strFieldName) ) == 0 ) {
          return $strValue["value"];
        }
      }
      $this->warning( "getFieldValue - Field name mismatch '".$strFieldName."'." );
      return false;
    }

    function replaceVars( $str ) {
      global $pfDebug;
      if ($pfDebug) echo '<div style="padding:24pt;"><h1>replaceVars</h1><table>';
      $arrData = $this->formToArray();
      foreach( $arrData as $strKey => $strValue ) {
        if ( is_array( $strValue["value"] ) ) {
          $strRes=",";
          switch ($strValue["separator"])
          {
            case SEP_SPACE:
              $strRes = " ";
              break;
            case SEP_COMMA:
              $strRes = ",";
              break;
            case SEP_COMMASPACE:
              $strRes = ", ";
              break;
            case SEP_HYPHEN:
              $strRes = "-";
              break;
            case SEP_NEWLINE:
            default:
              $strRes = "\n";
              break;
          }
          $res = implode($strRes,$strValue["value"]);
          if ($pfDebug) echo '<tr><td><b>$res:</b></td><td>'.$res.'</td></tr>';
          $str = preg_replace("/(\{$strKey\})/i",$res,$str);
          if ($pfDebug) echo '<tr><td><b>$str:</b></td><td>'.$str.'</td></tr>';
        } else {
          $str = preg_replace("/(\{$strKey\})/i",$strValue["value"],$str);
        }
      }
      $str = preg_replace("/(\{userip\})/i",$_SERVER['REMOTE_ADDR'],$str);
      if ($pfDebug)	echo '</table></div>';
      $str = parseAuto($str);
      return $str;
    }

    // read the submited values and stores them into form array
    function rememberFormFields() {
      global $pfDebug;
      foreach( $this->arrForm as $strKey => $arrAttributes ) {
        switch( $arrAttributes['type'] ) {
          case "select": case "radio": case "checkbox":
            if (array_key_exists($this->getFieldName( $arrAttributes['name'] ),$this->arrSubmitedFields)) {
              $arrSubmitedFields = $this->arrSubmitedFields[$this->getFieldName( $arrAttributes['name'] )];
              if ( count( $arrSubmitedFields ) > 0 ) {
                foreach( $arrSubmitedFields as $strSubmitedFieldValue ) {
                  foreach( $arrAttributes['options'] as $arrOptions => $arrOptionAttributes ) {
                    if ( strcasecmp( $arrOptionAttributes[0], $strSubmitedFieldValue ) == 0 ) {
                      $this->arrForm[$strKey]['options'][$arrOptions][1] = $this->arrInputSelectType[$arrAttributes['type']];
                    }
                  }
                }
              }
              foreach( $arrAttributes['options'] as $arrOptions => $arrOptionAttributes ) {
                if ( $arrSubmitedFields ) {
                  if ( !in_array( $arrOptionAttributes[0], $arrSubmitedFields ) ) {
                    unset( $this->arrForm[$strKey]['options'][$arrOptionAttributes[0]][1] );
                  }
                } else {
                  unset( $this->arrForm[$strKey]['options'][$arrOptionAttributes[0]][1] );
                }
              }
            } else {
              if ($pfDebug) echo '<div style="color:red;">rememberFormFields(): Not a valid element: '.$this->getFieldName( $arrAttributes['name'] ).'</div>';
            }
            break;
          case "submit": case "button": case "reset": case 'textual':
            // don't remeber values in this field
            break;
          case 'file':
            $tmpfilename = $arrAttributes['name'];
            switch($_FILES[$tmpfilename]['error']) {
              case 0:
                if ($pfDebug) {
                  echo "<pre>";
                  echo "NAME: ".$tmpfilename . "\n";
                  echo "FILENAME: ". $_FILES[$tmpfilename]['name'] . "\n";
                  echo "TYPE: ". $_FILES[$tmpfilename]['type'] . "\n";
                  echo "SIZE: ". $_FILES[$tmpfilename]['size'] . "\n";
                  echo "TMP_NAME: ". $_FILES[$tmpfilename]['tmp_name'] . "\n";
                  echo "ERROR: ". $_FILES[$tmpfilename]['error'] . "\n";
                  echo "PATH: " .$arrAttributes['value'] . "\n";
                  print_r($arrAttributes);
                  echo "</pre>";
                }
                // In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
                // of $_FILES.
                global $mosConfig_absolute_path;
                $uploaddir = $mosConfig_absolute_path.'/media/uploads/';
                if (isset($arrAttributes['value'])) {
                  $uploaddir = $arrAttributes['value'];
                }
                if ($pfDebug) echo "<pre>PATH: " .$arrAttributes['value'] . " ($uploaddir)\n</pre>";
                if (!file_exists($uploaddir)) {
                  if (!mkdir($uploaddir, 0775)) {
                    report_error(-71, ERROR_71, ERROR_71_INFO);
                    return;
                  } else {
                  }
                }
                global $my;
                $uploadfile = $uploaddir
                . date('Y-m-d-H-i') . "-" . ($my->name == "" ? "Unknown-" : $my->name . "-")
                . basename($_FILES[$tmpfilename]['name']);
                //							if (!IsValidFile($_FILES[$tmpfilename]['name'])) {
                //								report_error(999, "Bad File Type", "Unable to process executable files! Try sending a zip.");
                //								return;
                //							}
                if (move_uploaded_file($_FILES[$tmpfilename]['tmp_name'], $uploadfile)) {
                  chmod($uploadfile, 0664);
                  if ($pfDebug) {
                    report_messageEX(SUCCESS, UPLOAD_SUCCESSFUL, UPLOAD_SUCCESSFUL_INFO);
                  }
                } else {
                  // report_error( 71, ERROR_71, ERROR_71_INFO);
                }
                break;
              case 1:
                if ($pfDebug) report_error($_FILES[$tmpfilename]['error'], UPLOAD_ERROR_1, UPLOAD_ERROR_1_INFO);
                break;
              case 2:
                if ($pfDebug) report_error($_FILES[$tmpfilename]['error'], UPLOAD_ERROR_2, UPLOAD_ERROR_2_INFO);
                break;
              case 3:
                if ($pfDebug) report_error($_FILES[$tmpfilename]['error'], UPLOAD_ERROR_3, UPLOAD_ERROR_3_INFO);
                break;
              case 4:
                if ($pfDebug)	report_error($_FILES[$tmpfilename]['error'], UPLOAD_ERROR_4, UPLOAD_ERROR_4_INFO);
                break;
              case 5:
                if ($pfDebug) report_error($_FILES[$tmpfilename]['error'], UPLOAD_ERROR_5, UPLOAD_ERROR_5_INFO);
                break;
              case 6:
                if ($pfDebug) report_error($_FILES[$tmpfilename]['error'], UPLOAD_ERROR_6, UPLOAD_ERROR_6_INFO);
                break;
              case 7:
                if ($pfDebug) report_error($_FILES[$tmpfilename]['error'], UPLOAD_ERROR_7, UPLOAD_ERROR_7_INFO);
                break;
              default:
                break;
        }
        break;
              default:
                if (array_key_exists($arrAttributes['name'], $this->arrSubmitedFields)) {
                  $this->arrForm[$strKey]['value'] = $this->arrSubmitedFields[$arrAttributes['name']];
                } else {
                  if (array_key_exists('value', $arrAttributes)) {
                    $this->arrForm[$strKey]['value'] = $this->arrSubmitedFields[$arrAttributes['value']];
                  } else {
                    $this->arrForm[$strKey]['value'] = "";
                  }
                }
                break;
      }
    }
}

// generate form HTML code from input array
function make() {
  global $mosConfig_absolute_path, $mosConfig_live_site, $my;
  $forPrint = !(!isset($_REQUEST['printing'])  || ((isset($_REQUEST['printing']) && ($_REQUEST['printing'] === 'false' )))) ;
  $forPDF = (isset($_REQUEST["pdf"]) ? ($_REQUEST["pdf"] === 'true') : false);
  $this->bolFormOK = true;
  $strHiddenFields = "";
  $strSubmitButton = "";
  $strResetButton = "";
  if ( count( $this->arrForm ) == 0 ) {
    //		$this->warning( "Form must contain at least one input field!", 0 );
    if ($this->strFormName == " ") {
      return parseAuto($this->intro);
    } else {
      return parseAuto($this->strFormName);
    }
  }
  if ( $this->formSubmited() ) {
    $this->rememberFormFields();
  }
  $objTpl = new Template( dirname( $this->strSkin ), "keep" );
  $objTpl->set_file( "tForm", basename( $this->strSkin ) );
  $objTpl->set_var( "TAG_METHOD", $this->strMethod );
  //		$objTpl->set_var( "TAG_NAME", $this->strFormName );
  $tmpnam = preg_replace("/[^\w]/", "", $this->strFormName);
  $objTpl->set_var( "TAG_NAME", $tmpnam );
  $objTpl->set_var( "TAG_FORMID", $tmpnam );
  $objTpl->set_var( "TAG_ACTION", $this->strAction );
  if ($this->useContainer) {
    $objTpl->set_var( "TAG_FORM_WIDTH", "100%" );
    $objTpl->set_var( "TAG_FORM_TITLE", "");
    $objTpl->set_var( "TAG_FORM_TITLE_DISPLAY", "none" );
    $objTpl->set_var( "TAG_FORM_TITLE_DISPLAY", "none" );
  } else {
    $objTpl->set_var( "TAG_FORM_WIDTH", $this->formWidth );
    if ($this->showFormTitle) {
      $objTpl->set_var( "TAG_FORM_TITLE", parseAuto($this->strFormName) );
      $objTpl->set_var( "TAG_FORM_TITLE_DISPLAY", "block" );
    } else {
      $objTpl->del_handle( "tForm", "TAG_FORM_TITLE" );
      $objTpl->set_var( "TAG_FORM_TITLE_DISPLAY", "none" );
    }
  }
  $strUserName = "Guest";
  if ($my->id != 0) $strUserName = $my->name;
  $objTpl->set_var( "TAG_USERNAME", $this->strAction );
  if (!$forPrint) $objTpl->del_handle("tForm", "CONTROL_BUTTONS");
  if ($forPrint && !$forPDF) {
    $strControlButtons = '<div style="vertical-align: middle; text-align:right; height:16pt; border: thin gray solid; padding: 2pt;"><span style="height:100%; padding: 3pt; float:left; font-style: italic; font-family: helvetica; font-weight: lighter; font-size: small;"> '.parseAuto($this->strFormName).'</span>';
    if ( isJ10() ) {
      $strControlButtons .= '<input type="image" style="height:100%;" title="'._PRINT.'" alt="'._PRINT.'" accesskey="p" onclick="window.print();" src="'.$mosConfig_live_site.'/administrator/images/print_f2.png" />';
      $strControlButtons .= '<input type="image" style="height:100%;" title="'.CLOSE.'" alt="'.CLOSE.'" accesskey="c" onclick="window.close();" src="'.$mosConfig_live_site.'/administrator/images/cancel_f2.png" />';
    } else {
      $strControlButtons .= '<input type="image" style="height:100%;" title="'._PRINT.'" alt="'._PRINT.'" accesskey="p" onclick="window.print();" src="'.$mosConfig_live_site.'../../../administrator/images/print_f2.png" />';
      $strControlButtons .= '<input type="image" style="height:100%;" title="'.CLOSE.'" alt="'.CLOSE.'" accesskey="c" onclick="window.close();" src="'.$mosConfig_live_site.'../../../administrator/images/cancel_f2.png" />';
    }
    $strControlButtons .= '</div>';
    $objTpl->set_var( "CONTROL_BUTTONS", $strControlButtons );
  } else {
    $objTpl->set_var( "CONTROL_BUTTONS", "" );
    $objTpl->del_handle( "tForm", "CONTROL_BUTTONS" );
  }
  if (!$forPrint) {
    if($this->use_securityimages && file_exists($mosConfig_absolute_path."/components/com_securityimages") ) {
      $objTpl->set_var( "TAG_SECUREIMAGE",  insertSecurityImage("PFSecurity"));
      $objTpl->set_var( "TAG_SECUREIMAGE_INPUT",   getSecurityImageField("PFSecurity"));
      $objTpl->set_var( "TAG_SECUREIMAGE_HELP", "<div class=\"performs_help\">".$this->securityImageHelp."</div>" );
      if ($this->securityImageError != "") {
        $objTpl->set_var( "TAG_SECUREIMAGE_ERROR", "<div class=\"performs_error\">".$this->securityImageError."</div>" );
        $this->bolFrmSubmited = false;
      }	else $objTpl->set_var( "TAG_SECUREIMAGE_ERROR", "");
    }        else $objTpl->del_handle( "tForm", "secureimg" );
  }		else $objTpl->del_handle( "tForm", "secureimg" );
  $objTpl->set_var( "formRows", "" );
  $objTpl->set_block( "tForm", "formRow", "formRows" );
  $i=0;
  $accID = 100;
  foreach( $this->arrForm as $arrAttributes ) {
     
    // Determine if CSS classes have been set.
    $cssClasses = array();
    if (isset($arrAttributes['captionCssClass'])) {
      $cssClasses['caption'] = $arrAttributes['captionCssClass'];
      unset($arrAttributes['captionCssClass']);
    }
    if (isset($arrAttributes['valueCssClass'])) {
      $cssClasses['value'] = $arrAttributes['valueCssClass'];
      unset($arrAttributes['valueCssClass']);
    }
    if (isset($arrAttributes['infoCssClass'])) {
      $cssClasses['info'] = $arrAttributes['infoCssClass'];
      unset($arrAttributes['infoCssClass']);
    }
    if (isset($arrAttributes['errorCssClass'])) {
      $cssClasses['error'] = $arrAttributes['errorCssClass'];
      unset($arrAttributes['errorCssClass']);
    }

    $objTpl->set_var("TAG_COLSPAN", "");
     
    if (!isset ($arrAttributes['disabled']) ) {
      ++$accID;
      if ( !in_array( $arrAttributes['type'], $this->arrInputTypes ) ) {
        $this->warning( "Invalid input field type '".$arrAttributes['type']."'.", 0 );
      }
      if ( $my->id != 0) {
        if ($arrAttributes['name'] == 'replyto') {
          $arrAttributes['type'] = 'hidden';
          $arrAttributes['value'] = str_replace("@", EMAIL_MASH, $my->email);
          unset ( $arrAttributes['class'] );
          unset ( $arrAttributes['accesskey'] );
          unset ( $arrAttributes['size'] );
        }
        if ($arrAttributes['name'] == 'replytoName') {
          $arrAttributes['type'] = 'hidden';
          $arrAttributes['value'] = $my->username;
          unset ( $arrAttributes['class'] );
          unset ( $arrAttributes['accesskey'] );
          unset ( $arrAttributes['size'] );
        }
      }
      if ( $arrAttributes['type'] == "hidden" ) {
        //this switch may no longer be necessary... thanks to parseAuto()
        switch ($arrAttributes['name']) {
          case PFAUTO_USERNAME: {
            $arrAttributes['value'] = $my->username;
            break;
          }
          case PFAUTO_NAME: {
            $arrAttributes['value'] = $my->name;
            break;
          }
        }
        $strHiddenFields .= "<input".$this->attributes( $arrAttributes ).">\n";
        continue;
      } else if ( $arrAttributes['type'] == "submit" ) {
        if ($this->replaceSubmitButton) {
          $objTpl->set_var("SUBMIT_IMAGE", $this->submitImageUrl);
          $objTpl->set_var("SUBMIT_IMAGE_WIDTH", $this->submitImageWidth);
          $objTpl->set_var("SUBMIT_IMAGE_HEIGHT", $this->submitImageHeight);
          unset( $arrAttributes['class'] );
        } else {
          $objTpl->set_var("SUBMIT_IMAGE", "");
          $objTpl->set_var("SUBMIT_IMAGE_WIDTH", "0");
          $objTpl->set_var("SUBMIT_IMAGE_HEIGHT", "0");
          unset( $arrAttributes['id'] );
        }
        $strSubmitButton .= "<input".$this->attributes( $arrAttributes )
        .' tabindex="'.$accID.'"'
        .(($this->replaceSubmitButton) ? ' id="frmSubmit"' : '')
        .">\n";
        continue;
      } else if ( $arrAttributes['type'] == "reset" ) {
        if ($this->replaceResetButton) {
          $objTpl->set_var("RESET_IMAGE", $this->resetImageUrl);
          $objTpl->set_var("RESET_IMAGE_WIDTH", $this->resetImageWidth);
          $objTpl->set_var("RESET_IMAGE_HEIGHT", $this->resetImageHeight);
          unset( $arrAttributes['class'] );
        } else {
          $objTpl->set_var("RESET_IMAGE", "");
          $objTpl->set_var("RESET_IMAGE_WIDTH", "0");
          $objTpl->set_var("RESET_IMAGE_HEIGHT", "0");
          unset( $arrAttributes['id'] );
        }
        $strResetButton .= "<input".$this->attributes( $arrAttributes )
        .' tabindex="'.$accID.'"'
        .(($this->replaceResetButton) ? ' id="frmReset"' : '')
        .">\n";
        continue;
      }
      if($arrAttributes['type']=='pagebreak'){
        $objTpl->set_var( "PAGE_END_DIV", '</div>' );
        $objTpl->set_var( "PAGE_BEGIN_DIV", '<div class="tabbertab">' );
        $objTpl->set_var( "TAG_FIELD_CAPTION", '');
        $objTpl->set_var( "TAG_REQUIRED_FIELD_MARK", "" );
        $objTpl->set_var( "TAG_ERROR_MESSAGE", "" );
        $objTpl->set_var( "TAG_HELP_MESSAGE", "" );
        $objTpl->set_var( "TAG_CAPTION_STYLE", "" );
        $objTpl->set_var( "TAG_FIELD_STYLE", "" );
        $objTpl->set_var( "TAG_FIELD_CONTENT", '<input type="button" name="Submit" value="Geri" onclick="javascript:document.getElementById(\'performTabs\').tabber.tabShow('.$i.');"/>&nbsp;&nbsp;<input type="button" name="Submit" value="ileri" onclick="javascript:document.getElementById(\'performTabs\').tabber.tabShow('.($i+1).');"/>');
        $objTpl->parse( "formRows", "formRow", true );
        $i++;
        continue;
      }else {
        $objTpl->set_var( "PAGE_END_DIV", '' );
        $objTpl->set_var( "PAGE_BEGIN_DIV", '' );
      }

      switch( $arrAttributes['type'] ) {
        case "select":
          # preveri � se v imenu vnosnega polja nahaja '[]'
          if ( substr( $arrAttributes['name'], -2 ) != "[]" ) {
            $this->warning( "Invalid name '".$arrAttributes['name']."' for ".$arrAttributes['type'].". '[]' at the end of name is required!", 0 );
          }
          # zgenerira HTML kodo za polje tipa select
          $strFormCode = '<select'.$this->attributes( $arrAttributes ).' tabindex="'.$accID.'" id="PF'.$accID.'">\n'.$this->options( $arrAttributes, $accID ).'</select>';
          break;
        case "radio": case "checkbox":
          # preveri � se v imenu vnosnega polja nahaja '[]'
          if ( substr( $arrAttributes['name'], -2 ) != "[]" ) {
            $this->warning( "Invalid name '".$arrAttributes['name']."' for ".$arrAttributes['type'].". '[]' at the end of name is required!", 0 );
          }
          # zgenerira HTML kodo za polje tipa radio in checkbox
          $strFormCode = $this->options( $arrAttributes, $accID );
          $accID--;
          break;
        case "textarea":
          if (!$forPDF) {
            if ( isset( $arrAttributes['value'] ) ) {
              $strAttVal = $arrAttributes['value'];
            } else {
              $strAttVal = "";
            }
            # zgenerira HTML kodo za polje tipa textarea
            $strFormCode = '<textarea'.$this->attributes( $arrAttributes ).' tabindex="'.$accID.'" id="PF'.$accID.'">'.$strAttVal.'</textarea>';
          } else {
            //experimenting with drawing a div for print instead of a textarea
            $ta_width = intval($arrAttributes['cols']) * 7;
            $ta_height = intval($arrAttributes['rows']) * 15;
            $style= "border: thin gray solid; width: "
            .$ta_width."pt; height: "
            .$ta_height."pt;";
            $strFormCode = '<div style="'.$style.'">&nbsp;</div>';
          }
          break;
        case 'textual':
          global $mosConfig_absolute_path;
          if ($this->strSkin == $mosConfig_absolute_path."/components/com_performs/skins/tabular/tpl_form.html")
          $objTpl->set_var("TAG_COLSPAN", "colspan=\"3\"></td></tr><tr><td colspan=\"3\"");
          if ( array_key_exists( 'value', $arrAttributes) ) {
            //							if ($this->strSkin == "tabular.jpg") {
            //								$objTpl->set_var("TAG_COLSPAN", " colspan=\"2\"");
            //							}
            $strFormCode = '<div class="textual-'.$arrAttributes['id'].'">'.$arrAttributes['value'].'</div>';
          } else {
            $strFormCode = "";
          }
          if ($this->strSkin == $mosConfig_absolute_path."/components/com_performs/skins/tabular/tpl_form.html")
          $strFormCode .= "</td></tr><tr><td>";

          break;
        case 'date':
          $strFormCode = "<input readonly=\"true\" class=\"inputbox\" type=\"text\" name=\""
          .$arrAttributes['name']."\" id=\"".$arrAttributes['name']."\" size=25 maxlength=19  />"
          ."<input name=\"reset".$arrAttributes['name']."\"  class=\"button\" type=\"reset\" onClick=\"return showCalendar('"
          .$arrAttributes['name']."', 'y-mm-dd');\" tabindex=\"$accID\" value=\"...\"/>";
          break;
        case 'file':
          $maxfilesize = $arrAttributes['max'];
          unset($arrAttributes['max']);
          $strFormCode = '<input type="hidden" name="MAX_FILE_SIZE" value="'.$maxfilesize.'" />'
          .'<input '.$this->attributes( $arrAttributes ).' id="PF'.$accID.'" tabindex="'.$accID.'">';
          break;
        default:
          $strFormCode = '<input '.$this->attributes( $arrAttributes ).' id="PF'.$accID.'" tabindex="'.$accID.'">';
          break;
      }
      switch( $arrAttributes['type'] ) {
        //          case "checkbox": case "radio":
        //            $objTpl->set_var( "TAG_FIELD_CAPTION", $arrAttributes['caption']);
        case "checkbox": case "radio":
          if (isset($cssClasses['caption']))
          $objTpl->set_var( "TAG_FIELD_CAPTION", '<div class="'.$cssClasses['caption'].'">'.$arrAttributes['caption'].'</div>');
          else
          $objTpl->set_var( "TAG_FIELD_CAPTION", $arrAttributes['caption']);
          break;
        default:
          if ( ($arrAttributes['name'] == 'replyto') || ($arrAttributes['name'] == 'replytoName') ) {
            if ( $my->id == 0 ) {
              //show the unknown user the reply to caption
              $objTpl->set_var( "TAG_FIELD_CAPTION",
                                  '<label for="PF'.$accID.'">'.$arrAttributes['caption'].'</label>' );
            } else {
              // hide the email field from the user if logged in
              $objTpl->set_var( "TAG_FIELD_CAPTION", "");
            }
          } else {
            //              $objTpl->set_var( "TAG_FIELD_CAPTION",
            //                                '<label for="PF'.$accID.'">'.$arrAttributes['caption'].'</label>' );
            if (isset($cssClasses['caption']))
            $objTpl->set_var( "TAG_FIELD_CAPTION", '<div class="'.$cssClasses['caption'].'"><label for="PF'.$accID.'">'.$arrAttributes['caption'].'</label></div>' );
            else
            $objTpl->set_var( "TAG_FIELD_CAPTION", '<label for="PF'.$accID.'">'.$arrAttributes['caption'].'</label>' );
          }
          break;
      }
      # � ima polje nastavljen parameter required, se ob njegovem imenu izpie
      # poseben znak. Ponavadi je to zvezdica *.
      if ( isset( $arrAttributes['required'] ) ) {
        $objTpl->set_var( "TAG_REQUIRED_FIELD_MARK", $this->strRequiredFieldMark );
      } else {
        $objTpl->set_var( "TAG_REQUIRED_FIELD_MARK", "" );
      }
      # � je bila forma submitana, funkcija checkField preveri, � so bili vsi
      # zahtevani podatki vneeni in � so bili vneeni pravilno. Ob napaki se v
      # tag TAG_ERROR_MESSAGE nastavi ustrezno vizuelno sporo�lo o napaki.
      if ( $this->bolFrmSubmited ) {
        //          $objTpl->set_var( "TAG_ERROR_MESSAGE", $this->checkField( $arrAttributes ) );
        if (isset($cssClasses['error']))
        $objTpl->set_var( "TAG_ERROR_MESSAGE", '<div class="'.$cssClasses['error'].'">'.$this->checkField( $arrAttributes ).'</div>' );
        else
        $objTpl->set_var( "TAG_ERROR_MESSAGE", $this->checkField( $arrAttributes ) );
      } else {
        $objTpl->set_var( "TAG_ERROR_MESSAGE", "" );
      }
      # ob vnosnem polju lahko e vnaprej izpiemo kratko sporo�lo za pomo�
      # � je atribut 'help' nastavljen, bo uporabnik to sporo�lo videl izpisano
      # poleg vnosnega polja.
      if ( isset( $arrAttributes['help'] ) && (!isset($arrAttributes['disabled']) )) {
        //          $objTpl->set_var( "TAG_HELP_MESSAGE", "<div class=\"performs_help\">".$arrAttributes['help']."</div>");
        if (isset($cssClasses['info']))
        $objTpl->set_var( "TAG_HELP_MESSAGE", '<div class="'.$cssClasses['info'].'">'.$arrAttributes['help'].'</div>');
        else
        $objTpl->set_var( "TAG_HELP_MESSAGE", "<div class=\"performs_help\">".$arrAttributes['help']."</div>");
      } else {
        $objTpl->set_var( "TAG_HELP_MESSAGE", "" );
      }
      # Z atributoma 'lCellAtt', lahko dodatno vplivamo na stil vnosnih polj
      if ( isset( $arrAttributes['lCellAtt'] ) ) {
        $objTpl->set_var( "TAG_CAPTION_STYLE", $arrAttributes['lCellAtt'] );
      } else {
        $objTpl->set_var( "TAG_CAPTION_STYLE", "" );
      }
      # Z atributoma 'rCellAtt', lahko dodatno vplivamo na stil vnosnih polj
      if ( isset( $arrAttributes['rCellAtt'] ) ) {
        $objTpl->set_var( "TAG_FIELD_STYLE", $arrAttributes['rCellAtt'] );
      } else {
        $objTpl->set_var( "TAG_FIELD_STYLE", "" );
      }
      //        $objTpl->set_var( "TAG_FIELD_CONTENT", $strFormCode );
      // Set the field content, surrounding with a div if requested
      if (isset($cssClasses['value']))
      $objTpl->set_var( "TAG_FIELD_CONTENT", '<div class="'.$cssClasses['value'].'">'.$strFormCode.'</div>' );
      else
      $objTpl->set_var( "TAG_FIELD_CONTENT", $strFormCode );
       
      $objTpl->parse( "formRows", "formRow", true );
    }
  }
  $objTpl->set_var( "LIVE_SITE", $mosConfig_live_site );
  if(empty($this->formImage)) {
    $objTpl->del_handle( "tForm", "formimg" );
  }	else {
    $objTpl->set_var("FORM_IMAGE",$this->formImage);
    $imgstyle = 'style="float: '.$this->imageFloat.';"';
    $objTpl->set_var("TAG_IMAGESTYLE", $imgstyle);
  }
  //refactor to parseIntro()
  $p_intro = parseAuto($this->intro);
  $objTpl->set_var("FORM_MESSAGE",$p_intro);
  $accscr = buildaccscript($tmpnam, $this->arrForm);
  $objTpl->set_var( "ACC_SCRIPT", $accscr);
  //HACK: quick and dirty way of building a form with no buttons
  //for print/pdf...
  if (!$forPDF) {
    $objTpl->set_var( "TAG_HIDDEN_FIELDS", $strHiddenFields );
    if ($forPrint) {
      $objTpl->set_var( "TAG_SUBMIT_BUTTON", "" );
      $objTpl->set_var( "TAG_RESET_BUTTON", "" );
    } else {
      $objTpl->set_var( "TAG_SUBMIT_BUTTON", $strSubmitButton );
      $objTpl->set_var( "TAG_RESET_BUTTON", $strResetButton );
    }
    $objTpl->set_var( "TAG_ABOUT", "" );
  } else {
    $objTpl->set_var( "TAG_HIDDEN_FIELDS", '' );
    $objTpl->set_var( "TAG_SUBMIT_BUTTON", '' );
    $objTpl->set_var( "TAG_RESET_BUTTON", '' );
    $objTpl->set_var( "TAG_ABOUT", "" );
  }

  return $objTpl->parse( "output", "tForm" );
}
// generates the HTML code for form and displays it
function show() {
  echo $this->make();
}

function about( $strType = 0 ) {
  $strAbout = "";
  switch ( $strType ) {
    case 0:
      if ( file_exists( "img/phpForm.gif" ) ) {
        $strAbout = '<a href="'.$this->strHomePage.'"><img border="0" src="img/phpForm.gif" width="88" height="31" alt="phpForm Home page"></a>';
      } else {
        $strAbout = '<a href="'.$this->strHomePage.'"><font face="Arial" size="-2">phpForm Home page</font></a>';
      }
      $strAbout .= '<br><font face="Arial" size="-2">Copyright &copy; <a href="mailto:'.$this->strAuthorEmail.'">'.$this->strAuthorName.'</a><br>version '.$this->strVersion."</font>";
      break;
    case 1:
      if ( file_exists( "img/phpForm.gif" ) ) {
        $strAbout = '<a href="'.$this->strHomePage.'"><img border="0" src="img/phpForm.gif" width="88" height="31" alt="phpForm Home page"></a>';
      } else {
        $strAbout = '<a href="'.$this->strHomePage.'"><font face="Arial" size="-2">phpForm Home page</font></a>';
      }
      break;
    case 2:
      $strAbout = '<br><font face="Arial" size="-2">Copyright &copy; <a href="mailto:'.$this->strAuthorEmail.'">'.$this->strAuthorName.'</a><br>version '.$this->strVersion."</font>";
      break;
  }
  return $strAbout;
}

/**
 * @@@@ New extension code inserted  below this point
 * Date : 2/11/2006
 * Author : Joomlashack
 * Code added by Joomlashack to cope with the need to substitute subject and email addresses
 * 2 functions added :- subsituteEmailSubject($emailSubject) and subsituteEmailAddress($emailAddress)
 *
 */

/**************************************************************************
 * $Id: lib_phpForm.php,v 1.8 2006/11/14 14:21:09 jshack Exp $
 * name: subsituteEmailElemnet($emailSubject)
 * created by: Joomlashack
 * description : goes through the form and removed "Subject" caption and places it in the
 * email subject.  It then removes this from the list to avoid this being printed again
 * parameters: $strEmailValue - Current value $strFormFieldType - type for field to look for (e.g."name"),
 *             $strFormFieldValue - value to look for (e.g. "subject"),
 *             $bolCheckNull - do you require the original to be blank to perform the check,
 *             $bolActionAppend - does the new value get appended to the old or overwrite
 * returns: $strEmailValue the new email address/subject  (with or without appending it to the original)
 **************************************************************************/
function subsituteEmailElement($strEmailValue,$strFormFieldType,$strFormFieldValue,$bolCheckNull,$bolActionAppend,$bolDeleteFromForm){
  if (($bolCheckNull && $strEmailValue == null) || !$bolCheckNull){ // do I check for blank field
    // use a simple loop to go through the arrForm to find a referece to subject
    // note using a simple index it's much easer to delete an entry
    foreach($this->arrForm as $strKey => $strVal){
      switch ($this->arrForm[$strKey]['type'] ) {
        case 'text':
        case 'textarea':
          if ((strtolower($this->arrForm[$strKey][$strFormFieldType]) == $strFormFieldValue)){
            $mySubject =  $this->arrForm[$strKey]['value']; // use a temp variable as we could be going to delete the entry
            if ($bolDeleteFromForm){
              unset($this->arrForm[$strKey]); //delete this entry so that it does not appear in the message body
            }
            return $this->handleEmailValueAppend($strEmailValue,$mySubject,$bolActionAppend);
          }
          break;
        case 'select':
        case "radio":
          $strSelectValue = $strFormFieldValue . '[]';  // note the name changes for these types to name[].
          if ((strtolower($this->arrForm[$strKey][$strFormFieldType]) == $strSelectValue)){
            //go through all the options to see what is selected
            foreach($this->arrForm[$strKey]['options'] as $val => $val2 ){
              if(count($val2) == 2) { // if the are two elements then it is a checked/selected field
                $mySubject =  $val2[0]; // use a temp variable as we could be going to delete the entry
                if ($bolDeleteFromForm){
                  unset($this->arrForm[$strKey]); //delete this entry so that it does not appear in the message body
                }
                return $this->handleEmailValueAppend($strEmailValue,$mySubject,$bolActionAppend);
              }
            }
          }
          break;
      }
    }
  }
  return $strEmailValue;
}

/**************************************************************************
 *
 * name: handleEmailValueAppend($strEmailValue,$strNewEmailValue,$bolActionAppend)
 * created by: Joomlashack
 * description : simple function to handle the appening or overwriting of a value
 * parameters: $strEmailValue - original value ,$strNewEmailValue - new value,$bolActionAppend - overwrite or append
 * returns: $strEmailValue the new email address/subject  (with or without appending it to the original)
 **************************************************************************/

function handleEmailValueAppend($strEmailValue,$strNewEmailValue,$bolActionAppend){
  if ($bolActionAppend) {
    if ($strEmailValue == "") {
      return $strNewEmailValue;  // no need to append there is nothing here anyway
    }
    else {
      return $strEmailValue . ' ' . $strNewEmailValue; // add a space to the subject
    }
  }
  else {
    return $strNewEmailValue;
  }
}

/**************************************************************************
 * name: resolveEmailAddress($strEmailAddress,$strFormFieldType,$strValueToCheck,$strFormFieldValue)
 * created by: Joomlashack
 * description : goes through all the necessary substitions to get a final email address
 * parameters: $strEmailAddress inital value
 *			$strFormFieldType
 * 			$strFormFieldValue
 *			$bolAheckNull
 *			$bolActionAppend
 *                       $bolDeleteFromForm
 * returns: strEmailAddress
 **************************************************************************/
function resolveEmailAddress($strEmailAddress,$strFormFieldType,$strFormFieldValue,$bolCheckNull,$bolActionAppend,$bolDeleteFromForm){
  //subsitute any $user values
  $strEmailAddress = $this->subsituteEmailAddress($strEmailAddress);
  //subsitute a field form value ("mailto" "mailfrom") for an email element
  $strEmailAddress = $this->subsituteEmailElement($strEmailAddress,$strFormFieldType,$strFormFieldValue,$bolCheckNull,$bolActionAppend,$bolDeleteFromForm);
  return $strEmailAddress;
}

/**************************************************************************
 * name: subsituteEmailAddress($strEmailAddress)
 * created by: Joomlashack
 * description : substitues the email address "user" for the users email address
 * parameters: $strEmailAddress - the inital email value
 * returns: EmailAddress
 **************************************************************************/
function subsituteEmailAddress($strEmailAddress){
  global $database;
  if (strpos(strtolower($strEmailAddress), '$user') !== false){ // check to see if we must substitute email address
    if ($GLOBALS['my']->id ){
      $myval = $GLOBALS['my']->id;
      // create the sql to get the user email
      $query = "SELECT email"
      . "\n FROM #__users"
      . "\n WHERE id = $myval"
      ;
      $database->setQuery( $query );
      //get the users email address
      $myAddress = $database->loadResult();
      // substitute the email address
      $myNewAddress = $this->replacestring('$user',$myAddress,$strEmailAddress);
      return $myNewAddress;
    }
    else { //$user is used but nobody is logged in
      //$this->warning( "User must be logged in to use this form");
      return $GLOBALS['mosConfig_mailfrom'];  // not logged in.  This is NOT a good idea but better than nothing
    }
  }
  return $strEmailAddress;
}

/**************************************************************************
 * name: replacestring($search,$replace,$subject)
 * created by: Joomlashack
 * description : substitues one string in another (case insensitive)
 * parameters: $search - search for,$replace - substitute for,$subject - source string
 * returns: EmailAddress
 **************************************************************************/
function replacestring($strSearch,$strReplace,$strSubject) {
  $srchlen=strlen($strSearch);	// lenght of searched string
  if ($srchlen==0) return $strSubject;
  $find = $strSubject;
  while ($find = stristr($find,$strSearch)) {	// find $strSearch text in $strSubject - case insensitiv
    $srchtxt = substr($find,0,$srchlen);	// get new search text
    $find=substr($find,$srchlen);
    $strSubject = str_replace($srchtxt,$strReplace,$strSubject);	// replace founded case insensitive search text with $strReplace
  }
  return $strSubject;
}

/**************************************************************************
 * name: checkEmailAddress($fromEmail,$toEmail)
 * created by: Joomlashack
 * description : checks that the to and from email addresses are valid
 * parameters: $search - search for,$replace - substitute for,$subject - source string
 * returns: EmailAddress
 **************************************************************************/
function checkEmailAddress($strFromEmail,$strToEmail){
  $bolEmailOk = true;
  $strFromEmail = $this->resolveEmailAddress($strFromEmail,"name","mailfrom",false,false,false);
  if ( !isEmail( $strFromEmail ) ) {
    $this->warning( "Invalid Email From Address'".$strFromEmail."'." );
    $bolEmailOk = false;
  }

  $strToEmail = $this->resolveEmailAddress($strToEmail,"name","mailto",false,false,false);
  if ( !isEmail( $strToEmail ) ) {
    $this->warning( "Invalid Email To Address'".strToEmail."'." );
    $bolEmailOk = false;
  }
  return $bolEmailOk;
}
//
}
?>