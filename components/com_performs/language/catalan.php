<?php
/**
* @version $id: catalan.php,v 2.3
* @package performs
* @copyright (c) 2007 perForms
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @author David Walters
* @author (original) Ilhami KILIC http://www.tuwitek.at
* @author (traducció) Daniel Queralt i Creus 1.0.3 de 28/04/2007
* Joomla is Free Software
* 
* If you are translating, be sure to download the very latest
 * english.php, available from http://www.performs.org.au/performs/nightly/english.php.txt
*
*/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
if (defined("WELCOME_TO_PERFORMS")) return;

define("FORM", "Form");

define("SUBMIT_LABEL","Executar");
define("PUBLISH","publicar");
define("UNPUBLISH","no publicar");
define("NAME","Nom");
define("LINK","Enllaç");
define("ITEMS","Controls");
define("DB_TABLE_NAME","Nom de taula a BD");
define("DB_RECORDS","Registres a BD");
define("PUBLISHED","Publicat");
define("UNPUBLISHED","No publicat");
define("SECURITYIMAGESHELP","Missatge d&apos;ajuda d&apos;imatge de seguretat");
define("SECURITYIMAGESERROR","Missatge d&apos;error d&apos;imatge de seguretat");

define("FORM_PREVIEW","Visualitzar formulari");
define("DATE_TIME","Data");
define("NO_RECORDS_FOUND","Registres no trobats!");
define("FIELD_NAMES","Noms de camps");
define("SELECT_FIELDS","Selecioni els noms dels camps que desitji incloure a l&apos;informe...");
define("ALL","Tot");
define("INCLUDED_FIELDS","Noms de camps inclosos");
define("UP","Amunt");
define("DOWN","Avall");
define("_PRINT","Imprimir");

define("USE_SECURITYIMAGES","Usar imatges de seguretat");
define('NO_SI_INSTALLED', 'com_securityimages not installed');
define('NO_SI_INSTALLED_INFO', '<ul><li>Get it from <a href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,1211/Itemid,35/">Joomla! Extensions</a></li><li>PerForms will work fine without it.</li></ul>');

define("EDIT_FORM","Editar formulari");
define("ADD_EDIT_REMOVE","Agregar, Editar or Eliminar controls del formulari");

define('CAPTION',"Etiqueta");
define('USE_CAPTION',"Usar Etiqueta");
define('FIELD_SEPARATOR', "Separador de Camps");
define('USE_CAPTION_INFO',"En enviar el formulari cap a un email, perForms imprimirà els noms dels camps a continuació del valor.");
define('FIELD_SEPARATOR_INFO', "En enviar el formulari cap a un mail o text, aquest caràcter s&apos;usarà entre valors d&apos;opció.");
define('FORMAT_TAB',"Format");
define('FORMAT_INFO', "Format d&apos;Informe i Email");
define("TYPE","Tipus");
define("ORDER","Ordre");
define("REORDER","Reordenar");
define('INSERT', "Insertar");
define('REMOVE', "Eliminar");
define('SET_AS_SELECTED', "Marcar com seleccionat");
define("VALUE","Valor");
define("EDIT_ITEM","Editar control");
define("EDIT","Editar");
define("_NEW","Nou");
define("FORM_DETAILS","Detalls del formulari");
define("TITLE","Títol:");
define("INTRO_TEXT","Text d&apos;introducció:");
define("AFTER_SUBMIT","Després d&apos;executar:");
define("REDIRECT_TO_URL","Redireccionar a Url");
define("SHOW_TNX_TEXT","Mostrar text d&apos;agraïment");
define("REDIRECT_URL","Url redireccionada:");
define("TNX_TEXT","Text d&apos;agraïment:");
define("PUBLISHING_TAB","Publicació");
define("PUBLISHING_INFO","Informació de publicació");
define("ACCESS","Accedir");
define("START_PUBLISHING","Inici de publicació");
define("FINISH_PUBLISHING","Fi de publicació");
define("IMAGES_TAB","Imatges");
define("IMAGE_INFO","Informació d&apos;imatge");
define('IMAGE_INFO_INFO',"Per usar una imatge aquí, pujar la imatge a ".$mosConfig_live_site."/images/stories");
define("IMAGE","Imatge");
define("THEMES_TAB","Temes");
define("THEME_INFO","Informació de Tema");
define("THEME","Tema");
define("BUTTONS_TAB","Botons");
define("FORM_BUTTONS","Botons del formulari");
define("SUBMIT_LABEL_TITLE","Etiqueta Executar");
define("INCLUDE_RESET","Incloure botó de Reset");

