<?php
/**
* @version $id: hungarian.php,v 2.3
* @package performs
* @copyright (c) 2007 perForms
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @author David Walters
* @author (original) Ilhami KILIC http://www.tuwitek.at
* Joomla is Free Software
* 
* Hungarian Translation completed by Daniel Lakos
* http://www.joomla-webhosting.eu
*
* If you are translating, be sure to download the very latest
* english.php, available from http://www.performs.org.au/performs/nightly/english.php.txt
*
*/
defined( '_VALID_MOS' ) or die( 'A k&ouml;zvetlen hozz&aacute;f&eacute;r&eacute;s ehhez a helyhez nem ened&eacute;lyezett.' );
if (defined("WELCOME_TO_PERFORMS")) return;

define("FORM", "Form");

define("SUBMIT_LABEL","K&uuml;ld&eacute;s");
define("PUBLISH","k&ouml;zz&eacute;t&eacute;tel");
define("UNPUBLISH","visszavon&aacute;s");
define("NAME","N&eacute;v");
define("LINK","Hivatkoz&aacute;s");
define("ITEMS","Elemek");
define("DB_TABLE_NAME","DB t&aacute;blan&eacute;v");
define("DB_RECORDS","DB rekordok");
define("PUBLISHED","K&ouml;zz&eacute;t&eacute;ve");
define("UNPUBLISHED","Visszavonva");
define("SECURITYIMAGESHELP","Biztons&aacute;gi k&oacute;d s&uacute;g&oacute;&uuml;zenete");
define("SECURITYIMAGESERROR","Biztons&aacute;gi k&oacute;d hiba&uuml;zenete");

define("FORM_PREVIEW","&Ucirc;rlap el&otilde;n&eacute;zete");
define("DATE_TIME","D&aacute;tum");
define("NO_RECORDS_FOUND","Nem tal&aacute;lhat&oacute;k rekordok!");
define("FIELD_NAMES","Mez&otilde;nevek");
define("SELECT_FIELDS","Jel&ouml;lje ki azokat a mez&otilde;neveket, melyeket bele kv&aacute;n venni a jelent&eacute;sbe.");
define("ALL","Mind");
define("INCLUDED_FIELDS","Belevett mez&otilde;nevek");
define("UP","Fel");
define("DOWN","Le");
define("_PRINT","Nyomtat&aacute;s");

define("USE_SECURITYIMAGES","Biztons&aacute;gi k&oacute;d haszn&aacute;lata");
define('NO_SI_INSTALLED', 'com_securityimages nincs telep&iacute;tve');
define('NO_SI_INSTALLED_INFO', '<ul><li>Let&ouml;lthet&otilde; innen <a href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,1211/Itemid,35/">Joomla! Extensions</a></li><li>De a PerForms en&eacute;lk&uuml;l is m&ucirc;k&ouml;dni fog.</li></ul>');
define("EDIT_FORM","&Ucirc;rlap szerkeszt&eacute;se");
define("ADD_EDIT_REMOVE","&Ucirc;rlapelemek hozz&aacute;ad&aacute;sa, szerkeszt&eacute;se vagy elt&aacute;vol&iacute;t&aacute;sa");
define("CAPTION","C&iacute;m");
define('USE_CAPTION',"Felirat");
define('FIELD_SEPARATOR', "Mez&otilde; elv&aacute;laszt&oacute;");
define('USE_CAPTION_INFO',"Amikor az &ucirc;rlap emailben elk&uuml;ld&eacute;sre ker&uuml;l, a perForms a mez&otilde;neveket a kit&ouml;lt&ouml;tt &eacute;rt&eacute;kek mell&eacute; &iacute;rja.");
define('FIELD_SEPARATOR_INFO', "Amikor az &ucirc;rlap emailben elk&uuml;ld&eacute;sre ker&uuml;l, a perForms a kit&ouml;lt&ouml;tt &eacute;rt&eacute;kek ezzel a karakterrel v&aacute;lasztja el.");
define('FORMAT_TAB',"Form&aacute;tum");
define('FORMAT_INFO', "Jelent&eacute;s &eacute;s email form&aacute;z&aacute;s");
define("TYPE","T&iacute;pus");
define("ORDER","Sorrend");
define("REORDER","&Aacute;trendez&eacute;s");
define('INSERT', "Besz&uacute;r");
define('REMOVE', "Elt&aacute;vol&iacute;t");
define('SET_AS_SELECTED', "Legyen kiv&aacute;lasztva");
define("VALUE","&Eacute;rt&eacute;k");
define("EDIT_ITEM","Szerkeszt&eacute;s");
define("EDIT","Szerkeszt&eacute;s");
define("_NEW","&Uacute;j");
define("FORM_DETAILS","&Ucirc;rlap r&eacute;szletei");
define("TITLE","C&iacute;m:");
define("INTRO_TEXT","Bevezet&otilde; sz&ouml;veg:");
define("AFTER_SUBMIT","Tov&aacute;bb&iacute;t&aacute;s ut&aacute;ni m&ucirc;velet:");
define("REDIRECT_TO_URL","&Aacute;tir&aacute;ny&iacute;t&aacute;s URL-re");
define("SHOW_TNX_TEXT","K&ouml;sz&ouml;netnyilv&aacute;n&iacute;t&aacute;s megjelen&iacute;t&eacute;se");
define("REDIRECT_URL","&Aacute;tir&aacute;ny&iacute;t&oacute; URL:");
define("TNX_TEXT","K&ouml;sz&ouml;n&otilde; sz&ouml;veg:");
define("PUBLISHING_TAB","K&ouml;zz&eacute;t&eacute;tel");
define("PUBLISHING_INFO","K&ouml;zz&eacute;t&eacute;tel r&eacute;szletei");
define("ACCESS","Hozz&aacute;f&eacute;r&eacute;s");
define("START_PUBLISHING","K&ouml;zz&eacute;t&eacute;tel kezdete");
define("FINISH_PUBLISHING","K&ouml;zz&eacute;t&eacute;tel befejez&eacute;se");
define("IMAGES_TAB","K&eacute;pek");
define("IMAGE_INFO","K&eacute;p r&eacute;szletei");
define('IMAGE_INFO_INFO',"Egy&eacute;ni k&eacute;p haszn&aacute;lat&aacute;hoz t&ouml;ltse fel a k&eacute;pet ide: ".$mosConfig_live_site."/images/stories");
define("IMAGE","K&eacute;p");
define("THEMES_TAB","T&eacute;m&aacute;k");
define("THEME_INFO","T&eacute;ma r&eacute;szletei");
define("THEME","T&eacute;ma");
define("BUTTONS_TAB","Gombok");
define("FORM_BUTTONS","&Ucirc;rlapgombok");
define("SUBMIT_LABEL_TITLE","A K&uuml;ld&eacute;s gomb felirata");
define("INCLUDE_RESET","Az Alaphelyzet gomb hozz&aacute;ad&aacute;sa");

