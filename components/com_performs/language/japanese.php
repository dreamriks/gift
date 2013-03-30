<?php
/**
* @version $id: japanese.php,v 2.3
* @package performs
* @copyright (c) 2007 perForms
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @author David Walters
* @author (original) Ilhami KILIC http://www.tuwitek.at
* Joomla is Free Software
* 
* If you are translating, be sure to download the very latest
* english.php, available from http://www.performs.org.au/performs/nightly/english.php.txt
*
*/
defined( '_VALID_MOS' ) or die( 'この場所への直接の出入りは、許されません。' );
if (defined("WELCOME_TO_PERFORMS")) return;

define("FORM", "フォーム");
define("SUBMIT_LABEL","Submit");
define("PUBLISH","公表");
define("UNPUBLISH","unpublish");
define("NAME","名前");
define("LINK","リンク");
define("ITEMS","アイテム");
define("DB_TABLE_NAME","データベーステーブル名");
define("DB_RECORDS","データベースレコード");
define("PUBLISHED","発表されます");
define("UNPUBLISHED","未発表である");
define("SECURITYIMAGESHELP","セキュリティイメージヘルプメッセージ");
define("SECURITYIMAGESERROR","セキュリティイメージエラーメッセージ");

define("FORM_PREVIEW","フォームプレビュー");
define("DATE_TIME","日付");
define("NO_RECORDS_FOUND","見つかるレコードでない");
define("FIELD_NAMES","フィールド名");
define("SELECT_FIELDS","フィールドをレポートに含められるのに選んでください。");
define("ALL","全て");
define("INCLUDED_FIELDS","含まれたフィールド名");
define("UP","上");
define("DOWN","下");
define("_PRINT","プリント");

define("USE_SECURITYIMAGES","セキュリティイメージを使う");
define('NO_SI_INSTALLED', 'com_securityimagesは、インストールされません');
define('NO_SI_INSTALLED_INFO', '<ul><li><a href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,1211/Itemid,35/">Joomla! Extensions</a>からダウンロードして。</li><li>インストルしなたらPerFormsを使うことができます。</li></ul>');
define("EDIT_FORM","Edit Form");
define("ADD_EDIT_REMOVE","Add, Edit or Remove Form items");
define("CAPTION","カップション");
define('USE_CAPTION',"Use Caption");
define('FIELD_SEPARATOR', "Field Separator");
define('FIELD_SEPARATOR_INFO', "When outputting form to email or form to text, this char will be used between option values.");
define('USE_CAPTION_INFO',"When outputting form to email, perForms will print field names next to the value.");
define('FORMAT_TAB',"Format");
define('FORMAT_INFO', "Report and Email Formatting");
define("TYPE","Type");
define("ORDER","Order");
define("REORDER","Reorder");
define('INSERT', "Insert");
define('REMOVE', "Remove");
define('SET_AS_SELECTED', "Set as Selected");
define("VALUE","Value");
define("EDIT_ITEM","Edit Item");
define("EDIT","Edit");
define("_NEW","New");
define("FORM_DETAILS","Form Details");
define("TITLE","タイトル:");
define("INTRO_TEXT","イントロテキスト:");
define("AFTER_SUBMIT","After submit:");
define("REDIRECT_TO_URL","Redirect to Url");
define("SHOW_TNX_TEXT","Show Thanks Text");
define("REDIRECT_URL","Redirect Url:");
define("TNX_TEXT","「ありがとう」テキスト:");
define("PUBLISHING_TAB","Publishing");
define("PUBLISHING_INFO","Publishing Info");
define("ACCESS","アクセッス");
define("START_PUBLISHING","Start Publishing");
define("FINISH_PUBLISHING","Finish Publishing");
define("IMAGES_TAB","イメッジ");
define("IMAGE_INFO","イメッジインフォ");
define('IMAGE_INFO_INFO',"To use a custom image here, upload your image to ".$mosConfig_live_site."/images/stories");
define("IMAGE","イメッジ");
define("THEMES_TAB","テーマ");
define("THEME_INFO","テーマインフォ");
define("THEME","テーマ");
define("BUTTONS_TAB","Buttons");
define("FORM_BUTTONS","Form Buttons");
define("SUBMIT_LABEL_TITLE","Submit Label");
define("INCLUDE_RESET","Include reset button");
define("INCLUDE_PF","Include Printer Friendly button");
define("INCLUDE_PDF","Include PDF button");
define('INCLUDE_PF_INFO',"PerForms will include a Printer-Friendly button with the form header, allowing the form to be seen on its own, in a popup window.");
define('INCLUDE_PDF_INFO',"PerForms will include a PDF button with the form header when displayed.");
define('NO_PDF_INSTALLED', 'Html2PDF not installed. PerForms will not have PDF button available.');
define('NO_PDF_INSTALLED_INFO', '<ul><li>Get it from <a href="http://sourceforge.net/projects/html2fpdf">SourceForge</a></li><li>PerForms will work fine without it.</li></ul>');
define("RESET_LABEL","Reset Label");
define("EMAILS_TAB","E-Mails");
define("EMAIL_FORM_TITLE","Email Form");
define("EMAIL_FORM","Email Form:");
define('EMAIL_FORM_INFO', "If yes, perForms will send an email when this form is submitted.");