define('INCLUDE_PF',"Incloure botó d&apos;impressió");
define('INCLUDE_PDF',"Incloure botó de PDF");
define('INCLUDE_PF_INFO',"PerForms inclourà un botó d&apos;impressió adaptada amb el formulari, permetent que el formulari es pugui veure en una nova finestra popup");
define('INCLUDE_PDF_INFO',"PerForms inclourà un botó per generar PDF en el capçal quan es mostri.");
define('NO_PDF_INSTALLED', 'Html2PDF no instal·lat. PerForms no tindrà el botó PDF disponible.');
define('NO_PDF_INSTALLED_INFO', '<ul><li>Get it from <a href="http://sourceforge.net/projects/html2fpdf">SourceForge</a></li><li>PerForms will work fine without it.</li></ul>');

define('RESET_LABEL',"Etiqueta Reset");
define('EMAILS_TAB',"E-Mails"); 
define('EMAIL_FORM_TITLE',"Formulari d&apos;Email");
define('EMAIL_FORM',"Formulari d&apos;Email:");
define('EMAIL_FORM_INFO', "si SÍ perForms enviarà un email quan el formulari sigui executat.");
define('EMAIL_ADMIN',"Enviar còpia a admin:");
define('EMAIL_ADMIN_INFO', "si SÍ, perForms enviarà una còpia de l&apos;email a les adreces del camp &apos;to&apos; - si el camp està en blanc i borra c;Email Form&apos; és &apos;SÍ&apos;, un email és enviat a l&apos;administrador del lloc.");
define('EMAIL_USER',"Enviar còpia a l&apos;usuari:");
define('EMAIL_USER_INFO', "si SÍ, perForms enviarà un email a l&apos;usuari introduït al formulari. Observi que funcionarà automàticament amb els usuaris registrats. Si té elements anomenats <b>&apos;replyto&apos;</b> i <b>&apos;replytoName&apos;</b> s&apos;usaran els valors d&apos;aquests camps. Per defecte s&apos;ocultaran als usuaris registrats. Els visitants al lloc han de subministrar l&apos;adreça de correu en el formulari <b>&apos;replyto&apos;</b> i <b>&apos;replytoName&apos;</b> es mostraran als registrats si hi ha elements en el formulari.");
define('ENABLE_MAILFROM',"Allow mail spoofing:");
define('ENABLE_MAILFROM_INFO', "si SÍ, perForms intentarà enviar el missatge a l&apos;admin utilitzant el valor del camp anomenat <b>&apos;mailfrom&apos;</b> a la part &apos;FROM:&apos; del correu, si <b>&apos;mailfrom&apos;</b> és un element del formulari. Això no agrada tots els servidors de correu, per tant per defecte és &apos;NO&apos;.");
define("EMAIL_ALWAYS","Enviar malgrat error:");
define('EMAIL_ALWAYS_INFO', "si SÍ, perForms ignorarà errors i enviarà el correu igualment,");
define("FROM","De: (en blanc per usar el del SITE per defecte)");
define('FROM_INFO', "Si vols l&apos;adreça de <b>reply-to</b> e-mail perquè sigui la que l&apos;usuari usi en el formulari, aleshores deixi en blanc el paràmetre. Enlloc d&apos;afegir un camp per capturar l&apos;email al teu formulari (botó controls) i asseguri que <b>Nom</b> estigui establert a <b>mailfrom</b>");
define("TO","Per: (llista separada per comes)");
define('TO_INFO', 'Si vols que l&apos;adreça d&apos;e-mail <b>mail-to</b> que l&apos;usuari ha d&apos;escollir omplint en el fomulari (manualment si està creant una llista -drop down- d&apos;adreces d&apos;email) aleshores ha d&afegir l&apos;adreça d&apos;email <b>mail-to</b> en el següent paràmetre (per ser usada com a adreça d&apos;enviament per defecte). Aleshores afegeixi una llista de selecció de formulari (botó controls) amb adreces d&apos;email seleccionable per cada bústia i asseguri&apos;s que el <b>Nom</b> estigui marcada a <b>mailto</b>');
define("EMAIL_SUBJECT","Assumpte de l&apos;E-mail:");
define('EMAIL_SUBJECT_INFO', 'Si vol que l&apos;<b>Assumpte</b> de l&apos;email sigui únic (o establert mitjançant el formulari) deixi el paràmetre següent d&apos;<b>Assumpte</b> en blanc. Enlloc d&apos;afegir un camp d&apos;assumpte en el formulari (botó control) asseguri&apos;s que el <b>Nom</b> estigui establert a <b>Assumpte</b>. Altrament si afegeix un assumpte i encara té un camp d&apos;assumpte en el seu formulari, aleshores l&apos;assumpte s&apos;afegirà al que ha introduït l&apos;usuari');
define("INTRO_INCLUDE","Incloure text introductori:");
define('INTRO_INCLUDE_INFO', "si SÍ, l'entrada al formulari serà inclosa a l&apos;email.");
define('APPEND_TIMESTAMP', "Afegir temps");
define('APPEND_TIMESTAMP_INFO', "si SÍ, l'assumpte del correu inclourà la data i hora en què el formulari s'ha omplert.");

