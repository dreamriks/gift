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
* Hungarian (formal) translation
* Translated by Jozsef Tamas Herczeg, www.joomlandia.eu
*
*/
defined( '_VALID_MOS' ) or die( 'A közvetlen hozzáférés ehhez a helyhez nem enedélyezett.' );
if (defined("WELCOME_TO_PERFORMS")) return;

define("FORM", "Ûrlap");
define("SUBMIT_LABEL","Küldés");
define("PUBLISH","közzététel");
define("UNPUBLISH","visszavonás");
define("NAME","Név");
define("LINK","Hivatkozás");
define("ITEMS","Elemek");
define("DB_TABLE_NAME","DB táblanév");
define("DB_RECORDS","DB rekordok");
define("PUBLISHED","Közzétéve");
define("UNPUBLISHED","Visszavonva");
define("SECURITYIMAGESHELP","Biztonsági kód súgóüzenete");
define("SECURITYIMAGESERROR","Biztonsági kód hibaüzenete");

define("FORM_PREVIEW","Ûrlap elõnézete");
define("DATE_TIME","Dátum");
define("NO_RECORDS_FOUND","Nem találhatók rekordok!");
define("FIELD_NAMES","Mezõnevek");
define("SELECT_FIELDS","Jelöld ki azokat a mezõneveket, melyeket bele kívánsz venni a jelentésbe.");
define("ALL","Mind");
define("INCLUDED_FIELDS","Belevett mezõnevek");
define("UP","Fel");
define("DOWN","Le");
define("_PRINT","Nyomtatás");

define("USE_SECURITYIMAGES","Biztonsági kód használata");
define('NO_SI_INSTALLED', 'Még nem telepítetted a com_securityimages komponenst');
define('NO_SI_INSTALLED_INFO', '<ul><li>Szerezd be a <a href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,1211/Itemid,35/">Joomla! Extensions</a> weblapon</li><li>A perFormst nélküle is használhatod.</li></ul>');
define("EDIT_FORM","Ûrlap szerkesztése");
define("ADD_EDIT_REMOVE","Ûrlapelemek hozzáadása, szerkesztése vagy eltávolítása");
define("CAPTION","Cím");
define('USE_CAPTION',"Felirat használata");
define('FIELD_SEPARATOR', "Mezõelválasztó");
define('FIELD_SEPARATOR_INFO', "Az ûrlap adatainak emailbe vagy szövegbe történõ kivitelekor ezt a karaktert használja a választható értékek között.");
define('USE_CAPTION_INFO',"Az ûrlap adatainak emailbe történõ kivitelekor a perForms kinyomtatja az érték melletti szövegneveket.");
define('FORMAT_TAB',"Formátum");
define('FORMAT_INFO', "Jelentés és email formátuma");
define("TYPE","Típus");
define("ORDER","Sorrend");
define("REORDER","Átrendezés");
define('INSERT', "Beszúrás");
define('REMOVE', "Távoli");
define('SET_AS_SELECTED', "Beállítás kijelöltként");
define("VALUE","Érték");
define("EDIT_ITEM","Szerkesztés");
define("EDIT","Szerkesztés");
define("_NEW","Új");
define("FORM_DETAILS","Ûrlap részletei");
define("TITLE","Cím:");
define("INTRO_TEXT","Bevezetõ szöveg:");
define("AFTER_SUBMIT","Továbbítás utáni mûvelet:");
define("REDIRECT_TO_URL","Átirányítás URL-re");
define("SHOW_TNX_TEXT","Köszönetnyilvánítás megjelenítése");
define("REDIRECT_URL","Átirányító URL:");
define("TNX_TEXT","Köszönõ szöveg:");
define("PUBLISHING_TAB","Közzététel");
define("PUBLISHING_INFO","Közzététel részletei");
define("ACCESS","Hozzáférés");
define("START_PUBLISHING","Közzététel kezdete");
define("FINISH_PUBLISHING","Közzététel befejezése");
define("IMAGES_TAB","Képek");
define("IMAGE_INFO","Kép részletei");
define('IMAGE_INFO_INFO',"Ha egyedi képet kívánsz használni, akkor töltsd azt fel a ".$mosConfig_live_site."/images/stories könyvtárba");
define("IMAGE","Kép");
define("THEMES_TAB","Témák");
define("THEME_INFO","Téma részletei");
define("THEME","Téma");
define("BUTTONS_TAB","Gombok");
define("FORM_BUTTONS","Ûrlapgombok");
define("SUBMIT_LABEL_TITLE","A Küldés gomb felirata");
define("INCLUDE_RESET","Az Alaphelyzet gomb hozzáadása");
define("INCLUDE_PF","A Nyomtatóbarát gomb megjelenítése");
define("INCLUDE_PDF","A PDF gomb megjelenítése");
define('INCLUDE_PF_INFO',"A perForms elhelyezi a Nyomtatóbarát gombot az ûrlap fejlécével, ezáltal maga az ûrlap megtekinthetõ egy elõugró ablakban.");
define('INCLUDE_PDF_INFO',"A perForms elhelyezi a PDF gombot az ûrlap fejlécével, amikor megtekintik.");
define('NO_PDF_INSTALLED', 'Még nincs telepítve a FPDF. A perForms nem tudja megjeleníteni a PDF gombot.');
define('NO_PDF_INSTALLED_INFO', '<ul><li>Szerezd be a <a href="http://www.fpdf.org">www.fpfd.org</a> webhelyen</li><li>A perForms nélküle is kiválóan mûködik.</li></ul>');
define("RESET_LABEL","Az Alaphelyzet gomb felirata");
define("EMAILS_TAB","Email");
define("EMAIL_FORM_TITLE","Ûrlap küldése emailben");
define("EMAIL_FORM","Ûrlap küldése emailben:");
define('EMAIL_FORM_INFO', "Ha igen, akkor a perForms emailt fog küldeni az ûrlap beküldésekor.");