define('EMAIL_ADMIN',"Send copy to admin:");
define('EMAIL_ADMIN_INFO', "If yes, perForms will send a copy of the email to the address(es) in the \&apos;to\&apos; field - if the field is blank and \&apos;Email Form\&apos; is \&apos;yes\&apos;, an email is sent to the site administrator.");
define('EMAIL_USER',"Send copy to user:");
define('EMAIL_USER_INFO', "If yes, perForms will send an email to the user filling in the form. Please note this will work automatically with logged-in users. If you have items called <b>\&apos;replyto\&apos;</b> and <b>\&apos;replytoName\&apos;</b> then the values of those items will be used. They will be hidden for logged in users by default. Visitors to the site must supply their email address on the form <b>\&apos;replyto\&apos;</b> and <b>\&apos;replytoName\&apos;</b> will be displayed for any user not logged in, if they are items on the form.");
define('ENABLE_MAILFROM',"Allow mail spoofing:");
define('ENABLE_MAILFROM_INFO', "If yes, perForms will attempt to send the message to admin using a value from the field called <b>\&apos;mailfrom\&apos;</b> in the FROM: part of the email, if <b>\&apos;mailfrom\&apos;</b> is an item on the form. Not all mail servers are happy about this, so the default is \&apos;no\&apos;.");

define("EMAIL_ALWAYS","Send Even If Error:");
define('EMAIL_ALWAYS_INFO', "If yes, perForms will ignore errors and send the email anyway,");
define("FROM","From: <small>(blank to use site default)</small>");
define('FROM_INFO', "If you want the <b>reply-to</b> e-mail address to be that of the user filling in the form then leave the above paramater blank. Instead add an e-mail capture text field to your form (items tab) and ensure that the <b>Name</b> is set to <b>replyto</b>");
define("TO","To: <small>(comma separated list)</small>");
define('TO_INFO', 'If you want the <b>mail-to</b> e-mail address to be chosen by the user filling in the form (handy if you\&apos;re creating a contact form with a drop down list of e-mail recipients) then add your <b>mail-to</b> email address in the paramater above as normal (to be used as default send address). Then add a select list to your form (items tab) with selectable e-mail address for each recipient and ensure that the <b>Name</b> is set to <b>mailto</b>');
define("EMAIL_SUBJECT","E-mail Subject:");
define('EMAIL_SUBJECT_INFO', 'If you want the <b>Subject</b> of the e-mail to be unique (or set by the user filling in the form) then leave the <b>Subject</b> parameter above blank. Instead add a subject capture field to your form (items tab) and ensure that the <b>Name</b> is set to <b>subject</b> Alternatively if you add a subject above and still want a subject capture field in your form then the above subject will be appended to the subject added by the user.');
define("INTRO_INCLUDE","Include Intro Text:");
define('INTRO_INCLUDE_INFO', "If yes, the form intro will be included in the email.");
define('APPEND_TIMESTAMP', "Append Timestamp");
define('APPEND_TIMESTAMP_INFO', "If yes, the email subject will be appended with the date and time the form was submitted.");