define('INCLUDE_PF',"Nyomtat&oacute;bar&aacute;t gomb enged&eacute;lyez&eacute;se");
define('INCLUDE_PDF',"PDF gomb enged&eacute;lyez&eacute;se");
define('INCLUDE_PF_INFO',"A PerForms egy nyomtat&oacute;bar&aacute;t gombot helyez el az &ucirc;rlap fejl&eacute;c&eacute;ben, lehet&otilde;v&eacute; t&eacute;ve, hogy egy popup ablakban az &ucirc;rlap &ouml;nmag&aacute;ban megjelen&iacute;thet&otilde; legyen.");
define('INCLUDE_PDF_INFO',"A PerForms egy PDF gombot helyez el az &ucirc;rlap fejl&eacute;c&eacute;ben.");
define('NO_PDF_INSTALLED', 'A Html2PDF nincs telep&iacute;tve. A PDF export funkci&oacute; nem &eacute;rhet&otilde; majd el.');
define('NO_PDF_INSTALLED_INFO', '<ul><li>Let&ouml;lthet&otilde; innen: <a href="http://sourceforge.net/projects/html2fpdf">SourceForge</a></li><li>A PerForms en&eacute;lk&uuml;l is m&ucirc;k&ouml;dni fog.</li></ul>');

define("RESET_LABEL","Az Alaphelyzet gomb felirata");
define("EMAILS_TAB","Email");
define("EMAIL_FORM_TITLE","&Ucirc;rlap k&uuml;ld&eacute;se emailben");
define("EMAIL_FORM","&Ucirc;rlap k&uuml;ld&eacute;se emailben:");
define('EMAIL_FORM_INFO', "Ha be van kapcsolva, a perForms emailben k&uuml;ldi el az &ucirc;rlap tartalm&aacute;t.");
define('EMAIL_ADMIN',"M&aacute;solat k&uuml;ld&eacute;se az adminnak:");
define('EMAIL_ADMIN_INFO', "Ha be van kapcsolva, a perForms &uuml;zenetet k&uuml;ld a \&apos;c&iacute;mzett\&apos; mez&otilde;ben megadott c&iacute;mre - ha a c&iacute;mzett mez&otilde; &uuml;res &eacute;s az \&apos;&Ucirc;rlap k&uuml;ld&eacute;se emailben\&apos;  \&apos;Igen\&apos;, re van &aacute;ll&iacute;tva, akkor az oldal administr&aacute;tor&aacute;nak megy az email.");
define('EMAIL_USER',"M&aacute;solat k&uuml;ld&eacute;se az &ucirc;rlap kit&ouml;lt&otilde;j&eacute;nek:");
define('EMAIL_USER_INFO', "Ha be van kapcsolva, a perForms az emailt az &ucirc;rlap kit&ouml;lt&otilde;j&eacute;nek is elk&uuml;ldi. Bejelentkezett felhaszn&aacute;l&oacute;k eset&eacute;ben ez automatikus. Ha vannak az &ucirc;rlapban <b>\&apos;replyto\&apos;</b> &eacute;s <b>\&apos;replytoName\&apos;</b> elnevez&eacute;s&ucirc; elemek, akkor ezek &eacute;rt&eacute;k&eacute;t haszn&aacute;lja majd a k&uuml;ld&eacute;shez. Ezek a mez&otilde;k bejelentkezett felhaszn&aacute;l&oacute;k sz&aacute;m&aacute;ra rejtettek maradnak.");
define('ENABLE_MAILFROM',"Email c&iacute;m hamis&iacute;t&aacute;s:");
define('ENABLE_MAILFROM_INFO', "Ha be van kapcsolva, a perForms megpr&oacute;b&aacute;lja k&eacute;zbes&iacute;teni a levelet a <b>\&apos;mailfrom\&apos;</b> mez&otilde; tartalm&aacute;t k&uuml;ld&otilde;k&eacute;nt felt&uuml;ntetve a FROM: headerben, amennyiben a <b>\&apos;mailfrom\&apos;</b> az &ucirc;rlap l&eacute;tez&otilde; mz&otilde;je. Nem minden mail server fogadja gond n&eacute;lk&uuml;l az ilyen leveleket ez&eacute;rt alap&eacute;rtelmez&eacute;sben ez a lehet&otilde;s&eacute;g  \&apos;kikapcsolt\&apos;.");
define("EMAIL_ALWAYS","K&uuml;ld&eacute;s hiba eset&eacute;n is:");
define('EMAIL_ALWAYS_INFO', "Ha be van kapcsolva, a perForms hiba eset&eacute;n is elk&uuml;ldi az emailt");
define("FROM","Felad&oacute;: (hagyja &uuml;resen a webhely alap&eacute;rtelmez&eacute;s&eacute;nek haszn&aacute;lat&aacute;hoz)");
define('FROM_INFO', "Ha a <b>reply-to</b> v&aacute;lasz e-mail c&iacute;met hasz&aacute;lni akarja, hagyja &uuml;resen ezt a be&aacute;ll&iacute;t&aacute;st. Ebben az esetben adjon egy <b>mailfrom</b> elnevez&eacute;s&ucirc; mez&otilde;t az &ucirc;rlapj&aacute;hoz.");
define("TO","C&iacute;mzett: (vessz&otilde;vel elv&aacute;lasztott lista)");
define('TO_INFO', 'Ha azt akarja, hogy a <b>mail-to</b> c&iacute;mzett e-mail c&iacute;m a kit&ouml;lt&otilde; &aacute;ltal m&oacute;dos&iacute;that&oacute; legyen (hasznos, ha az &ucirc;rlapon drop-down list&aacute;val v&aacute;laszthat&oacute; a c&iacute;mzett) akkor adja meg a <b>mail-to</b> c&iacute;mzett email c&iacute;met az alap&eacute;rtelmezettk&eacute;nt val&oacute; haszn&aacute;latra. Majd adjon egy v&aacute;laszt&oacute; mez&otilde;t az &ucirc;rlapj&aacute;hoz az email c&iacute;m v&aacute;laszt&aacute;shoz , &uuml;gyelve arra, hogy a mez&otilde;n&eacute;v <b>mailto</b> legyen.');
define("EMAIL_SUBJECT","Az email t&aacute;rgya:");
define('EMAIL_SUBJECT_INFO', 'Ha azt akarja, hogy az email <b>t&aacute;rgya</b> egy&eacute;ni legyen, vagy meg lehessen adni az &ucirc;rlapon, akkor hagyja a t&aacute;rgyat &uuml;resen. Ehelyett adjon egy t&aacute;rgy mez&otilde;t az &ucirc;rlapj&aacute;ra <b>subject</b> mez&otilde;n&eacute;vvel. Ha itt is be&aacute;ll&iacute;t t&aacute;rgyat &eacute;s az &ucirc;rlapon is megadhat&oacute;, akkor a k&eacute;t t&aacute;rgy &ouml;sszef&ucirc;zve ker&uuml;l elk&uuml;ld&eacute;sre.');
define("INTRO_INCLUDE","A bevezet&otilde; sz&ouml;veg besz&uacute;r&aacute;sa:");
define('INTRO_INCLUDE_INFO', "Ha enged&eacute;lyezett, akkor az &ucirc;rlap bevezet&otilde; sz&ouml;vege benne lesz az emailben.");
define('APPEND_TIMESTAMP', "Id&otilde;b&eacute;lyeg hozz&aacute;ad&aacute;sa");
define('APPEND_TIMESTAMP_INFO', "Ha enged&eacute;lyezett, akkor az elk&uuml;ld&ouml;tt email t&aacute;rgya a k&uuml;ld&eacute;s id&otilde;pontj&aacute;val b&otilde;v&uuml;l.");

