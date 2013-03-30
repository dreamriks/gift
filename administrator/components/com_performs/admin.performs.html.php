 <?php
/**
* @version $id: admin.performs.html.php,v 2.3
* @package performs
* @copyright (C) 2007 perForms
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @author David Walters
* @author (original) Ilhami KILIC http://www.tuwitek.at
* Joomla is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $mosConfig_absolute_path;
require_once( $mosConfig_absolute_path . '/administrator/components/com_performs/lib/myLib.php' );

class HTML_perform {

	function showForms( &$rows, &$pageNav,  $option ) {
//		global $my,$mosConfig_absolute_path,$mosConfig_live_site;
		global $my, $mosConfig_live_site;
		mosCommonHTML::loadOverlib();
        
		?>   
      <script language="javascript">
      var formIDs = new Array(<?php echo count($rows);?>);
      function submitbutton(pressbutton) {
        var form = document.adminForm;
        if (pressbutton == 'newItem' || pressbutton == 'editItem' ) {
          form.hidemainmenu.value="1";
          submitform( pressbutton );
          return;
        } else if(pressbutton == 'performswindow'){
          var firstItemChecked = -1;
          for (i = 0; true; ++i) {
            cb = eval('document.adminForm.cb'+i);
            if (!cb) break;
            if (cb.checked) firstItemChecked = i;
          }
          if (firstItemChecked > -1) {
            window.open('components/com_performs/performswindow.php?formId='+formIDs[firstItemChecked], 'win1', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');
          } else {
            alert('<?php echo sprintf(SELECT_A_RECORD_TO, PREVIEW);?>');
          }
        }
        else {
          submitform( pressbutton );
        }
      }
</script>    
<form action="index2.php" method="post" name="adminForm">
    <?php 
      if (count($rows) > 0) echo "<input type=\"hidden\" name=\"formId\" value=\"".$rows[0]->id."\">";
      if ( isJ10() ) { 
        echo report_update_info( PFVersionNumber() );
        } else {
        }
    ?>
    <table class="adminlist">
    <tr>
      <th width="20"> # </th>
      <th width="20" class="title"> <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" />
      </th>
      <th class="title"> <?php echo NAME;?> </th>
      <th class="title"> <?php echo LINK;?> </th>
      <th class="title" width="10%"> <?php echo ITEMS;?></th>
      <th class="title" width="10%"> <?php echo DB_TABLE_NAME;?> </th>
	  <th class="title" width="10%"> <?php echo DB_RECORDS;?></th>
      <th width="5%" class="title" nowrap="true"> <?php echo PUBLISHED;?> </th>
    </tr>
    <?php
		$k = 0;
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			$link 	= 'index2.php?option=com_performs&task=editA&hidemainmenu=1&id='. $row->id;
			$urlToForm = 'index.php?option=com_performs&formid='. $row->id;

			$img 	= $row->published ? 'tick.png' : 'publish_x.png';
			$task 	= $row->published ? 'unpublish' : 'publish';
			$alt 	= $row->published ? PUBLISHED : UNPUBLISHED;

			$checked 	= mosCommonHTML::CheckedOutProcessing( $row, $i );

			?>
    <tr class="<?php echo "row$k"; ?>">
      <td><?php echo $pageNav->rowNumber( $i ); ?> </td>
        <td><?php echo $checked; ?> 
          <script language="javascript">
          formIDs[<?php echo $i;?>] = <?php echo $row->id;?>;
            </script></td>
      <td align="left"><?php
				if ( ($row->checked_out) && ( $row->checked_out != $my->id ) ) {
					echo $row->title;
				} else {
					?>
        <a href="<?php echo $link; ?>" title="<?php echo EDIT_FORM;?>"> <?php echo $row->title; ?> </a>
        <?php
				}
				?>
      </td>
      <td align="left"><?php echo $urlToForm; ?> </td>
      <td align="center"><?php
						echo $row->fieldCount;
						?>
              &nbsp;<a href="javascript: void(0);" onClick="return listItemTask('cb<?php echo $i;?>','items')"  title="<?php echo ADD_EDIT_REMOVE;?>" >
                <?php echo EDIT_ITEMS; ?></a>
        <?php			
					 ?>
      </td>
      <td align="left"><?php echo $row->tablename; ?> </td>

      <td align="center"><?php 
	  	if( intval($row->recordsCount)>0){
	  		?>
			<a href="#" onclick="window.open('components/com_performs/performsReport.php?formId=<?php echo $row->id; ?>', 'win1', 
			'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');">
			<?php echo $row->recordsCount; ?> </a>
			<?php	
		}		else  echo $row->recordsCount; ?> </td>
	  
      <td align="center"><a href="javascript: void(0);" onClick="return listItemTask('cb<?php echo $i;?>','<?php echo $task;?>')"> <img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" /> </a> </td>
    </tr>
    <?php
			$k = 1 - $k;
		}
		?>
      <tr>
<!--      </table> -->
<td colspan="8" style="text-align: center;">
      <?php echo $pageNav->getListFooter(); ?>
        </td>
        </tr>
        </table>
        <input type="hidden" name="option" value="<?php echo $option; ?>" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="hidemainmenu" value="0">
        </form>
<?php
	}

	function showFormItems( &$rows,&$pageNav,$option, $formID, $formCaption, $isBound = false ) {
		global $my;

		mosCommonHTML::loadOverlib();
		?>
<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'newItem' || pressbutton == 'editItem' ) {
				form.hidemainmenu.value="1";
				submitform( pressbutton );
				return;
			} else if(pressbutton == 'performswindow'){
				window.open('components/com_performs/performswindow.php?formId=<?php echo $formID; ?>', 'win1', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');
			}
			 else {
				submitform( pressbutton );
			}
		}
    function reverseorder( n ) {
      for ( var j = 0; j <= n; j++ ) {
        box = eval( "document.adminForm.cb" + j );
        if ( box ) {
          if ( box.checked == false ) {
            box.checked = true;
          }
        } else {
          alert("You cannot change the order of items, as an item in the list (" + j + ") is `Checked Out`");
          return;
        }
        
      }
      submitform('reverseorder');
    }
    function invertaspect( n ) {
      for ( var j = 0; j <= n; j++ ) {
        box = eval( "document.adminForm.cb" + j );
        if ( box ) {
          if ( box.checked == false ) {
            box.checked = true;
          }
        } else {
          alert("You cannot change the order of items, as an item in the list (" + j + ") is `Checked Out`");
          return;
        }
      }
      submitform('swapsize1and2');
    }
</script>
<form action="index2.php" method="post" name="adminForm">
  <table class="adminheading">
    <tr>
      <th> PerForms <?php echo PFVersionNumber(); ?>: <small> <?php echo ITEMS." - \"".$formCaption."\" (ID = ".$formID.")";?> </small> </th>
    </tr>
  </table>
  <table class="adminlist">
    <tr>
      <th width="20"> # </th>
      <th width="20" class="title"> <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" />
      </th>
        <th class="title"> <?php echo CAPTION;?> </th>
<!--        <th class="title"> <?php echo ACCESSKEY;?> </th> -->
        <th class="title"> <?php echo NAME;?> </th>
      <th class="title"> <?php echo TYPE;?> </th>
      <th class="title"> <?php echo CHECK;?> </th>
      <th class="title" nowrap="nowrap" colspan="2" width="4%"> <?php echo REORDER;?> </th>
        <th width="2%"><?php echo ORDER; ?></th>
  	                         <th width="2%">
          <a href="javascript: reverseorder( <?php echo count( $rows )-1; ?> )">
          <img src="images/reload_f2.png" border="0" width="16" height="16" alt="<?php echo REVERSE_ORDER; ?>" title="<?php echo REVERSE_ORDER; ?>" />
          </a>
          <a href="javascript: saveorder( <?php echo count( $rows )-1; ?> )">
          <img src="images/filesave.png" border="0" width="16" height="16" alt="<?php echo SAVE_ORDER; ?>" title="<?php echo SAVE_ORDER; ?>" />
          </a>
          </th>
      <th class="title"> <?php echo VALUE;?> </th>
      <th class="title"> <?php echo REQUIRED;?> </th>
      <th class="title"> <?php echo DISABLED;?> </th>
      <th class="title"> <?php echo SIZE1;?> </th>
        <th width="2%">
        <a href="javascript: invertaspect( <?php echo count( $rows )-1; ?> )">
        <img src="images/restore_f2.png" border="0" width="16" height="16" alt="<?php echo SWAP_SIZE_VARS; ?>" title="<?php echo SWAP_SIZE_VARS; ?>" />
        </a>
        </th>
        <th class="title"> <?php echo SIZE2;?> </th>
    </tr>
    <?php
		$k = 0;
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];
			$link 	= 'index2.php?option=com_performs&task=editItemA&hidemainmenu=1&formId='. $row->formId .'&id='.  $row->itemId;
			?>
  <tr class="<?php echo "row$k"; ?>">
    <td><?php echo $i+1 ; ?> </td>
    <td><?php echo mosHTML::idBox( $i, $row->itemId);///$checked; ?> </td>
    <td align="left"><?php
        ?>
      <a href="<?php echo $link; ?>" title="<?php echo EDIT_ITEM?>"> <?php echo $row->caption; ?> </a>
    </td>
<!--        <td align="center"><?php echo $row->accesskey; ?> </td> -->
        <td align="center"><?php echo $row->name; ?> </td>
    <td align="left"><?php echo LocaliseTypeName($row->type); ?> </td>
    <td align="left"><?php echo $row->check; ?> </td> 
    <td><?php echo $pageNav->orderUpIcon( $i ); ?> </td>
    <td><?php echo $pageNav->orderDownIcon( $i, $n ); ?> </td>
    <td colspan="2" align="center">
    <input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" />
    </td>
    <td align="left"><?php echo implode(", ", explode( getEncodingSep(), $row->value)); ?> </td> 
    <td align="left"><?php echo ($row->required ? _CMN_YES : _CMN_NO); ?> </td>
    <td align="left"><?php echo ($row->disabled ? _CMN_YES : _CMN_NO); ?> </td>
    <td align="left" colspan="2"><?php echo $row->var1; ?> </td>
    <td align="left"><?php echo $row->var2; ?> </td>
  </tr>
    <?php
		}
		?>
  </table>
  <input type="hidden" name="formId" value="<?php echo $formID; ?>" />
  <input type="hidden" name="option" value="<?php echo $option; ?>" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="hidemainmenu" value="0">
</form>
<?php
	}

	function editForm( &$row, &$lists, $option, &$params ) {
		global $mosConfig_live_site, $pfDebug;
		if ($row->image == '') {
			$row->image = 'blank.png';
		}
//		$tabs = new mosTabs(0);
if (!isset($_REQUEST['webfxtab_content-pane'])) $_REQUEST['webfxtab_content-pane'] = 0;
		$tabs = new mosTabs(1);
		mosMakeHtmlSafe( $row, ENT_QUOTES, 'misc' );
    PFLoadCalendar();
		?>
      <style type="text/css">
      div.adminrow {
        padding-top: 4px;
        padding-bottom: 2px;
      }
      label.adminlabel {
        float: left;
        width: 128px;
            }
      </style>
<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
      } else if (pressbutton == 'performswindow'){
        window.open('components/com_performs/performswindow.php?formId=<?php echo $row->id; ?>', 'win1', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');
        return;
      }
			// do field validation
			if ( form.title.value == "" ) {
				alert( "<?php echo TITLE_EMPTY;?>" );
			}
			 else {
				<?php getEditorContents( 'editor1', 'intro' ) ; ?>
				<?php getEditorContents( 'editor2', 'note' ) ; ?>
				submitform( pressbutton );
			}
		}
		function asubChange(){
			if(document.getElementById('to_url').checked){
				document.getElementById('url_row').style.display ='block';
				document.getElementById('tnx_row').style.display='none';	
			}else if(document.getElementById('to_tnx').checked){ 
				document.getElementById('url_row').style.display='none';
				document.getElementById('tnx_row').style.display='block';	
			}
		}
</script>
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
<form action="index2.php" method="post" name="adminForm">
  <table class="adminheading">
    <tr>
      <th> PerForms <?php echo PFVersionNumber(); ?>:<small> 
	  <?php echo (($row->id) ? EDIT : _NEW)." - \"".$row->title."\" (ID = ".$row->id.")" ;  ?> </small>
      </th>
    </tr>
  </table>
      <table width="100%"> 
    <tr>
      <td valign="top"><table class="adminform">
          <tr>
            <th colspan="2"> <?php echo FORM_DETAILS;?> </th>
          </tr>
          <tr>
            <td width="20%" align="right"> <?php echo TITLE;?> </td>
            <td ><input class="inputbox" type="text" name="title" size="50" value="<?php echo $row->title; ?>" />
            </td>
          </tr>
          <tr>
            <td width="20%" align="right" valign="top"><?php echo INTRO_TEXT;?></td>
              </tr><tr>
            <td colspan="2" ><?php
					// parameters : areaname, content, hidden field, width, height, rows, cols
					editorArea( 'editor1',  $row->intro , 'intro', '100%;', '200', '75', '20' ) ; ?>
            </td>
          </tr>
          <tr>
            <td colspan="2">
            <div style="border-top: thin dotted gray; margin-top: 6pt;">
            <table><tr>
            <td width="20%" align="right" valign="top"><?php echo MISSING_FIELD_TEXT;?></td>
            <td >
			<input class="inputbox" type="text" name="strMissingFieldMsg" size="50" value="<?php echo $row->strMissingFieldMsg; ?>" />
            </td>
          </tr>		  
          <tr>
            <td width="20%" align="right" valign="top"> <?php echo AFTER_SUBMIT;?> </td>
            <td >
			<input type="radio" value="1" onclick="asubChange()" name="asub" id="to_url" <?php echo $row->asub=="1"?"checked":"" ?>  /> <label for="to_url"><?php echo REDIRECT_TO_URL?> </label><br />
			<input type="radio" value="2"  onclick="asubChange()" name="asub" id="to_tnx" <?php echo $row->asub=="2"?"checked":"" ?> /> <label for="to_tnx"> <?php echo SHOW_TNX_TEXT?> </label>
            </td>
          </tr>			  
        </table></div></td>
        </tr>
          <tr>
		   <td colspan="2">
           <div id="url_row" style="width:100%; padding-top: 4pt; padding-left: 2pt; padding-bottom: 4pt;"> 
		    <table cellpadding="0" width="100%" cellspacing="0" border="0"><tr> 
        <td align="right" valign="middle"> <?php echo REDIRECT_URL;?> </td>
          <td style="vertical-align: middle;">
			<input class="inputbox" type="text" name="r_url" size="50" value="<?php echo $row->r_url; ?>" />
            </td>
		</tr></table> 
			</div> 
			</td>
          </tr>		  
          <tr >
		   <td colspan="2">
           <div id="tnx_row">
		    <table cellpadding="0" width="100%" cellspacing="0" border="0"><tr>		  
            <td colspan="2" align="right" valign="top"> <?php echo TNX_TEXT;?> </td>
              </tr><tr>
            <td colspan="2">
			<?php
					// parameters : areaname, content, hidden field, width, height, rows, cols
					editorArea( 'editor2',  $row->note , 'note', '100%;', '200', '75', '20' ) ; ?>
            </td>	</tr></table>	
			</div>
			 </td>		
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>		  
        </table></td>
              <td valign="top" width="400px"> 
              <?php
				$tabs->startPane("content-pane");
				$tabs->startTab(PRESENTATION_INFO,"publish-page");
				?>
<!--          <table width="440px" border="<?php echo $pfDebug; ?>" class="adminform"> -->
          <table border="<?php echo $pfDebug; ?>" class="adminform">
					
          <tr>
            <th colspan="3"> <?php echo PRESENTATION_INFO;?> </th>
          </tr>
					<tr><td colspan="3">
						<fieldset>
						<legend><?php echo PUBLISHING_INFO;?></legend>


  <div class="adminrow">
  <?php PFinfoIcon( PUBLISHED, PUBLISHED_INFO); ?>
  <label class="adminlabel" for="published"><?php echo PUBLISHED;?></label>
  <?php echo $lists['published']; ?>
  </div>
  <div class="adminrow">
  <?php PFinfoIcon( ACCESS, ACCESS_INFO); ?>
  <label class="adminlabel" for="access"><?php echo ACCESS;?></label>
  <?php echo $lists['access']; ?>
  </div>
  <div class="adminrow">
		<?php PFinfoIcon( START_PUBLISHING, START_PUBLISHING_INFO); ?>
		<label class="adminlabel" for="start_date"><?php echo START_PUBLISHING;?></label>
		<input class="text_area" type="text" name="start_date" id="start_date" size="24" value="<?php echo $row->start_date; ?>" />
		<input type="reset" class="button" value="..." onClick="return showCalendar('start_date', 'y-mm-dd');">
  </div>
  <div class="adminrow">
		<?php PFinfoIcon( FINISH_PUBLISHING, FINISH_PUBLISHING_INFO); ?>
		<label class="adminlabel" for="finish_date"><?php echo FINISH_PUBLISHING;?></label>
		<input class="text_area" type="text" name="finish_date" id="finish_date" size="24" value="<?php echo $row->finish_date; ?>" />
		<input type="reset" class="button" value="..." onClick="return showCalendar('finish_date', 'y-mm-dd');"/>
  </div>
  <div class="adminrow">
		<?php PFinfoIcon( NO_AUTH_MESSAGE, NO_AUTH_MESSAGE_INFO); ?>
		<label class="adminlabel" for="noAuthMessage"><?php echo NO_AUTH_MESSAGE;?></label>
		<textarea class="inputbox" name="noAuthMessage" size="10"><?php echo $row->noAuthMessage; ?></textarea>
  </div>
	</fieldset>
	<fieldset>
	<legend><?php echo FORM_DISPLAY;?></legend>
	<div class="adminrow">
	<?php PFinfoIcon( USE_CONTAINER, USE_CONTAINER_INFO); ?>
	<label class="adminlabel" for="useContainer"><?php echo USE_CONTAINER;?></label>
	<?php echo $lists['useContainer']; ?>
	</div>
	<div class="adminrow">
	<?php PFinfoIcon( SHOW_FORM_TITLE, SHOW_FORM_TITLE_INFO); ?>
	<label class="adminlabel" for="showFormTitle"><?php echo SHOW_FORM_TITLE;?></label>
	<?php echo $lists['showFormTitle']; ?>
	</div>
	<div class="adminrow">
	<?php PFinfoIcon( FORM_WIDTH, FORM_WIDTH_INFO); ?>
	<label class="adminlabel" for="formWidth"><?php echo FORM_WIDTH;?></label>
	<input class="inputbox" type="text" name="formWidth" size="5" value="<?php echo $row->formWidth; ?>" />
	</div>
	</fieldset>
		  <?php
			global $mosConfig_absolute_path;
		  	if (file_exists($mosConfig_absolute_path.'/administrator/components/com_securityimages/client.php')) {
//		  	if (file_exists('../../../administrator/components/com_securityimages/client.php')) {
		  ?>
          <fieldset>
					<legend>com_securityimages</legend>
  <div class="adminrow">
  <?php PFinfoIcon( USE_SECURITYIMAGES, USE_SECURITYIMAGES_INFO); ?>
  <label class="adminlabel" for="use_securityimages"><?php echo USE_SECURITYIMAGES;?></label>
  <?php echo $lists['use_securityimages']; ?>
  </div>
  <div class="adminrow">
  <?php PFinfoIcon( SECURITYIMAGESHELP, SECURITYIMAGESHELP_INFO); ?>
  <label class="adminlabel" for="securityHelpText"><?php echo SECURITYIMAGESHELP;?></label>
	<input class="inputbox" type="text" name="securityHelpText" size="20" value="<?php echo $row->securityHelpText; ?>" />
  </div>
	<div>&nbsp;</div>
  <div class="adminrow">
  <?php PFinfoIcon( SECURITYIMAGESERROR, SECURITYIMAGESERROR_INFO); ?>
  <label class="adminlabel" for="securityErrorText"><?php echo SECURITYIMAGESERROR;?></label>
	<input class="inputbox" type="text" name="securityErrorText" size="20" value="<?php echo $row->securityErrorText; ?>" />
  </div>
              <?php
              } else {
                ?>
                <?php
                report_message( NO_SI_INSTALLED, NO_SI_INSTALLED_INFO );
                ?>
                <?php
              }
            ?>
          </fieldset>		  
					</td></tr>
					
        </table>
        <?php
				$tabs->endTab();
				$tabs->startTab(IMAGES_TAB,"images-page");
				?>
        <table width="100%" class="adminform">
          <tr>
            <th colspan="3"> <?php echo IMAGE_INFO;?> </th>
          </tr>
          <tr>
            <td><?php PFinfoIcon( IMAGE_INFO, IMAGE_INFO_INFO); ?></td>
            <td align="left" width="20%"> <?php echo IMAGE;?>: </td>
            <td align="left"><?php echo $lists['image']; ?> </td>
          </tr>
          <tr>
            <td><?php PFinfoIcon( IMAGEFLOAT, IMAGEFLOAT_INFO); ?></td>
            <td align="left" width="20%"> <?php echo IMAGEFLOAT;?>: </td>
            <td align="left"><?php echo $lists['imagefloat'] ?> </td>
          </tr>
          <tr>
              <td colspan="3"><div style="padding:12pt;"><script language="javascript" type="text/javascript">
					if (document.forms[0].image.options.value!=''){
            <?php
            if (isJ10()) {
              ?>
              jsimg='../images/stories/' + getSelectedValue( 'adminForm', 'image' );
              <?php
            } else {
              ?>
              jsimg='<?php echo $mosConfig_live_site; ?>/images/stories/' + getSelectedValue( 'adminForm', 'image' );
              <?php
            }
            ?>
					} else {
						jsimg='../images/M_images/blank.png';
					}
            document.write('<img src=' + jsimg + ' name="imagelib" width="100%" border="2" alt="Preview" />');
					asubChange();
					</script></div>
            </td>
          </tr>
        </table>
        <?php
			$tabs->endTab();
			$tabs->startTab(THEMES_TAB,"themes-page");
			?>
        <table width="100%" class="adminform">
          <tr>
            <th colspan="2"> <?php echo THEME_INFO;?> </th>
          </tr>
          <tr>
            <td align="left" width="20%"> <?php echo THEME;?>: </td>
            <td align="left"><?php echo $lists['themes']; ?> </td>
          </tr>
          <tr>
            <td colspan="2"><div style="padding:12pt;"><script language="javascript" type="text/javascript">
					if (document.forms[0].theme.options.value!=''){
						jsimg1='../components/com_performs/skins/' +getSelectedValue( 'adminForm', 'theme' );
					} else {
						jsimg1='../images/M_images/blank.png';
					}
					document.write('<img src=' + jsimg1 + ' name="themelib" width="100%" border="2" alt="Preview" />');
					</script></div>
            </td>
          </tr>
        </table>				
			<?php
			$tabs->endTab();
			$tabs->startTab(BUTTONS_TAB,"buttons-page");
				?>
  <table width="100%" class="adminform">
  <tr>
  <th colspan="3"> <?php echo FORM_BUTTONS;?> </th>
  </tr>
  <tr><td colspan="3">
  <fieldset>
  <legend><?php echo SUBMIT;?></legend>
  <div class="adminrow">
  <?php PFinfoIcon( INCLUDE_SUBMIT, INCLUDE_SUBMIT_INFO); ?>
  <label class="adminlabel" for="includeSubmit"><?php echo INCLUDE_SUBMIT;?></label>
  <?php echo $lists['includeSubmit']; ?>
  </div>
  <div class="adminrow">
  <?php PFinfoIcon( SUBMIT_LABEL_TITLE, SUBMIT_LABEL_INFO); ?>
  <label class="adminlabel" for="submitLabel"><?php echo SUBMIT_LABEL_TITLE;?></label>
  <input class="inputbox" type="text" name="submitLabel" size="25" value="<?php echo $row->submitLabel; ?>" />
  </div>
  <div class="adminrow">
  <?php PFinfoIcon( REPLACE_SUBMIT_BUTTON, REPLACE_SUBMIT_BUTTON_INFO); ?>
  <label class="adminlabel" for="replaceSubmit"><?php echo REPLACE_SUBMIT_BUTTON;?></label>
  <?php echo $lists['replaceSubmit']; ?>
  </div>
  <div class="adminrow">
  <?php PFinfoIcon( SUBMIT_IMAGE_URL, SUBMIT_IMAGE_URL_INFO); ?>
  <label class="adminlabel" for="submitImageUrl"><?php echo SUBMIT_IMAGE_URL;?></label>
  <input class="inputbox" type="text" name="submitImageUrl" size="25" value="<?php echo $row->submitImageUrl; ?>" />
  </div>
  <div class="adminrow">
  <?php PFinfoIcon( SUBMIT_IMAGE_WIDTH, SUBMIT_IMAGE_WIDTH_INFO); ?>
  <label class="adminlabel" for="submitImageWidth"><?php echo SUBMIT_IMAGE_WIDTH;?></label>
  <input class="inputbox" type="text" name="submitImageWidth" size="5" value="<?php echo $row->submitImageWidth; ?>" />
  </div>
  <div class="adminrow">
  <?php PFinfoIcon( SUBMIT_IMAGE_HEIGHT, SUBMIT_IMAGE_HEIGHT_INFO); ?>
  <label class="adminlabel" for="submitImageHeight"><?php echo SUBMIT_IMAGE_HEIGHT;?></label>
  <input class="inputbox" type="text" name="submitImageHeight" size="5" value="<?php echo $row->submitImageHeight; ?>" />
  </div>
  </fieldset>
  </td></tr>
  <tr><td colspan="3">
  <fieldset>
  <legend><?php echo RESET;?></legend>
  <div class="adminrow">
  <?php PFinfoIcon( INCLUDE_RESET, INCLUDE_RESET_INFO); ?>
  <label class="adminlabel" for="includeReset"><?php echo INCLUDE_RESET;?></label>
  <?php echo $lists['includeReset']; ?>
  </div>
  <div class="adminrow">
  <?php PFinfoIcon( RESET_LABEL, RESET_LABEL_INFO); ?>
  <label class="adminlabel" for="resetLabel"><?php echo RESET_LABEL;?></label>
  <input class="inputbox" type="text" name="resetLabel" size="25" value="<?php echo $row->resetLabel; ?>" />
  </div>
  <div class="adminrow">
  <?php PFinfoIcon( REPLACE_RESET_BUTTON, REPLACE_RESET_BUTTON_INFO); ?>
  <label class="adminlabel" for="replaceReset"><?php echo REPLACE_RESET_BUTTON;?></label>
  <?php echo $lists['replaceReset']; ?>
  </div>
  <div class="adminrow">
  <?php PFinfoIcon( RESET_IMAGE_URL, RESET_IMAGE_URL_INFO); ?>
  <label class="adminlabel" for="resetImageUrl"><?php echo RESET_IMAGE_URL;?></label>
  <input class="inputbox" type="text" name="resetImageUrl" size="25" value="<?php echo $row->resetImageUrl; ?>" />
  </div>
  <div class="adminrow">
  <?php PFinfoIcon( RESET_IMAGE_WIDTH, RESET_IMAGE_WIDTH_INFO); ?>
  <label class="adminlabel" for="resetImageWidth"><?php echo RESET_IMAGE_WIDTH;?></label>
  <input class="inputbox" type="text" name="resetImageWidth" size="5" value="<?php echo $row->resetImageWidth; ?>" />
  </div>
  <div class="adminrow">
  <?php PFinfoIcon( RESET_IMAGE_HEIGHT, RESET_IMAGE_HEIGHT_INFO); ?>
  <label class="adminlabel" for="resetImageHeight"><?php echo RESET_IMAGE_HEIGHT;?></label>
  <input class="inputbox" type="text" name="resetImageHeight" size="5" value="<?php echo $row->resetImageHeight; ?>" />
  </div>
  </fieldset>
  </td></tr>
  <tr><td colspan="3">
  <fieldset>
  <legend><?php echo PRINTER_FRIENDLY;?></legend>
  <div class="adminrow">
  <?php PFinfoIcon( INCLUDE_PF, INCLUDE_PF_INFO); ?>
  <label class="adminlabel" for="includePF"><?php echo INCLUDE_PF;?></label>
  <?php echo $lists['includePF']; ?>
  </div>
  </td></tr>
  <?php
  $html2pdf = false;
	global $mosConfig_absolute_path;
  $html2pdf = file_exists($mosConfig_absolute_path.'/../html2fpdf-3.0.2b') ;
  if (!$html2pdf) $html2pdf = file_exists($mosConfig_absolute_path.'/html2fpdf-3.0.2b') ;
  if (!$html2pdf) $html2pdf = file_exists($mosConfig_absolute_path.'/administrator/components/com_performs/html2fpdf-3.0.2b') ;
  $withVirtuemart = file_exists($mosConfig_absolute_path.'/administrator/components/com_virtuemart/classes/pdf') ;
  if ( $html2pdf || $withVirtuemart ) {
    ?>
    <tr><td colspan="3">
    <fieldset>
    <legend><?php echo DOWNLOAD_PDF;?></legend>
      <div class="adminrow">
      <?php PFinfoIcon( INCLUDE_PDF, INCLUDE_PDF_INFO); ?>
      <label class="adminlabel" for="includePDF"><?php echo INCLUDE_PDF;?></label>
      <?php echo $lists['includePDF']; ?>
      </div>
      </td></tr>
      <?php
  } else {
    ?><tr><td colspan="3"><?php
    report_message( NO_PDF_INSTALLED, NO_PDF_INSTALLED_INFO );
    ?></tr><?php
}
?>
<tr><td colspan="3"><hr /></td></tr>
</table>
        <?php
			$tabs->endTab();		
			$tabs->startTab(EMAILS_TAB,"emails-page");
				?>
        <table width="100%" class="adminform">
          <tr>
            <th colspan="3"> <?php echo EMAILS_TAB?> </th>
          </tr>
					<tr><td colspan=3>
					<fieldset><legend><?php echo EMAIL_FORM; ?></legend>
  <div class="adminrow">
  <?php PFinfoIcon( EMAIL_FORM, EMAIL_FORM_INFO); ?>
  <label class="adminlabel" for="mailIt"><?php echo EMAIL_FORM;?></label>
  <?php echo $lists['mailIt']; ?>
  </div>
  <div class="adminrow">
  <?php PFinfoIcon( FROM, FROM_INFO); ?>
  <label class="adminlabel" for="from"><?php echo FROM;?></label>
	<input name="from" class="inputbox" type="text" size="25" maxlength="60" value="<?php echo $row->from; ?>" />
  </div>
  <div class="adminrow">
  <?php PFinfoIcon( TO, TO_INFO); ?>
  <label class="adminlabel" for="emails"><?php echo TO;?></label>
	<textarea name="emails" class="inputbox" rows="3" cols="24" ><?php echo $row->emails; ?></textarea>
  </div>
	</fieldset>
	<fieldset><legend><?php echo EMAIL_SUBJECT; ?></legend>
  <div class="adminrow">
  <?php PFinfoIcon( EMAIL_SUBJECT, EMAIL_SUBJECT_INFO); ?>
  <label class="adminlabel" for="mailSubject"><?php echo EMAIL_SUBJECT;?></label>
	<input class="inputbox" type="text" name="mailSubject" size="25" value="<?php echo $row->mailSubject; ?>" />
  </div>
  <div class="adminrow">
  <?php PFinfoIcon( APPEND_TIMESTAMP, APPEND_TIMESTAMP_INFO); ?>
  <label class="adminlabel" for="appendtimestamp"><?php echo APPEND_TIMESTAMP;?></label>
	<?php echo $lists['appendtimestamp']; ?>
  </div>
</fieldset>
<fieldset><legend><?php echo EXTRA_RECIPIENTS; ?></legend>
  <div class="adminrow">
  <?php PFinfoIcon( EMAIL_ADMIN, EMAIL_ADMIN_INFO); ?>
  <label class="adminlabel" for="mailToAdmin"><?php echo EMAIL_ADMIN;?></label>
  <?php echo $lists['mailToAdmin']; ?>
  </div>
  <div class="adminrow">
  <?php PFinfoIcon( EMAIL_USER, EMAIL_USER_INFO); ?>
  <label class="adminlabel" for="mailToUser"><?php echo EMAIL_USER;?></label>
  <?php echo $lists['mailToUser']; ?>
  </div>
</fieldset>
<fieldset><legend><?php echo MAIL_OPTIONS; ?></legend>
  <div class="adminrow">
  <?php PFinfoIcon( ENABLE_MAILFROM, ENABLE_MAILFROM_INFO); ?>
  <label class="adminlabel" for="enableMailFrom"><?php echo ENABLE_MAILFROM;?></label>
  <?php echo $lists['enableMailFrom']; ?>
  </div>
  <div class="adminrow">
  <?php PFinfoIcon( INTRO_INCLUDE, INTRO_INCLUDE_INFO); ?>
  <label class="adminlabel" for="useintro"><?php echo INTRO_INCLUDE;?></label>
  <?php echo $lists['useintro']; ?>
  </div>
  <div class="adminrow">
  <?php PFinfoIcon( EMAIL_ALWAYS, EMAIL_ALWAYS_INFO); ?>
  <label class="adminlabel" for="mailAlways"><?php echo EMAIL_ALWAYS;?></label>
	<?php echo $lists['mailAlways']; ?> 
  </div>
  <div class="adminrow">
  <?php PFinfoIcon( MAIL_AS_TEXT, MAIL_AS_TEXT_INFO); ?>
  <label class="adminlabel" for="mailAsText"><?php echo MAIL_AS_TEXT;?></label>
	<?php echo $lists['mailAsText']; ?>
  </div>
  <div class="adminrow">
  <?php PFinfoIcon( ATTACH_XML_FORM, ATTACH_XML_FORM_INFO); ?>
  <label class="adminlabel" for="attachXmlFile"><?php echo ATTACH_XML_FORM;?></label>
	<?php echo $lists['attachXmlFile']; ?>
  </div>
  <div class="adminrow">
  <?php PFinfoIcon( ATTACH_XML_FORM_USER, ATTACH_XML_FORM_USER_INFO); ?>
  <label class="adminlabel" for="attachXmlFileUSER"><?php echo ATTACH_XML_FORM_USER;?></label>
	<?php echo $lists['attachXmlFileUSER']; ?>
  </div>


					</fieldset>
					</td></tr>
        </table>
        <?php
			$tabs->endTab();		
			$tabs->endPane();
			?>
      </td>
    </tr>
  </table>
  <script language="Javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/overlib_mini.js"></script>
  <input type="hidden" name="option" value="<?php echo $option; ?>" />
  <input type="hidden" name="id" value="<?php echo $row->id; ?>" />
  <input type="hidden" name="task" value="" />
</form>
<?php
	}
function editformitem( &$row, &$lists, $option ){
		global $mosConfig_live_site, $pfDebug;
if (!isset($_REQUEST['webfxtab_content-pane'])) $_REQUEST['webfxtab_content-pane'] = 0;
//		$tabs = new mosTabs(0);
		$tabs = new mosTabs(1);
		mosMakeHtmlSafe( $row, ENT_QUOTES, 'misc' );
		?>
<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancelItem') {
				submitform( pressbutton );
				return;
      } else if (pressbutton == 'performswindow'){
        window.open('components/com_performs/performswindow.php?formId=<?php echo $row->formId; ?>', 'win1', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');
        return;
      }
			// do field validation
			if ( form.caption.value == "" ) {
				alert( "<?php echo CAPTION_EMPTY;?>" );
			} else if ( form.name.value == "" ) {
				alert( "<?php echo NAME_EMPTY;?>" );
			} else {
				for(var i = 0;i < form.elements["values[]"].length;i++){
					form.elements["values[]"].options[i].selected = true;
				}
				submitform( pressbutton );
			}
		}		
		</script>
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
<form action="index2.php" method="post" name="adminForm">
  <table class="adminheading">
    <tr>
      <th> PerForms <?php echo PFVersionNumber(); ?>: <small> <?php echo ITEMS;?>:</small> <small> <?php echo $row->itemId ? EDIT : _NEW;?> </small>
        <br><strong style="color: maroon;"><?php echo $row->caption; ?></strong> </th>
    </tr>
  </table>
  <table width="100%">
    <tr>
          <td valign="top">
        <table class="adminform" style="width: 100%;">
          <tr>
            <th colspan="3"> <?php echo FORM_ITEMS_DETAILS;?> </th>
          <tr>
              <tr>
              <td width="20%" align="right"> <?php echo CAPTION;?>: * </td>
                <td ><input class="inputbox" type="text" name="caption" size="50" value="<?php echo $row->caption; ?>" />
                </td>
                <td><?php PFinfoIcon( CAPTION, CAPTION_INFO); ?></td>
                </tr>
                <tr>
                <td width="20%" align="right"> <?php echo ACCESSKEY;?>: * </td>
                  <td ><input class="inputbox" type="text" name="accesskey" size="4" value="<?php echo $row->accesskey; ?>" />
                  </td>
                  <td><?php PFinfoIcon( ACCESSKEY, ACCESSKEY_INFO); ?></td>
                  </tr>
									
                  <tr>
            <td width="20%" align="right"> <?php echo NAME;?>: *<br /><small><?php echo NO_SPECIAL_CHARS;?></small> </td>
            <td ><input class="inputbox" type="text" name="name" onchange="nameAlphaChars();" size="50" value="<?php echo $row->name; ?>" />
              <td><?php PFinfoIcon( NAME, NAME_INFO); ?></td>
            </td>
          </tr>
					
<!--            <tr><td></td>
                <td>
                  <input type="hidden" name="name" value="<?php echo $row->name;?>"> 
                </td><td></td>
                </tr> -->
								
          <tr>
            <td width="20%" align="right" valign="top"> <?php echo TYPE;?>: </td>
            <td ><?php echo $lists['types']; ?> </td>
              <td><?php PFinfoIcon( TYPE, TYPE_INFO); ?></td>
          </tr>
          <tr>
            <td width="20%" align="right" valign="top"> <?php echo CHECK;?>: </td>
            <td ><?php echo $lists['checks']; ?> </td>
              <td><?php PFinfoIcon( CHECK, CHECK_INFO); ?></td>
          </tr>
          <tr>
            <td width="20%" align="right"> <?php echo HELP_TEXT;?>: </td>
            <td >
              <!-- <input class="inputbox" type="text" name="help" size="50" value="<?php echo $row->help; ?>" /> -->
              <textarea name="help" cols="50" rows="5" ><?php echo $row->help; ?></textarea>
            </td>
                <td><?php PFinfoIcon( HELP_TEXT, HELP_TEXT_INFO); ?></td>
          </tr>
          <tr>
            <td width="20%" align="right"> <?php echo ERROR_MSG;?>: </td>
            <td >
                <!-- <input class="inputbox" type="text" name="errMsg" size="50" value="<?php echo $row->errMsg; ?>" /> -->
                <textarea name="errMsg" cols="50" rows="5" ><?php echo $row->errMsg; ?></textarea>
            </td>
                  <td><?php PFinfoIcon( ERROR_MSG, ERROR_MSG_INFO); ?></td>
          </tr>
        </table></td>
        <td width="480px" valign="top">
      <?php
				$tabs->startPane("content-pane");
				$tabs->startTab(DISPLAY_TAB,"display-page");
				?>
        <table width="100%" class="adminform">
          <tr>
            <th colspan="3"> <?php echo DISPLAY_PROP;?> </th>
          <tr>
          <tr>
            <td valign="top" align="left"><?php echo SIZE1;?>: </td>
            <td><input class="inputbox" type="text" name="var1" size="5" value="<?php echo $row->var1; ?>" />
            </td>
              <td><?php PFinfoIcon( SIZE1, SIZE1_INFO); ?></td>
          </tr>
          <tr>
            <td valign="top" align="left"><?php echo SIZE2;?>: </td>
            <td ><input class="inputbox" type="text" name="var2" size="12" value="<?php echo $row->var2; ?>" />
            </td>
              <td><?php PFinfoIcon( SIZE2, SIZE2_INFO); ?></td>
          </tr>
          <tr>
            <td valign="top" align="left"> <?php echo REQUIRED;?>: </td>
            <td><?php echo $lists['required']; ?> </td>
              <td><?php PFinfoIcon( REQUIRED, REQUIRED_INFO); ?></td>
          </tr>
          <tr>
            <td valign="top" align="left"> <?php echo DISABLED;?>: </td>
            <td><?php echo $lists['disabled']; ?> </td>
              <td><?php PFinfoIcon( DISABLED, DISABLED_INFO); ?></td>
          </tr>
          <tr>
            <td valign="top" align="left"> <?php echo READONLY;?>: </td>
            <td><?php echo $lists['readonly']; ?> </td>
              <td><?php PFinfoIcon( READONLY, READONLY_INFO); ?></td>
          </tr>
          <tr>
            <td valign="top" align="left"> <?php echo MULTIPLE;?>: </td>
            <td><?php echo $lists['multiple']; ?> </td>
              <td><?php PFinfoIcon( MULTIPLE, MULTIPLE_INFO); ?></td>
          </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr>
            <td valign="top" align="left"><?php echo CAPTIONCSSCLASS;?>: </td>
            <td ><input class="inputbox" type="text" name="captionCssClass" size="12" value="<?php echo $row->captionCssClass; ?>" />
            </td>
            <td><?php PFinfoIcon( CAPTIONCSSCLASS, CAPTIONCSSCLASS_INFO); ?></td>
          </tr>
          <tr>
            <td valign="top" align="left"><?php echo VALUECSSCLASS;?>: </td>
            <td ><input class="inputbox" type="text" name="valueCssClass" size="12" value="<?php echo $row->valueCssClass; ?>" />
            </td>
            <td><?php PFinfoIcon( VALUECSSCLASS, VALUECSSCLASS_INFO); ?></td>
          </tr>
          <tr>
            <td valign="top" align="left"><?php echo INFOCSSCLASS;?>: </td>
            <td ><input class="inputbox" type="text" name="infoCssClass" size="12" value="<?php echo $row->infoCssClass; ?>" />
            </td>
            <td><?php PFinfoIcon( INFOCSSCLASS, INFOCSSCLASS_INFO); ?></td>
          </tr>
          <tr>
            <td valign="top" align="left"><?php echo ERRORCSSCLASS;?>: </td>
            <td ><input class="inputbox" type="text" name="errorCssClass" size="12" value="<?php echo $row->errorCssClass; ?>" />
            </td>
            <td><?php PFinfoIcon( ERRORCSSCLASS, ERRORCSSCLASS_INFO); ?></td>
          </tr>
        </table>
        <?php
				$tabs->endTab();
				$tabs->startTab(VALUES_TAB,"values-page");
				?>
        <table border="<?php echo ( ( $pfDebug ) ? '1' : '0') ?>" width="100%" class="adminform">
          <tr>
            <th colspan="4"> <?php echo VALUES_INFO;?> </th>
          </tr>
              <tr>
              <td colspan="4">&nbsp;</td>
                </tr>
          <tr>
            <td align="left" width="20%"> <?php echo VALUE;?>: </td>
            <td align="left"><input class="inputbox" type="text" name="value" size="35" value="<?php echo $row->value; ?>" />
            </td><td><input type="button" name="insert" value="<?php echo INSERT; ?>" onclick="insertValue();" />
          </td>
              <td><?php PFinfoIcon(VALUE, VALUE_INFO); ?></td>
          </tr>
          <tr>
            <td align="left"><?php echo LIST_VALUES;?>: </td>
            <td align="left" rowspan="6">
				<?php echo $lists['values']; ?></td>
          </td><td></td><td></td></tr>
          <tr>
          <td></td>
          <td>
        <INPUT TYPE="button" VALUE="&nbsp;<?php echo UP; ?>&nbsp;" name="up" onClick="moveOptionUp(document.adminForm.values)">
          </td><td style="text-align: right;">
          <?php PFinfoIcon(VALUE_UP, VALUE_UP_INFO); ?>
            </td></tr>
            <tr>
            <td></td>
            <td>
        <INPUT TYPE="button" name="down" VALUE="<?php echo DOWN?>" onClick="moveOptionDown(document.adminForm.values)">
            </td><td style="text-align: right;">
          <?php PFinfoIcon(VALUE_DOWN, VALUE_DOWN_INFO); ?>
            </td></tr>
            <tr>
            <td></td>
            <td>
            <input type="button" name="remove" value="<?php echo REMOVE; ?>"	onclick="removeValue();" />
            </td><td style="text-align: right;">
            <?php PFinfoIcon(REMOVE, REMOVE_INFO); ?>
            </td></tr>
            <tr>
              <td></td>
              <td>
              <input type="button" name="setasselected" value="<?php echo SET_AS_SELECTED; ?>"	onclick="setSelectedValue();" />
              </td><td style="text-align: right;">
              <?php PFinfoIcon(SET_AS_SELECTED, SET_AS_SELECTED_INFO); ?>
            </td></tr>
		  <tr>
            <td colspan="2">
       </td>
          <td></td>
          </tr>
          <tr>
            <td align="left" width="20%"><?php echo SELECTED_VALUE;?>: </td>
            <td align="left"><input class="inputbox" type="text" name="checkOrSelect" readonly="true" size="35" value="<?php echo $row->checkOrSelect; ?>" />
			</td><td></td>
              <td><?php PFinfoIcon(SELECTED_VALUE, SELECTED_VALUE_INFO); ?></td>
          </tr>		  
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr>
        </table>
        <?php
				$tabs->endTab();
				$tabs->startTab(FORMAT_TAB,"format-page");
				?>
        <table width="100%" class="adminform">
          <tr>
          <th colspan="3"> <?php echo FORMAT_INFO; ?> </th>
          </tr>
          <tr>
          <td align="left" width="20%"><?php echo USE_CAPTION; ?></td>
            <td ><?php echo $lists['usecaption']; ?> </td>
              <td><?php PFinfoIcon( USE_CAPTION, USE_CAPTION_INFO); ?></td>
          </tr>
          <tr>
                <td align="left" width="20%"><?php echo FIELD_SEPARATOR; ?></td>
            <td ><?php echo $lists['separators']; ?> </td>
              <td><?php PFinfoIcon( FIELD_SEPARATOR, FIELD_SEPARATOR_INFO); ?></td>
          </tr>
          <tr>
            <td align="left" width="20%"><?php echo SHOW_UPLOADED_IMAGE; ?></td>
            <td ><?php echo $lists['showuploadedimage']; ?> </td>
            <td><?php PFinfoIcon( SHOW_UPLOADED_IMAGE, SHOW_UPLOADED_IMAGE_INFO); ?></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
        </table>
        <?php
				$tabs->endTab();
				$tabs->endPane();
				?>
      </td>
    </tr>
  </table>
  	<script language="javascript" src="<?php echo $mosConfig_live_site;?>/administrator/components/com_performs/selectbox.js" > </script>	
  <script language="Javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/overlib_mini.js"></script>
  <input type="hidden" name="formId" value="<?php echo $row->formId; ?>" />
  <input type="hidden" name="option" value="<?php echo $option; ?>" />
          <input type="hidden" name="itemId" value="<?php echo $row->itemId; ?>" />
          <input type="hidden" name="ordering" value="<?php echo $row->ordering; ?>" />
  <input type="hidden" name="task" value="" />
</form>

<script language="javascript">		
		function setSelectedValue(){
			var form = document.adminForm;	
			
			if(form.elements["values[]"].selectedIndex==-1)
				return;
			
		form.checkOrSelect.value = form.elements["values[]"].options[form.elements["values[]"].selectedIndex].value;
		}
		
		function insertValue(){
			var form = document.adminForm;	
			if(form.value.value!="")
			 form.elements["values[]"].options[form.elements["values[]"].length]= new Option(form.value.value, form.value.value);
			 
			 form.value.value = "";	
			 form.value.focus();
		}		
		function removeValue(){
			var form = document.adminForm;	
			
			if(form.elements["values[]"].selectedIndex==-1)
				return;
			for(var i=form.elements["values[]"].options.length-1; i>=0;i--){
			 	if(form.elements["values[]"].options[i].selected)
			 		form.elements["values[]"].options[i]= null;	
			 }
		}					
		function setSize()
		{	
			var form = document.adminForm;		

			form.var2.disabled = true;
			form.var1.disabled = true;
			form.multiple.disabled = true;
			form.up.disabled = true;
			form.down.disabled = true;			
			form.var2.value=""; 
			form.var1.value="";

    		for (var i=0;i < form.multiple.length;i++)
        		form.multiple[i].disabled=true;
								
			var selected = form.type.options[form.type.selectedIndex].value;
			if (selected=='file') {
				form.values.disabled = false;
				form.setasselected.disabled = true;
				form.insert.disabled = true;
				form.remove.disabled = true;
				form.up.disabled = true;
				form.down.disabled = true;				
      }
      
			if(selected=='select' || selected=='checkbox' || selected=='radio'){
				form.values.disabled = false;
				form.setasselected.disabled = false;
				form.insert.disabled = false;
				form.remove.disabled = false;
				form.up.disabled = false;
				form.down.disabled = false;				
			}
			else{
				form.values.disabled = true;
				form.setasselected.disabled = true;
				form.insert.disabled = true;
				form.remove.disabled = true;			
				form.up.disabled = true;
				form.down.disabled = true;				
				
			}
			
			if (selected=='select')
			{
				form.var1.disabled = false;
				form.var1.value="1" ;
	 	 		for (var i=0;i < form.multiple.length;i++)
        			form.multiple[i].disabled=false;				
				return;
			} else if(selected=='text'){
				form.var1.disabled = false;
				form.var1.value="20" ;
				return;			
			} else if(selected=='file'){
				form.var1.disabled = false;
        form.var2.disabled = false;
        form.var1.value = "20";
				form.var2.value="16384" ;
				return;			
			} else if(selected=='textarea'){
				form.var1.disabled = false;
				form.var2.disabled = false;
				form.var1.value="40" ;
				form.var2.value = "5";				
				return;			
			} 
		}
		var var1 = document.adminForm.var1.value;
		var var2 = document.adminForm.var2.value;

		setSize();
		if(var1!="")
		 document.adminForm.var1.value="<?php echo $row->var1; ?>";
		if(var2!="")		 
		 document.adminForm.var2.value="<?php echo $row->var2; ?>"		
		 	 
</script>
<?php
	}	

/* Prints a summary report of the table bound to a form
* @author David Walters
* @date 2007-02
*/ 
function showBoundTable($cid, &$row, $option, &$pageNav) {
  global $mosConfig_live_site, $database, $mainframe, $mosConfig_list_limit;
		?>
      <table style="width:100%;">
      <tr>
      <td>
      <table class="adminheading">
      <tr>
			<th>
      <?php 
      echo BOUNDDATA.': '.$row->title.' ';
    if ($row->tablename) {
      echo '<small><small>['.$row->tablename.']</small></small>';
    }
    ?>
			</th>
      </tr>
      </table>
      </td>
      </tr>
      <tr>
      <td>
      <form action="index2.php" method="post" name="adminForm" id="adminForm">
      <table class="adminlist" style="width:100%;">
      <?php
      if(!empty($row->tablename)){
        $database->setQuery( "SELECT COUNT(*) FROM ".$row->tablename);
        $r = $database->loadResult();
      }
//    require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
//    $limit 		= $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
//    $limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );
//    $pageNav = new mosPageNav( $r, $limitstart, $limit  );	
    if ($row->tablename) {
    require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
    $limit 		= $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
    $limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );
    $pageNav = new mosPageNav( $r, $limitstart, $limit  );	
      $sqltxt = "SELECT * FROM ".$row->tablename."\n LIMIT $pageNav->limitstart, $pageNav->limit";
      $database->setQuery($sqltxt);
      $database->query();
      $results = $database->loadRowList();
      echo '<tr style="font-style:italic;">';
      $headings = $database->getTableFields( array($row->tablename) );
      $hdngs = $headings[$row->tablename];
      echo '<th class="title">#</th>';
			$guidindex = -1;
			$hdgindex = -1;
      foreach ($hdngs as $hname=>$type) {
        echo '<th class="title" style="font-weight: bold;">'.$hname.'</th>';
				++$hdgindex;
				if ($hname == "GUID") $guidindex = $hdgindex;
      }
      echo '</tr>';
      $rc = 0;
      foreach ($results as $rval) {
        echo '<tr class="row'.($rc % 2).'">';
//        echo '<td>'.$pageNav->rowNumber($rc).'</td>';
        echo '<td nowrap>';
				if (($guidindex > -1) && ($rval[$guidindex] != "")){
					echo '<a href="'. $mosConfig_live_site 
					. '/administrator/index2.php?option=com_performs&task=ViewSubmission&hidemainmenu=1&GUID='
					. $rval[$guidindex]
					.'&formid='
					. $row->id
					. '">'
					//.$pageNav->rowNumber($rc)
					.' &nbsp; <img alt="Click to view" width="20px" src="' . $mosConfig_live_site 
					. "/administrator/images/query.png" . '" /></a></td>';
				}
        $n = count($rval);
        for($j = 0; $j < $n; $j++) {
//          echo '<td><pre style="font-family: inherit;">'.$rval[$j].'</pre></td>';
          echo '<td>'.str_replace(PF_RECORD_SEPARATOR, ",", $rval[$j]).'</td>';
        }
        echo '</tr>';
        $rc++;
      }
      echo '</table>';
      echo $pageNav->getListFooter();
    } else {
      echo '<center>';
      report_messageEX(FORM.' '.$row->id.' "'.$row->title.'" '.NOT_BOUND, TABLE_NAME_EMPTY, CLICK_BINDING_BUTTON);
      echo "\n\n</center>";
    }
    ?>
      </td>
      </tr>
      <tr>
      <td style="text-align: right;"><?php if ( defined ('_BACK') ) { ?><a onclick="submitform('');"><?php echo _BACK; ?></a><?php } ?></td>
      </tr>
      </table>
      <input type="hidden" name="option" value="<?php echo $option; ?>" />
      <input type="hidden" name="task" value="showData" />
      <input type="hidden" name="cid" value="<?php echo $cid; ?>" /> 
      <input type="hidden" name="formrowindex" value="<?php echo $cid; ?>" /> 
      <input type="hidden" name="hidemainmenu" value="0">
      </form>
      <?php
}

