<?php
/**
* @version $id: german.php,v 2.3
 * @package performs
 * @copyright (C) 2007 perForms
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @author JUW translations-performs@forge.joomla.org
 * Joomla is Free Software
 *
 * If you are translating, be sure to download the very latest
 * english.php, available from http://www.performs.org.au/performs/nightly/english.php.txt
 *
 * Deutsche Uebersetzung:  canislupus - ju.wolf@ib-canislupus.com
 */

defined( '_VALID_MOS' ) or die( 'Ein Direktzugriff ist an dieser Stelle nicht erlaubt.' );
if (defined("WELCOME_TO_PERFORMS")) return;

define("FORM", "Formular");

define("SUBMIT_LABEL","Senden");
define("PUBLISH","ver&ouml;ffentlichen");
define("UNPUBLISH","nicht ver&ouml;ffentlichen");
define("NAME","Name");
define("NAME","Elementname");
define("LINK","Verweis");
define("ITEMS","Elemente");
define("DB_TABLE_NAME","DB Tabellen Name");
define("DB_RECORDS","DB Datens&auml;tze");
define("PUBLISHED","ver&ouml;ffentlicht");
define("UNPUBLISHED","unver&ouml;ffentlicht");
define("SECURITYIMAGESHELP","Hilfetext f&uuml;r Sicherheitsbild");
define("SECURITYIMAGESERROR","Fehlermeldung f&uuml;r Sicherheitsbild");

define("FORM_PREVIEW","Formular Vorschau");
define("DATE_TIME","Datum");
define("NO_RECORDS_FOUND","Keine Datens&auml;tze gefunden!");
define("FIELD_NAMES","Feldnamen");
define("SELECT_FIELDS","W&auml;hlen Sie die Feldnamen, die Sie in Ihren Bericht einbeziehen wollen...");
define("ALL","Alle");
define("INCLUDED_FIELDS","Einbezogene Feldnamen");
define("UP","Auf");
define("DOWN","Ab");
define("_PRINT","Drucken");