define("TABLE_ALREADY_CREATED","A t&aacute;bla l&eacute;trehoz&aacute;sa m&aacute;r megt&ouml;rt&eacute;nt...");
define("CREATE_DATABASE_TABLE","Adatb&aacute;zist&aacute;bla l&eacute;trehoz&aacute;sa...");
define("NOT_BOUND_TO_TABLE","Ez az &ucirc;rlap jelenleg NEM kapcsol&oacute;dik egyik adatb&aacute;zist&aacute;bl&aacute;hoz sem.");
define("BOUND_TO_TABLE","Ez az &ucirc;rlap jelenleg adatb&aacute;zist&aacute;bl&aacute;hoz kapcsol&oacute;dik. A t&aacute;bla neve: ");
define("BOUND_INFO1","Amikor hozz&aacute;kapcsol egy t&aacute;bl&aacute;t egy &ucirc;rlaphoz, akkor <strong>nem</strong> adhat hozz&aacute;, m&oacute;dos&iacute;that vagy t&ouml;r&ouml;lhet &ucirc;rlapelemeket.");
define("BOUND_INFO2","A t&aacute;blan&eacute;v <strong>ne</strong> tartalmazzon sz&oacute;k&ouml;zt, pontot, sem m&aacute;s speci&aacute;lis karaktert.");
define("TABLE_NAME","T&aacute;bla neve:");

define("DELETE_FORM_INFO1","Ez az &ucirc;rlap m&aacute;r a(z) '%s' t&aacute;bl&aacute;hoz kapcsol&oacute;dik" );
define("DELETE_FORM_INFO2","Ha t&ouml;rli ezt a t&aacute;bl&aacute;t, akkor valamennyi adat el fog veszni, &eacute;s a t&aacute;bla is t&ouml;rl&eacute;sre fog ker&uuml;lni.");
define("DELETE_FORM_INFO3","T&Ouml;RL&Eacute;S UT&Aacute;N NINCS M&Oacute;D EZEN INFOR&Aacute;CI VISSZA&Aacute;LLÍT&Aacute;S&Aacute;RA");
define("DELETE_TABLE","T&ouml;rli a t&aacute;bl&aacute;t?");
define("FORM_ITEMS_DETAILS","&Ucirc;rlapelemek r&eacute;szletei");
define("NO_SPECIAL_CHARS","Sz&oacute;k&ouml;z, pont vagy speci&aacute;lis karakter n&eacute;lk&uuml;l!");
define("CHECK","Ellen&otilde;rz&eacute;s");
define("HELP_TEXT","S&uacute;g&oacute;sz&ouml;veg");
define("ERROR_MSG","Hiba&uuml;zenet");
define("DISPLAY_TAB","Megjelen&iacute;t&eacute;s");
define("DISPLAY_PROP","Megjelen&iacute;t&eacute;s tulajdons&aacute;gai");
define("SIZE1","1. m&eacute;ret");
define("SIZE2","2. m&eacute;ret");
define('SIZE1_INFO',"Sz&eacute;less&eacute;g, Oszlopok");
define('SIZE2_INFO',"Magass&aacute;g, Sorok, <br/>Max file m&eacute;ret (byte)");
define("REQUIRED","K&ouml;telez&otilde;");
define('REQUIRED_INFO',"A performs nem engedi az &ucirc;rlap elk&uuml;ld&eacute;s&eacute;t, ha ez a mez&otilde; nincs kit&ouml;ltve");
define("DISABLED","Letiltott");
define("READONLY","Ír&aacute;sv&eacute;dett");
define("MULTIPLE","T&ouml;bb p&eacute;ld&aacute;ny");
define('MULTIPLE_INFO',"\&apos;V&aacute;laszt&oacute;\&apos; elemekhez haszn&aacute;latos.");
define("VALUES_TAB","&Eacute;rt&eacute;k");
define("VALUES_INFO","&Eacute;rt&eacute;kek tulajdons&aacute;gai");
define("MISSING_FIELD_TEXT","Hi&aacute;nyz&oacute; mez&otilde; sz&ouml;vege:");

