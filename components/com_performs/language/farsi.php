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
*Translator And developed Persian/Farsi By Joomfa Team
*Translation : Saeid Farzad (Joomfa Team)
* Joomfa Team ==> http://joomfa.org
*/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
if (defined("WELCOME_TO_PERFORMS")) return;

define("FORM", "فرم");
define("SUBMIT_LABEL","ارسال");
define("PUBLISH","انتشار");
define("UNPUBLISH","بدون انتشار");
define("NAME","نام");
define("LINK","لينك");
define("ITEMS","گزينه ها");
define("DB_TABLE_NAME","نام جدول DataBase");
define("DB_RECORDS","ركوردهاي DataBase");
define("PUBLISHED","منتشر شده");
define("UNPUBLISHED","منتشر نشده");
define("SECURITYIMAGESHELP","پيغام راهنماي تصوير امنيتي");
define("SECURITYIMAGESERROR","پيغام خطاي تصوير امنيتي");

define("FORM_PREVIEW","پيش نمايش فرم");
define("DATE_TIME","تاريخ");
define("NO_RECORDS_FOUND","ركوردها يافت نشد");
define("FIELD_NAMES","نام فيلد");
define("SELECT_FIELDS","نام فيلدها را انتخاب كنيد، همراه با مواردي كه در گزارشتان ميخواهيد باشد..");
define("ALL","همه");
define("INCLUDED_FIELDS","شامل نام فيلدها");
define("UP","بالا");
define("DOWN","پايين");
define("_PRINT","چاپ");

