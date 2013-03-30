<?php
/**
* @version $id: english.php,v 2.3
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
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
if (defined("WELCOME_TO_PERFORMS")) return;

define("FORM", "טופס");
define("SUBMIT_LABEL","הגש");
define("PUBLISH","פרסם");
define("UNPUBLISH","בטל פרסום");
define("NAME","שם");
define("LINK","קישור");
define("ITEMS","פריטים");
define("DB_TABLE_NAME","שם טבלת מסד נתונים");
define("DB_RECORDS","רשומות מסד נתונים");
define("PUBLISHED","פורסם");
define("UNPUBLISHED","לא פורסם");
define("SECURITYIMAGESHELP","הודעת עזרה - תמונת אבטחה");
define("SECURITYIMAGESERROR","הודעת שגיאה - תמונת אבטחה");

define("FORM_PREVIEW","תצוגה מקדימה");
define("DATE_TIME","תאריך");
define("NO_RECORDS_FOUND","לא נמצאו רשומות !");
define("FIELD_NAMES","שמות שדות");
define("SELECT_FIELDS","בחר את שמות השדות, אותם תרצה לכלול בדוח שלך.");
define("ALL","הכל");
define("INCLUDED_FIELDS","כולל שמות שדות");
define("UP","מעלה");
define("DOWN","מטה");
define("_PRINT","הדפסה");

define("USE_SECURITYIMAGES","השתמש בתמונת אבטחה");
define('NO_SI_INSTALLED', 'com_securityimages לא הותקן');
define('NO_SI_INSTALLED_INFO', '<ul><li>השג זאת מכאן <a href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,1211/Itemid,35/">Joomla! Extensions</a></li><li>PerForms will work fine without it.</li></ul>');
define("EDIT_FORM","ערוך טופס");
define("ADD_EDIT_REMOVE","הוסף, ערוך או מחק את פריטיי הטופס");
define("CAPTION","כותרת");
define('USE_CAPTION',"השתמש בכותרת");
define('FIELD_SEPARATOR', "מפריד שדה");
define('FIELD_SEPARATOR_INFO', "כאשר הנתונים נשלחים מהטופס אל האימייל, התו הזה ישמש כמפריד בין הערכים.");
define('USE_CAPTION_INFO',"כאשר הנתונים נשלחים מהטופס אל האימייל, בצד הערכים יופיע שמם.");
define('FORMAT_TAB',"פורמט");
define('FORMAT_INFO', "דווח ושלח פורמט אימייל");
define("TYPE","סוג");
define("ORDER","סדר");
define("REORDER","סידור מחדש");
define('INSERT', "הכנס");
define('REMOVE', "הסרה");
define('SET_AS_SELECTED', "הגדר את הנבחרים");
define("VALUE","ערך");
define("EDIT_ITEM","ערוך פריט");
define("EDIT","עריכה");
define("_NEW","חדש");
define("FORM_DETAILS","פרטיי טופס");
define("TITLE","כותרת:");
define("INTRO_TEXT","טקסט מקדים:");
define("AFTER_SUBMIT","לאחר ההגשה:");
define("REDIRECT_TO_URL","הפנה לכתובת אתר");
define("SHOW_TNX_TEXT","הצג הודעת תודה");
define("REDIRECT_URL","כתובת אתר אליה מפנים:");
define("TNX_TEXT","הודעת תודה:");
define("PUBLISHING_TAB","פירסום");
define("PUBLISHING_INFO","מידע אודות פירסום");
define("ACCESS","גישה");
define("START_PUBLISHING","התחלת פירסום");
define("FINISH_PUBLISHING","סיום פירסום");
define("IMAGES_TAB","תמונות");
define("IMAGE_INFO","מידע על התמונה");
define('IMAGE_INFO_INFO',"לשימוש בתמונה מותאמת אישית, העלה את התמונה ל ".$mosConfig_live_site."/images/stories");
define("IMAGE","תמונה");
define("THEMES_TAB","עיצוב");
define("THEME_INFO","מידע אודות עיצוב");
define("THEME","עיצוב");
define("BUTTONS_TAB","לחצנים");
define("FORM_BUTTONS","לחצניי טופס");
define("SUBMIT_LABEL_TITLE","הגש תווית");
define("INCLUDE_RESET","כלול לחצן איפוס");
define("INCLUDE_PF","כלול לחצן להדפסה");
define("INCLUDE_PDF","כלול כפתור PDF");
define('INCLUDE_PF_INFO',"הכללת אפשרות ללחצן להדפסה ידידותית בראש הטופס.");
define('INCLUDE_PDF_INFO',"הטופס יכלול לחצן המרה למסמך בפורמט PDF.");
define('NO_PDF_INSTALLED', 'Html2PDF לא הותקן. PerForms לא יכלול PDF לחצן.');
define('NO_PDF_INSTALLED_INFO', '<ul><li>השג זאת מ- <a href="http://sourceforge.net/projects/html2fpdf">SourceForge</a></li><li>PerForms ימשיך לפעול היטב גם בלעדיו.</li></ul>');
define("RESET_LABEL","איפוס כותרת");
define("EMAILS_TAB","אימיילים");
define("EMAIL_FORM_TITLE","טופס אימייל");
define("EMAIL_FORM","טופס אימייל:");
define('EMAIL_FORM_INFO', "במידה וכן, ישלח הטופס אל כתובת האמייל.");

define('EMAIL_ADMIN',"שליחת עותק למנהל:");
define('EMAIL_ADMIN_INFO', "אם כן, הרכיב ישלח עותק מהטופס שנשלח אל הכתובות הרשומות בשדה \&apos;אל\&apos; field - if the field is blank and \&apos;Email Form\&apos; is \&apos;yes\&apos;, an email is sent to the site administrator.");
define('EMAIL_USER',"שליחת עותק למשתמש:");
define('EMAIL_USER_INFO', "If yes, perForms will send an email to the user filling in the form. Please note this will work automatically with logged-in users. If you have items called <b>\&apos;replyto\&apos;</b> and <b>\&apos;replytoName\&apos;</b> then the values of those items will be used. They will be hidden for logged in users by default. Visitors to the site must supply their email address on the form <b>\&apos;replyto\&apos;</b> and <b>\&apos;replytoName\&apos;</b> will be displayed for any user not logged in, if they are items on the form.");
define('ENABLE_MAILFROM',"אפשר שליחת טופס בזהות שונה (spoofing):");
define('ENABLE_MAILFROM_INFO', "במידה וכן הטופס ישלח באופן שכאילו נשלח מהרשום בשדה <b>\&apos;mailfrom\&apos;</b> שבטופס: לא כל השרתים אוהבים שימוש בשיטה זו, לכן המצב בברירת המחדל הוא \&apos;לא\&apos;.");

define("EMAIL_ALWAYS","שליחה גם במקרה של שגיאה:");
define('EMAIL_ALWAYS_INFO', "במידה וכן הטופס ישלח לאימייל ותעלם משגיאות שקרו");
define("FROM","מאת: <small>(השאר ריק לשימוש בברירת המחדל של האתר)</small>");
define('FROM_INFO', "If you want the <b>reply-to</b> e-mail address to be that of the user filling in the form then leave the above paramater blank. Instead add an e-mail capture text field to your form (items tab) and ensure that the <b>Name</b> is set to <b>replyto</b>");
define("TO","אל: <small>(מספר כתובות יופרדו בפסיק)</small>");
define('TO_INFO', 'אם אתה רוצה שהטופס <b>ישלח ל</b> כתובות אימייל שיבחר הגולש (handy if you\&apos;re creating a contact form with a drop down list of e-mail recipients) then add your <b>mail-to</b> email address in the paramater above as normal (to be used as default send address). Then add a select list to your form (items tab) with selectable e-mail address for each recipient and ensure that the <b>Name</b> is set to <b>mailto</b>');
define("EMAIL_SUBJECT","נושא אימייל:");
define('EMAIL_SUBJECT_INFO', 'במידה ואתה מעונין כי <b>הנושא</b> של האימייל יהיה יחודי (או ייקבע לפי מה שיכתוב המשתמש) אזי אל תגע  <b>נושא</b> - פשוט השאר את הפרמטר שלו ריק. Instead add a subject capture field to your form (items tab) and ensure that the <b>Name</b> is set to <b>subject</b> Alternatively if you add a subject above and still want a subject capture field in your form then the above subject will be appended to the subject added by the user.');
define("INTRO_INCLUDE","כלול טקסט מקדים:");
define('INTRO_INCLUDE_INFO', "במידה וכן, הטקסט המקדים ישלח לאימייל.");
define('APPEND_TIMESTAMP', "חותמת זמן");
define('APPEND_TIMESTAMP_INFO', "במידה וכן, לכותר הנושא יצורפו התאריך והשעה שבו הוגש הטופס.");

define("TABLE_ALREADY_CREATED","הטבלה כבר נוצרה...");
define("CREATE_DATABASE_TABLE","יצירת טבלת מסד נתונים..");
define("NOT_BOUND_TO_TABLE","נכון לרגע זה הטופס אינו מקושר לאף טבלה במסד נתונים .");
define("BOUND_TO_TABLE","הטופס הנוכחי מקושר למסד הנתונים . שם הטבלה: ");
define("BOUND_INFO1","When you bind a table to a form you can<strong>not</strong> add, edit or delete form elements.");
define("BOUND_INFO2","שם הטבלה <strong>אסור שיכלול</strong> רווחים, נקודות או תווים מיוחדים אחרים.");
define("TABLE_NAME","שם טבלה:");

define("DELETE_FORM_INFO1","הטופס הזה כבר מקושר ל '%s' " );
define("DELETE_FORM_INFO2","אם תימחק הטבלה ימחק גם המידע בה.");
define("DELETE_FORM_INFO3","שים לב ! - אין אפשרות לשחזר את המידע במידה ונמחק");
define("DELETE_TABLE","מחיקת טבלה?");
define("FORM_ITEMS_DETAILS","נתוניי פרטי טופס");
define("NO_SPECIAL_CHARS","ללא רווחים, נקודות או תווים מיוחדים!");
define("CHECK","בדיקה");
define("HELP_TEXT","טקסט עזרה");
define("ERROR_MSG","הודעת שגיאה");
define("DISPLAY_TAB","הצגה");
define("DISPLAY_PROP","הצגת תכונות");
define("SIZE1","גודל 1");
define("SIZE2","גודל 2");
define('SIZE1_INFO',"רוחב, עמודות");
define('SIZE2_INFO',"גובה, שורות, <br/>גודל קובץ מקסימלי (בייטים)");
define("REQUIRED","נדרש");
define('REQUIRED_INFO',"לא תתאפשר שליחת טופס אלא אם שדה זה יוזן כנדרש.");
define("DISABLED","לא פעיל");
define("READONLY","קריאה בלבד");
define("MULTIPLE","רב בחירה");
define('MULTIPLE_INFO',"לשימוש באלמנטים -  \&apos;Select\&apos; ");
define("VALUES_TAB","ערכים");
define('VALUES_INFO',"מידע על ערכים");
define("MISSING_FIELD_TEXT","טקסט שדה חסר:");

// Errors
define("ITEMS_CANT_EDITED","הפריטים בטופס זה לא ניתנים לעריכה!");
define("FORM_CURRENTLY_EDITED","הטופס %s נערך ברגע זה על ידי מנהל אחר.");
define("NO_FORM_FOUND","טופס לא נמצא.");
define("SELECT_A_RECORD_TO","בחר רשומה ל %s");
define("ALREADY_TABLE_EXISTS","הטבלה \'%s\' כבר קיימת, אנא רשום שם אחר.");
define("ERROR_OCCURRED","התרחשה שגיאה!");
define("DB_ERROR_OCCURRED","שגיאה ברישום למסד הנתונים!");
define("TITLE_EMPTY","הכותרת ריקה!");
define("TABLE_NAME_EMPTY","אתה חייב לתת שם טבלה.");
define("DELETE_DATA_CONFIRM","האם אתה בטוח שברצונך למחוק את כל המידע?");
define("CAPTION_EMPTY","התווית ריקה.");
define("NAME_EMPTY","השם ריק");
define("LIST_VALUES","רשימת ערכים");
define("SELECTED_VALUE","ערך נבחר");
define('SELECTED_VALUE_INFO',"The initial selected value of the element.");

define("PF_ERROR_18", "הליך לא נמשך.");
define("PF_ERROR_18_COMMENT", 
       "<br /><ul><li>יכול להיפתר על ידי לחיצה על לחצן אחורה בדפדפן וגם "
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

define("PF_ERROR_23", "לא נמצא טופס.");
define("PF_ERROR_23_COMMENTA", "טופס עם id");
define("PF_ERROR_23_COMMENTB",
       @"לא ניתן למציאה.<ul>
<li>אתה לא רשאי לצפות בטופס זה, או
<li>הטופס שהיה כאן בעבר כבר נמחק או שפתוח רק למשתשמים רשומים.</ul>");
define("FOR_MORE_HELP", 'לעזרה נוספת בשימוש ברכיב זה '
       .'ראו עמוד הבית של פיתוח הרכיב <a href="http://www.performs.org.au/"> '
       .'performs.org.au</a>');

define("PF_ERROR_127", "פרמטר רשימה שגוי.");
define("PF_ERROR_127_COMMENT",
       'Usually caused by missing parameters for a "Component" menu item. '
       .'<ul><li>זכור להוסיף <strong>formid=1</strong> לרשימה של '
       .'parameters (or the id corresponding to the form you wish to display).'
       .'</li></ul>');

define("PF_ERROR_71", "לא מצליח ליצור תיקייה להעלאת קבצים!");
define("PF_ERROR_71_INFO", "התיקייה עבור טופס זה היא בלתי חוקית, או שלא ניתנת ליצירה. אנא בדוק שוב את נתיב הקובץ להעלאה 'values' טאב בניהול.");

// MENU

define("DATABASE","מסד נתונים");
define("BOUNDDATA","מידע");
define("EXPORTTOEXCEL","ייצוא");
define("PREVIEW","תצוגה מקדימה");
define("CLOSE","סגירה");
define("CANCEL","ביטול");
define("DELETE","מחיקה");
define("COPY_RECORD","העתקה");
define("NEW_ITEM","פריט חדש");
define("DELETE_ITEM_CONFIRM","מחיקת פריט?");
define("SAVE","שמירה");

define("PRINTER_FRIENDLY", "הדפסה ידידותית");
define("DOWNLOAD_PDF", "הורד PDF");
define("ACCESSKEY", "תו קיצור" );

define('PLEASE_FILL_OUT', 'אנא מלא את השדות!');
define('BINDING', 'מקושר');
define('EDIT_ITEMS', 'ערוך פריטים');
define('UPGRADE_NEWS', 'עדכוני שדרוג');
define('IS_AVAILABLE', 'זמין');
define('DOWNLOAD_FROM', 'הורדת טופס');

define('SEP_COMMA', 'פסיק');
define('SEP_COMMASPACE', 'פסיק+רווח');
define('SEP_HYPHEN', 'מקף');
define('SEP_NEWLINE', 'שורה חדשה');
define('SEP_SPACE', 'רווח');

define('TY_EMAIL', 'אימייל');
define('TY_FLOAT', 'float');
define('TY_INTEGER', 'מספר שלם');
define('TY_NAME', 'שם');
define('TY_STRING', 'מחרוזת');
define('TY_URL', 'כתובת אינטרנט');

define('ITEMTYPE_BUTTON', 'לחצן');
define('ITEMTYPE_CHECKBOX', 'תיבת סימון');
define('ITEMTYPE_DATE', 'תאריך');
define('ITEMTYPE_FILE', 'קובץ');
define('ITEMTYPE_HIDDEN', 'מוסתר');
define('ITEMTYPE_IMAGE', 'תמונה');
define('ITEMTYPE_PASSWORD', 'סיסמה');
define('ITEMTYPE_PAGEBREAK', 'סיום עמוד');
define('ITEMTYPE_RADIO', 'רדיו');
define('ITEMTYPE_SELECT', 'בחירה');
define('ITEMTYPE_TEXT', 'טקסט');
define('ITEMTYPE_TEXTAREA', 'שטח טקסט');
define('ITEMTYPE_TEXTUAL', 'טקסטואלי');

define('VALUE_UP', "מעלה");
define('VALUE_UP_INFO', "הפריטים שנבחרו הוזזו מעלה ברשימה.");
define('VALUE_DOWN', "מטה");
define('VALUE_DOWN_INFO', "הזז מטה ברשימה את הפריט שנבחר.");
define('SET_AS_SELECTED_INFO', "Performs will draw the html form element with this item initially selected.");
define('REMOVE_INFO', "הסרת האופציות הנבחרות מרשימת הערכים.");

define('DISABLED_INFO', "במידה וכן, רכיב זה לא ירשם.");
define('READONLY_INFO', "If yes, perForms will draw this item as a read only element. It cannot be filled in.");
define('VALUE_INFO',"הזן ערך ולחץ ".INSERT." על מנת להוסיף לרשימה.<br /><br /> For <strong>".ITEMTYPE_FILE."</strong> items, enter the default upload path here, with a trailing separator <br />(eg <code>/path/to/uploads/</code> or <code>c:\\\uploads\\\</code>).");

define('SUBMIT_LABEL_INFO', "הטקסט שיופיע בתוך הלחצן \&apos;<b>הגש</b>\&apos;.");
define('INCLUDE_RESET_INFO', "במידה וכן יכלל בטופס לחצן  \&apos;<b>איפוס</b>\&apos; .");
define('RESET_LABEL_INFO', "הטקסט שיופיע בתוך הלחצן \&apos<b>איפוס</b>\&apos; הטופס.");
define('PUBLISHED_INFO', "במידה וכן, הטופס יהיה נגיש למשתמשי האתר.");
define('ACCESS_INFO', "הגדר את רמת הגישה למסמך.");
define('START_PUBLISHING_INFO', "התאריך בו הטופס יהיה נגיש למשתמשים.");
define('FINISH_PUBLISHING_INFO', "התאריך בו הטופס יפסיק מלהופיע באתר. אם התאריך הוא 0000-00-00 00:00:00 הטופס יוצג תמיד.");

define('CAPTION_INFO', "הטקסט שיודפס ככותרתו של הפריט הזה.");
define('ACCESSKEY_INFO', "רשום תו באנגלית אשר יאפשר קפיצה מהירה למילוי שדה פריט זה. בפיירפוקס זה נעשה על ידי לחיצה על crtl-shift-k, alt-shift-k באינטרנט אקספלורר.");
define('NAME_INFO', "The internal name of the item. Must not contain any non-alpha characters. If this item is named <b>bcc, cc, mailfrom, mailto, replyto </b>or<b> replytoName</b> the value will be automatically used to send an email if the form is set to send emails.");
define('TYPE_INFO', "Select a type of item, from the list. Different item types support different properties.<br /><ul><li>The <b>".ucfirst(ITEMTYPE_TEXTAREA)."</b> uses ".SIZE1." and ".SIZE2.@" to define its width and height.<br /></li><li>The <b>".ITEMTYPE_SELECT.", ".ITEMTYPE_RADIO." </b>and<b> ".ITEMTYPE_CHECKBOX."</b> types must have at least one value in the item ".VALUES_TAB." list.<br /></li><li>The <strong>".ucfirst(ITEMTYPE_FILE)."</strong> item uses <strong>".SIZE1."</strong> for the width of the filename box, <strong>".SIZE2."</strong> to define the maximum upload size and <strong>".VALUE."</strong> for upload path (where uploaded files are stored).</li></ul>");
define('CHECK_INFO', "Select a validator for this item. Selecting the blank validator will allow all types of data.");
define('HELP_TEXT_INFO', "טקסט העזרה שיופיע יחד עם הפריט.");
define('ERROR_MSG_INFO', "הודעת השגיאה שתופיע יחד עם הפריט.");

define('REVERSE_ORDER', "לשנות סדר");
define('SAVE_ORDER', "שמור סידור");
define('SWAP_SIZE_VARS', "Swap Size1 and Size2 for all textarea items");
define('NEW_SIZEVARS_SAVED', 'הגדלים החדשים נשמרו.');
define('NEW_ORDERING_SAVED', 'הסידור החדש נשמר');

define('PF_LICENCE_INFO', 'perForms היא תוכנה חופשית תחת הרישיון של  <a href="http://www.gnu.org/copyleft/gpl.html">GNU General Public License</a>.');
define('INSTALLATION_MESSAGES', 'הודעות התקנה');
define('THANKS_FOR_CHOOSING', 'תודה לך על בחירתך ב perForms.');
define('WE_NEED_TRANSLATORS', @"
<p>
PerForms הוא רכיב בינלאומי ומתורגם למספר רב של שפות. אם הנך בקי בשפה נוספת אנה עזור לנו בתרגום! 
<a href=\"http://forge.joomla.org/sf/go/projects.performs/discussion.language_file_translations\">Help make PerForms global!</a>
</p>");
define('FOR_SUPPORT', @"
<p><b>לתמיכה, אנא בקר באתר המיועד לכך <a href=\"http://www.performs.org.au/\">http://www.performs.org.au/</a>.</b></p>
");
define('PERFORMS_FEATURES', @"
<p>תכונות כלולות:</p>
<ul>
<li>מספר שדות בלתי מוגבל</li>
<li>בחירה בין 9 סוגי שדות</li>
<li>אפשרות להעלאת קבצים!</li>
<li>העברת נתוניי טופס לאימייל</li>
<li>User-submitted mail-from, reply-to and subject fields</li>
<li>אפשרות ליצירת טבלאות מסד נתונים שונות עבור כל טופס</li>
<li>בדיקת תקינות שדות</li>
<li>טפסים עם נגישות אופטימלית דרך המקלדת</li>
<li>אפשרות לעריכת הודעות שגיאה</li>
<li>עזרה עבור כל שדה למילוי</li>
<li>Report page for viewing the records in the table</li>
<li>תבניות עיצוב בסיסיות</li>
<li>View / Export Captured Data in Administrator</li>
<li>מציג גרסה להדפסה באתר הקדמי</li>
<li>הורד PDF</li>
<li>Joomla 1.5 התאמה ל-</li>
</ul>
");
define('WELCOME_TO_PERFORMS', @"
<p>
PerForms makes it easy to create custom forms that can be emailed or saved to a database. Results can be viewed in admin or downloaded as csv.
</p>
".FOR_SUPPORT.PERFORMS_FEATURES.WE_NEED_TRANSLATORS);
define('NEW_FEATURES', @"
<strong>תכונות חדשות: </strong>
<ul>
<li>נגישות קלה ומהירה</li>
<li>Admin info icons</li>
<li>Bound Data Paging</li>
<li>הגדרות</li>
<li>אפשרות העלאת קבצים</li>
<li>הודעות שגיאה ידידותיות</li>
<li>בדיקת גירסה עדכנית</li>
</ul>
");
define('UPGRADE_MESSAGE', @"
<p>PerForms עבר שינוי! 
<ol><li><p><img src=\"images/reload_f2.png\" height=\"16\" width=\"16\" border=\"0\" /> The <strong>".REVERSE_ORDER.@"</strong> button.</p>You may see your items are in reverse order, to fix the order, simply press the '<strong>"
       .REVERSE_ORDER."</strong>' button at the top of the ".ORDER.@" column in item view.</li>
<li style=\"margin-top: 4pt;\"><p>
<img src=\"images/restore_f2.png\" border=\"0\" width=\"16\" height=\"16\" />
 The <strong>".SWAP_SIZE_VARS.@"</strong> button.</p>
We have changed the way textarea items use Size1 and Size2, to correct your textareas,
click the '<strong>".SWAP_SIZE_VARS."</strong>' button at the top of the ".SIZE1." and ".SIZE2.@" columns.</li></ol></p>
".WE_NEED_TRANSLATORS.NEW_FEATURES.FOR_SUPPORT);


define('SUCCESSFUL_UPGRADE', "השדרוג עבר בהצלחה לגירסה ");
define('INS_WELCOME', "ברוכים הבאים!");
define('INS_SQL_STATEMENTS', "SQL הצהרות");
define('INS_SQL_ERRORS', "SQL שגיאות");

define('UPLOAD_ERROR_1', "הקובץ שהועלה חורג מהגבלת הגודל שנקבע בקובץ php.ini.");
define('UPLOAD_ERROR_1_INFO', "הקובץ גדול מזה המותר על ידי מערכת ניהול התוכן של האתר.<ul><li> אנא צור קשר עם מנהל האתר בענין.</li></ul>");
define('UPLOAD_ERROR_2', "הקובץ שהועלה חורג מהקביעה- MAX_FILE_SIZE שהוגדרה בטופס ה HTML.");
define('UPLOAD_ERROR_2_INFO', "הקובץ המוגש גדול מהמקסימום האפשרי שנקבע על ידי מנהל האתר.");
define('UPLOAD_ERROR_3', "הקובץ שהוגש להעלאה, הועלה רק בחלקו.");
define('UPLOAD_ERROR_3_INFO', "בעיות תקשורת עם השרת גרמו לקובץ לעלות לא בשלמות.");
define('UPLOAD_ERROR_4', "שום קובץ לא הועלה.");
define('UPLOAD_ERROR_4_INFO', "שגיאה ממקור לא ידוע גרמה לכישלון בהעלאה.");
define('UPLOAD_ERROR_5', "תגובת שגיאה לא ידועה!!.");
define('UPLOAD_ERROR_5_INFO', "התקנת ה php גרמה לשגיאה לא מובנת!");
define('UPLOAD_ERROR_6', "לא קיימת תיקייה זמנית. קרא עוד בענין בנושא PHP 4.3.10 ו- PHP 5.0.3.");
define('UPLOAD_ERROR_6_INFO', "בהתקנת מערכת ניהול תוכן זו חסרה התייחסות לתיקייה זמנית בקובץ in php.ini.");
define('UPLOAD_ERROR_7', "נכשל בכתיבת לכונן הקשיח של השרת. קרא בענין בנושא PHP 5.1.0.");
define('UPLOAD_ERROR_7_INFO', "לא נשאר מקום פנוי בכונן הקשיח של השרת או שהתיקייה במצב קריאה בלבד.");

define('SUCCESS', "הצלחה!");
define('UPLOAD_SUCCESSFUL', "הקובץ תקין והועלה בהצלחה.\n");
define('UPLOAD_SUCCESSFUL_INFO', "הקובץ הועלה בהצלחה למערכת וממתין לבדיקתו של מנהל האתר.");
define('ERROR_71', "קיימת התכנות לניסיון חיצוני לתקיפה דרך מנגנון העלאת הקבצים!\n");
define('ERROR_71_INFO', "שם הקבוץ או הנתיב אליו לא תקינים!");

define('UNKNOWN_SENDER', "שולח לא ידוע");

define('IMAGEFLOAT', "מיקום");
define('IMAGEFLOAT_INFO', "קבע את סגנון הריחוף של התמונה (css float: [שמאל, ימין, ללא, לקבל את הגדרת האתר];)");
define('FLOAT_LEFT', 'שמאל');
define('FLOAT_RIGHT', 'ימין');
define('FLOAT_NONE', 'לא');
define('FLOAT_INHERIT', 'לקבל את הגדרת האתר');

define('NOT_BOUND', "לא קשור/מחובר!");
define('CLICK_BINDING_BUTTON', "לחץ על הלחצן <b>מקושר</b> על מנת להקצות טבלה חדשה במסד הנתונים.");

define('SHOW_UPLOADED_IMAGE', "הצג תמונה מועלה");
define('SHOW_UPLOADED_IMAGE_INFO', "When displaying the user input via email, file items can be displayed as a link, or displayed like an image.");

define('SUBMIT', "הגש");
define('REPLACE_SUBMIT_BUTTON', "החלפת לחצן הגשה");
define('REPLACE_SUBMIT_BUTTON_INFO', "החלפת לחצן ברירת המחדל להגשה בתמונה משלך.");
define('SUBMIT_IMAGE_URL', "נתיב התמונה ללחצן ההגשה");
define('SUBMIT_IMAGE_URL_INFO', "הנתיב שבו נמצאת התמונה שתחליף את לחצן ההגשה שבברירת המחדל.");
define('SUBMIT_IMAGE_WIDTH', "רוחב תמונת לחצן");
define('SUBMIT_IMAGE_WIDTH_INFO', "רוחב התמונה להחלפת לחצן ברירת המחדל.");
define('SUBMIT_IMAGE_HEIGHT', "גובה תמונת לחצן");
define('SUBMIT_IMAGE_HEIGHT_INFO', "גובה התמונה אשר תחליף את לחצן ההגשה שבברירת המחדל.");

define('RESET', "איפוס טופס");
define('REPLACE_RESET_BUTTON', "החלפת לחצן איפוס");
define('REPLACE_RESET_BUTTON_INFO', "החלפת לחצן איפוס הטופס שבברירת המחדל בתמונה משלך.");
define('RESET_IMAGE_URL', "כתובת לתמונה עבור לחצן איפוס");
define('RESET_IMAGE_URL_INFO', "הנתיב שבו נמצאת התמונה שתחליף את לחצן האיפוס בברירת המחדל של המערכת.");
define('RESET_IMAGE_WIDTH', "רוחב תמונת לחצן איפוס");
define('RESET_IMAGE_WIDTH_INFO', "רוחב התמונה שתחליף את לחצן ברירת המחדל לאיפוס.");
define('RESET_IMAGE_HEIGHT', "גובה תמונה עבור לחצן איפוס");
define('RESET_IMAGE_HEIGHT_INFO', "גובה התמונה שתחליף את לחצן ברירת המחדל.");

define('NOT_AUTHORIZED', "You are not authorized to see this resource.");
define("NO_AUTH_MESSAGE", "Unauthorized Message");
define("NO_AUTH_MESSAGE_INFO", "The message presented by the form when an unauthorized user attempts to view it.");

define('USE_CONTAINER', "Use Container");
define('USE_CONTAINER_INFO', "When displaying a perForms form, the standard container will be used if yes. If no, perForms forms can be used to replace individual words in a sentance, for example.");
define('SHOW_FORM_TITLE', "Show Form Title");
define('SHOW_FORM_TITLE_INFO', "When showing perForms as a component, sets the title display on/off.");
define('FORM_WIDTH', "Form Width");
define('FORM_WIDTH_INFO', 'The width of the form when displayed. Can be &quot;100px&quot; or &quot;35%&quot; etc.');
define('FORM_DISPLAY', "Form Display");
define('PRESENTATION_INFO', "Presentation");
define('INCLUDE_SUBMIT', "Include Submit Button");
define('INCLUDE_SUBMIT_INFO', "Show the Submit button on the form.");
define('MAIL_AS_TEXT', "Mail as Text");
define('MAIL_AS_TEXT_INFO', "If yes, perForms will send the form data as raw text, but remember, if you are going to include the intro in your form email, that it will not be rendered as Html.");

define('EXTRA_RECIPIENTS', "Extra Recipients");
define('MAIL_OPTIONS', "Mail Options");

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
define('PFAUTO_USERNAME', "שם משתמש");
define('PFAUTO_NAME', "name");
define('PFAUTO_USERTYPE', "usertype");
define('PFAUTO_REGISTERDATE', "registerDate");
define('PFAUTO_LASTVISITDATE', "lastvisitDate");
define('PFAUTO_USEREMAIL', "useremail");
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