define('EMAIL_ADMIN',"Másolat küldése az adminisztrátornak:");
define('EMAIL_ADMIN_INFO', "Ha igen, akkor a perForms elküldi az email másolatát a \&apos;címzett\&apos; mezõben megadott cím(ek)re - ha a mezõ üres, és az \&apos;Ûrlap küldése emailben\&apos; \&apos;igen\&apos;, akkor a webhely adminisztrátora kap emailt.");
define('EMAIL_USER',"Másolat küldése a felhasználónak:");
define('EMAIL_USER_INFO', "Ha igen, akkor a perForms küld emailt az ûrlapot kitöltõ felhasználónak. Bejelentkezett felhasználók esetében ez automatikusan mûködik. Ha vannak <b>\&apos;replyto\&apos;</b> és <b>\&apos;replytoName\&apos;</b> nevû elemek, akkor azoknak az elemeknek az értékei kerülnek felhasználásra. A bejelentkezett felhasználók számára ezek alapértelmezésként rejtettek maradnak. A webhely látogatóinak meg kell adniuk az email címüket az ûrlapon <b>\&apos;replyto\&apos;</b> és <b>\&apos;replytoName\&apos;</b> látható lesz a nem bejelentkezett felhasználók számára is, ha azok elemek az ûrlapon.");
define('ENABLE_MAILFROM',"A levélcsapda engedélyezése:");
define('ENABLE_MAILFROM_INFO', "Ha igen, akkor a perForms megkísérli elküldeni az adminisztrátornak az üzenetet a <b>\&apos;mailfrom\&apos;</b> nevû mezõben lévõ érték felhasználásával az email FELADÓ: részében, ha a <b>\&apos;mailfrom\&apos;</b> egy elem az ûrlapon. Nem minden levelezési kiszolgáló örül ennek, ezért a \&apos;no\&apos; az alapértelmezés.");