define("USE_SECURITYIMAGES","استفاده از تصاوير امنيتي");
define('NO_SI_INSTALLED', 'تصاوير امنيتي نصب نشده است');
define('NO_SI_INSTALLED_INFO', '<ul><li>Get it from <a href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,1211/Itemid,35/">Joomla! Extensions</a></li><li>PerForms will work fine without it.</li></ul>');
define("EDIT_FORM","ويرايش فرم");
define("ADD_EDIT_REMOVE","افزودن، ويرايش يا حذف گزينه هاي فرم");
define("CAPTION","عنوان");
define('USE_CAPTION',"استفاده از عنوان");
define('FIELD_SEPARATOR', "عنصر جدا كننده");
define('FIELD_SEPARATOR_INFO', "هنگامي كه متني خروجي به فرم يا ايميل فرستاده ميشود، اين كاراكتر بين دو مقدار اختياري قرار خواهد گرفت.");
define('USE_CAPTION_INFO',"When outputting form to email, perForms will print field names next to the value.");
define('FORMAT_TAB',"فرمت");
define('FORMAT_INFO', "فرمت كردن ايميل و گزارش");
define("TYPE","نوع");
define("ORDER","طبقه");
define("REORDER","طبقه بندي دوباره");
define('INSERT', "درج");
define('REMOVE', "حذف");
define('SET_AS_SELECTED', "استفاده از انتخاب شده");
define("VALUE","مقدار");
define("EDIT_ITEM","ويرايش گزينه");
define("EDIT","ويرايش");
define("_NEW","جديد");
define("FORM_DETAILS","جزئيات فرم");
define("TITLE","تيتر:");
define("INTRO_TEXT","متن معرفي:");
define("AFTER_SUBMIT","پس از ارسال:");
define("REDIRECT_TO_URL","فهرست بندي دوباره به آدرس");
define("SHOW_TNX_TEXT","نمايش متن تشكر");
define("REDIRECT_URL","آدرس مجدد فهرست");
define("TNX_TEXT","متن هاي تشكر:");
define("PUBLISHING_TAB","منتشر كردن");
define("PUBLISHING_INFO","اطلاعات منتشر كردن");
define("ACCESS","دستيابي");
define("START_PUBLISHING","آغاز منتشر كردن");
define("FINISH_PUBLISHING","پايان منتشر كردن");
define("IMAGES_TAB","تصاوير");
define("IMAGE_INFO","اطلاعات تصوير");
define('IMAGE_INFO_INFO',"براي استفاده ي دستي تصوير در اينجا، تصويرتان را آپلود كنيد".$mosConfig_live_site."/images/stories");
define("THEMES_TAB","ظواهر");
define("THEME_INFO","اطلاعات قالب");
define("THEME","قالب");
define("BUTTONS_TAB","دكمه ها");
define("FORM_BUTTONS","دكمه هاي فرم");
define("SUBMIT_LABEL_TITLE","برچسب ارسال");
define("INCLUDE_RESET","شامل دكمه ي ريست");
define("INCLUDE_PF","Include Printer Friendly button");
define("INCLUDE_PDF","شامل دكمه PDF");
define('INCLUDE_PF_INFO',"PerForms will include a Printer-Friendly button with the form header, allowing the form to be seen on its own, in a popup window.");
define('INCLUDE_PDF_INFO'," در هنگامي كه بالاي فرم نمايش داده ميشود دكمه ي PDF نيز وجود خواهد داشت");
define('NO_PDF_INSTALLED', 'HTML به PDF نصب نشده است. دكمه ي PDF براي انجام در دسترس نخواهد بود.');
define('NO_PDF_INSTALLED_INFO', '<ul><li>Get it from <a href="http://sourceforge.net/projects/html2fpdf">SourceForge</a></li><li>PerForms will work fine without it.</li></ul>');
define("RESET_LABEL","برچب ريست");
define("EMAILS_TAB","ايميل ها");
define("EMAIL_FORM_TITLE","فرم ايميل");
define("EMAIL_FORM","فرم ايميل:");
define('EMAIL_FORM_INFO', "اگر بله، هنگامي كه به اين فرم ارسال گردد يك ايميل فرستاده خواهد شد.");
define('EMAIL_ADMIN',"Send copy to admin:");
define('EMAIL_ADMIN_INFO', "اگر بله، يك كپي از ايميل (ها) فرستاده خواهد شد به آدرس \&apos;to\&apos; فيلد - اگر اگر فيلد خالي باشد و \&apos;Email Form\&apos; باشد \&apos;yes\&apos;, يك ايميل به مدير سايت فرستاده شده است.");
define('EMAIL_USER',"فرستادن كپي به كاربر:");
define('EMAIL_USER_INFO', "اگر بله، يك ايميل به كاربري كه فرم را پركرده ارسال خواهد شد. لطفا دقت كنيد كه اين كار با ورود كاربران بطور خودكار انجام ميشود. اگر شما اين گزينه ها را فراخواني نماييد <b>\&apos;replyto\&apos;</b> and <b>\&apos;replytoName\&apos;</b> در اين صورت از مقدار اين گزينه ها استفاده خواهد شد. اين ها بطور پيشفرض براي كاربران وارد شده مخفي خواهد بود. بازديدكنندگان سايت ميبايست خود را از طريق آدرس ايميل در فرم <b>\&apos;replyto\&apos;</b> and <b>\&apos;replytoName\&apos;</b> معرفي نمايند كه براي تمامي كاربراني كه وارد نشده اند نمايش داده خواهد شد، در صورتي كه گزينه ها در فرم باشد.");
define('ENABLE_MAILFROM',"اجازه ي ايميل جعلي:");
define('ENABLE_MAILFROM_INFO', "اگر بله، سعي ميشود پيغامي از فيلد فراخواني شده به مديري كه از اين مقدار استفاده كرده فرستاده شود <b>\&apos;mailfrom\&apos;</b> در فرم: بخشي از ايميل، اگر <b>\&apos;mailfrom\&apos;</b> باشد يك گزينه در فرم خواهد بود. تمامي ايميل سرورها از آن راضي نخواهند بود، بنابر اين پيشفرض \&apos;no\&apos; خواهد بود.");
define("EMAIL_ALWAYS","در صورت خطا ارسال كن:");
define('EMAIL_ALWAYS_INFO', "اگر بله، در صورت بروز مشكلات از ارسال ايميل چشم پوشي خواهد شد،");
define("FROM","From: <small>(خالي جهت استفاده از پيشفرض سايت)</small>");
define('FROM_INFO', "اگر شما ميخواهيد آدرس ايميل <b>reply-to</b> به كاربراني كه فرم را بصورت ناقص پر كرده اند و برخي پارامترهاي بالا را خالي رها نموده اند پاسخ داده شود. در عوض  يك ايميل در فيلد به فرم شما (گزينه هاي سربرگ) بيافزايند و شما از آن <b>Name</b> اطمينان پيدا كنيد به <b>replyto</b> تنظيم ميشود.");
define("TO","To: <small>(comma separated list)</small>");
define('TO_INFO', 'اگر شما ميخواهيد آدرس ايميل <b>mail-to</b> توسط كاربري كه فرم را پر كرده انتخاب شود (دستي ايجاد شود you\&apos;re اگر يك فرم تماس با يك ليست پايين كشيدني از ايميل گيرنده داشته باشيد) در اين صورت مي افزاييد آدرس ايميل خود را <b>mail-to</b> در پارامترهاي بالا بصورت نرمال (تا با استفاده از آدرس پيشفرض بفرستد). سپس يك يك ليست انتخاب به فرم افزوده (برگه گزينه ها) با آدرس ايميل قابل انتخاب براي هر گيرنده و با اطمينان در <b>Name</b> is set to <b>mailto</b>');
define("EMAIL_SUBJECT","موضوع ايميل:");
define('EMAIL_SUBJECT_INFO', 'اگر ميخواهيد <b>Subject</b> ايميلي يكتا باشد (يا با پر كردن فرم توسط كاربر) پارامترهاي بالا را <b>Subject</b> خالي ترك نمايد. در عوض يك فيلد موضوع به فرم شما بيافزايد (برگه گزينه ها) و مطمئن شويد <b>Name</b> با <b>subject</b> به نوبت تنظيم است اگر شما يك موضوع در بالا بيافزاييد و بخواهيد كه هنوز يك فيلد در فرم شما باشد در اين صورت موضوع بالا توسط كاربر در موضوع باز شده افزوده خواهد شد.');
define("INTRO_INCLUDE","حاوي معرفي متن:");
define('INTRO_INCLUDE_INFO', "اگر بله، معرفي متن در محتويات ايميل خواهد بود.");
define('APPEND_TIMESTAMP', "افزودن تمبر زمان");
define('APPEND_TIMESTAMP_INFO', "اگر بله، موضوع ايميل بر حسب زمان و تاريخ بازشدن فرم ارسال مشود.");
define("TABLE_ALREADY_CREATED","اين جدول ايجاد شده است");
define("CREATE_DATABASE_TABLE","ايجاد جدول DataBase..");
define("NOT_BOUND_TO_TABLE","اين فرم در محدوده ي جريان به يك جدول DataBase نميباشد.");
define("BOUND_TO_TABLE","اين فرم در محدوده ي جريان به يك جدول DataBase ميباشد. نام جدول: ");
define("BOUND_INFO1","هنگامي كه شما يك جدول را به يك فرم پيوست ميكنيد شما ميتوانيد <strong>not</strong> را بيافزاييد، ويرايش نماييد يا آن را از عناصر فرم حذف نماييد.");
define("BOUND_INFO2","نام جدول <strong>must not</strong> شامل فاصله ها، علامات جدا كننده يا كاراكترهاي ويژه ميباشد.");
define("TABLE_NAME","نام جدول:");