define("USE_SECURITYIMAGES","Sicherheitsbilder benutzen");
define("NO_SI_INSTALLED","com_securityimages ist nicht installiert");
define("NO_SI_INSTALLED_INFO",'<ul><li>Sie bekommen die Komponente von <a href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,1211/Itemid,35/">Joomla! Extensions</a></li><li>PerForms wird auch ohne diese Komponente gut arbeiten.</li></ul>');
define("EDIT_FORM","Formular bearbeiten");
define("ADD_EDIT_REMOVE","Hinzuf&uuml;gen, Bearbeiten oder Entfernen von Formularelementen");
define("CAPTION","Beschriftung");
define("USE_CAPTION","Beschriftung benutzen");
define("FIELD_SEPARATOR", "Feldtrennzeichen");
define("USE_CAPTION_INFO","Wenn Sie das Formular als E-Mail ausgeben, werden die Feldnamen neben den Werten angezeigt.");
define("FIELD_SEPARATOR_INFO", "Wenn Sie das Formular als E-Mail oder Text ausgeben, wird dieses Zeichen zwischen den Auswahlm&ouml;glichkeiten angezeigt.");
define('FORMAT_TAB',"Format");
define('FORMAT_INFO', "Berichts- und E-Mailformat");
define("TYPE","Elementtyp");
define("ORDER","sortieren");
define("REORDER","neu sortieren");
define("INSERT", "Einf&uuml;gen");
define("REMOVE", "Entfernen");
define("SET_AS_SELECTED", "als Vorauswahl");
define("VALUE","Wert");
define("EDIT_ITEM","Element bearbeiten");
define("EDIT","bearbeiten");
define("_NEW","neu");
define("FORM_DETAILS","Formular Details");
define("TITLE","Titel:");
define("INTRO_TEXT","Einf&uuml;hrungstext:");
define("AFTER_SUBMIT","Nach der &Uuml;bertragung:");
define("REDIRECT_TO_URL","Umleiten zur URL");
define("SHOW_TNX_TEXT","Zeigt den Danke-Text");
define("REDIRECT_URL","Umleitungs Url:");
define("TNX_TEXT","Danke-Text:");
define("PUBLISHING_TAB","Ver&ouml;ffentlichung");
define("PUBLISHING_INFO","Ver&ouml;ffentlichungsinfo");
define("ACCESS","Zugriffsrechte");
define("START_PUBLISHING","Start der Ver&ouml;ffentlichung");
define("FINISH_PUBLISHING","Ende der Ver&ouml;ffentlichung");
define("IMAGES_TAB","Bilder");
define("IMAGE_INFO","Bild Info");
define("IMAGE_INFO_INFO","Um hier ein eigenes Bild zu verwenden laden Sie dieses in den Ordner  ".$mosConfig_live_site."/images/stories");
define("IMAGE","Bild");
define("THEMES_TAB","Vorlagen");
define("THEME_INFO","Vorlagen Info");
define("THEME","Vorlage");
define("BUTTONS_TAB","Schaltfl&auml;chen");
define("FORM_BUTTONS","Formularschaltfl&auml;chen");
define("SUBMIT_LABEL_TITLE","Beschriftung f&uuml;r 'Senden'");
define("INCLUDE_RESET","Schaltfl&auml;che 'Zur&uuml;cksetzen' verwenden");
define("INCLUDE_PF","Schaltfl&auml;che 'Druckvorschau' verwenden");
define("INCLUDE_PDF","Schaltfl&auml;che 'PDF' verwenden");
define("INCLUDE_PF_INFO","PerForms wird eine 'Druckvorschau'-Schaltfl&auml;che in den Formularkopf einbinden, die es erlaubt das Formular in einem separaten Fenster zu sehen.");
define("INCLUDE_PDF_INFO","PerForms wird eine 'PDF'-Schaltfl&auml;che im Formularkopf anzeigen.");
define("NO_PDF_INSTALLED", "Html2PDF ist nicht installiert. PerForms kann leider keine 'PDF'-Schaltfl&auml;che anzeigen.");
define("NO_PDF_INSTALLED_INFO",'<ul><li>Sie k&ouml;nnen dies von <a href="http://sourceforge.net/projects/html2fpdf">SourceForge</a></li><li> herunterladen. PerForms wird auch ohne sehr gut funktionieren.</li></ul>');
define("RESET_LABEL","Beschriftung von 'Zur&uuml;cksetzen' ");
define("EMAILS_TAB","E-Mails");
define("EMAIL_FORM_TITLE","E-Mail Formular");
define("EMAIL_FORM","Formular per E-Mail senden:");
define("EMAIL_FORM_INFO", "Wenn Sie JA w&auml;hlen, wird perForms eine E-Mail absetzen sobald das Formular &uuml;bertragen wird.");
define("EMAIL_ADMIN","Kopie an den Admin senden:");
define("EMAIL_ADMIN_INFO", "Wenn Sie JA w&auml;hlen wird perForms eine Kopie der E-Mail an die Adresse(n) im \&apos;an\&apos; Feld - wenn dieses Feld leer ist und \&apos;Formular per E-Mail senden\&apos; ist \&apos;JA\&apos;, dann wird eine E-Mail an den Seiten-Administrator gesendet.");
define("EMAIL_USER","Sende Kopie an Benutzer:");
define("EMAIL_USER_INFO", "Wenn JA, denn wird perForms eine E-Mail an den formularausf&uuml;llenden Benutzer senden. Dies funktioniert automatisch mit angemeldeten Benutzern. Wenn Sie Elemente mit den Namen <b>\&apos;replyto\&apos;</b> und <b>\&apos;replytoName\&apos;</b> verwenden, dann werden die Werte dieser Elemente benutzt. Sie werden  f&uuml;r angemeldete Nutzer standardm&auml;&szlig;ig versteckt. Besucher der Seite m&uuml;ssen ihre E-Mail Adresse im Formular angeben  <b>\&apos;replyto\&apos;</b> und <b>\&apos;replytoName\&apos;</b> werden f&uuml;r jeden nicht angemeldeten Benutzer angezeigt wenn sie Elemente des Formulars sind.");
define("ENABLE_MAILFROM","Erlaube Adressverschleierung (mail spoofing):");
define("ENABLE_MAILFROM_INFO", "Wenn JA gew&auml;hlt wird, versucht perForms die Nachricht an den Admin unter Verwendung des Wertes aus dem Feld mit dem Namen <b>\&apos;mailfrom\&apos;</b> als Absender abzusetzen, dazu muss <b>\&apos;mailfrom\&apos;</b> im Formular enthalten sein. Nicht alle Mailserver sind gl&uuml;cklich dar&uuml;ber, deshalb ist der Standardwert hier \&apos;NEIN\&apos;.");
define("EMAIL_ALWAYS","Senden, auch wenn Fehler aufgetreten sind:");
define("EMAIL_ALWAYS_INFO", "Wenn ja, wird perForms Fehler ignorieren und in jedem Fall eine E-Mail senden,");
define("FROM","Von: <small>(frei lassen um die Voreinstellung zu verwenden)</small>");
define("FROM_INFO", "Wenn Sie eine vom Benutzer eingegebene <b>Antwort</b> E-Mail Adresse verwenden wollen, lassen Sie den obigen Parameter frei. Statt dessen erg&auml;nzen Sie ihr Formular um ein E-Mail Feld (Register Elemente) und stellen sicher, dass im Feld <b>Absender</b> der <b>Feldname</b> eingetragen ist.");
define("TO","An: <small>(Komma getrennte Liste)</small>");
define("TO_INFO", "Wenn Sie m&ouml;chten dass die <b>Empf&auml;nger</b> E-Mail Adresse beim Ausf&uuml;llen des Formulars durch den Benutzer ausgew&auml;hlt werden kann, (praktisch wenn Sie ein Kontaktformular mit einer Auswahlliste von Empf&auml;ngern anbieten wollen) dann f&uuml;gen Sie Ihre <b>Empf&auml;nger</b> E-Mail Adresse in die obigen Parameter ein (um Sie als Standard Absender zu verwenden). Dann f&uuml;gen Sie in Ihr Formular eine Auswahlliste (Register Elemente) mit ausw&auml;hlbaren E-Mail Adressen f&uuml;r jeden Empf&auml;nger ein und stellen sicher, dass der <b>Feldname</b> als <b>Empf&auml;nger</b> eingetragen ist.");
define("EMAIL_SUBJECT","E-mail Betreff:");
define("EMAIL_SUBJECT_INFO", "Wenn Sie den <b>Betreff</b> der E-Mail individuell (oder vom Benutzer ins Formular eingegeben) anwenden wollen, lassen Sie den obigen <b>Betreff</b> Parameter frei. Anstelle dessen f&uuml;gen Sie ein Betreff-Eingabefeld in Ihr Formular ein (Register Elemente) und pr&uuml;fen danach, dass der <b>Name des Feldes</b> im <b>Betreff</b> eingetragen ist. Alternativ wird, wenn Sie oben einen Betreff eingeben und au&szlig;erdem ein 'Betreff-Eingabefeld' in Ihrem Formular verwenden, der eingegebene Betreff durch den Eintrag des Benutzers erg&auml;nzt.");
define("INTRO_INCLUDE","Einf&uuml;hrungstext einbinden:");
define("INTRO_INCLUDE_INFO", "Bei JA wird der Einf&uuml;hrungstext in die E-Mail eingebunden.");
define("APPEND_TIMESTAMP", "Zeitstempel anh&auml;ngen");
define("APPEND_TIMESTAMP_INFO", "Bei JA wird an den Betreff Datum und Uhrzeit der &Uuml;bermittlung angef&uuml;gt.");
define("TABLE_ALREADY_CREATED","Tabelle ist bereits angelegt...");
define("CREATE_DATABASE_TABLE","Erzeuge Datenbanktabelle...");
define("NOT_BOUND_TO_TABLE","Dieses Formular ist momentan NICHT an eine Datenbanktabelle angebunden.");
define("BOUND_TO_TABLE","Dieses Formular ist momentan an eine Datenbanktabelle angebunden. Name der Tabelle: ");
define("BOUND_INFO1","Wenn Sie eine Datenbanktabelle an ein Formular binden k&ouml;nnen Sie <strong>keine</strong> Formularelemente hinzuf&uuml;gen, bearbeiten oder l&ouml;schen.");
define("BOUND_INFO2","Der Tabellenname <strong>darf keine</strong> Leerzeichen, Umlaute oder Sonderzeichen enthalten.");
define("TABLE_NAME","Tabellenname:");
define("DELETE_FORM_INFO1","Dieses Formular ist bereits verbunden mit '%s' " );
define("DELETE_FORM_INFO2","Wenn Sie die Tabelle l&ouml;schen werden alle enthaltenen Daten und die Tabelle selbst entfernt.");
define("DELETE_FORM_INFO3","ES GIBT KEINE M&Ouml;GLICHKEIT EINMAL GEL&Ouml;SCHTE INFORMATIONEN WIEDERHERZUSTELLEN");
define("DELETE_TABLE","Tabelle l&ouml;schen?");
define("FORM_ITEMS_DETAILS","Formularelemente Details");
define("NO_SPECIAL_CHARS","Keine Leerzeichen, Umlaute, Punkte oder Sonderzeichen!");
define("CHECK","Pr&uuml;fen auf");
define("HELP_TEXT","Hilfetext");
define("ERROR_MSG","Fehlermeldung");
define("DISPLAY_TAB","Anzeige");
define("DISPLAY_PROP","Anzeige Details");
define("SIZE1","Breite in Zeichen");
define("SIZE2","H&ouml;he in Zeilen <br/> bzw. Gr&ouml;&szlig;e in Byte");