function exportToExcel ( &$row , $option, $formid) {
  global $mosConfig_live_site, $database;
  $headings = $database->getTableFields( array($row->tablename) );
  $hdngs = $headings[$row->tablename];
  $tableheadings = '';
  $headingcount = count($hdngs);
  foreach ($hdngs as $hname=>$type) {
    $tableheadings = $tableheadings.$hname;
    if (--$headingcount > 0) $tableheadings.=',';
  }
  mosRedirect('components/com_performs/performsReport.php?formId='.$formid.'&t='.$tableheadings.'&show=1');
}

function editDBTable(&$row,$option){
		global $mosConfig_live_site;
		?>
      <script language="javascript" type="text/javascript">
      function submitbutton(pressbutton) {
        var form = document.adminForm;
        var tablename= "<?php echo $row->tablename; ?>";
        if (pressbutton == 'cancel') {
          submitform( pressbutton );
          return;
        }
        
        // do field validation
        if(tablename==""){
          if ( form.tablename.value == "" ) {
            alert( "<?php echo TABLE_NAME_EMPTY;?>" );
          } else {
            submitform( pressbutton );
          }
        }
        else {
          if(confirm("<?php echo DELETE_DATA_CONFIRM;?>"))
            submitform( pressbutton );
        }
      }
		</script>
      <div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
      <form action="index2.php" method="post" name="adminForm">
      <table class="adminheading">
      <tr>
			<th>
perForms:
			<small>
			<?php echo $row->tablename ? TABLE_ALREADY_CREATED : CREATE_DATABASE_TABLE;?>
        </small>
        </th>
        </tr>
        </table>
        <table width="100%">
        <tr>
        <td width="60%" valign="top">
				<table width="100%" class="adminform">
				<tr>
        <td align="right" colspan="2">
        <?php if(empty($row->tablename))
          echo NOT_BOUND_TO_TABLE;
  else echo BOUND_TO_TABLE.$row->tablename;  ?>
    </td>
				</tr>
    <?php if(empty($row->tablename)){ ?>	
      <tr>
      <td colspan="2">
						<ul>
      <li><?php echo BOUND_INFO1;?> </li>
        <li><?php echo BOUND_INFO2;?> </li>
          </ul>
					</td>
          </tr>
          <tr>
					<td width="10%" align="right">
          <?php echo TABLE_NAME;?> 
            </td>
            <td align="right">
						<input class="inputbox" type="text" name="tablename" size="50" value="usr_performs_table<?php echo $row->id;?>"/>
            </td>					
            </tr>
            <?php }
  else {
    ?>		
				<tr>
    <td colspan="2">
    <ul>
    <li> <?php printf(DELETE_FORM_INFO1, $row->tablename); ?></li>
      <li><?php echo DELETE_FORM_INFO2;?> </li>
        <li> <?php echo DELETE_FORM_INFO3;?></li>
          </ul>
					</td>
          </tr>
          <tr>
					<td width="10%" align="right">
          <?php echo DELETE_TABLE;?>  
            </td>
            <td align="right">
						<input class="inputbox" type="checkbox" name="delete" value="1" />
            </td>					
            </tr>
            <?php } ?>				 		
				</table>
    </td>
		</tr>
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="task" value="" />
		</form>
		<?php
}


}
?>