define("EMAIL_ALWAYS","Küldés hiba esetén is:");
define('EMAIL_ALWAYS_INFO', "Ha igen, akkor a perForms figyelmen kívül hagyja a hibákat, és mindenképp elküldi az emailt,");
define("FROM","Feladó: (hagyd üresen a webhely alapértelmezésének használatához)");
define('FROM_INFO', "Ha azt szeretnéd, hogy a felhasználó töltse ki a <b>válasz</b> email címez az ûrlapon, akkor hagyd üresen a fenti paramétert. Tegyél inkább email cím rögzítõmezût az ûrlapra (Elemek fül), és gyõzõdj meg róla, hogy a <b>Név</b> <b>mailfrom</b> lehetõségre van állítva.");
define("TO","Címzett: (vesszõvel elválasztott lista)");
define('TO_INFO', 'Ha azt szeretnéd, hogy a felhasználó úgy választhassa ki a <b>címzett</b> email címet az ûrlapon (ügyes dolog, ha a címzettek legördülõ listáját tartalmazó kapcsolatfelvételi ûrlapot készítesz), akkor a fenti paraméterben add hozzá normálként az (alapértelmezett küldési címként használandó) <b>mail-to</b> email címet. Ezután tegyél választólistát az ûrlapra (Elemek fül) mindegyik címzett számára kiválasztható email címmel, és gyõzõdj meg róla, hogy a <b>Név</b> <b>mailto</b> lehetõségre van állítva.');
define("EMAIL_SUBJECT","Az email tárgya:");
define('EMAIL_SUBJECT_INFO', 'Ha azt szeretnéd, hogy az email <b>Tárgy</b> mezõje egyedi legyen (vagy a felhasználó tölthesse ki), akkor hagyd üresen a fenti <b>Tárgy</b> paramétert. Tegyél inkább tárgy rögzítõmezõt az ûrlapra (Elemek fül), és gyõzõdj meg róla, hogy a <b>Név</b> választhatóan <b>tárgy</b>ra van állítva, ha hozzáadsz egy fenti tárgyat, és ha tárgy rögzítõmezõt is akarsz tenni az ûrlapra, akkor a fenti tárgy hozzáfûzésre kerül a felhasználó által beírt tárgyhoz.');
define("INTRO_INCLUDE","A bevezetõ szöveg beszúrása:");
define('INTRO_INCLUDE_INFO', "Ha igen, akkor az email tartalmazni fogja ûrlap bevezetõjét.");
define('APPEND_TIMESTAMP', "Idõbélyegzés hozzáfûzése");
define('APPEND_TIMESTAMP_INFO', "Ha igen, akkor az email tárgyához hozzáfûzésre kerül az ûrlap beküldésének dátumát és idõpontját.");

define("TABLE_ALREADY_CREATED","A tábla létrehozása már megtörtént...");
define("CREATE_DATABASE_TABLE","Adatbázistábla létrehozása...");
define("NOT_BOUND_TO_TABLE","Ez az ûrlap jelenleg NEM kapcsolódik egyik adatbázistáblához sem.");
define("BOUND_TO_TABLE","Ez az ûrlap jelenleg adatbázistáblához kapcsolódik. A tábla neve: ");
define("BOUND_INFO1","Amikor hozzákapcsolsz egy táblát egy ûrlaphoz, akkor <strong>nem</strong> adhatsz hozzá, módosíthatsz vagy törölhetsz ûrlapelemeket.");
define("BOUND_INFO2","A táblanév <strong>ne</strong> tartalmazzon szóközt, pontot, sem más speciális karaktert.");
define("TABLE_NAME","Tábla neve:");

define("DELETE_FORM_INFO1","Ez az ûrlap már a(z) '%s' táblához kapcsolódik" );
define("DELETE_FORM_INFO2","Ha törlöd ezt a táblát, akkor valamennyi adat el fog veszni, és a tábla is törlésre fog kerülni.");
define("DELETE_FORM_INFO3","TÖRLÉS UTÁN NINCS MÓD EZEN INFORÁCIÓ VISSZAÁLLÍTÁSÁRA");
define("DELETE_TABLE","Törlöd a táblát?");
define("FORM_ITEMS_DETAILS","Ûrlapelemek részletei");
define("NO_SPECIAL_CHARS","Szóköz, pont vagy speciális karakter nélkül!");
define("CHECK","Ellenõrzés");
define("HELP_TEXT","Súgószöveg");
define("ERROR_MSG","Hibaüzenet");
define("DISPLAY_TAB","Megjelenítés");
define("DISPLAY_PROP","Megjelenítés tulajdonságai");
define("SIZE1","1. méret");
define("SIZE2","2. méret");
define('SIZE1_INFO',"Szélesség, Oszlopok");
define('SIZE2_INFO',"Magasság, Sorok");
define("REQUIRED","Kötelezõ");
define('REQUIRED_INFO',"A perForms nem engedi az ûrlap továbbítását, ha nem töltik ki ezt a mezõt.");
define("DISABLED","Letiltott");
define("READONLY","Írásvédett");
define("MULTIPLE","Több példány");
define('MULTIPLE_INFO',"A \&apos;Select\&apos; elemekkel történõ használathoz.");
define("VALUES_TAB","Értékek");
define('VALUES_INFO','Értékek tulajdonságai');
define("MISSING_FIELD_TEXT","Hiányzó mezõ szövege:");