define("TABLE_ALREADY_CREATED","Table already created...");
define("CREATE_DATABASE_TABLE","Create a database table..");
define("NOT_BOUND_TO_TABLE","This form is currently NOT bound to a database table .");
define("BOUND_TO_TABLE","This form is currently bound to a database table . Table name: ");
define("BOUND_INFO1","When you bind a table to a form you can<strong>not</strong> add, edit or delete form elements.");
define("BOUND_INFO2","Table name <strong>must not</strong> contain spaces, periods or special chars.");
define("TABLE_NAME","Table Name:");

define("DELETE_FORM_INFO1","This form is already bound to '%s' " );
define("DELETE_FORM_INFO2","If you delete the Table, all data will be lost, and the table will also be deleted.");
define("DELETE_FORM_INFO3","THERE IS NO WAY TO RESTORE THIS INFORMATION ONCE DELETED");
define("DELETE_TABLE","Delete Table?");
define("FORM_ITEMS_DETAILS","Form Items Details");
define("NO_SPECIAL_CHARS","No spaces, periods or special chars!");
define("CHECK","Check");
define("HELP_TEXT","Help Text");
define("ERROR_MSG","Error Message");
define("DISPLAY_TAB","Display");
define("DISPLAY_PROP","Display Properties");
define("SIZE1","Size 1");
define("SIZE2","Size 2");
define('SIZE1_INFO',"Width, Columns");
define('SIZE2_INFO',"Height, Rows, <br/>Max Upload Size (bytes)");
define("REQUIRED","Required");
define('REQUIRED_INFO',"PerForms will not allow a form to be submitted unless this field is filled in.");
define("DISABLED","Disabled");
define("READONLY","Readonly");
define("MULTIPLE","Multiple");
define('MULTIPLE_INFO',"For use with \&apos;Select\&apos; elements.");
define("VALUES_TAB","Values");
define('VALUES_INFO',"Values Info");
define("MISSING_FIELD_TEXT","Missing field text:");

// Errors
define("ITEMS_CANT_EDITED","Items of this Form can not be edited!");
define("FORM_CURRENTLY_EDITED","The form %s is currently being edited by another administrator.");
define("NO_FORM_FOUND","No Form found.");
define("SELECT_A_RECORD_TO","Select a record to %s");
define("ALREADY_TABLE_EXISTS","The table \'%s\' already exists, please give a different name.");
define("ERROR_OCCURRED","An error occurred!");
define("DB_ERROR_OCCURRED","Error writing to database!");
define("TITLE_EMPTY","Title is empty!");
define("TABLE_NAME_EMPTY","You must provide a tablename.");
define("DELETE_DATA_CONFIRM","Do you really want to delete ALL DATA?");
define("CAPTION_EMPTY","Caption is empty.");
define("NAME_EMPTY","Name is empty");
define("LIST_VALUES","List Values");
define("SELECTED_VALUE","Selected Value");
define('SELECTED_VALUE_INFO',"The initial selected value of the element.");

define("PF_ERROR_18", "Session not persistent.");
define("PF_ERROR_18_COMMENT", 
       "<br /><ul><li>Can be solved by pressing the browser's back button and "
       ."trying again. <cite>The session may need to be restarted.</cite><br /></li>"
       .'<ul><li>Also occurs when joomla global config setting "Live Site" '
       .'protocol does not match current protocol (http / https)<br />'
       .'See <a href="http://forge.joomla.org/sf/go/post17630">'
       .'http://forge.joomla.org/sf/go/post17630</a></li><br />'
       .'<br /><li>Also an intermittent fault when a user logs out of a joomla '
       .'session, and tries to show a printer-friendly form by clicking the '
       .'link displayed at the head of the form (in "joomla mode") - sometimes '
       .'sessions are not initialised immediately... the workaround is to close'
       .' the printer-friendly window, and click the menu item again (to bring '
       .'up the form), then click its '
       .'printer-friendly button, and the popup should work.</li></ul>'
       );       
define("PF_ERROR_22", "Non-numeric formid.");
define("PF_ERROR_22_COMMENT",
       'Usually caused by a malformed link url. '
       .'See <a href="http://forge.joomla.org/sf/go/post17395">'
       .'http://forge.joomla.org/sf/go/post17395</a>');