// Errors
define("ITEMS_CANT_EDITED","Nem m&oacute;dos&iacute;thatja ennek az &ucirc;rlapnak az elemeit!");
define("FORM_CURRENTLY_EDITED","A(z) %s &ucirc;rlapot &eacute;pp egy m&aacute;sik adminisztr&aacute;tor szerkeszti.");
//define("NO_FORM_FORUND","Nem tal&aacute;lhat&oacute; &ucirc;rlap!");
define("NO_FORM_FOUND","Nem tal&aacute;lhat&oacute; &ucirc;rlap!");
define("SELECT_A_RECORD_TO","V&aacute;lassza ki a rekordot a k&ouml;vetkez&otilde; m&ucirc;velethez: %s");
define("ALREADY_TABLE_EXISTS","A t&aacute;bla \'%s\' m&aacute;r l&eacute;tezik. K&eacute;rj&uuml;k, hogy m&aacute;sik nevet adjon neki.");
define("ERROR_OCCURRED","Hiba t&ouml;rt&eacute;nt!");
define("DB_ERROR_OCCURRED","Hiba t&ouml;rt&eacute;nt az adatb&aacute;zisba &iacute;r&aacute;skor!");

define("TITLE_EMPTY","&Uuml;res a c&iacute;m!");
//define("TANLE_NAME_EMPTY","Meg kell adnia a t&aacute;bla nev&eacute;t.");
define("TABLE_NAME_EMPTY","Meg kell adnia a t&aacute;bla nev&eacute;t.");
define("DELETE_DATA_CONFIRM","Val&oacute;ban t&ouml;r&ouml;lni akarja AZ &Ouml;SSZES ADATOT?");
define("CAPTION_EMPTY","A c&iacute;m &uuml;res.");
define("NAME_EMPTY","A n&eacute;v &uuml;res");
define("LIST_VALUES","Lista&eacute;rt&eacute;kek");
define("SELECTED_VALUE","Kijel&ouml;lt &eacute;rt&eacute;k");
define('SELECTED_VALUE_INFO',"A v&aacute;laszt&oacute; elem kezdeti &eacute;rt&eacute;ke.");

define('PF_ERROR_18', "Session not persistent.");
define('PF_ERROR_18_COMMENT', 
       "<br /><ul><li>Can be solved by pressing the browser's back button and "
       ."trying again. <cite>The session may need to be restarted.</cite><br /></li>"
       .'<ul><li>Also occurs when joomla global config setting "Live Site" '
       .'protocol does not match current protocol (http / https)<br>'
       .'See <a href="http://forge.joomla.org/sf/go/post17630">'
       .'http://forge.joomla.org/sf/go/post17630</a></li>'
       .'<br><li>Also an intermittent fault when a user logs out of a joomla '
       .'session, and tries to show a printer-friendly form by clicking the '
       .'link displayed at the head of the form (in "joomla mode") - sometimes '
       .'sessions are not initialised immediately... the workaround is to close'
       .' the printer-friendly window, and click the menu item again (to bring '
                                                                      .'up the form), then click its '
       .'printer-friendly button, and the popup should work.</li></ul>'
       );       
define('PF_ERROR_22', "A form id nem sz&aacute;m.");
define('PF_ERROR_22_COMMENT',
       '&Aacute;ltal&aacute;ban hib&aacute;s url okozza. '
       .'L&aacute;sd <a href="http://forge.joomla.org/sf/go/post17395">'
       .'http://forge.joomla.org/sf/go/post17395</a>');