// Errors
define("ITEMS_CANT_EDITED","Nem módosíthatod ennek az ûrlapnak az elemeit!");
define("FORM_CURRENTLY_EDITED","A(z) %s ûrlapot épp egy másik adminisztrátor szerkeszti.");
define("NO_FORM_FOUND","Nem található ûrlap!");
define("SELECT_A_RECORD_TO","Válaszd ki a rekordot a következõ mûvelethez: %s");
define("ALREADY_TABLE_EXISTS","A tábla \'%s\' már létezik. Kérjük, hogy másik nevet adj neki.");
define("ERROR_OCCURRED","Hiba történt!");
define("DB_ERROR_OCCURRED","Hiba történt az adatbázisba íráskor!");
define("TITLE_EMPTY","Üres a cím!");
define("TABLE_NAME_EMPTY","Meg kell adnod a tábla nevét.");
define("DELETE_DATA_CONFIRM","Valóban törölni akarod AZ ÖSSZES ADATOT?");
define("CAPTION_EMPTY","A cím üres.");
define("NAME_EMPTY","A név üres");
define("LIST_VALUES","Listaértékek");
define("SELECTED_VALUE","Kijelölt érték");
define('SELECTED_VALUE_INFO',"Az elem kezdetben kiválasztott értéke.");

define("PF_ERROR_18", "A munkamenet nem folyamatos.");
define("PF_ERROR_18_COMMENT", 
       "<br /><ul><li>A böngészõ Vissza gombjának megnyomásával és újabb próbával "
       ."megoldható. <cite>Lehet, hogy újra kell indítani a munkamenetet.</cite><br /></li>"
       .'<ul><li>Akkor is elfordul, ha a Joomla globális beállítása, a "Live Site" '
       .'protokoll nem egyezik a jelenlegi protokollal (http / https)<br />'
       .'Keresd fel a <a href="http://forge.joomla.org/sf/go/post17630">'
       .'http://forge.joomla.org/sf/go/post17630</a> címet</li><br />'
       .'<br /><li>Rendszertelen hiba az is, amikor egy felhasználó kijelentkezik egy Joomla '
       .'munkamenetbõl, és megpróbálja megjeleníteni a nyomtatóbarát ûrlapot az '
       .'ûrlap fejlécében látható hivatkozásra kattintva ("joomla módban") - a munkamenetek '
       .'nincsenek mindig azonnal inicializálva... a megoldás a nyomtatóbarát ablak '
       .'bezárása, majd kattints ismét a menüpontra (hogy elõhozd '
       .'az ûrlapot), ezután kattints a '
       .'nyomtatóbarát gombjára, és az elõugró ablaknak mûködnie kell.</li></ul>'
       );       
define("PF_ERROR_22", "Nem numerikus ûrlap azonosítószám.");
define("PF_ERROR_22_COMMENT",
       'Általában hibás URL okozza. '
       .'Keresd fel a <a href="http://forge.joomla.org/sf/go/post17395">'
       .'http://forge.joomla.org/sf/go/post17395</a> címet');