define("TABLE_ALREADY_CREATED","La taula ja ha sigut creada...");
define("CREATE_DATABASE_TABLE","Crear una taula a la base de dades..");
define("NOT_BOUND_TO_TABLE","Aquest formulari no està introduït a la base de dades .");
define("BOUND_TO_TABLE","Aquest formulari ja està a la base de dades . Nom de taula: ");
define("BOUND_INFO1","Quan lligues una taula a un formulari <strong>no</strong> pots agregar, editar o borrar elements del formulari.");
define("BOUND_INFO2","El nom de la taula <strong>no pot</strong> tenir espais, cometes o caràcters especials.");
define("TABLE_NAME","Nom de taula:");

define("DELETE_FORM_INFO1","Aquest formulari ja està assignat a '%s' " );
define("DELETE_FORM_INFO2","Si borres la taula, totes les dades s'eliminaran, inclosa la taula.");
define("DELETE_FORM_INFO3","NO ES POT RECUPERAR AQUESTA INFORMACIÓ UN COP ELIMINADA");
define("DELETE_TABLE","Borrar taula?");
define("FORM_ITEMS_DETAILS","Detalls deLs controls del formulari");
define("NO_SPECIAL_CHARS","Sense espais, cometes o caràcters especials!");
define("CHECK","Revisar");
define("HELP_TEXT","Text d'ajuda");
define("ERROR_MSG","Missatge d'error");
define("DISPLAY_TAB","Presentació");
define("DISPLAY_PROP","Propiedats de presentació");
define("SIZE1","Mida 1");
define("SIZE2","Mida 2");
define('SIZE1_INFO',"Amplada, columnes");
define('SIZE2_INFO',"Altura, files, <br/>Mida màxima de pujada (bytes)");
define("REQUIRED","Obligatori");
define('REQUIRED_INFO',"PerForms no permetrà executar un formulari si no s'omple aquest camp.");
define("DISABLED","Desabilitat");
define("READONLY","Només lectura");
define("MULTIPLE","Múltiples");
define('MULTIPLE_INFO',"Per ús amb elements &apos;seleccionats&apos;.");
define("VALUES_TAB","Valors");
define("VALUES_INFO","Informació dels valors");
define("MISSING_FIELD_TEXT","Test de camps perduts:");

// Errors
define("ITEMS_CANT_EDITED","Els controls d'aquest formulari no es poden editar!");
define("FORM_CURRENTLY_EDITED","Un altre administrador està editant el formulari %s .");
define("NO_FORM_FOUND","Formulari no trobat !");
define("SELECT_A_RECORD_TO","Seleccioni un registre a %s");
define("ALREADY_TABLE_EXISTS","La taula \'%s\' ja existeix; introdueixi un nom diferent.");
define("ERROR_OCCURRED","Ha succeït un error!");
define("DB_ERROR_OCCURRED","Error d'escriptura a la base de dades!");