define('SIZE1_INFO',"Breite des Feldes in Zeichen");

define("SIZE2_INFO","H&ouml;he des Feldes in Zeilen, <br/>Max. Dateigr&ouml;&szlig;e (in Byte)");
define("REQUIRED","erforderlich");
define("REQUIRED_INFO","PerForms wird nicht erlauben ein Formular zu &uuml;bertragen solange in diesem Feld nichts eingetragen wurde.");
define("DISABLED","gesperrt");
define("READONLY","nur lesen");
define("MULTIPLE","mehrfach");
define("MULTIPLE_INFO","Zur Verwendung mit 'Auswahl'-Elementen.");
define("VALUES_TAB","Werte");
define("VALUES_INFO","Werte Details");
define("MISSING_FIELD_TEXT","Hinweis bei vergessenem Pflichtfeldeintrag:");

// Errors (Fehlermeldungen :o) )
define("ITEMS_CANT_EDITED","Die Elemente in diesem Formular k&ouml;nnen nicht bearbeitet werden!");
define("FORM_CURRENTLY_EDITED","Das Formular %s wird derzeit von einem anderen Administrator bearbeitet.");
define("NO_FORM_FOUND","Kein Formular gefunden.");
define("SELECT_A_RECORD_TO","W&auml;hlen Sie einen Datensatz zum %s");
define("ALREADY_TABLE_EXISTS","Die Tabelle \'%s\' existiert bereits, bitte vergeben Sie einen anderen Namen.");
define("ERROR_OCCURRED","Es ist ein Fehler aufgetreten!");
define("DB_ERROR_OCCURRED","Fehler beim Schreiben in die Datenbank!");
define("TITLE_EMPTY","Der Titel ist leer!");
define("TABLE_NAME_EMPTY","Sie m&uuml;ssen einen Tabellennamen angeben.");
define("DELETE_DATA_CONFIRM","M&ouml;chten sie wirklich ALLE DATEN l&ouml;schen?");
define("CAPTION_EMPTY","Das Beschriftungsfeld ist leer.");
define("NAME_EMPTY","Das Feld Name ist leer.");
define("LIST_VALUES","Werte auflisten");
define("SELECTED_VALUE","Ausgew&auml;hlte Werte");
define("SELECTED_VALUE_INFO","Der urspr&uuml;nglich ausgew&auml;hlte Wert des Elements.");