define("DELETE_FORM_INFO1","اين فرم هم اكنون محدود به '%s' ميباشد" );
define("DELETE_FORM_INFO2","اگر شما جدول را حذف نماييد، تمامي داده ها از دست خواهند رفت، و همچنين جدول حذف خواهد شد.");
define("DELETE_FORM_INFO3","راهي براي بازگرداندن اطلاعاتي كه به يكباره حذف شده اند وجود ندارد");
define("DELETE_TABLE","جدول حذف گردد؟");
define("FORM_ITEMS_DETAILS","جزئيات گزينه هاي فرم");
define("NO_SPECIAL_CHARS","فاصله، علائم جدا كننده يا كاراكترهاي ويژه نميپذيرد!");
define("CHECK","بررسي");
define("HELP_TEXT","متن راهنما");
define("ERROR_MSG","پيغام خطا");
define("DISPLAY_TAB","نمايش");
define("DISPLAY_PROP","نمايش خصوصيات");
define("SIZE1","اندازه 1");
define("SIZE2","اندازه 2");
define('SIZE1_INFO',"عرض، ستون ها");
define('SIZE2_INFO',"ارتفاع، سطرها، <br/> بيشترين اندازه ي آپلود (بايت)");
define("REQUIRED","مورد نياز");
define('REQUIRED_INFO',"فرم در دسترس نيست مگر اينكه اين فيلد پر شود.");
define("DISABLED","غير فعال است");
define("READONLY","فقط خواندني");
define("MULTIPLE","چندگانه");
define('MULTIPLE_INFO',"براي استفاده با عناصر \&apos;Select\&apos;");
define("VALUES_TAB","مقادير");
define('VALUES_INFO',"اطلاعات مقادير");
define("MISSING_FIELD_TEXT","متن فيلد مفقود شده:");

// Errors
define("ITEMS_CANT_EDITED","گزينه هاي اين فرم نميتوانند ويرايش گردند!");
define("FORM_CURRENTLY_EDITED","فرم %s هم اكنون توسط مدير ديگري ويرايش گرديده است.");
define("NO_FORM_FOUND","فرم يافت نشد.");
define("SELECT_A_RECORD_TO","انتخاب يك ركورد به %s");
define("ALREADY_TABLE_EXISTS","جدول \'%s\' موجود است، لطفا نام ديگري وارد نماييد.");
define("ERROR_OCCURRED","يك خطا رخ داده است!");
define("DB_ERROR_OCCURRED","خطاي نوشتن در DataBase");
define("TITLE_EMPTY","تيتر خالي است!");
define("TABLE_NAME_EMPTY","شما بايد يك نام جدول بدهيد.");
define("DELETE_DATA_CONFIRM","آيا مطمئن هستيد كه ميخواهيد تمامي داده ها حذف گردند؟");
define("CAPTION_EMPTY","عنوان خالي ميباشد.");
define("NAME_EMPTY","نام خالي ميباشد.");
define("LIST_VALUES","مقادير ليست");
define("SELECTED_VALUE","مقدار انتخابي");
define('SELECTED_VALUE_INFO',"اولين مقدار انتخابي از عنصر.");