define("PF_ERROR_23", "Nem található ûrlap.");
define("PF_ERROR_23_COMMENTA", "Nem található");
define("PF_ERROR_23_COMMENTB",
       @"nem található.<ul>
<li>Nem engedélyezhették a számodra ezen erõforrás megtekintését, vagy
<li>Ez az ûrlap lejárhatott, visszavonhatták vagy eltávolíthatták.</ul>");
define("FOR_MORE_HELP", 'Ha további segítségre van szükséged a perForms használatához, '
       .'akkor keresd fel a perForms honlapját a <a href="http://www.performs.org.au/"> '
       .'performs.org.au</a> címen');

define("PF_ERROR_127", "Érvénytelen paraméterlista.");
define("PF_ERROR_127_COMMENT",
       'Általában egy "Component" menüpont hiányzó paramétere okozza. '
       .'<ul><li>Ne feledd el felvenni a <strong>formid=1</strong> paramétert '
       .'a paraméterlistára (vagy a megjelenítendõ ûrlap megfelelõ azonosítóját).'
       .'</li></ul>');

define("PF_ERROR_71", "Nem hozható létre a feltöltések könyvtára!");
define("PF_ERROR_71_INFO", "Eme ûrlap tárolókönyvtára érvénytelen, vagy nem hozható létre. Ellenõrizd a perForms adminisztrátor 'értékek' fülén a feltöltési útvonalat.");

// MENU

define("DATABASE","Adatbázis");
define("BOUNDDATA","Adatok");
define("EXPORTTOEXCEL","Exportálás");
define("PREVIEW","Elõnézet");
define("CLOSE","Bezárás");
define("CANCEL","Mégse");
define("DELETE","Törlés");
define("COPY_RECORD","Másolás");
define("NEW_ITEM","Új elem");
define("DELETE_ITEM_CONFIRM","Törli az elemet?");
define("SAVE","Mentés");

define("PRINTER_FRIENDLY", "Nyomtatóbarát");
define("DOWNLOAD_PDF", "PDF fájl letöltése");
define("ACCESSKEY", "Hívóbetû" );

define('PLEASE_FILL_OUT', 'Kérjük, hogy töltsd ki!');
define('BINDING', 'Kötés');
define('EDIT_ITEMS', 'Elemek szerkesztése');
define('UPGRADE_NEWS', 'Frissítési hírek');
define('IS_AVAILABLE', 'megjelent');
define('DOWNLOAD_FROM', 'Töltsd le itt:');

define('SEP_COMMA', 'vesszõ');
define('SEP_COMMASPACE', 'vesszõ+szóköz');
define('SEP_HYPHEN', 'kötõjel');
define('SEP_NEWLINE', 'új sor');
define('SEP_SPACE', 'szóköz');

define('TY_EMAIL', 'email');
define('TY_FLOAT', 'lebegõ');
define('TY_INTEGER', 'egész szám');
define('TY_NAME', 'név');
define('TY_STRING', 'karakterlánc');
define('TY_URL', 'url');

define('ITEMTYPE_BUTTON', 'gomb');
define('ITEMTYPE_CHECKBOX', 'jelölõnégyzet');
define('ITEMTYPE_DATE', 'dátum');
define('ITEMTYPE_FILE', 'fájl');
define('ITEMTYPE_HIDDEN', 'rejtett');
define('ITEMTYPE_IMAGE', 'kép');
define('ITEMTYPE_PASSWORD', 'jelszó');
define('ITEMTYPE_PAGEBREAK', 'oldaltörés');
define('ITEMTYPE_RADIO', 'választó');
define('ITEMTYPE_SELECT', 'kijelölõ');
define('ITEMTYPE_TEXT', 'szöveg');
define('ITEMTYPE_TEXTAREA', 'szövegterület');
define('ITEMTYPE_TEXTUAL', 'szöveges');

define('VALUE_UP', "Fel");
define('VALUE_UP_INFO', "A kijelölt elemet a listában felfelé lépteti.");
define('VALUE_DOWN', "Le");
define('VALUE_DOWN_INFO', "A kijelölt elemet a listában lefelé lépteti.");
define('SET_AS_SELECTED_INFO', "A perForms ezzel a kezdetben kijelölt elemmel rajzolja meg a HTML-ûrlapelemet.");
define('REMOVE_INFO', "Eltávolítja a kiválasztott lehetõséget az értéklistáról.");

define('DISABLED_INFO', "Ha igen, akkor a perForms nem rajzolja meg ezt az elemet.");
define('READONLY_INFO', "Ha igen, akkor a perForms csak írásvédettként rajzolja meg ezt az elemet. Nem lehet kitölteni.");
define('VALUE_INFO',"Írj be egy értéket ebbe a mezõbe, majd kattints a ".INSERT." gombra a listára vételhez.<br /><br /> Az <strong>".ITEMTYPE_FILE."</strong> elemek esetén ide írd be az alapértelmezett feltöltési útvonalat, sorvégi elválasztóval <br />(pl. <code>/path/to/uploads/</code> vagy <code>c:\\\uploads\\\</code>).");

define('SUBMIT_LABEL_INFO', "Az ûrlap \&apos;<b>küldés</b>\&apos; gombjának felirata.");
define('INCLUDE_RESET_INFO', "Ha igen, akkor a perForms \&apos;<b>alaphelyzet</b>\&apos; gombot helyez el az ûrlapon.");
define('RESET_LABEL_INFO', "Az \&apos<b>alaphelyzet</b>\&apos; gomb felirata.");
define('PUBLISHED_INFO', "Ha igen, akkor az ûrlap elérhetõ lesz a webhely látogatói számára.");
define('ACCESS_INFO', "Határozd meg az ûrlap hozzáférési szintjét.");
define('START_PUBLISHING_INFO', "Az a dátum, mikortól az ûrlap a webhely látogatói számára hozzáférhetõ lesz.");
define('FINISH_PUBLISHING_INFO', "Az a dátum, mikortól az ûrlap a webhely látogatói számára nem lesz hozzáférhetõ. Ha a dátum 0000-00-00 00:00:00, akkor az ûrlap már elérhetõ.");

define('CAPTION_INFO', "Az elem szövegcímkéjeként nyomtatásra kerülõ szöveg.");
define('ACCESSKEY_INFO', "Az elemhez társított olyan hívóbetû, amit a böngészõ rendel hozzá egy billentyûkombinációhoz. Például a \&apos;<b>k</b>\&apos; hívóbetûje a crtl-shift-k gyorsbilentyûnek fele meg a Firefox böngészõben, az Internet Explorerben pedig alt-shift-k.");
define('NAME_INFO', "Az elem belsõ neve. Ne tartalmazzon semmilyen nem betû karaktert. Ha ennek az elemnek <b>bcc, cc, mailfrom, mailto, replyto </b>vagy<b> replytoName</b> a neve, akkor az érték automatikusan kerül felhasználásra az emailküldéshez, ha az ûrlapot emailek küldésére állította be.");
define('TYPE_INFO', "Válassza ki az elemtípust a listából. A különféle elemtípusok különbözõ tulajdonságokat támogatnak.<br /><ul><li>A <b>".ucfirst(ITEMTYPE_TEXTAREA)."</b> a ".SIZE1." és a ".SIZE2.@" paramétert használja a szélesség és a magasság meghatározásához.<br /></li><li>A <b>".ITEMTYPE_SELECT.", ".ITEMTYPE_RADIO." </b>ás a<b> ".ITEMTYPE_CHECKBOX."</b> típusnak legalább egy értéknek kell lennie az elem ".VALUES_TAB." listában.<br /></li><li>A <strong>".ucfirst(ITEMTYPE_FILE)."</strong> elem a <strong>".SIZE1."</strong> paramétert használja a fájlnévmezõ szélességéhez, a <strong>".SIZE2."</strong> paraméter határozza meg a legnagyobb feltölthetõ fájlméretet, a <strong>".VALUE."</strong> pedig a feltöltési útvonalat (ahol a feltöltött fájlok tárolása történik).</li></ul>");
define('CHECK_INFO', "Válaszd ki ennek az elemnek az érvényesítõjét. Az üres érvényesítõ választása esetén mindenféle típusú adat engedélyezésre kerül.");
define('HELP_TEXT_INFO', "Az elemhez tartozó helyi súgó.");
define('ERROR_MSG_INFO', "A megjelenítendõ hibaüzenet, ha probléma van az elemmel.");

define('REVERSE_ORDER', "Fordított sorrend");
define('SAVE_ORDER', "Sorrend mentése");
define('SWAP_SIZE_VARS', "Minden szövegterület elem Méret1 és Méret2 értékének felcserélése");
define('NEW_SIZEVARS_SAVED', 'Az új méretváltozók mentése kész.');
define('NEW_ORDERING_SAVED', 'Az új sorrend mentése kész.');

define('PF_LICENCE_INFO', 'A perForms a <a href="http://www.gnu.org/copyleft/gpl.html">GNU Általános Nyilvános Licenc</a> alatt kiadott szabad szoftver.');
define('INSTALLATION_MESSAGES', 'Telepítési üzenetek');
define('THANKS_FOR_CHOOSING', 'Köszönjük, hogy a perFormst választottad.');
define('WE_NEED_TRANSLATORS', @"
<p>
A perForms most már teljesen lokalizált, és fordítókat keresünk! 
<a href=\"http://forge.joomla.org/sf/go/projects.performs/discussion.language_file_translations\">Segítsen, hogy a PerForms globális legyen!</a>
</p>");
define('FOR_SUPPORT', @"
<p><b>Tanácsadásért kérjük, keresd fel hivatalos támogató webhelyünket a <a href=\"http://www.performs.org.au/\">http://www.performs.org.au/</a> címen.</b></p>
");
define('PERFORMS_FEATURES', @"
<p>Fontosabb funkciói:</p>
<ul>
<li>Korlátlan számú beviteli mezõ</li>
<li>9 féle mezõtípus közül választhat</li>
<li>Fájlfeltöltés!</li>
<li>Az ûrlap postázása</li>
<li>A felhasználók által beküldött levél-feladó, válaszcím és tárgy mezõ</li>
<li>Tetszés szerint hozható létre külön adatbázistábla mindegyik ûrlaphoz</li>
<li>A mezõk ellenõrzése</li>
<li>Kisegítõ lehetõségekkel ellátott ûrlapok</li>
<li>Egyedi hibaüzenetek</li>
<li>Egyedi helyi súgó minden egyes mezõhöz</li>
<li>Jelentéslap a táblában lévõ rekordok megtekintéséhez</li>
<li>Alap szintû sablonkészítõ rendszer</li>
<li>A rögzített adatok megtekintése / exportálása az Adminisztrátorban</li>
<li>A nyomtatóbarát változat megtekintése a látogatói oldalon</li>
<li>PDF letöltése</li>
<li>Joomla 1.5-kompatibilis</li>
</ul>
");
define('WELCOME_TO_PERFORMS', @"
<p>
A perForms segítségével egyszerûen készíthetsz emailben elküldhetõ vagy az adatbázisba menthetõ egyedi ûrlapokat. Az eredményeket megtekintheted az adminisztrációban, vagy letöltheted CSV formátumban.
</p>
".FOR_SUPPORT.PERFORMS_FEATURES.WE_NEED_TRANSLATORS);
define('NEW_FEATURES', @"
<strong>Új funkciók: </strong>
<ul>
<li>Kisegítõ lehetõségek</li>
<li>Admin infó ikonok</li>
<li>Adatkötés lapozás</li>
<li>Konfigurálás</li>
<li>Fájlfeltöltési mezõ</li>
<li>Barátságos hibák</li>
<li>Verzióellenõrzés</li>
</ul>
");
define('UPGRADE_MESSAGE', @"
<p>A perForms változott! 
<ol><li><p><img src=\"images/reload_f2.png\" height=\"16\" width=\"16\" border=\"0\" /> <strong>".REVERSE_ORDER.@"</strong> gomb.</p>Az elemeket fordított sorrendben tekintheted meg, csak kattints elem nézetben a '<strong>"
       .REVERSE_ORDER."</strong>' gombra az átrendezéshez a ".ORDER.@" oszlop tetején.</li>
<li style=\"margin-top: 4pt;\"><p>
<img src=\"images/restore_f2.png\" border=\"0\" width=\"16\" height=\"16\" />
 <strong>".SWAP_SIZE_VARS.@"</strong> gomb.</p>
Változtattunk a szövegterület elemek Méret1 és Méret2 paraméterének felhasználási módján, a szövegterületek javításához
kattints a '<strong>".SWAP_SIZE_VARS."</strong>' gombra a ".SIZE1." és a ".SIZE2.@" oszlop tetején.</li></ol></p>
".WE_NEED_TRANSLATORS.NEW_FEATURES.FOR_SUPPORT);


define('SUCCESSFUL_UPGRADE', "A frissítés sikerült a PerForms ");
define('INS_WELCOME', "Üdvözöl a perForms!");
define('INS_SQL_STATEMENTS', "SQL utasítások");
define('INS_SQL_ERRORS', "SQL hibák");

define('UPLOAD_ERROR_1', "A feltöltött fájl mérete túllépi a php.ini fájlban az upload_max_filesize utasításban megadott méretet.");
define('UPLOAD_ERROR_1_INFO', "A fájl a php eme telepítésében engedélyezettnél nagyobb volt.<ul><li> Kérd meg a php/joomla adminisztrátort, hogy növelje meg az upload_max_filesize méretét.</li></ul>");
define('UPLOAD_ERROR_2', "A feltöltött fájl túllépi a HTML-ûrlapban megadott MAX_FILE_SIZE utasításban megadott méretet.");
define('UPLOAD_ERROR_2_INFO', "Az adminisztrátor a legnagyobb feltölthetõ fájlméretet a fájlod méreténél kisebbre állította.");
define('UPLOAD_ERROR_3', "A feltöltött fájl csak részben került feltöltésre.");
define('UPLOAD_ERROR_3_INFO', "Csatlakozási hiba miatt a fájl megsérült a kiszolgálói oldalon. Kérjük, hogy próbáld újra.");
define('UPLOAD_ERROR_4', "Nem került fájl feltöltésre.");
define('UPLOAD_ERROR_4_INFO', "Ismeretlen feltétel miatt a fájlfeltöltés nem sikerült.");
define('UPLOAD_ERROR_5', "Ismeretlen hibaválasz!!.");
define('UPLOAD_ERROR_5_INFO', "A php telepítés nem szabványos hibakódot adott vissza!");
define('UPLOAD_ERROR_6', "Hiányzik egy ideiglenes könyvtár. A PHP 4.3.10 és a PHP 5.0.3 verzióban került bevezetésre.");
define('UPLOAD_ERROR_6_INFO', "Ennek a php telepítésnek nincs megadva az ideiglenes könyvtára a php.ini fájlban.");
define('UPLOAD_ERROR_7', "Nem sikerült a fájl írása a lemezre. A PHP 5.1.0 verzióba került bevezetésre.");
define('UPLOAD_ERROR_7_INFO', "Elfogyhatott a szabad terület a kiszolgálón, vagy az ideiglenes könyvtár írásvédett lehet.");

define('SUCCESS', "Sikerült!");
define('UPLOAD_SUCCESSFUL', "A fájl érvényes, a feltöltése sikerült.\n");
define('UPLOAD_SUCCESSFUL_INFO', "A fájl feltöltése megtörtént, tárolókönyvtárban került elhelyezésre, az adminisztrátorra vár.");
define('ERROR_71', "Lehetséges fájlfeltöltési támadás!\n");
define('ERROR_71_INFO', "Érvénytelen a fájl neve vagy útvonala!");

define('UNKNOWN_SENDER', "Ismeretlen feladó");

define('IMAGEFLOAT', "Kép körbefuttatásának stílusa");
define('IMAGEFLOAT_INFO', "Beállítja a kép körbefuttatási stílusát (css float: [balra, jobbra, nincs, öröklés];)");
define('FLOAT_LEFT', 'Balra');
define('FLOAT_RIGHT', 'Jobbra');
define('FLOAT_NONE', 'Nincs');
define('FLOAT_INHERIT', 'Öröklés');

define('NOT_BOUND', "Nincs összekötve!");
define('CLICK_BINDING_BUTTON', "Kattints a <b>Kötés</b> gombra új adatbázistábla hozzárendeléséhez.");

define('SHOW_UPLOADED_IMAGE', "Feltöltött kép megjelenítése");
define('SHOW_UPLOADED_IMAGE_INFO', "A felhasználói bevitel emailben történõ megtekintésekor a fájlelemek hivatkozással vagy képként jeleníthetõk meg.");

define('SUBMIT', "Küldés");
define('REPLACE_SUBMIT_BUTTON', "A Küldés gomb lecserélése");
define('REPLACE_SUBMIT_BUTTON_INFO', "Az alapértelmezett ûrlaptovábbító gomb képre cserélése.");
define('SUBMIT_IMAGE_URL', "A Küldés képgomb URL-je");
define('SUBMIT_IMAGE_URL_INFO', "Az alapértelmezett Küldés gombot lecserélõ kép URL-je.");
define('SUBMIT_IMAGE_WIDTH', "A Küldés képgomb szélessége");
define('SUBMIT_IMAGE_WIDTH_INFO', "Az alapértelmezett Küldés gombot lecserélõ kép szélessége.");
define('SUBMIT_IMAGE_HEIGHT', "A Küldés képgomb magassága");
define('SUBMIT_IMAGE_HEIGHT_INFO', "Az alapértelmezett Küldés gombot lecserélõ kép magassága.");

define('RESET', "Mégse");
define('REPLACE_RESET_BUTTON', "A Mégse gomb lecserélése");
define('REPLACE_RESET_BUTTON_INFO', "Az alapértelmezett ûrlaptörlõ gomb képre cserélése.");
define('RESET_IMAGE_URL', "A Mégse képgomb URL-je");
define('RESET_IMAGE_URL_INFO', "Az alapértelmezett ûrlaptörlõ gombot lecserélõ kép URL-je.");
define('RESET_IMAGE_WIDTH', "A Mégse képgomb szélessége");
define('RESET_IMAGE_WIDTH_INFO', "A Mégse gombot lecserélõ kép szélessége.");
define('RESET_IMAGE_HEIGHT', "A Mégse képgomb magassága");
define('RESET_IMAGE_HEIGHT_INFO', "A Mégse gombot lecserélõ kép magassága.");

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
define('PFAUTO_USERNAME', "felhasználónév");
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