define("PF_ERROR_18", "Die Arbeitssitzung ist nicht stabil.");
define("PF_ERROR_18_COMMENT",
       '<br /><ul><li>Dies kann durch das Bet&auml;tigen der &quot;Zur&uuml;ck&quot;-Schaltfl&auml;che des Browsers und einen weiteren'
       .'Versuch gel&ouml;st werden. <cite>Die Arbeitssitzung sollte neu gestartet werden.</cite><br /></li>'
       .'<ul><li>Dies tritt auch dann auf wenn die globalen Joomla Konfigurationseinstellungen des &quot;Live Site&quot; '
       .'Protokolls nicht mit dem aktuellen Protokoll &uuml;bereinstimmen (http / https)<br />'
       .'Siehe auch <a href="http://forge.joomla.org/sf/go/post17630">'
       .'http://forge.joomla.org/sf/go/post17630</a></li><br />'
       .'<br /><li>Genauso bei einem Unterbrechngsfehler, wenn sich ein Benutzer aus einer Joomla '
       .'Arbeitssitzung abmeldet, und versucht eine Druckvorschau durch Klicken des '
       .'Verweises im Formularkopf anzuzeigen (im &quot;Joomla Modus&quot;) - werden manchmal '
       .'Arbeitssitzungen nicht sofort initiiert ... Dem kann man abhelfen indem man'
       .'das Druckvorschaufenster schliesst, und das Men&uuml;element erneut anklickt  '
       .'(um das Fomular anzuzeigen) danach erneut die Druckvorschau anklicken '
       .'und das Fenster sollte erscheinen.</li></ul>');

define("PF_ERROR_22", "Diese Formularnummer ist keine Zahl.");
define("PF_ERROR_22_COMMENT",'Gew&ouml;hnlich verursacht durch eine verst&uuml;mmelte Verweis-URL. '
       .'Siehe auch <a href="http://forge.joomla.org/sf/go/post17395">'
       .'http://forge.joomla.org/sf/go/post17395</a>');