define("TITLE_EMPTY","El títol està en blanc!");
define("TABLE_NAME_EMPTY","Ha d'introduir un nom per a la taula.");
define("DELETE_DATA_CONFIRM","Realment vol borrar TOTES LES DADES?");
define("CAPTION_EMPTY","L'etiqueta està buida.");
define("NAME_EMPTY","El nom està buit");
define("LIST_VALUES","Mostrar valors");
define("SELECTED_VALUE","Valors seleccionats");
define('SELECTED_VALUE_INFO',"El valor inicial seleccionat de l'element.");

define('PF_ERROR_18', "Session not persistent.");
define('PF_ERROR_18_COMMENT', 
       "<br /><ul><li>Es pot solucionar prement el botó enrere a la finestra del navegador, i "
       ."provar-ho altre cop. <cite>La sessió pot necessitar de reiniciar-se</cite><br /></li>"
       .'<li>També succeeix quan el protocol joomla global config setting "Live Site" '
       .'no coincideix amb l&apos;actual protocol (http / https)<br>'
       .'Veure <a href="http://forge.joomla.org/sf/go/post17630">'
       .'http://forge.joomla.org/sf/go/post17630</a></li>'
       .'<br><li>També es produeix una incidència puntural quan un usuari tanca la sessió de joomla, '
       .'i prova de mostrar la pantalla d&apos;impressió d&apos;un formulari clicant '
       .'l&apos;enllaç mostrat a l&apos;encapçalament del formulari (in "joomla mode") - a vegades '
       .'les sessions no s&apos;inicien immediatament... i està treballant per tancar '
       .'la finestra d&apos;impressió, i clica l&apos;element de menú altre cop (to bring '
                                                                      .'up the form), aleshores clicar '
       .'el botó d&apos;impressió, i la finestra popup hauria de funcionar.</li></ul>'
       );       
define('PF_ERROR_22', "Non-numeric formid.");
define('PF_ERROR_22_COMMENT',
       'Normalment causat per un enllaç url mal realitzat. '
       .'Veure <a href="http://forge.joomla.org/sf/go/post17395">'
       .'http://forge.joomla.org/sf/go/post17395</a>');