define("PF_ERROR_23", "No Form Found.");
define("PF_ERROR_23_COMMENTA", "A form with the id");
define("PF_ERROR_23_COMMENTB",
       @"cannot be found.<ul>
<li>You may not be authorised to view this resource, or
<li>This form may have expired, been unpublished, or removed.</ul>");
define("FOR_MORE_HELP", 'For more help using PerForms, see '
       .'the PerForms home page, at <a href="http://www.performs.org.au/"> '
       .'performs.org.au</a>');

define("PF_ERROR_127", "Invalid Parameter List.");
define("PF_ERROR_127_COMMENT",
       'Usually caused by missing parameters for a "Component" menu item. '
       .'<ul><li>Remember to add <strong>formid=1</strong> to the list of '
       .'parameters (or the id corresponding to the form you wish to display).'
       .'</li></ul>');

define("PF_ERROR_71", "Unable to create uploads directory!");
define("PF_ERROR_71_INFO", "The holding directory for this form is invalid, or unable to be created. Please check the upload path in the 'values' tab of performs administrator.");

// MENU

define("DATABASE","Database");
define("BOUNDDATA","Data");
define("EXPORTTOEXCEL","Export");
define("PREVIEW","Preview");
define("CLOSE","Close");
define("CANCEL","Cancel");
define("DELETE","Delete");
define("COPY_RECORD","Copy");
define("NEW_ITEM","New Item");
define("DELETE_ITEM_CONFIRM","Delete Item?");
define("SAVE","Save");

define("PRINTER_FRIENDLY", "Printer Friendly");
define("DOWNLOAD_PDF", "Download PDF");
define("ACCESSKEY", "AccKey" );

define('PLEASE_FILL_OUT', 'Please fill out!');
define('BINDING', 'Binding');
define('EDIT_ITEMS', 'Edit Items');
define('UPGRADE_NEWS', 'Upgrade News');
define('IS_AVAILABLE', 'is available');
define('DOWNLOAD_FROM', 'Download from');

define('SEP_COMMA', 'comma');
define('SEP_COMMASPACE', 'comma+space');
define('SEP_HYPHEN', 'hyphen');
define('SEP_NEWLINE', 'newline');
define('SEP_SPACE', 'space');

define('TY_EMAIL', 'email');
define('TY_FLOAT', 'float');
define('TY_INTEGER', 'integer');
define('TY_NAME', 'name');
define('TY_STRING', 'string');
define('TY_URL', 'url');

define('ITEMTYPE_BUTTON', 'button');
define('ITEMTYPE_CHECKBOX', 'checkbox');
define('ITEMTYPE_DATE', 'date');
define('ITEMTYPE_FILE', 'file');
define('ITEMTYPE_HIDDEN', 'hidden');
define('ITEMTYPE_IMAGE', 'image');
define('ITEMTYPE_PASSWORD', 'password');
define('ITEMTYPE_PAGEBREAK', 'pagebreak');
define('ITEMTYPE_RADIO', 'radio');
define('ITEMTYPE_SELECT', 'select');
define('ITEMTYPE_TEXT', 'text');
define('ITEMTYPE_TEXTAREA', 'textarea');
define('ITEMTYPE_TEXTUAL', 'textual');

define('VALUE_UP', "Up");
define('VALUE_UP_INFO', "Moves the selected item up in the list.");
define('VALUE_DOWN', "Down");
define('VALUE_DOWN_INFO', "Moves the selected item down in the list.");
define('SET_AS_SELECTED_INFO', "Performs will draw the html form element with this item initially selected.");
define('REMOVE_INFO', "Remove the selected option from the list of values.");

define('DISABLED_INFO', "If yes, perForms will not draw this item.");
define('READONLY_INFO', "If yes, perForms will draw this item as a read only element. It cannot be filled in.");
define('VALUE_INFO',"Enter a value in this field and click the ".INSERT." button to add to the list.<br /><br /> For <strong>".ITEMTYPE_FILE."</strong> items, enter the default upload path here, with a trailing separator <br />(eg <code>/path/to/uploads/</code> or <code>c:\\\uploads\\\</code>).");

define('SUBMIT_LABEL_INFO', "The text to appear on the form \&apos;<b>submit</b>\&apos; button.");
define('INCLUDE_RESET_INFO', "If yes, perForms will include a \&apos;<b>reset</b>\&apos; button on the form.");
define('RESET_LABEL_INFO', "The text to appear on the \&apos<b>reset</b>\&apos; button.");
define('PUBLISHED_INFO', "If yes, the form will be available to users of the site.");
define('ACCESS_INFO', "Define the access level for the form.");
define('START_PUBLISHING_INFO', "The date the form will begin to be available to users of the site.");
define('FINISH_PUBLISHING_INFO', "The date the form will stop being available to users of the site. If the date is 0000-00-00 00:00:00 the form is always available.");

define('CAPTION_INFO', "The text that will be printed as the caption of the item.");
define('ACCESSKEY_INFO', "The access key that will be associated with the item, which is mapped to a key combination by the browser. So an accesskey of \&apos;<b>k</b>\&apos; will map to crtl-shift-k on firefox, alt-shift-k in internet explorer.");
define('NAME_INFO', "The internal name of the item. Must not contain any non-alpha characters. If this item is named <b>bcc, cc, mailfrom, mailto, replyto </b>or<b> replytoName</b> the value will be automatically used to send an email if the form is set to send emails.");
define('TYPE_INFO', "Select a type of item, from the list. Different item types support different properties.<br /><ul><li>The <b>".ucfirst(ITEMTYPE_TEXTAREA)."</b> uses ".SIZE1." and ".SIZE2.@" to define its width and height.<br /></li><li>The <b>".ITEMTYPE_SELECT.", ".ITEMTYPE_RADIO." </b>and<b> ".ITEMTYPE_CHECKBOX."</b> types must have at least one value in the item ".VALUES_TAB." list.<br /></li><li>The <strong>".ucfirst(ITEMTYPE_FILE)."</strong> item uses <strong>".SIZE1."</strong> for the width of the filename box, <strong>".SIZE2."</strong> to define the maximum upload size and <strong>".VALUE."</strong> for upload path (where uploaded files are stored).</li></ul>");
define('CHECK_INFO', "Select a validator for this item. Selecting the blank validator will allow all types of data.");
define('HELP_TEXT_INFO', "The help text that will appear with the item.");
define('ERROR_MSG_INFO', "The error message to display if there is a problem with the item.");

define('REVERSE_ORDER', "Reverse Order");
define('SAVE_ORDER', "Save Order");
define('SWAP_SIZE_VARS', "Swap Size1 and Size2 for all textarea items");
define('NEW_SIZEVARS_SAVED', 'New sizevars saved.');
define('NEW_ORDERING_SAVED', 'New ordering saved');

define('PF_LICENCE_INFO', 'perForms is free software licensed with the <a href="http://www.gnu.org/copyleft/gpl.html">GNU General Public License</a>.');
define('INSTALLATION_MESSAGES', 'Installation Messages');
define('THANKS_FOR_CHOOSING', 'Thank you for choosing PerForms.');
define('WE_NEED_TRANSLATORS', @"
<p>
PerForms is now fully localised, and we need translators! 
<a href=\"http://forge.joomla.org/sf/go/projects.performs/discussion.language_file_translations\">Help make PerForms global!</a>
</p>");
define('FOR_SUPPORT', @"
<p><b>For support, please visit the official support site at <a href=\"http://www.performs.org.au/\">http://www.performs.org.au/</a>.</b></p>
");
define('PERFORMS_FEATURES', @"
<p>Features include:</p>
<ul>
<li>Unlimited input fields</li>
<li>Choose between 9 field types</li>
<li>File Upload Feature!</li>
<li>Form to mail function</li>
<li>User-submitted mail-from, reply-to and subject fields</li>
<li>Optionally create a separate database table for each form</li>
<li>Field validations</li>
<li>Accessible Forms</li>
<li>Custom error messages</li>
<li>Custom help messages for each field</li>
<li>Report page for viewing the records in the table</li>
<li>Basic templating system</li>
<li>View / Export Captured Data in Administrator</li>
<li>View Printable Version from front end</li>
<li>Download PDF</li>
<li>Joomla 1.5 Ready</li>
</ul>
");
define('WELCOME_TO_PERFORMS', @"
<p>
PerForms makes it easy to create custom forms that can be emailed or saved to a database. Results can be viewed in admin or downloaded as csv.
</p>
".FOR_SUPPORT.PERFORMS_FEATURES.WE_NEED_TRANSLATORS);
define('NEW_FEATURES', @"
<strong>New Features: </strong>
<ul>
<li>Accessibility</li>
<li>Admin info icons</li>
<li>Bound Data Paging</li>
<li>Config</li>
<li>File Upload Field</li>
<li>Friendly Errors</li>
<li>Version Check</li>
</ul>
");
define('UPGRADE_MESSAGE', @"
<p>PerForms has changed! 
<ol><li><p><img src=\"images/reload_f2.png\" height=\"16\" width=\"16\" border=\"0\" /> The <strong>".REVERSE_ORDER.@"</strong> button.</p>You may see your items are in reverse order, to fix the order, simply press the '<strong>"
       .REVERSE_ORDER."</strong>' button at the top of the ".ORDER.@" column in item view.</li>
<li style=\"margin-top: 4pt;\"><p>
<img src=\"images/restore_f2.png\" border=\"0\" width=\"16\" height=\"16\" />
 The <strong>".SWAP_SIZE_VARS.@"</strong> button.</p>
We have changed the way textarea items use Size1 and Size2, to correct your textareas,
click the '<strong>".SWAP_SIZE_VARS."</strong>' button at the top of the ".SIZE1." and ".SIZE2.@" columns.</li></ol></p>
".WE_NEED_TRANSLATORS.NEW_FEATURES.FOR_SUPPORT);


define('SUCCESSFUL_UPGRADE', "Successfully upgraded to PerForms ");
define('INS_WELCOME', "Welcome!");
define('INS_SQL_STATEMENTS', "SQL Statements");
define('INS_SQL_ERRORS', "SQL Errors");

define('PFAUTO_USERNAME', "username");

define('UPLOAD_ERROR_1', "The uploaded file exceeds the upload_max_filesize directive in php.ini.");
define('UPLOAD_ERROR_1_INFO', "The file was larger than this installation of php will allow.<ul><li> Ask your php/joomla administrator to increase the value of upload_max_filesize.</li></ul>");
define('UPLOAD_ERROR_2', "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.");
define('UPLOAD_ERROR_2_INFO', "The administrator has set the maximum upload file size to less than the size of your file.");
define('UPLOAD_ERROR_3', "The uploaded file was only partially uploaded.");
define('UPLOAD_ERROR_3_INFO', "A connection error caused the file to be imcomplete at the server end. Please try again.");
define('UPLOAD_ERROR_4', "No file was uploaded.");
define('UPLOAD_ERROR_4_INFO', "An unknown condition has caused the file upload to fail.");
define('UPLOAD_ERROR_5', "Unknown Error Response!!.");
define('UPLOAD_ERROR_5_INFO', "The php installation has responded with a non-standard error code!");
define('UPLOAD_ERROR_6', "Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.");
define('UPLOAD_ERROR_6_INFO', "This php installation has no temporary folder set in php.ini.");
define('UPLOAD_ERROR_7', "Failed to write file to disk. Introduced in PHP 5.1.0.");
define('UPLOAD_ERROR_7_INFO', "The server may have run out of space, or the temporary directory is read-only.");

define('SUCCESS', "Success!");
define('UPLOAD_SUCCESSFUL', "File is valid, and was successfully uploaded.\n");
define('UPLOAD_SUCCESSFUL_INFO', "The file has been uploaded and placed in a holding directory, waiting for the administrator.");
define('ERROR_71', "Possible file upload attack!\n");
define('ERROR_71_INFO', "The name of the file or path is not valid!");

define('UNKNOWN_SENDER', "Unknown Sender");

define('IMAGEFLOAT', "Image Float Style");
define('IMAGEFLOAT_INFO', "Sets the float style of the image (css float: [left, right, none, inherit];)");
define('FLOAT_LEFT', 'Left');
define('FLOAT_RIGHT', 'Right');
define('FLOAT_NONE', 'None');
define('FLOAT_INHERIT', 'Inherit');

define('NOT_BOUND', "Not Bound!");
define('CLICK_BINDING_BUTTON', "Click the <b>Binding</b> button to assign a new database table.");

define('SHOW_UPLOADED_IMAGE', "Show Uploaded Image");
define('SHOW_UPLOADED_IMAGE_INFO', "When displaying the user input via email, file items can be displayed as a link, or displayed like an image.");

define('SUBMIT', "Submit");
define('REPLACE_SUBMIT_BUTTON', "Replace Submit Button");
define('REPLACE_SUBMIT_BUTTON_INFO', "Replace the default form submit button with an image.");
define('SUBMIT_IMAGE_URL', "Submit Image Url");
define('SUBMIT_IMAGE_URL_INFO', "A Url pointing to the image that will replace the default submit button.");
define('SUBMIT_IMAGE_WIDTH', "Submit Image Width");
define('SUBMIT_IMAGE_WIDTH_INFO', "The width of the image used to replace the default submit button.");
define('SUBMIT_IMAGE_HEIGHT', "Submit Image Height");
define('SUBMIT_IMAGE_HEIGHT_INFO', "The height of the image used to replace the default submit button.");

define('RESET', "Reset");
define('REPLACE_RESET_BUTTON', "Replace Reset Button");
define('REPLACE_RESET_BUTTON_INFO', "Replace the default form reset button with an image.");
define('RESET_IMAGE_URL', "Reset Image Url");
define('RESET_IMAGE_URL_INFO', "A Url pointing to the image that will replace the default reset button.");
define('RESET_IMAGE_WIDTH', "Reset Image Width");
define('RESET_IMAGE_WIDTH_INFO', "The width of the image used to replace the reset button.");
define('RESET_IMAGE_HEIGHT', "Reset Image Height");
define('RESET_IMAGE_HEIGHT_INFO', "The height of the image used to replace the reset button.");

define("USE_SECURITYIMAGES_INFO", "If yes, com_securityimages will be used to enable CAPTCHA for this form.");
define("SECURITYIMAGESHELP_INFO", "This message will be displayed along with the CAPTCHA image text box.");
define("SECURITYIMAGESERROR_INFO", "This message will be displayed if CAPTCHA fails for the form.");

define("CAPTIONCSSCLASS","Caption CSS class(es)");
define('CAPTIONCSSCLASS_INFO',"If set, the caption will be surrounded by a div tag, which has its CSS class attribute to this value.");
define("VALUECSSCLASS","Value CSS class(es)");
define('VALUECSSCLASS_INFO',"If set, the value will be surrounded by a div tag, which has its CSS class attribute to this value. If the form item has more than one value (such as a radio button), the entire set of values will be surrounded by the div.");
define("INFOCSSCLASS","Help CSS class(es)");
define('INFOCSSCLASS_INFO',"If set, the help text will be surrounded by a div tag, which has its CSS class attribute to this value.");
define("ERRORCSSCLASS","Error CSS class(es)");
define('ERRORCSSCLASS_INFO',"If set, an error message related to this form item will be surrounded by a div tag, which has its CSS class attribute to this value.");



//define("Delete","Delete");
/*
PFAUTO_ fields can be embedded into any text part of a form or form item
Where there can be text, an expression enclosed in braces, ilke {username}
will return the "Auto" field for PFAUTO_USERNAME
*/
define('PFAUTO_USERNAME', "username");//<the current user's login name
define('PFAUTO_NAME', "name");//<the current user's name
define('PFAUTO_USERTYPE', "usertype");//<the current user's usertype
define('PFAUTO_REGISTERDATE', "registerDate");//<current user's register date
define('PFAUTO_LASTVISITDATE', "lastvisitDate");//<current user's last visit
define('PFAUTO_USEREMAIL', "useremail");//<current user's email address
/*
The $_PFAUTO array is an associative list (map) of replacements.
Where there can be text, an expression enclosed in braces, starting with an 
equals sign, will be evaluated from the map.
Eg. "{=PF_FIELD_NAME}" will become "Name"
*/
global $_PFAUTO;
$_PFAUTO = array ( 
	"usertype" => "USER TYPE",
	"name" => "Name",/*your variable names need not be so formal*/
	"address" => "Address" );


?>