define('PF_ERROR_23', "Nincs &ucirc;rlap.");
define('PF_ERROR_23_COMMENTA', "A k&ouml;vetkez&otilde; sz&aacute;m&uacute; &ucirc;rlap");
define("PF_ERROR_23_COMMENTB",
       @"nem tal&aacute;lhat&oacute;.<ul>
<li>Lehet, hogy nem enged&eacute;lyezett ennek az er&otilde;forr&aacute;snak az el&eacute;r&eacute;s&eacute;re.
<li>Az &ucirc;rlap lehet, hogy lej&aacute;rt, nincs publik&aacute;lva vagy el lett t&aacute;vol&iacute;tva</ul>");
define('FOR_MORE_HELP', 'A performs haszn&aacute;lat&aacute;hoz tov&aacute;bbi seg&iacute;ts&eacute;get '
       .'a PerForms honlapj&aacute;n tal&aacute;l <a href="http://www.performs.org.au/"> '
       .'performs.org.au</a>');

define("PF_ERROR_127", "&Eacute;rv&eacute;nytelen param&eacute;ter lista.");
define("PF_ERROR_127_COMMENT",
       '&Aacute;ltal&aacute;ban a komponens men&uuml; url-j&eacute;b&otilde;l hi&aacute;nyoznak param&eacute;terek. '
       .'<ul><li>Ne felejtse el hozz&aacute;adni a <strong>formid=1</strong> az url '
       .'v&eacute;g&eacute;re (vagy a megjelen&iacute;teni k&iacute;v&aacute;nt &ucirc;rlap id-j&eacute;t behelyettes&iacute;tve).'
       .'</li></ul>');



// MENU

define("DATABASE","Adatb&aacute;zis");
define("BOUNDDATA","Adatok");
define("EXPORTTOEXCEL","Export&aacute;l&aacute;s");
define("PREVIEW","El&otilde;n&eacute;zet");
define("CLOSE","Bez&aacute;r&aacute;s");
define("CANCEL","M&eacute;gse");
define("DELETE","T&ouml;rl&eacute;s");
define("COPY_RECORD","M&aacute;sol&aacute;s");
define("NEW_ITEM","&Uacute;j elem");
define("DELETE_ITEM_CONFIRM","T&ouml;rli az elemet?");
define("SAVE","Ment&eacute;s");

define('PRINTER_FRIENDLY', "Nyomtat&oacute;bar&aacute;t v&aacute;ltozat");
define('DOWNLOAD_PDF', "Let&ouml;lt&eacute;s PDF-ben");
define('ACCESSKEY', "Gyorsbillenty&ucirc;" );

define('PLEASE_FILL_OUT', 'K&eacute;rem t&ouml;ltse ki!');
define('BINDING', 'Binding');
define('EDIT_ITEMS', 'Elem(ek) szerkeszt&eacute;se');
define('UPGRADE_NEWS', 'H&iacute;rek a frisst&eacute;sr&otilde;l');
define('IS_AVAILABLE', 'el&eacute;rhet&otilde;k');
define('DOWNLOAD_FROM', 'Let&ouml;lthet&otilde; innen');

define('SEP_COMMA', 'vessz&otilde;');
define('SEP_COMMASPACE', 'vessz&otilde;+sz&oacute;k&ouml;z');
define('SEP_HYPHEN', 'elv&aacute;laszt&oacute;jel');
define('SEP_NEWLINE', '&uacute;jsor');
define('SEP_SPACE', 'sz&oacute;k&ouml;z');

define('TY_EMAIL', 'email c&iacute;m');
define('TY_FLOAT', 't&ouml;rtsz&aacute;m');
define('TY_INTEGER', 'eg&eacute;ssz&aacute;m');
define('TY_NAME', 'n&eacute;v');
define('TY_STRING', 'karaktersorozat');
define('TY_URL', 'url');

define('ITEMTYPE_BUTTON', 'gomb');
define('ITEMTYPE_CHECKBOX', 'jel&ouml;l&otilde;n&eacute;gyzet');
define('ITEMTYPE_DATE', 'd&aacute;tum');
define('ITEMTYPE_FILE', 'f&aacute;jl');
define('ITEMTYPE_HIDDEN', 'rejtett');
define('ITEMTYPE_IMAGE', 'k&eacute;p');
define('ITEMTYPE_PASSWORD', 'jelsz&oacute;');
define('ITEMTYPE_PAGEBREAK', 'oldalt&ouml;r&eacute;s');
define('ITEMTYPE_RADIO', 'radio');
define('ITEMTYPE_SELECT', 'leg&ouml;rd&uuml;l&otilde;-v&aacute;laszt&oacute;');
define('ITEMTYPE_TEXT', 'sz&ouml;vegbevitel');
define('ITEMTYPE_TEXTAREA', 'sz&ouml;vegdoboz');
define('ITEMTYPE_TEXTUAL', 'textual');

define('VALUE_UP', "Fel");
define('VALUE_UP_INFO', "A kijel&ouml;lt elemet f&ouml;lfel&eacute; mozgatja a list&aacute;ban.");
define('VALUE_DOWN', "Le");
define('VALUE_DOWN_INFO', "A kijel&ouml;lt elemet lefel&eacute; mozgatja a list&aacute;ban.");
define('SET_AS_SELECTED_INFO', "Ez az elem az &ucirc;rlap bet&ouml;lt&eacute;sekor ki lesz v&aacute;lasztva.");
define('REMOVE_INFO', "Elt&aacute;vol&iacute;tja a kiv&aacute;lasztott opci&oacute;t a list&aacute;b&oacute;l.");

define('DISABLED_INFO', "Ha igen, akkor ez az elem nem fog l&aacute;tszani.");
define('READONLY_INFO', "Ha igen, akkor ez az elem nem t&ouml;lthet&otilde; ki.");
define('VALUE_INFO',"Írja be az &eacute;rt&eacute;ket ebbe a mez&otilde;be &eacute;s nyomja meg a ".INSERT." gombot a list&aacute;hoz val&oacute; hozz&aacute;ad&aacute;shoz. <strong>".ITEMTYPE_FILE."</strong> elemekhez, adja meg az alap&eacute;rtelmezett felt&ouml;lt&eacute;si &uacute;tvonalat.");

define('SUBMIT_LABEL_INFO', "Az &ucirc;rlap elk&uuml;ld&otilde; \&apos;<b>submit</b>\&apos; gomb sz&ouml;vege.");
define('INCLUDE_RESET_INFO', "Ha igen, akkor egy \&apos;<b>reset</b>\&apos; t&ouml;rl&otilde; gomb is megjelenik az &ucirc;rlapon.");
define('RESET_LABEL_INFO', "A t&ouml;rl&otilde; \&apos<b>reset</b>\&apos; gomb sz&ouml;vege.");
define('PUBLISHED_INFO', "Ha igen, akkor az &ucirc;rlap l&aacute;that&oacute; lesz.");
define('ACCESS_INFO', "Adja meg az &ucirc;rlap hozz&aacute;f&eacute;r&eacute;si szintj&eacute;t.");
define('START_PUBLISHING_INFO', "Ett&otilde;l a d&aacute;tumt&oacute;l lesz el&eacute;rhet&otilde; az &ucirc;rlap.");
define('FINISH_PUBLISHING_INFO', "Eddig az id&otilde;pontig marad el&eacute;rhet&otilde; az &ucirc;rlap. Ha a d&aacute;tum 0000-00-00 00:00:00 akkor mindig el&eacute;rhet&otilde; marad.");

define('CAPTION_INFO', "Ez a sz&ouml;veg lesz a mez&otilde; felirata.");
define('ACCESSKEY_INFO', "A gyorsbillenty&ucirc;, ami ehhez az elemhez van rendelve. P&eacute;ld&aacute;ul a \&apos;<b>k</b>\&apos; gyorsbillenty&ucirc; a crtl-shift-k val lesz el&eacute;rhet&otilde; firefox ban, &eacute;s alt-shift-k val internet explorerben.");
define('NAME_INFO', "Az &ucirc;rlap bels&otilde; neve. Csak alafnumerikus karaktereket tartalmazhat &eacute;kezet n&eacute;lk&uuml;l. Ha az elem neve <b>bcc, cc, mailfrom, mailto, replyto </b>vagy<b> replytoName</b> az &eacute;rt&eacute;k az email k&uuml;ld&eacute;sn&eacute;l ker&uuml;l felhaszn&aacute;l&aacute;sra .");
define('TYPE_INFO', "V&aacute;lassza ki az elem t&iacute;pus&aacute;t. K&uuml;l&ouml;nb&ouml;z&otilde; t&iacute;pusokhoz m&aacute;s be&aacute;ll&iacute;t&aacute;sok tartoznak.<br /><ul><li>A <b>".ucfirst(ITEMTYPE_TEXTAREA)."</b> ".SIZE1."-(e)t &eacute;s ".SIZE2.@"-(e)t haszn&aacute;l a magass&aacute;g &eacute;s sz&eacute;less&eacute;g be&aacute;ll&iacute;t&aacute;s&aacute;hoz.<br /></li><li>A <b>".ITEMTYPE_SELECT.", ".ITEMTYPE_RADIO." </b>&eacute;s a<b> ".ITEMTYPE_CHECKBOX."</b> t&iacute;pusoknak legal&aacute;bb egy lehet&otilde;s&eacute;get kell tartalmazniuk.<br /></li><li>A <strong>".ucfirst(ITEMTYPE_FILE)."</strong> elemn&eacute;l a <strong>".SIZE1."</strong> a f&aacute;jln&eacute;v ablak sz&eacute;less&eacute;g&eacute;t &aacute;ll&iacute;tja be , a <strong>".SIZE2."</strong> adja meg a maxim&aacute;lis f&aacute;jlm&eacute;retet <strong>".VALUE."</strong> &eacute;s azt az &uacute;tvonalat , ahov&aacute; a f&aacute;jlok felt&ouml;lt&eacute;sre ker&uuml;lnek.</li></ul>");
define('CHECK_INFO', "V&aacute;lassza ki az elemhez sz&uuml;ks&eacute;ges ellen&otilde;rz&otilde; elj&aacute;r&aacute;st. &Uuml;res ellen&otilde;rz&otilde; b&aacute;rmilyen &eacute;rt&eacute;k megad&aacute;s&aacute;t lehet&otilde;v&eacute; teszi.");
define('HELP_TEXT_INFO', "A s&uacute;g&oacute; sz&ouml;veg ezzel az elemmel fog megjelenni.");
define('ERROR_MSG_INFO', "A hiba&uuml;zenet, ha gond van az elem kit&ouml;lt&eacute;s&eacute;vel.");

define('REVERSE_ORDER', "Ford&iacute;tott sorrend");
define('SAVE_ORDER', "Sorrend ment&eacute;se");
define('SWAP_SIZE_VARS', "Megcser&eacute;li a M&eacute;ret1 &eacute;s M&eacute;ret2 &eacute;rt&eacute;ket az &ouml;sszes sz&ouml;vegbeviteli mez&otilde;n&eacute;l.");
define('NEW_SIZEVARS_SAVED', '&Uacute;j m&eacute;retbe&aacute;ll&iacute;t&aacute;sok elmentve.');
define('NEW_ORDERING_SAVED', '&Uacute;j sorrend elmentve');

define('PF_LICENCE_INFO', 'A perForms szabad szoftver <a href="http://www.gnu.org/copyleft/gpl.html">GNU General Public License</a> licensszel.');
define('INSTALLATION_MESSAGES', 'Telep&iacute;t&eacute;si &uuml;zenetek');
define('THANKS_FOR_CHOOSING', 'K&ouml;sz&ouml;nj&uuml;k, hogy a PerForms-t v&aacute;lasztotta!');
define('WE_NEED_TRANSLATORS', @"
<p>
Ford&iacute;t&oacute;kat keres&uuml;nk a PerForms-hoz! 
<a href=\"http://forge.joomla.org/sf/go/projects.performs/discussion.language_file_translations\">Help make PerForms global!</a>
</p>");
define('FOR_SUPPORT', @"
<p><b>T&aacute;mogat&aacute;s&eacute;rt k&eacute;rj&uuml;k l&aacute;togassa meg a hivatalos t&aacute;mogat&oacute; oldalt<a href=\"http://www.performs.org.au/\">http://www.performs.org.au/</a>.</b></p>
");
define('PERFORMS_FEATURES', @"
<p>Funkci&oacute;k:</p>
<ul>
<li>V&eacute;gtelen beviteli mez&otilde;</li>
<li>9 k&uuml;l&ouml;nb&ouml;z&otilde; be&eacute;p&iacute;tett mez&otilde; t&iacute;pus</li>
<li>F&aacute;jl felt&ouml;lt&eacute;s az &ucirc;rlappal egy&uuml;tt!</li>
<li>E-mail k&uuml;ld&eacute;s</li>
<li>Az &ucirc;rlap kit&ouml;lt&otilde;je megadhatja az email k&uuml;ld&otilde;j&eacute;t, a v&aacute;laszc&iacute;met &eacute;s a t&aacute;rgyat</li>
<li>Az &ucirc;rlapokhoz k&uuml;l&ouml;n-k&uuml;l&ouml;n adatb&aacute;zis t&aacute;bl&aacute;k rendelhet&otilde;k</li>
<li>Beviteli-mez&otilde; ellen&otilde;rz&eacute;s</li>
<li>V&aacute;ltoztahta&oacute; hiba&uuml;zenetek</li>
<li>Minden mez&otilde;h&ouml;z k&uuml;l&ouml;n s&uacute;g&oacute;-sz&ouml;veg adhat&oacute; meg</li>
<li>Az adatb&aacute;zis t&aacute;bl&aacute;k megtekinthet&otilde;k</li>
<li>Egyszer&ucirc; template rendszer</li>
<li>Az admin fel&uuml;leten megtekinthet&otilde;k &eacute;s export&aacute;lhat&oacute;k at elk&uuml;ld&ouml;tt &ucirc;rlapok</li>
<li>Nyomtat&oacute;-bar&aacute;t v&aacute;ltozat</li>
<li>Az &ucirc;rlap let&ouml;lt&eacute;se PDF-ben</li>
<li>Joomla 1.5 -el kompatibilis</li>
</ul>
");
define('WELCOME_TO_PERFORMS', @"
<p>
A PerForms-al k&ouml;nnyed&eacute;n k&eacute;sz&iacute;thet tetsz&otilde;leges &ucirc;rlapokat, amiket emailben elk&uuml;ldhet vagy adatb&aacute;zisban t&aacute;rolhat. Az adatok megtekinthet&otilde;k az admin fel&uuml;leten, illetve CSV-be export&aacute;lhat&oacute;k.
</p>
".FOR_SUPPORT.PERFORMS_FEATURES.WE_NEED_TRANSLATORS);
define('NEW_FEATURES', @"
<strong>j funkci&oacute;k: </strong>
<ul>
<li>Gyorsbilenty&ucirc; haszn&aacute;lat</li>
<li>Admin info ikonok</li>
<li>File felt&ouml;lt&eacute;si lehet&otilde;s&eacute;g</li>
<li>Felhaszn&aacute;l&oacute;bar&aacute;t hiba&uuml;zenetek</li>
<li>Version ellen&otilde;rz&eacute;s</li>
</ul>
");
define('UPGRADE_MESSAGE', @"
<p>A PerForms megv&aacute;ltozott! 
<ol><li><p><img src=\"images/reload_f2.png\" height=\"16\" width=\"16\" border=\"0\" /> <strong>".REVERSE_ORDER.@"</strong> gomb.</p>Az elemek sorrendj&eacute;nek megford&iacute;t&aacute;s&aacute;hoz egyszer&ucirc;en nyomja meg a '<strong>"
       .REVERSE_ORDER."</strong>' gombot a ".ORDER.@" oszlop tetej&eacute;n az elem n&eacute;zetben.</li>
<li style=\"margin-top: 4pt;\"><p>
<img src=\"images/restore_f2.png\" border=\"0\" width=\"16\" height=\"16\" />
<strong>".SWAP_SIZE_VARS.@"</strong> gomb.</p>
Megv&aacute;ltoztattuk a sz&ouml;vegdoboz m&eacute;ret kezel&eacute;s&eacute;t, ennek a jav&iacute;t&aacute;s&aacute;hoz,
kattintson a '<strong>".SWAP_SIZE_VARS."</strong>' gombra a ".SIZE1." &eacute;s a ".SIZE2.@" oszlopok tetej&eacute;n.</li></ol></p>
".WE_NEED_TRANSLATORS.NEW_FEATURES.FOR_SUPPORT);


define('SUCCESSFUL_UPGRADE', "A PerForms sikeresen friss&iacute;tve ");
define('INS_WELCOME', "&Uuml;dv&ouml;z&ouml;lj&uuml;k!");
define('INS_SQL_STATEMENTS', "SQL kifejez&eacute;sek");
define('INS_SQL_ERRORS', "SQL Hib&aacute;k");

define('UPLOAD_ERROR_1', "A felt&ouml;ltend&otilde; f&aacute;jl nagyobb, mint az upload_max_filesize php.ini direkt&iacute;va.");
define('UPLOAD_ERROR_1_INFO', "A f&aacute;jl nagyobb, mint a PHP-ban enged&eacute;lyezett m&eacute;ret.<ul><li> K&eacute;rje a webmestert/rendszergazd&aacute;t, hogy n&ouml;velje az upload_max_filesize &eacute;rt&eacute;k&eacute;t.</li></ul>");
define('UPLOAD_ERROR_2', "A felt&ouml;ltend&otilde; f&aacute;jl nagyobb, mint az &ucirc;rlap be&aacute;ll&iacute;t&aacute;s&aacute;nl megadott MAX_FILE_SIZE &eacute;rt&eacute;k.");
define('UPLOAD_ERROR_2_INFO', "Ez a f&aacute;jl nagyobb, mint az adminisztr&aacute;tor &aacute;ltal enged&eacute;lyezett maxim&aacute;lis f&aacute;jl m&eacute;ret.");
define('UPLOAD_ERROR_3', "A f&aacute;jlt csak r&eacute;szben siker&uuml;lt felt&ouml;lteni.");
define('UPLOAD_ERROR_3_INFO', "Egy szerver oldali csatlakoz&aacute;si hiba miatt a f&aacute;jlt csak r&eacute;szben siker&uuml;lt felt&ouml;lteni. K&eacute;rem pr&oacute;b&aacute;lja &uacute;jra!");
define('UPLOAD_ERROR_4', "Nem t&ouml;lt&otilde;d&ouml;tt fel f&aacute;jl.");
define('UPLOAD_ERROR_4_INFO', "Ismeretlen hiba miatt a felt&ouml;lt&eacute;s sikertelen.");
define('UPLOAD_ERROR_5', "Ismeretlen hiba!!");
define('UPLOAD_ERROR_5_INFO', "A PHP nem szokv&aacute;nyos hibak&oacute;ddal v&aacute;laszolt!");
define('UPLOAD_ERROR_6', "&Aacute;tmeneti k&ouml;nyvt&aacute;r hi&aacute;nyzik. A PHP 4.3.10 &eacute;s PHP 5.0.3 ben ker&uuml;lt bevezet&eacute;sre.");
define('UPLOAD_ERROR_6_INFO', "Nincs temp k&ouml;nyvt&aacute;r be&aacute;ll&iacute;tva a php-ban.");
define('UPLOAD_ERROR_7', "Nem siker&uuml;lt a f&aacute;jlt a lemezre &iacute;rni. A PHP 5.1.0. ban ker&uuml;lt bevezet&eacute;sre");
define('UPLOAD_ERROR_7_INFO', "A t&aacute;rhely betelt, vagy az &aacute;tmeneti k&ouml;nyvt&aacute;r &iacute;r&aacute;sv&eacute;dett.");

define('SUCCESS', "Siker!");
define('UPLOAD_SUCCESSFUL', "A f&aacute;jl felt&ouml;lt&eacute;se sikeresen befejez&otilde;d&ouml;tt.\n");
define('UPLOAD_SUCCESSFUL_INFO', "A f&aacute;jl felt&ouml;lt&otilde;d&ouml;tt &eacute;s egy &aacute;tmeneti k&ouml;onyvt&aacute;rban az adminisztr&aacute;torra v&aacute;r.");
define('ERROR_71', "Lehets&eacute;ges f&aacute;jl felt&ouml;lt&eacute;si t&aacute;mad&aacute;s!\n");
define('ERROR_71_INFO', "A f&aacute;jl neve vagy &uacute;tvonala nem &eacute;rv&eacute;nyes!");

define('UNKNOWN_SENDER', "Ismeretlen felad&oacute;");

define('IMAGEFLOAT', "K&eacute;p elhelyez&eacute;s");
define('IMAGEFLOAT_INFO', "A k&eacute;p css float style-j&aacute;t all&iacute;tja be (css float: [left, right, none, inherit];)");
define('FLOAT_LEFT', 'Bal');
define('FLOAT_RIGHT', 'Jobb');
define('FLOAT_NONE', 'Nem be&aacute;ll&iacute;tott');
define('FLOAT_INHERIT', '&Ouml;r&ouml;kl&ouml;tt');

define('NOT_BOUND', "Nincs k&uuml;l&ouml;n adatb&aacute;zis!");
define('CLICK_BINDING_BUTTON', "Kattintson a <b>Binding</b> gombra hogy egy &uacute;j adatb&aacute;zis t&aacute;bl&aacute;t rendeljen az &ucirc;rlaphoz.");

define('SHOW_UPLOADED_IMAGE', "Mutasson a felt&ouml;lt&ouml;tt f&aacute;jl hely&eacute;n k&eacute;pet");
define('SHOW_UPLOADED_IMAGE_INFO', "A felt&ouml;lt&ouml;tt f&aacute;jlok link-k&eacute;nt vagy k&eacute;pk&eacute;nt jelenjenek meg az emailben.");

define('SUBMIT', "Elk&uuml;ld");
define('REPLACE_SUBMIT_BUTTON', "Az elk&uuml;ld gomb helyettes&iacute;t&eacute;se");
define('REPLACE_SUBMIT_BUTTON_INFO', "Az alap&eacute;rtelmezett k&uuml;ld&eacute;s gomb helyettes&iacute;t&eacute;se egy tetsz&otilde;leges k&eacute;ppel.");
define('SUBMIT_IMAGE_URL', "A k&eacute;p &uacute;tvonala");
define('SUBMIT_IMAGE_URL_INFO', "A k&uuml;ld&eacute;s gomb k&eacute;p&eacute;hez vezet&otilde; &uacute;tvonal.");
define('SUBMIT_IMAGE_WIDTH', "K&uuml;ld&eacute;s gomb-k&eacute;p sz&eacute;less&eacute;g");
define('SUBMIT_IMAGE_WIDTH_INFO', "A k&uuml;ld&eacute;s gomb k&eacute;p&eacute;nek sz&eacute;less&eacute;ge.");
define('SUBMIT_IMAGE_HEIGHT', "K&uuml;ld&eacute;s gomb-k&eacute;p magass&aacute;g");
define('SUBMIT_IMAGE_HEIGHT_INFO', "A k&uuml;ld&eacute;s gomb k&eacute;p&eacute;nek magass&aacute;ga.");

define('NOT_AUTHORIZED', "You are not authorized to see this resource.");
define("NO_AUTH_MESSAGE", "Unauthorized Message");
define("NO_AUTH_MESSAGE_INFO", "The message presented by the form when an unauthorized user attempts to view it.");

define('RESET', "T&ouml;rl&eacute;s");
define('REPLACE_RESET_BUTTON', "T&ouml;rl&eacute;s gomb helyettes&iacute;t&eacute;se");
define('REPLACE_RESET_BUTTON_INFO', "Az alap&eacute;rtelmezett t&ouml;rl&eacute;s gomb helyettes&iacute;t&eacute;se egy tetsz&otilde;leges k&eacute;ppel.");
define('RESET_IMAGE_URL', "A k&eacute;p &uacute;tvonala");
define('RESET_IMAGE_URL_INFO', "A t&ouml;rl&eacute;s gomb k&eacute;p&eacute;hez vezet&otilde; &uacute;tvonal.");
define('RESET_IMAGE_WIDTH', "T&ouml;rl&eacute;s gomb-k&eacute;p sz&eacute;less&eacute;g");
define('RESET_IMAGE_WIDTH_INFO', "A t&ouml;rl&eacute;s gomb k&eacute;p&eacute;nek sz&eacute;less&eacute;ge.");
define('RESET_IMAGE_HEIGHT', "T&ouml;rl&eacute;s gomb-k&eacute;p magass&aacute;g");
define('RESET_IMAGE_HEIGHT_INFO', "A t&ouml;rl&eacute;s gomb k&eacute;p&eacute;nek magass&aacute;ga.");

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


//define("Delete","T&ouml;rl&eacute;s");
/*
PFAUTO_ fields can be embedded into any text part of a form or form item
Where there can be text, an expression enclosed in braces, ilke {username}
will return the "Auto" field for PFAUTO_USERNAME
*/
define('PFAUTO_USERNAME', "felhaszn&aacute;l&oacute;n&eacute;v");
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