define('PF_ERROR_23', "Formulari no trobat.");
define('PF_ERROR_23_COMMENTA', "Un formulari amb l' id");
define("PF_ERROR_23_COMMENTB",
       @"no es pot trobar.<ul>
<li>Pot ser que no estigui autoritzat per veure aquest recurs, o
<li>Aquest formulari es pot haver caducat, despublicat o eliminat.</ul>");

define('FOR_MORE_HELP', 'Per més ajuda sobre l&apos;ús de PerForms, veure '
       .'la pàgina de PerForms, a <a href="http://www.performs.org.au/"> '
       .'performs.org.au</a>');

define("PF_ERROR_127", "Llista de paràmetres invàlida.");
define("PF_ERROR_127_COMMENT",
       'Normalment causat per paràmetres buits d&apos;un element de menú.'
       .'<ul><li>Recordi d&apos;afegir <strong>formid=1</strong> a la llista de '
       .'paràmetres (o l&apos; id corresponent o el formulari que desitja mostrar).'
       .'</li></ul>');

define("PF_ERROR_71", "Incapaç de crear directori de pujada!");
define("PF_ERROR_71_INFO", "El directori d&apos;on penja aquest formulari és invàlid, o incapaç de ser creat. Comprovi l&apos;adreça de pujada a 'values' tab of performs administrator.");


// MENU

define("DATABASE","Base de dades");
define("BOUNDDATA","Dades");
define("EXPORTTOEXCEL","Exportar");
define("PREVIEW","Visualitzar");
define("CLOSE","Tancar");
define("CANCEL","Cancelar");
define("DELETE","Borrar");
define("COPY_RECORD","Copiar");
define("NEW_ITEM","Nou control");
define("DELETE_ITEM_CONFIRM","Borrar control?");
define("SAVE","Guardar");

define('PRINTER_FRIENDLY', "Printer Friendly");
define('DOWNLOAD_PDF', "Baixar PDF");
define('ACCESSKEY', "Tecla accessible" );

define('PLEASE_FILL_OUT', 'Please fill out!');
define('BINDING', 'Binding');
define('EDIT_ITEMS', 'Editar controls');
define('UPGRADE_NEWS', 'Upgrade News');
define('IS_AVAILABLE', 'és disponible');
define('DOWNLOAD_FROM', 'Baixar desde');

define('SEP_COMMA', 'coma');
define('SEP_COMMASPACE', 'coma+espai');
define('SEP_HYPHEN', 'hyphen');
define('SEP_NEWLINE', 'nova línia');
define('SEP_SPACE', 'espai');

define('TY_EMAIL', 'email');
define('TY_FLOAT', 'float');
define('TY_INTEGER', 'enter');
define('TY_NAME', 'nom');
define('TY_STRING', 'text');
define('TY_URL', 'url');

define('ITEMTYPE_BUTTON', 'botó');
define('ITEMTYPE_CHECKBOX', 'checkbox');
define('ITEMTYPE_DATE', 'Data');
define('ITEMTYPE_FILE', 'fitxer');
define('ITEMTYPE_HIDDEN', 'ocult');
define('ITEMTYPE_IMAGE', 'imatge');
define('ITEMTYPE_PASSWORD', 'contrasenya');
define('ITEMTYPE_PAGEBREAK', 'salt de pàgina');
define('ITEMTYPE_RADIO', 'ràdio');
define('ITEMTYPE_SELECT', 'select');
define('ITEMTYPE_TEXT', 'text');
define('ITEMTYPE_TEXTAREA', 'textarea');
define('ITEMTYPE_TEXTUAL', 'textual');

define('VALUE_UP', "Up");
define('VALUE_UP_INFO', "Mou amunt l'element seleccionat dins de la llista.");
define('VALUE_DOWN', "Down");
define('VALUE_DOWN_INFO', "Mou avall l'element seleccionat dins de la llista.");
define('SET_AS_SELECTED_INFO', "Performs diubixarà l'element html de formulari amb aquest element seleccionat inicialment.");
define('REMOVE_INFO', "Eliminia l'opció seleccionada de la llista de valors.");

define('DISABLED_INFO', "si SÍ, perForms no dibuixarà aquest element.");
define('READONLY_INFO', "si Sí, perForms dibuixarà aquest element com a només lectura. No s'hi podrà escriure.");
define('VALUE_INFO',"Entri un valor en aquest camp i després cliqui el botó ".INSERT." per afegir-lo a la llista. Per elements <strong>".ITEMTYPE_FILE."</strong>, entri aquí la carpeta de pujada per defecte.");

define('SUBMIT_LABEL_INFO', "El text que apareix en el botó <b>executar</b>.");
define('INCLUDE_RESET_INFO', "si SÍ, perForms inclourà un botó <b>reset</b> al formulari.");
define('RESET_LABEL_INFO', "El text que apareix al botó <b>reset</b>.");
define('PUBLISHED_INFO', "si SÍ, el formulari estarà disponible als usuaris del lloc.");
define('ACCESS_INFO', "Defineixi el nivell d'accés per al formulari.");
define('START_PUBLISHING_INFO', "La data en què el fomrulari començarà a estar disponible als usuaris del lloc.");
define('FINISH_PUBLISHING_INFO', "La data en què el fomrulari deixarà d'estar disponible als usuaris del lloc. Si la data és 0000-00-00 00:00:00 el formulari estarà sempre disponible.");

define('CAPTION_INFO', "El text serà imprès com a etiqueta de l'element.");
define('ACCESSKEY_INFO', "La tecla accessible (o d'accessibilitat) estarà associada a cada element, el qual la gestionarà el navegador. Per tant, si la tecla accessible  és &apos;<b>k</b>&apos;, el Firefox hi anirà amb crtl-shift-k, i l'internet explorer amb alt-shift-k.");
define('NAME_INFO', "El nom intern del formulari. No pot contenir no alfa caràcters. Si aquest element s'anomena <b>bcc, cc, mailfrom, mailto, replyto</b> o <b>replytoName</b> el valor serà automàticament usat per enviar un email si el formulari està fet per a enviar emails.");
define('TYPE_INFO', "Seleccionar un tipus d'element dins de la llista. Cada tipus d'element té diferents propietats.<br /><ul><li>The <b>".ucfirst(ITEMTYPE_TEXTAREA)."</b> usa ".SIZE1." i ".SIZE2.@" per definir la seva amplada i altura.<br /></li><li>Els tipus <b>".ITEMTYPE_SELECT.", ".ITEMTYPE_RADIO." </b>i<b> ".ITEMTYPE_CHECKBOX."</b> han de tenir com a mínim un valor en la llista del control ".VALUES_TAB.".<br /></li><li>El control <strong>".ucfirst(ITEMTYPE_FILE)."</strong> usa <strong>".SIZE1."</strong> per l'amplada de l&apos;etiqueta de nom de fitxer, <strong>".SIZE2."</strong> per definir la mida màxima del fitxer de pujada i <strong>".VALUE."</strong> per la carpeta de pujada (on es guaden els fitxers).</li></ul>");
define('CHECK_INFO', "Seleccioni un validador per aquest element. Seleccionant un validador en blanc permetrà introduir qualsevol tipus de dades.");
define('HELP_TEXT_INFO', "El text d'ajuda que apareix amb aquest element.");
define('ERROR_MSG_INFO', "El missatge d'error que es mostra si hi ha un problema amb aquest element.");

define('REVERSE_ORDER', "Invertir Ordre");
define('SAVE_ORDER', "Guardar Ordre");
define('SWAP_SIZE_VARS', "Intercanviar Mida1 i Mida2 per tots els elements textarea");
define('NEW_SIZEVARS_SAVED', 'Noves variables de mida guardades.');
define('NEW_ORDERING_SAVED', 'Nou ordre guardat');


define('PF_LICENCE_INFO', 'perForms és programari lliure amb <a href="http://www.gnu.org/copyleft/gpl.html">GNU General Public License</a>.');
define('INSTALLATION_MESSAGES', 'Missatges d&apos;Instal·lació');
define('THANKS_FOR_CHOOSING', 'Gràcies per escollir PerForms.');
define('WE_NEED_TRANSLATORS', @"
<p>
PerForms is now fully localised, and we need translators! 
<a href=\"http://forge.joomla.org/sf/go/projects.performs/discussion.language_file_translations\">Help make PerForms global!</a>
</p>");
define('FOR_SUPPORT', @"
<p><b>For support, please visit the official support site at <a href=\"http://www.performs.org.au/\">http://www.performs.org.au/</a>.</b></p>
");
define('PERFORMS_FEATURES', @"
<p>Característiques incloses:</p>
<ul>
<li>Introdueix il·limitat nombre de camps</li>
<li>Escull entre 9 tipus de camp</li>
<li>Pujada de fitxers!</li>
<li>Formulari per enviar emails</li>
<li>Formulari de mail d'execució per l'usuari, i camps per a respondre i assumpte</li>
<li>Opcionalment es poden crear o separar taules de la base de dades per cada formulari</li>
<li>Validacions de camp</li>
<li>Formularis accessibles</li>
<li>Missatges d'error personalitzables</li>
<li>Missatges d'ajuda personalitzables per cada camp</li>
<li>Pàgina d'informe per veure els registres de la taula</li>
<li>Sistema de plantilles bàsica</li>
<li>Veure / Exportar dades des de l'administració</li>
<li>Veure versió imprimible des de la interfície d'usuari</li>
<li>Baixar PDF</li>
<li>Preparat per a Joomla 1.5</li>
</ul>
");
define('WELCOME_TO_PERFORMS', @"
<p>
PerForms fa més fàcil crear formularis personalitzats que poden ser enviats o guardats a la base de dades. Els resultats es poden veure des de l'admin com a csv.
</p>
".FOR_SUPPORT.PERFORMS_FEATURES.WE_NEED_TRANSLATORS);
define('NEW_FEATURES', @"
<strong>Noves característiques: </strong>
<ul>
<li>Accessibilitat</li>
<li>Icones Admin info</li>
<li>Bound Data Paging</li>
<li>Config</li>
<li>Camp de pujada de Fitxer</li>
<li>Errors amigables</li>
<li>Comprovar Versió</li>
</ul>
");
define('UPGRADE_MESSAGE', @"
<p>PerForms ha canviat! 
<ol><li><p><img src=\"images/reload_f2.png\" height=\"16\" width=\"16\" border=\"0\" /> The <strong>".REVERSE_ORDER.@"</strong> button.</p>Hauria de veure els controls en ordre invers, per fixar l&apos;ordre, premi el botó '<strong>"
       .REVERSE_ORDER."</strong>' dalt de la columna ".ORDER.@" en la vista del control.</li>
<li style=\"margin-top: 4pt;\"><p>
<img src=\"images/restore_f2.png\" border=\"0\" width=\"16\" height=\"16\" />
The <strong>".SWAP_SIZE_VARS.@"</strong> button.</p>
Hem canviat la forma en què els controls textare usen Mida1 i Mida2, per corregir els vostres textareas,
cliqueu al botó '<strong>".SWAP_SIZE_VARS."</strong>' dalt de les columnes de ".SIZE1." i ".SIZE2.@".</li></ol></p>
".WE_NEED_TRANSLATORS.NEW_FEATURES.FOR_SUPPORT);

define('SUCCESSFUL_UPGRADE', "PerForms actualitzat satisfactòriament ");
define('INS_WELCOME', "Benvingut!");
define('INS_SQL_STATEMENTS', "Seqüència SQL");
define('INS_SQL_ERRORS', "Errors SQL");

define('UPLOAD_ERROR_1', "El fitxer pujat excedeix la mida màxima establerta en la directiva upload_max_filesize de php.ini.");
define('UPLOAD_ERROR_1_INFO', @"El fitxer és major que el que permet la instal·lació de php.
<ul><li> Pregunti al seu administrador php/joomla per augmentar el valor de la mida màxima de fitxer (upload_max_filesize).</li></ul>");
define('UPLOAD_ERROR_2', "El fitxer pujat excedeix la mida màxima de fitxer d'acord amb la directiva MAX_FILE_SIZE especificada en el formulari HTML.");
define('UPLOAD_ERROR_2_INFO', "L'administrador ha establert la mida màxima de fitxer menor a la mida del seu fitxer.");
define('UPLOAD_ERROR_3', "El fitxer s'ha pujat només parcialment.");
define('UPLOAD_ERROR_3_INFO', "Un error de connexió ha provocat que el fitxer estigui incomplert al servidor. Provi-ho altre cop.");
define('UPLOAD_ERROR_4', "Cap fitxer no s'ha pujat.");
define('UPLOAD_ERROR_4_INFO', "Una causa desconeguda ha provocat un error en pujar el fitxer.");
define('UPLOAD_ERROR_5', "Error desconegut!!.");
define('UPLOAD_ERROR_5_INFO', "El codi php d'instal·lació ha generat un error no previst!");
define('UPLOAD_ERROR_6', "Falta una carpeta temporal. Introduït amb PHP 4.3.10 i PHP 5.0.3.");
define('UPLOAD_ERROR_6_INFO', "Aquesta instal·lació de php no té carpeta temporal establerta a php.ini.");
define('UPLOAD_ERROR_7', "S'ha fallat en escriure el fitxer al disc. Introduït amb PHP 5.1.0.");
define('UPLOAD_ERROR_7_INFO', "El servidor es pot haver quedat sense espai, o la carpeta temporal és només de lectura.");

define('SUCCESS', "Èxit!");
define('UPLOAD_SUCCESSFUL', "El fitxer és vàlid i s'ha pujat amb èxit.\n");
define('UPLOAD_SUCCESSFUL_INFO', "El fitxer s'ha pujat i guardat en un directori d'espera de l'administrador.");
define('ERROR_71', "Fitxer de pujada possiblement d'atac!\n");
define('ERROR_71_INFO', "El nom del fitxer o carpeta no és vàlid!");

define('UNKNOWN_SENDER', "Enviament desconegut");

define('IMAGEFLOAT', "Estil de posició d'imatge");
define('IMAGEFLOAT_INFO', "Estableix l'estil de posició de la imatge (css float: [left, right, none, inherit];)");
define('FLOAT_LEFT', 'Esquerra');
define('FLOAT_RIGHT', 'Dreta');
define('FLOAT_NONE', 'No');
define('FLOAT_INHERIT', 'Heredar-ho');

define('NOT_BOUND', "Not Bound!");
define('CLICK_BINDING_BUTTON', "Clicar el botó <b>Binding</b> per assignar una nova taula de base de dades.");

define('SHOW_UPLOADED_IMAGE', "Mostra imatge pujada");
define('SHOW_UPLOADED_IMAGE_INFO', "En mostrar via email la informació introduïda, els fitxers es mostren com un enllaç o com una imatge.");

define('SUBMIT', "Executar");
define('REPLACE_SUBMIT_BUTTON', "Substituir botó Executar");
define('REPLACE_SUBMIT_BUTTON_INFO', "Substitueix el botó d'executar per defecte, amb una imatge.");
define('SUBMIT_IMAGE_URL', "Url de la imatge Executar");
define('SUBMIT_IMAGE_URL_INFO', "Una adreça Url apuntant a la imatge que substituirà el botó d'executar per defecte.");
define('SUBMIT_IMAGE_WIDTH', "Amplada imatge Executar");
define('SUBMIT_IMAGE_WIDTH_INFO', "L'amplada (en nombre de píxels) de la imatge que substitueix el botó d'executar per defecte.");
define('SUBMIT_IMAGE_HEIGHT', "Altura imatge Executar");
define('SUBMIT_IMAGE_HEIGHT_INFO', "L'altura (en nombre de píxels) de la imatge que substitueix el botó d'executar per defecte.");

define('RESET', "Reset");
define('REPLACE_RESET_BUTTON', "Substituir el botó Reset");
define('REPLACE_RESET_BUTTON_INFO', "Substituir el botó reset per defecte per una imatge.");
define('RESET_IMAGE_URL', "Url d&apos;imatge Reset");
define('RESET_IMAGE_URL_INFO', "Una Url que apunta a la imatge que substiuirà el botó reset per defecte.");
define('RESET_IMAGE_WIDTH', "Reset amplada d&apos;imatge");
define('RESET_IMAGE_WIDTH_INFO', "L&apos;amplada de la imatge usada per reemplaçar el botó de reset.");
define('RESET_IMAGE_HEIGHT', "Reset altura d&apos;imatge");
define('RESET_IMAGE_HEIGHT_INFO', "L&apos;altura de la imatge usada per substituir el botó de reset.");

define('NOT_AUTHORIZED', "No està autoritzat a veure aquest recurs.");
define("NO_AUTH_MESSAGE", "Missatge de no autorització");
define("NO_AUTH_MESSAGE_INFO", "El missatge que presenta el formulari quan un usuari no autoritzat intenta veure&apos;l.");

define('USE_CONTAINER', "Usar contenidor");
define('USE_CONTAINER_INFO', @"En mostrar un formulari de perForms, el 
contenidor estàndard serà usat si SÍ. Si NO, els formularis de perForms poden ser
usats per substituir paraules individuals en una frase, per exemple.");
define('SHOW_FORM_TITLE', "Mostrar títol de formulari");
define('SHOW_FORM_TITLE_INFO', @"En mostrar perForms com a componenent,
estableix si mostra el títol sí/no.");
define('FORM_WIDTH', "Amplada de formulari");
define('FORM_WIDTH_INFO', 'L&apos;amplada del formulari quan es mostra. Poden ser entre "100px" o "35%" etc.');
define('FORM_DISPLAY', "Mostrar el formulari");
define('PRESENTATION_INFO', "Presentació");
define('INCLUDE_SUBMIT', "Incloure botó Executar");
define('INCLUDE_SUBMIT_INFO', "Mostra el botó Executar en el formulari.");
define('MAIL_AS_TEXT', "Correu com Text");
define('MAIL_AS_TEXT_INFO', "si SÍ, perForms enviarà les dades del formulari com un text &apos;raw&apos;, però recordi, si vol incloure la introducció en el correu, aquest no s&apos;enviarà en format Html.");

define('EXTRA_RECIPIENTS', "Bústies extres");
define('MAIL_OPTIONS', "Opcions de correu");

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
define('PFAUTO_USERNAME', "Nom d&apos;usuari");
define('PFAUTO_NAME', "Nom");
define('PFAUTO_USERTYPE', "Tipus d&usuari");
define('PFAUTO_REGISTERDATE', "Data de registre");
define('PFAUTO_LASTVISITDATE', "Darrera visita");
define('PFAUTO_USEREMAIL', "correu d&apos;usuari");
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



//define("Delete","Borrar");

?>