define("PF_ERROR_23", "Kein Formular gefunden.");
define("PF_ERROR_23_COMMENTA", "Ein Formular mit der Nummer ");
define("PF_ERROR_23_COMMENTB",
       @"kann nicht gefunden werden.<ul>
<li>Sie haben entweder nicht die Rechte um dieses Formular zu sehen oder
<li>Dieses Formular ist abgelaufen, nicht mehr ver&ouml;ffentlicht bzw. entfernt worden</ul>");

define("FOR_MORE_HELP",'F&uuml;r weitere Hilfe zur Nutzung von PerForms, besuchen Sie '
       .'die PerForms Homepage, auf <a href="http://www.performs.org.au/"> '
       .'performs.org.au </a>');

define("PF_ERROR_127", "Ung&uuml;ltige Parameterliste.");
define("PF_ERROR_127_COMMENT",
       'Normalerweise verursacht durch fehlende Parameter eines "Komponenten" Men&uuml;elements. '
       .'<ul><li>Denken Sie daran <strong>formid=1</strong> in die Liste der Parameter'
       .'einzuf&uuml;gen (oder die entsprechende Nummer des Fomulars, welches Sie aufrufen wollen).'
       .'</li></ul>');
define("PF_ERROR_71", "Das 'Upload'-Verzeichnis konnte nicht erstellt werden!");
define("PF_ERROR_71_INFO", "Das Verzeichnis zur Aufbewahrung dieses Formulars ist ung&uuml;ltig, oder kann nicht erstellt werden. Bitte pr&uuml;fen Sie den 'Upload'-Pfad im Register 'Werte' der Konfiguration.");


// MENU

define("DATABASE","Datenbank");
define("BOUNDDATA","Daten");
define("EXPORTTOEXCEL","Exportieren");
define("PREVIEW","Vorschau");
define("CLOSE","Schliessen");
define("CANCEL","Abbrechen");
define("DELETE","L&ouml;schen");
define("COPY_RECORD","Kopieren");
define("NEW_ITEM","Neues Element");
define("DELETE_ITEM_CONFIRM","Element l&ouml;schen?");
define("SAVE","Speichern");

define("PRINTER_FRIENDLY", "Druckvorschau");
define("DOWNLOAD_PDF", "PDF herunterladen");
define("ACCESSKEY", "Schnellzugriffstaste <br/>(AccessKey)" );

define('PLEASE_FILL_OUT', 'Bitte eintragen!');
define('BINDING', 'verbinde');
define('EDIT_ITEMS', 'Elemente &auml;ndern');
define('UPGRADE_NEWS', 'Bessere Version');
define('IS_AVAILABLE', 'ist verf&uuml;gbar');
define('DOWNLOAD_FROM', 'Herunterladen von');

define('SEP_COMMA', 'Komma');
define('SEP_COMMASPACE', 'Komma+Leerzeichen');
define('SEP_HYPHEN', 'Bindestrich');
define('SEP_NEWLINE', 'neue Zeile');
define('SEP_SPACE', 'Leerzeichen');

define('TY_EMAIL', 'E-Mail');
define('TY_FLOAT', 'Flie&szlig;komma');
define('TY_INTEGER', 'Ganzzahl');
define('TY_NAME', 'Name');
define('TY_STRING', 'Zeichenkette');
define('TY_URL', 'Webadresse (URL)');

define('ITEMTYPE_BUTTON', 'Schaltfl&auml;che');
define('ITEMTYPE_CHECKBOX', 'Kontrollk&auml;stchen');
define('ITEMTYPE_DATE', 'Datum');
define('ITEMTYPE_FILE', 'Datei');
define('ITEMTYPE_HIDDEN', 'verborgen');
define('ITEMTYPE_IMAGE', 'Bild');
define('ITEMTYPE_PASSWORD', 'Passwort');
define('ITEMTYPE_PAGEBREAK', 'Seitenwechsel');
define('ITEMTYPE_RADIO', 'Entscheidung (Radio-Button)');
define('ITEMTYPE_SELECT', 'Auswahl');
define('ITEMTYPE_TEXT', 'Text');
define('ITEMTYPE_TEXTAREA', 'Mengentext');
define('ITEMTYPE_TEXTUAL', 'textuell');

define('VALUE_UP', "Auf");
define('VALUE_UP_INFO', "Bewegt das ausgew&auml;hlte Element in der Liste nach oben.");
define('VALUE_DOWN', "Ab");
define('VALUE_DOWN_INFO', "Bewegt das ausgew&auml;hlte Element in der Liste nach unten.");
define('SET_AS_SELECTED_INFO', "PerForms wird das Formularelement mit diesem vorausgew&auml;hlten Eintrag erzeugen.");
define('REMOVE_INFO', "Entfernt die gew&auml;hlte M&ouml;glichkeit aus der Werteliste.");

define('DISABLED_INFO', "Wird JA gew&auml;hlt, stellt perForms dieses Element nicht dar.");
define('READONLY_INFO', "Wird JA gew&auml;hlt, stellt perForms dieses Element schreibgesch&uuml;tzt dar. Es kann nicht ausgef&uuml;llt werden.");
define('VALUE_INFO',"Tragen Sie in dieses Feld einen Wert ein und klicken Sie auf die ".INSERT." Schaltfl&auml;chee um ihn zur Liste hinzuzuf&uuml;gen. F&uuml;r <strong>".ITEMTYPE_FILE."</strong> Elemente, geben Sie hier den vorgegebenen 'Upload'-Pfad ein.");

define('SUBMIT_LABEL_INFO', "Der Text der auf der \&apos;<b>Senden</b>\&apos; Schaltfl&auml;che angezeigt werden soll.");
define('INCLUDE_RESET_INFO', "Wird JA gew&auml;hlt, bindet perForms eine \&apos;<b>Zur&uuml;cksetzen</b>\&apos; Schaltfl&auml;che in das Formular ein.");
define('RESET_LABEL_INFO', "Der Text der auf der \&apos<b>Zur&uuml;cksetzen</b>\&apos; Schaltfl&auml;che erscheinen soll.");
define('PUBLISHED_INFO', "Wird JA gew&auml;hlt, steht das Formular den Seitenbenutzern zur Verfuuml;gung.");
define('ACCESS_INFO', "Legt die Zugriffsberechtigung f&uuml;r das Formular fest.");
define('START_PUBLISHING_INFO', "Das Datum ab dem das Formular den Benutzern zur Verf&uuml;gung stehen soll.");
define('FINISH_PUBLISHING_INFO', "Das Datum bis zu dem das Formular den Benutzern zur Verf&uuml;gung stehen soll. Wenn das Datum 0000-00-00 00:00:00 eingestellt ist, ist das Formular immer verf&uuml;gbar.");

define('CAPTION_INFO', "Der Text der als Elementbeschriftung verwendet werden soll.");
define('ACCESSKEY_INFO', "Die Taste, die mit dem Element verbunden werden soll, um dieses &uuml;ber eine Tastenkombination durch den Browser ausw&auml;hlbar zu machen. So wird eine festgelegte Schnellzugriffstaste \&apos;<b>k</b>\&apos; im Firefox &uuml;ber \&apos;<b>STRG+Umschalt+k</b>\&apos; um im Internet Explorer &uuml;ber \&apos;<b>Alt+Umschalt+k</b>\&apos; verf&uuml;gbar gemacht.");
define('NAME_INFO', "Der interne Name des Elements. Dieser darf nur alphanumerische Zeichen enthalten. Wenn das Element <b>bcc, cc, mailfrom, mailto, replyto </b>oder<b> replytoName</b> genannt wird, wird der eingetragene Wert automatisch - soll das Formular per E-Mail versendet werden -  in den entsprechenden Feldern einer E-Mail benutzt um diese zu versenden.");
define('TYPE_INFO', "W&auml;hlen Sie einen Elementtyp aus der Liste. Die unterschiedlichen Elementtypen unterst&uuml;tzen verschiedene Voreinstellungen.<br /><ul><li>Das <b>".ucfirst(ITEMTYPE_TEXTAREA)."</b> benutzt ".SIZE1." und ".SIZE2.@" um seine Breite und H&ouml;he festzulegen.<br /></li><li>Die Typen <b>".ITEMTYPE_SELECT.", ".ITEMTYPE_RADIO." </b>und<b> ".ITEMTYPE_CHECKBOX."</b> ben&ouml;tigen mindestens einen Wert in der ".VALUES_TAB."liste.<br /></li><li>Der  <strong>".ucfirst(ITEMTYPE_FILE)."</strong> Typ benutzt <strong>".SIZE1."</strong> f&uuml;r die Breite des Dateinamenfeldes, <strong>".SIZE2."</strong> um die maximale Dateigr&ouml;&szlig;e festzulegen und  <strong>".VALUE."</strong> f&uuml;r den 'Upload'-Pfad (wo die hochgeladenen Dateien gespeichert werden sollen).</li></ul>");
define('CHECK_INFO', "W&auml;hlen Sie ein Pr&uuml;fmuster f&uuml;r dieses Element. Der leere Eintrag erlaubt die Eingabe aller Zeichen.");
define('HELP_TEXT_INFO', "Der Hilfetext, der mit dem Element erscheinen wird.");
define('ERROR_MSG_INFO', "Die Fehlermeldung die angezeigt wird, sobald ein Problem mit dem Element auftritt.");

define('REVERSE_ORDER', "Reihenfolge umkehren");
define('SAVE_ORDER', "Reihenfolge speichern");
define('SWAP_SIZE_VARS', "Breite und Houml;he f&uuml;r alle Flie&szlig;textelemente vertauschen");
define('NEW_SIZEVARS_SAVED', 'Die neuen Gr&ouml;&szlig;enfestlegungen gespeichert.');
define('NEW_ORDERING_SAVED', 'Die neue Reihenfolge wurde gespeichert.');

define('PF_LICENCE_INFO', 'PerForms ist freie Software lizensiert mit der <a href="http://www.gnu.org/copyleft/gpl.html">GNU General Public License</a>.');
define('INSTALLATION_MESSAGES', 'Installations Meldungen');
define('THANKS_FOR_CHOOSING', 'Danke, dass Sie sich f&uuml;r PerForms entschieden haben.');
define('WE_NEED_TRANSLATORS', @"
<p>
PerForms ist derzeit nur in wenigen Sprachen verf&uuml;gbar, darum brauchen wir &Uuml;bersetzer!
<a href=\"http://forge.joomla.org/sf/go/projects.performs/discussion.language_file_translations\">Helfen Sie uns PerForms zu globalisieren!</a>
</p>");
define('FOR_SUPPORT', @"
<p><b>Ben&ouml;tigen Sie Hilfestellung, besuchen Sie bitte die offizielle Hilfeseite auf <a href=\"http://www.performs.org.au/\">http://www.performs.org.au/</a>.</b></p>
");
define('PERFORMS_FEATURES', @"
<p>Eigenschaften von PerForms:</p>
<ul>
<li>unbegrenzete Eingabefelder</li>
<li>Auswahlm&ouml;glichkeit aus 9 Feldtypen</li>
<li>Dateiupload ist m&ouml;glich!</li>
<li>Formular-zu-E-mail Funktion</li>
<li>Benutzerdefinierte Absender-, Antwort- und Betreffangaben</li>
<li>Die M&ouml;glichkeit f&uuml;r jedes Formular eine eigene Datenbanktabelle anzulegen.</li>
<li>Eingabe&uuml;berpr&uuml;fung</li>
<li>zug&auml;ngliche Formulare</li>
<li>Individuelle Fehlermeldungen</li>
<li>Individuelle Hilfemeldungen f&uuml;r jedes Feld</li>
<li>Bericht zur Anzeige der Datenbankeintr&auml;ge</li>
<li>Einfaches Templatesystem</li>
<li>Ansicht- und Exportm&ouml;glichkeit der erfassten Daten.</li>
<li>Druckvorschau aus dem Frontend</li>
<li>Downloadm&ouml;glichkeit als PDF</li>
<li>vorbereitet f&uuml;r Joomla 1.5 </li>
</ul>
");
define('WELCOME_TO_PERFORMS', @"
<p>
PerForms macht es einfach benutzerdefinierte Formulare zu erstellen, die anschlie&szlig;end per Mail versendet oder in der Datenbank gespeichert werden k&ouml;nnen. Die Eintr&auml;ge k&ouml;nnen eingesehen oder als '.csv' heruntergeladen werden.
</p>
".FOR_SUPPORT.PERFORMS_FEATURES.WE_NEED_TRANSLATORS);
define('NEW_FEATURES', @"
<strong>Neue Eigenschaften: </strong>
<ul>
<li>Zug&auml;nglichkeit</li>
<li>Administrator Icons</li>
<li>Verwaltung erfasster Daten</li>
<li>Konfiguration</li>
<li>Dateiupload</li>
<li>Benutzerfreundliche Fehlermeldungen</li>
<li>Versions&uuml;berpr&uuml;fung</li>
</ul>
");
define('UPGRADE_MESSAGE', @"
<p>&Auml;nderungen in PerForms:
<ol><li><p><img src=\"images/reload_f2.png\" height=\"16\" width=\"16\" border=\"0\" /> Die  <strong>".REVERSE_ORDER.@"</strong> Schaltfl&auml;che.</p>Wenn Sie die Elemente in umgekehrter Reihenfolge sehen sollten, klicken Sie bitte einfach auf die '<strong>"
       .REVERSE_ORDER."</strong>' Schaltfl&auml;che im Kopf der ".ORDER.@" Spalte in der Elementansicht.</li>
<li style=\"margin-top: 4pt;\"><p>
<img src=\"images/restore_f2.png\" border=\"0\" width=\"16\" height=\"16\" />
Die <strong>".SWAP_SIZE_VARS.@"</strong> Schaltfl&auml;che.</p>
Wir haben die Art wie Mengentextfelder Breite und H&ouml;he verwenden ge&auml;ndert. Um Ihre Mengentextfelder anzupassen klicken Sie bitte die '<strong>".SWAP_SIZE_VARS."</strong>' Schaltfl&auml;che zwischen der ".SIZE1." und ".SIZE2.@" Spalte an.</li></ol></p>
".WE_NEED_TRANSLATORS.NEW_FEATURES.FOR_SUPPORT);


define('SUCCESSFUL_UPGRADE', "Erfolgreich aktualisiert zu PerForms ");
define('INS_WELCOME', "Willkommen!");
define('INS_SQL_STATEMENTS', "SQL Anweisungen");
define('INS_SQL_ERRORS', "SQL Fehler");


define('UPLOAD_ERROR_1', "Die hochgeladene Datei &uuml;berschreitet die upload_max_filesize Vorgabe in der php.ini.");
define('UPLOAD_ERROR_1_INFO', "Die datei war gr&ouml;&szlig;er als diese in dieser PHP-Installation zul&auml;ssig.<ul><li> Bitten Sie Ihren  php/joomla Administrator um eine Erh&ouml;hung des upload_max_filesize-Wertes.</li></ul>");
define('UPLOAD_ERROR_2', "Die hochgeladene Datei &uuml;berschreitet die MAX_FILE_SIZE Vorgabe des HTML Formulars.");
define('UPLOAD_ERROR_2_INFO', "Der Administrator hat die maximale Dateigr&ouml;&szlig;e f&uuml;r das hochzuladende Dateien auf einen niedrigeren Wert als den Ihrer Datei festgelegt.");
define('UPLOAD_ERROR_3', "Die Datei wurde nur teilweise hochgeladen.");
define('UPLOAD_ERROR_3_INFO', "Ein Verbindungsfehler hat den Upload unterbrochen. Bitte versuchen Sie es noch einmal.");
define('UPLOAD_ERROR_4', "Es wurde keine Datei hochgeladen.");
define('UPLOAD_ERROR_4_INFO', "Eine unbekanntes Ereignis f&uuml;hrte zum Scheitern des Uploads.");
define('UPLOAD_ERROR_5', "Unbekannter Fehler!!.");
define('UPLOAD_ERROR_5_INFO', "Die PHP-Installation hat mit einem nichtstandardisierten Fehlercode geantwortet!");
define('UPLOAD_ERROR_6', "Es fehlt ein tempor&auml;rer Ordner. Eingef&uuml;hrt in PHP 4.3.10 und PHP 5.0.3.");
define('UPLOAD_ERROR_6_INFO', "F&uuml;r diese PHP-Installation wurde ein der php.ini kein tempor&auml;res Verzeichnis festgelegt.");
define('UPLOAD_ERROR_7', "Fehler beim Schreiben auf die Platte. Eingef&uuml;hrt in PHP 5.1.0.");
define('UPLOAD_ERROR_7_INFO', "Der Server scheint keinen Speicherplatzmehr zur Verf&uuml;gung zu haben oder das tempor&auml;re Verzeichnis ist schreibgesch&uuml;tzt.");

define('SUCCESS', "Erfolgreich!");
define('UPLOAD_SUCCESSFUL', "Die Datei wurde erfolgreich hochgeladen.\n");
define('UPLOAD_SUCCESSFUL_INFO', "Die Datei wurde &uuml;berpr&uuml;ft und hochgeladen und wartet nun im angegebenen Verzeichnis auf den Administrator.");
define('ERROR_71', "M&ouml;glicher Datei-Upload Angriff!\n");
define('ERROR_71_INFO', "Der Name der Datei oder des Pfades ist nicht g&uuml;ltig!");

define('UNKNOWN_SENDER', "Unbekannter Absender");

define('IMAGEFLOAT', "Bildumlauf-Stil");
define('IMAGEFLOAT_INFO', "Legt die Art des Textumlaufs um das Bild fest (css float: [left, right, none, inherit];)");
define('FLOAT_LEFT', 'links');
define('FLOAT_RIGHT', 'rechts');
define('FLOAT_NONE', 'kein');
define('FLOAT_INHERIT', 'vererbt');

define('NOT_BOUND', "Ungebunden!");
define('CLICK_BINDING_BUTTON', "Klicken Sie auf die <b>Binding</b> Schaltfl&auml;che um eine neue Datenbanktabelle zuzuweisen.");

define('SHOW_UPLOADED_IMAGE', "Zeige das hochgeladene Bild");
define('SHOW_UPLOADED_IMAGE_INFO', "Bei der Anzeige als E-Mail k&ouml;nnen Datei-Uploads als Verkn&uuml;pfung oder als Bild angezeigt werden.");

define('SUBMIT', "Senden");
define('REPLACE_SUBMIT_BUTTON', "Ersetze die Senden-Schaltfl&auml;che");
define('REPLACE_SUBMIT_BUTTON_INFO', "Ersetzt die 'Senden'-Schaltfl&auml;che durch ein Bild.");
define('SUBMIT_IMAGE_URL', "URL f&uuml;r 'Senden'-Bild");
define('SUBMIT_IMAGE_URL_INFO', "Eine URL, die auf das Bild zum Ersetzen des 'Senden'-Schaltfl&auml;che zeigt.");
define('SUBMIT_IMAGE_WIDTH', "Breite 'Senden'-Bild");
define('SUBMIT_IMAGE_WIDTH_INFO', "Die Breite des Bildes welches die 'Senden'-Schaltfl&auml;che ersetzt.");
define('SUBMIT_IMAGE_HEIGHT', "H&ouml;he 'Senden'-Bild");
define('SUBMIT_IMAGE_HEIGHT_INFO', "Die H&ouml;he des Bildes welches die 'Senden'-Schaltfl&auml;che ersetzt.");

define('RESET', "Zur&uuml;ck");
define('REPLACE_RESET_BUTTON', "Ersetze die Zur&uuml;ck-Schaltfl&auml;che");
define('REPLACE_RESET_BUTTON_INFO', "Ersetzt die 'Zur&uuml;ck'-Schaltfl&auml;che durch ein Bild.");
define('RESET_IMAGE_URL', "URL f&uuml;r 'Zur&uuml;ck'-Bild");
define('RESET_IMAGE_URL_INFO', "Eine URL, die auf das Bild zum Ersetzen des 'Zur&uuml;ck'-Schaltfl&auml;che zeigt.");
define('RESET_IMAGE_WIDTH', "Breite 'Zur&uuml;ck'-Bild");
define('RESET_IMAGE_WIDTH_INFO', "Die Breite des Bildes welches die 'Zur&uuml;ck'-Schaltfl&auml;che ersetzt.");
define('RESET_IMAGE_HEIGHT', "H&ouml;he 'Zur&uuml;ck'-Bild");
define('RESET_IMAGE_HEIGHT_INFO', "Die H&ouml;he des Bildes welches die 'Zur&uuml;ck'-Schaltfl&auml;che ersetzt.");

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


/*
PFAUTO_ fields can be embedded into any text part of a form or form item
Where there can be text, an expression enclosed in braces, ilke {username}
will return the "Auto" field for PFAUTO_USERNAME
*/
define('PFAUTO_USERNAME', "username");
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