define("PF_ERROR_18", "جلسه پايدار نميباشد");
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
define("PF_ERROR_22", "بدون عدد مقدور است");
define("PF_ERROR_22_COMMENT",
       'معمولا به دليل آدرس نادرست ميباشد. '
       .'نگاه كنيد <a href="http://forge.joomla.org/sf/go/post17395">'
       .'http://forge.joomla.org/sf/go/post17395</a>');

define("PF_ERROR_23", "فرم يافت نشد.");
define("PF_ERROR_23_COMMENTA", "يك فرم با شناسه");
define("PF_ERROR_23_COMMENTB",
       @"نميتواند بيابد.<ul>
<li>ممكن است شما اجازه ي دسترسي به اين منبع را نداشته باشيد, يا
<li>يا اين فرم منقضي شده است, منتشر شده نباشد, يا حذف گرديده.</ul>");
define("FOR_MORE_HELP", 'جهت استفاده از اطلاعات بيشتر, نگاه كنيد '
       .'صفحه ي خانگي را ببينيد, در <a href="http://www.performs.org.au/"> '
       .'performs.org.au</a>');

define("PF_ERROR_127", "ليست پارامتر معتبر نيست");
define("PF_ERROR_127_COMMENT",
       'معمولا به دليل از دست رفتن پارامترها براي يك گزينه ي منو از"اجزا" ميباشد.'
	   .'<ul><li>بخاطر آوردن به افزودن <strong>formid=1</strong> به ليستي از '
       .'پارامترها (  يا مكاتبه ي شناسه به فرمي كه ميخواهيد نمايش داده شود).'
	   .'</li></ul>');

define("PF_ERROR_71", "نميتواند فهرست آپلودها را ايجاد نمايد");
define("PF_ERROR_71_INFO", "براي نگهداري فهرست براي اين فرم نا معتبر است، يا نميتواند ايجاد نمايد. لطفا مسير آپلود در 'مقادير' جدول مدير را بررسي نماييد.");

// MENU

define("DATABASE","Database");
define("BOUNDDATA","داده");
define("EXPORTTOEXCEL","صدور");
define("PREVIEW","پيش نمايش");
define("CLOSE","بستن");
define("CANCEL","انصراف");
define("DELETE","حذف");
define("COPY_RECORD","كپي");
define("NEW_ITEM","گزينه جديد");
define("DELETE_ITEM_CONFIRM","حذف گزينه؟");
define("SAVE","ذخيره");

define("PRINTER_FRIENDLY", "Printer Friendly");
define("DOWNLOAD_PDF", "دريافت PDF");
define("ACCESSKEY", "AccKey" );

define('PLEASE_FILL_OUT', 'لطفا بيرون پر كنيد');
define('BINDING', 'چسباندن');
define('EDIT_ITEMS', 'ويرايش گزينه ها');
define('UPGRADE_NEWS', 'اخبار جديد');
define('IS_AVAILABLE', 'در دسترس ميباشد');
define('DOWNLOAD_FROM', 'دريافت فرم');

define('SEP_COMMA', 'comma');
define('SEP_COMMASPACE', 'comma+space');
define('SEP_HYPHEN', 'خط ربط');
define('SEP_NEWLINE', 'خط جديد');
define('SEP_SPACE', 'فاصله');

define('TY_EMAIL', 'ايميل');
define('TY_FLOAT', 'عدد شناور');
define('TY_INTEGER', 'عدد صحيح');
define('TY_NAME', 'نام');
define('TY_STRING', 'رشته');
define('TY_URL', 'مسير');

define('ITEMTYPE_BUTTON', 'دكمه');
define('ITEMTYPE_CHECKBOX', 'چك باكس');
define('ITEMTYPE_DATE', 'تاريخ');
define('ITEMTYPE_FILE', 'فايل');
define('ITEMTYPE_HIDDEN', 'مخفي');
define('ITEMTYPE_IMAGE', 'تصوير');
define('ITEMTYPE_PASSWORD', 'رمزعبور');
define('ITEMTYPE_PAGEBREAK', 'pagebreak');
define('ITEMTYPE_RADIO', 'radio');
define('ITEMTYPE_SELECT', 'انتخاب');
define('ITEMTYPE_TEXT', 'متن');
define('ITEMTYPE_TEXTAREA', 'نواحي متن');
define('ITEMTYPE_TEXTUAL', 'متني');

define('VALUE_UP', "بالا");
define('VALUE_UP_INFO', "بالا بردن گزينه ي انتخاب شده در ليست.");
define('VALUE_DOWN', "پايين");
define('VALUE_DOWN_INFO', "پايين بردن گزينه ي انتخاب شده در ليست");
define('SET_AS_SELECTED_INFO', "عنصر html فرم توسط اولين گزينه ي انتخابي ترسيم خواهد شد.");
define('REMOVE_INFO', "حذف فرم اختياري انتخاب شده از ليست مقادير.");
define('DISABLED_INFO', "اگر بله، اين گزينه ترسيم نميشود.");
define('READONLY_INFO', "اگر بله، اين عنصر بصورت فقط خواندني ترسيم ميشود، نميتواند پر شود.");
define('VALUE_INFO',"يك مقدار در اين فيلد وارد نموده و دكمه ي ".درج." را كليك كنيد تا به ليست افزوده شود. <br /><br /> براي <strong>".ITEMTYPE_FILE."</strong> گزينه ها، مسير پيشفرض آپلود را در اينجا وارد كنيد، با يك جداساز <br />(eg <code>/path/to/uploads/</code> or <code>c:\\\uploads\\\</code>).");
define('SUBMIT_LABEL_INFO', "دكمه \&apos;<b>submit</b>\&apos; متني كه در فرم نمايش داده ميشود.");
define('INCLUDE_RESET_INFO', "اگر بله، شامل يك \&apos;<b>reset</b>\&apos; دكمه در فرم خواهد بود.");
define('RESET_LABEL_INFO', "دكمه \&apos<b>reset</b>\&apos; متني كه در فرم نمايش داده ميشود.");
define('PUBLISHED_INFO', "If yes, the form will be available to users of the site.");
define('ACCESS_INFO', "تعريف سطح دسترسي براي فرم.");
define('START_PUBLISHING_INFO', "تاريخ شروع دسترسي فرم براي كاربران در سايت.");
define('FINISH_PUBLISHING_INFO', "تاريخ شروع توقف دسترسي كاربران به فرم در سايت. اگر تاريخ 0000-00-00 00:00:00 باشد هميشه در دسترس خواهد بود.");
define('CAPTION_INFO', "اين متن به منظور عنوان گزينه چاپ خواهد شد.");
define('ACCESSKEY_INFO', "كليد دستيابي وابسته به گزينه خواهد بود، كه اين ترسيم با يك كليد تركيبي به مرورگر ميباشد. بنابر اين يك كليد دستيبابي از \&apos;<b>k</b>\&apos; نقشه اي به crtl-shift-k در فايرفاكس، و alt-shift-k in در اينترنت اكسپلورر خواهد بود.");
define('NAME_INFO', "نام داخلي از گزينه، بايد شامل هيچ كاراكتري غير الفبايي نباشد.  اگر اين گزينه با نام <b>bcc, cc, mailfrom, mailto, replyto </b>or<b> replytoName</b> باشد اگر فرم براي ارسال ايميل ها تنظيم شده باشد بطور خودكار براي ارسال مقدار به يك ايميل خواهد بود .");
define('TYPE_INFO', "انتخاب يك نوع از گزينه، از ليست. انواع متفاوت گزينه از خصوصيات متفاوتي پشتيباني ميكند. <br /><ul><li>The <b>".ucfirst(ITEMTYPE_TEXTAREA)."</b> uses ".SIZE1." and ".SIZE2.@" براي تعريف عرض و ارتفاع.<br /></li><li>The <b>".ITEMTYPE_SELECT.", ".ITEMTYPE_RADIO." </b>and<b> ".ITEMTYPE_CHECKBOX."</b> انواع بايد يك مقدار كوچك در گزينه باشند ".VALUES_TAB." list.<br /></li><li>The <strong>".ucfirst(ITEMTYPE_FILE)."</strong> item uses <strong>".SIZE1."</strong> براي عرض جعبه ي نام فايل، <strong>".SIZE2."</strong> جهت تعريف بيشترين اندازه ي آپلود و <strong>".VALUE."</strong> براي مسير آپلود (فايلهاي آپلود شده در كجا نگهداري ميشوند) .</li></ul>");
define('CHECK_INFO', " انتخاب يك معتبر ساز براي اين گزينه. انتخاب معتبر ساز خالي اجازه ي همه ي انواع داده را خواهد داد.");
define('HELP_TEXT_INFO', "متن راهنما همراه با گزينه ظاهر خواهد شد.");
define('ERROR_MSG_INFO', "پيغام خطا هنگامي كه يك مشكل براي گزينه وجود داشته باشد نمايش داده خواهد شد.");
define('REVERSE_ORDER', "معكوس طبقه");
define('SAVE_ORDER', "ذخيره طبقه");
define('SWAP_SIZE_VARS', "جابجايي اندازه1 و اندازه2 براي تمامي نواحي متن گزينه ها");
define('NEW_SIZEVARS_SAVED', 'اندازه ي متغيرهاي جديد ذخيره شده');
define('NEW_ORDERING_SAVED', 'طبقه بندي جديد ذخيره شده');

define('PF_LICENCE_INFO', 'نرم افزار رايگان با مجوز  <a href="http://www.gnu.org/copyleft/gpl.html">GNU General Public License</a>.');
define('INSTALLATION_MESSAGES', 'پيغام هاي نصب');
define('THANKS_FOR_CHOOSING', 'بخاطر اين انتخاب متشكريم');
define('WE_NEED_TRANSLATORS', @"
<p>
هم اكنون كاملا محلي است، و ما نياز به ترجمه داريم!
<a href=\"http://forge.joomla.org/sf/go/projects.performs/discussion.language_file_translations\">ايجاد يك كمك سراسري</a>
</p>");
define('FOR_SUPPORT', @"
<p><b>جهت پشتيباني, لطفا به سايت عالي رتبه ي ما سر بزنيد در <a href=\"http://www.performs.org.au/\">http://www.performs.org.au/</a>.</b></p>
");
define('PERFORMS_FEATURES', @"
<p>شامل تركيبات:</p>
<ul>
<li>فيلدهاي ورودي نامحدود</li>
<li>انتخاب بين 9 نوع فيلد</li>
<li>چهره ي آپلود فايل!</li>
<li>فرم به تابع ايميل</li>
<li>كاربر ارسال شده ايميل فرم, پاسخ به و فيلدهاي موضوع</li>
<li>Optionally create a separate database table for each form</li>
ايجاد يك جدول مجزا براي هر DataBase بصورت اختياري
<li>مقدار دهي هاي فيلد</li>
<li>فرم هاي دسترس پذير</li>
<li>پيغام هاي خطاي دستي</li>
<li>پيغام هاي راهنمايي دستي براي هر فيلد</li>
<li>صفحه ي گزارش براي مشاهده ي ركوردها در جدول</li>
<li>سيستم قالب سازي پايه</li>
<li>مشاهده/صدور دريافت داده در مديريت</li>
<li><مشاهده ي نسخه ي قابل چاپ از جلودار/li>
<li>دريافت PDF</li>
<li>جوملا! 1.5 آماده است</li>
</ul>
");
define('WELCOME_TO_PERFORMS', @"
<p>
ايجاد آسان فرم هاي دستي كه ميتوانيد ايميل بفرستيد يا در DataBase ذخيره نماييد. نتايج را ميتوانيد در مدير يا csv دريافت شده مشاهده نماييد.
</p>
".FOR_SUPPORT.PERFORMS_FEATURES.WE_NEED_TRANSLATORS);
define('NEW_FEATURES', @"
<strong>چهره هاي جديد: </strong>
<ul>
<li>قابل دسترس</li>
<li>آيكن هاي اطلاعات مدير</li>
<li>صفحه بندي محدوده ي داده</li>
<li>تنظيم</li>
<li>فيلد آپلود فايل</li>
<li>پيغام هاي دوستانه</li>
<li>بررسي ورژن</li>
</ul>
");
define('UPGRADE_MESSAGE', @"
<p>تغييرات انجام شده! 
<ol><li><p><img src=\"images/reload_f2.png\" height=\"16\" width=\"16\" border=\"0\" /> The <strong>".REVERSE_ORDER.@"</strong> button.</p>ممكن است شما گزينه هايتان را بصورت طبقه بندي وارونهببينيد، براي طبقه ثابت، بسادگي فشاردهيد'<strong>"

       .REVERSE_ORDER."</strong>' دكمه در بالاي  ".ORDER.@" ستون در نمايش گزينه.</li>
<li style=\"margin-top: 4pt;\"><p>
<img src=\"images/restore_f2.png\" border=\"0\" width=\"16\" height=\"16\" />
 The <strong>".SWAP_SIZE_VARS.@"</strong> button.</p>
ما سبك گزينه هاي نواحي متن را به اندازه1 و اندازه2 تغيير داديم، تا نواحي متن شما بدرستي ديده شود،
كليك كنيد '<strong>".SWAP_SIZE_VARS."</strong>' دكمه در بالاي ".SIZE1." و ".SIZE2.@" ستون ها.</li></ol></p>
".WE_NEED_TRANSLATORS.NEW_FEATURES.FOR_SUPPORT);


define('SUCCESSFUL_UPGRADE', "با موفقيت ارتقا يافت ");
define('INS_WELCOME', "خوش آمديد!");
define('INS_SQL_STATEMENTS', "تشريحات SQL");
define('INS_SQL_ERRORS', "خطاهاي SQL");

define('UPLOAD_ERROR_1', "تجاوز فايل آپلود شده بيشتر از اندازه ي تعيين شده در php.ini.");
define('UPLOAD_ERROR_1_INFO', "فايل بزرگتر از php در دسترس براي نصب ميباشد.<ul><li> از مدير php/جوملا ي خود بپرسيد تا بيشترين ميزان آپلود فايل را افزايش دهد.</li></ul>");
define('UPLOAD_ERROR_2', "فايل آپلود بزرگتر از بيشترين ميزان آپلود ميباشد اين در فرم HTML تعيين شده است.");
define('UPLOAD_ERROR_2_INFO', "The administrator has set the maximum upload file size to less than the size of your file.");
define('UPLOAD_ERROR_3', "تنها بخشي از فايل آپلود شده آپلود گرديده است.");
define('UPLOAD_ERROR_3_INFO', "خطا در اتصال بدليل ناقص بودن فايل در پايان سرور. لطفا مجددا تلاش نماييد.");
define('UPLOAD_ERROR_4', "فايل آپلود نشده است");
define('UPLOAD_ERROR_4_INFO', "بدليل عدم موفقيت در آپلود فايل حالت ناشناخته رخ داده است.");
define('UPLOAD_ERROR_5', "Unknown Error Response!!.");
define('UPLOAD_ERROR_5_INFO', "نصب php در حالت خطاي كد غير استاندارد پاسخ داده شده است!");
define('UPLOAD_ERROR_6', "مفقود شدن يك پوشه ي موقت. معرفي در PHP 4.3.10 و PHP 5.0.3.");
define('UPLOAD_ERROR_6_INFO', "هنگام نصب php پوشه ي موقتي در فايل php.ini تنظيم نشده است.");
define('UPLOAD_ERROR_7', "عدم موفقيت نوشتن فايل در ديسك. معرفي در PHP 5.1.0.");
define('UPLOAD_ERROR_7_INFO', "The server may have run out of space, or the temporary directory is read-only.");
define('SUCCESS', "با موفقيت!");
define('UPLOAD_SUCCESSFUL', "فايل صيح ميباشد، و با موفقيت آپلود شده است.\n");
define('UPLOAD_SUCCESSFUL_INFO', "فايل آپلود شده و در يك فهرست جاي داده شده نگهداري ميشود، براي مدير نوشته گرديده است.");
define('ERROR_71', "آپلود فايل قابل حمله ميباشد!\n");
define('ERROR_71_INFO', "نام فايل يا مسير نا معتبر ميباشد!");
define('UNKNOWN_SENDER', "Unknown Sender");
define('IMAGEFLOAT', "شيوه ي تصوير شناور");
define('IMAGEFLOAT_INFO', "تنظيم شيوه ي تصوير شناور (css شناور: [چپ، راست، هيچ يك، جانشين];)");
define('FLOAT_LEFT', 'چپ');
define('FLOAT_RIGHT', 'راست');
define('FLOAT_NONE', 'هيچ كدام');
define('FLOAT_INHERIT', 'جانشين');

define('NOT_BOUND', "مهيا نيست");
define('CLICK_BINDING_BUTTON', "كليك كنيد روي <b>Binding</b> دكمه تا يك جدول DataBase جديد اختصاص دهيد.");

define('SHOW_UPLOADED_IMAGE', "نمايش تصوير آپلود شده");
define('SHOW_UPLOADED_IMAGE_INFO', "هنگامي كه يك كاربر را از طريق وارد كردن ايميل نمايش ميدهد، گزينه هاي فايل ميتوانند بصورت يك لينك نمايش داده شوند، يا به شكل يك تصوير نمايش داده شوند.");
define('SUBMIT', "ارسال");
define('REPLACE_SUBMIT_BUTTON', "جايگزيني دكمه ارسال");
define('REPLACE_SUBMIT_BUTTON_INFO', "جايگزيني دكمه ي ارسال پيشفرض فرم با يك تصوير.");
define('SUBMIT_IMAGE_URL', "ارسال آدرس تصوير");
define('SUBMIT_IMAGE_URL_INFO', "اشاره يك آدرس به تصوير موجب جايگزيني دكمه ي ارسال پيشفرض ميشود.");
define('SUBMIT_IMAGE_WIDTH', "پهناي تصوير ارسال");
define('SUBMIT_IMAGE_WIDTH_INFO', "پهناي تصوير براي جايگزيني دكمه ي ارسال پيشفرض استفاده ميشود.");
define('SUBMIT_IMAGE_HEIGHT', "بلندي تصوير ارسال");
define('SUBMIT_IMAGE_HEIGHT_INFO', "بلندي تصوير براي جايگزيني دكمه ي ارسال پيشفرض استفاده ميشود.");
define('RESET', "ريست");
define('REPLACE_RESET_BUTTON', "جايگزيني دكمه ريست");
define('REPLACE_RESET_BUTTON_INFO', "جايگزيني دكمه ي ريست پيشفرض فرم با يك تصوير.");
define('RESET_IMAGE_URL', "آدرس تصوير ريست");
define('RESET_IMAGE_URL_INFO', "اشاره يك آدرس به تصوير موجب جايگزيني دكمه ي ريست پيشفرض ميشود.");
define('RESET_IMAGE_WIDTH', "پهناي تصوير ريست");
define('RESET_IMAGE_WIDTH_INFO', "پهناي تصوير براي جايگزيني دكمه ي ريست پيشفرض استفاده ميشود.");
define('RESET_IMAGE_HEIGHT', "بلندي تصوير ريست");
define('RESET_IMAGE_HEIGHT_INFO', "بلندي تصوير براي جايگزيني دكمه ي ريست پيشفرض استفاده ميشود.");
define('NOT_AUTHORIZED', "شما اجازه ي ديدن اين منبع را نداريد.");
define("NO_AUTH_MESSAGE", "پيغام اجازه ندادن");
define("NO_AUTH_MESSAGE_INFO", "پيغام توسط فرم معرفي شده هنگامي كه يك كاربر نا معتبر قصد مشاهده ي آن را داشته است.");

define('USE_CONTAINER', "استفاده محتوي");
define('USE_CONTAINER_INFO', "وقتي كه يك فرم به نمايش در مي آيد، از محتويات استاندارد در صورت بله بودن استفاده ميشود. اگر نه، براي جايگزيني حروف منحصر بفرد و فرستادن آن به عنوان مثال به فرم ميتوانند استفاده كنند.");
define('SHOW_FORM_TITLE', "نمايش تيتر فرم");
define('SHOW_FORM_TITLE_INFO', "وقتي كه يك مولفه نمايش داده ميشود،‌ تيتر تنظيمات بصورت روشن/خاموش نمايش داده ميشود.");
define('FORM_WIDTH', "پهناي فرم");
define('FORM_WIDTH_INFO', 'هنگامي كه پهناي فرم نمايش داده ميشود. ميتواند &quot;100px&quot; يا &quot;35%&quot; باشد.');
define('FORM_DISPLAY', "نمايش فرم");
define('PRESENTATION_INFO', "عرضه");
define('INCLUDE_SUBMIT', "شامل دكمه ارسال");
define('INCLUDE_SUBMIT_INFO', "نمايش دكمه ي ارسال در فرم.");
define('MAIL_AS_TEXT', "ايميل بصورت متن");
define('MAIL_AS_TEXT_INFO', "اگر بله، داده هاي فرم بصورت خام فرستاده ميشود، اما بخاطر داشته باشيد، اگر شما درون تعريف ايميل فرم برويد، بصورت Html نخواهد بود.");
define('EXTRA_RECIPIENTS', "گيرندگان بيشتر");
define('MAIL_OPTIONS', "اختيارات ايميل");
//define("Delete","Delete");

define("USE_SECURITYIMAGES_INFO", "اگر بله، تصوير امنيتي براي فعال شدن CAPTCHA در اين فرم استفاده خواهد شد.");
define("SECURITYIMAGESHELP_INFO", "اين پيغام بصورت تنها و با تصوير جعبه ي متن CAPTCHA نمايش داده ميشود.");
define("SECURITYIMAGESERROR_INFO", "اين پيغام در صورتي كه CAPTCHA با خطا براي فرم مواجه شود نمايش داده ميشود.");

define("CAPTIONCSSCLASS","Caption CSS class(es)");
define('CAPTIONCSSCLASS_INFO',"If set, the caption will be surrounded by a div tag, which has its CSS class attribute to this value.");
define("VALUECSSCLASS","Value CSS class(es)");
define('VALUECSSCLASS_INFO',"If set, the value will be surrounded by a div tag, which has its CSS class attribute to this value. If the form item has more than one value (such as a radio button), the entire set of values will be surrounded by the div.");
define("INFOCSSCLASS","Help CSS class(es)");
define('INFOCSSCLASS_INFO',"If set, the help text will be surrounded by a div tag, which has its CSS class attribute to this value.");
define("ERRORCSSCLASS","Error CSS class(es)");
define('ERRORCSSCLASS_INFO',"If set, an error message related to this form item will be surrounded by a div tag, which has its CSS class attribute to this value.");



/*
PFAUTO_ fields can be embedded into any text part of a form or form item
Where there can be text, an expression enclosed in braces, ilke {نام كاربري}
will return the "Auto" field for PFAUTO_USERNAME
*/
define('PFAUTO_USERNAME', "نام كاربري");
define('PFAUTO_NAME', "نام");
define('PFAUTO_USERTYPE', "نوع كاربري");
define('PFAUTO_REGISTERDATE', "تاريخ ثبت");
define('PFAUTO_LASTVISITDATE', "تاريخ آخرين بازديد");
define('PFAUTO_USEREMAIL', "ايميل كاربر");
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