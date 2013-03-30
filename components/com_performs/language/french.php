<?php
/**
* @version $id: french.php,v 2.3
 * @package performs
 * @copyright (c) 2007 perForms
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @author David Walters (and FA)
 * Joomla is Free Software
 */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
if (defined("WELCOME_TO_PERFORMS")) return;

define("FORM", "Form");

define("SUBMIT_LABEL","Envoi");
define("PUBLISH","Publié");
define("UNPUBLISH","Dépublié");
define("NAME","Nom");
define("LINK","Lien");
define("ITEMS","Champs");
define("DB_TABLE_NAME","BD nom de la table");
define("DB_RECORDS","Enregistement BD");
define("PUBLISHED","Publié");
define("UNPUBLISHED","Dépublié");
define("SECURITYIMAGESHELP","Message d'aide sur l'image de sécurité");
define("SECURITYIMAGESERROR","Message d'erreur sur l'image de sécurité");

define("FORM_PREVIEW","Aperçu du formulaire");
define("DATE_TIME","Date");
define("NO_RECORDS_FOUND","Aucun enregistrement trouvé!");
define("FIELD_NAMES","Nom des champs");
define("SELECT_FIELDS","Sélectionnez les noms de champ que vous voulez inclure dans votre rapport..");
define("ALL","Tout");
define("INCLUDED_FIELDS","Les noms de champ inclus");
define("UP","Haut");
define("DOWN","Bas");
define("_PRINT","Imprimer");

define("USE_SECURITYIMAGES","Utiliser image de sécurité");
define('NO_SI_INSTALLED', 'com_securityimages n\'est pas installé');
define('NO_SI_INSTALLED_INFO', '<ul><li>Aller sur <a href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,1211/Itemid,35/">Joomla! Extensions</a></li><li>PerForms se combine très bien avec.</li></ul>');
define("EDIT_FORM","Éditer Formulaire");
define("ADD_EDIT_REMOVE","Ajouter, Éditer ou supprimer des champs");
define("CAPTION","légende");
define('USE_CAPTION',"Utiliser légende");
define('FIELD_SEPARATOR', "Séparateur de champ");
define('USE_CAPTION_INFO',"Quand les sorties formulaire est un email, perForms veut imprimer les noms des champ à côté de la valeur.");
define('FIELD_SEPARATOR_INFO', "When outputting form to email or form to text, this char will be used between option values.");
define("TYPE","Type");
define("ORDER","Trie");
define("REORDER","Re-Trie");
define('INSERT', "Inserer");
define('REMOVE', "Distant");
define('SET_AS_SELECTED', "Mettez comme Sélectionné");
define("VALUE","Valeur");
define('VALUE_INFO',"Entrez une valeur dans ce champ et cliquez sur le bouton ".INSERT." pour ajouter a la liste.");
define("EDIT_ITEM","Éditer champ");
define("EDIT","Éditer");
define("_NEW","Nouveau");
define("FORM_DETAILS","Détails du formulaire");
define("TITLE","Titre:");
define("INTRO_TEXT","Texte d'introduction:");
define("AFTER_SUBMIT","Après soumission:");
define("REDIRECT_TO_URL","URL de redirection");
define("SHOW_TNX_TEXT","Afficher le message de remerciement");
define("REDIRECT_URL","URL de redirection:");
define("TNX_TEXT","Texte de remerciement:");
define("PUBLISHING_TAB","Publié");
define("PUBLISHING_INFO","Info de publication");
define("ACCESS","Access");
define("START_PUBLISHING","Début publication");
define("FINISH_PUBLISHING","Fin publication");
define("IMAGES_TAB","Images");
define("IMAGE_INFO","Image Info");
define('IMAGE_INFO_INFO',"Pour utiliser une image personelle ici, transférer votre image sur ".$mosConfig_live_site."/images/stories");
define("IMAGE","Image");
define("THEMES_TAB","Thèmes");
define("THEME_INFO","Thème Info");
define("THEME","Thème");
define("BUTTONS_TAB","Boutons");
define("FORM_BUTTONS","Boutons du formulaire");
define("SUBMIT_LABEL_TITLE","Étiquette de soumettre");
define("INCLUDE_RESET","Inclure le bouton reset");
define("INCLUDE_PF","Inclure le bouton imprimer");
define("INCLUDE_PDF","Inclure le bouton PDF");
define('INCLUDE_PF_INFO',"PerForms inclura un bouton Imprimer dans l\'en-tête du formulaire, permettant au formulaire d\'être afficher dans un popup.");
define('INCLUDE_PDF_INFO',"PerForms inclura un bouton PDF dans l'en-tête du formulaire.");
define('NO_PDF_INSTALLED', 'Html2PDF not installed. PerForms will not have PDF button available.');
define('NO_PDF_INSTALLED_INFO', '<ul><li>Get it from <a href="http://sourceforge.net/projects/html2fpdf">SourceForge</a></li><li>PerForms will work fine without it.</li></ul>');
define("RESET_LABEL","Étiquette du Reset");
define("EMAILS_TAB","E-Mails");
define("EMAIL_FORM_TITLE","Formulaire e-mail");
define("EMAIL_FORM","Email Form:");
define('EMAIL_FORM_INFO', "Si oui, perForms enverra un e-mail quand ce formulaire est soumis.");
define("EMAIL_ALWAYS","Envoyez même si erreur:");
define('EMAIL_ALWAYS_INFO', "Si oui, perForms ignorera les erreurs et enverra le mail dans tout les cas,");
define("FROM","De: <small>(Laisser vide pour utiliser les paramètres par défaut)</small>");
define('FROM_INFO', "Si vous voulez que l\'adresse d\'E-mail de <b>répondre à</b> soit celui de l\'utilisateur complétant le formulaire alors laissez le vide. Puis ajoutez un champ E-mail à votre formulaire (étiquette du champ) et s\'assurer que la valeur de <b>Nom</b> soit <b>mailfrom</b>");
define("TO","A: <small>(liste séparée par une virgule)</small>");
define('TO_INFO', 'Si vous voulez que une adresse mail de <b>mail-to</b> soit choisie par l utilisateur complétant le formulaire (créer un menu pool-down avec une liste de contacts vers des destinataires E-mail) puis ajouter votre address email de <b>mail-to</b> dans le paramater ci-dessus en tant que normale (être utilisé par défaut envoyer une adresse). Alors ajouter une liste à choix à votre formulaire (étiquette du champ) avec les adresses mail sélectionnable pour chaque destinataire et s`assurer que la valeur de <b>Nom</b> soit <b>mailto</b> ');
define("EMAIL_SUBJECT","Sujet du mail:");
define('EMAIL_SUBJECT_INFO', 'Si vous voulez que le <b>suject</b> du mail soit unique (ou définis par l`utilisateur complétant le formulaire) alors le paramètre du <b>sujet</b> doit rester vide. Ensuite, ajoutez un champ sujet dans le formulaire (étiquette du champs) et assurez-vous que la valeur du <b>Nom</b> soit <b>subject</b>. alternativement si vous ajoutez un sujet ici et voulez toujours un champ sujet dans votre formulaire alors que le sujet inscrit ici sera apposé au sujet supplémentaire par l`utilisateur.');
define("INTRO_INCLUDE","Introduction:");
define('INTRO_INCLUDE_INFO', "Si oui, l\'introduction de formulaire sera incluse dans l\'email.");
define('APPEND_TIMESTAMP', "Apposer un horodateur");
define('APPEND_TIMESTAMP_INFO', "Si oui, le sujet du mail sera apposé avec la date et temps où le formulaire a été soumis.");

define("TABLE_ALREADY_CREATED","Table déjà créée...");
define("CREATE_DATABASE_TABLE","Créer une table dans la BD..");
define("NOT_BOUND_TO_TABLE","Cette forme n'est pas actuellement liée à une table de base de données.");
define("BOUND_TO_TABLE","Ce formulaire est actuellement liée à une table de base de données. Nom de la table :  ");
define("BOUND_INFO1","Quand vous liez une table à une forme que vous <strong>ne</strong> pouvez <strong>pas</strong> ajouter, éditer ou supprimer les éléments du formulaire. ");
define("BOUND_INFO2","Le nom de la table <strong>ne doit pas</strong> contenir d'espace, blanc ou ou caractères spéciales.");
define("TABLE_NAME","Nom de la table:");

define("DELETE_FORM_INFO1","Ce formulaire est déjà obligé '%s' " );
define("DELETE_FORM_INFO2","Si vous effacez la Table, tous les données seront perdus, et la table sera aussi effacée.");
define("DELETE_FORM_INFO3","IL Y A AUCUNE FAÇON DE RESTAURER CES RENSEIGNEMENTS UNE FOIS EFFACÉE");
define("DELETE_TABLE","Supprimez la table?");
define("FORM_ITEMS_DETAILS","Détails des champs du formulaire");
define("NO_SPECIAL_CHARS","Aucuns espaces, blanc ou caractères spéciales!");
define("CHECK","Contrôle");
define("HELP_TEXT","Texte d'aide");
define("ERROR_MSG","Message d'erreur");
define("DISPLAY_TAB","Afficher");
define("DISPLAY_PROP","Afficher propriétés");
define("SIZE1","Taille 1");
define("SIZE2","Taille 2");
define('SIZE1_INFO',"Largeur, Colonnes");
define('SIZE2_INFO',"Hauteur, Lignes");
define("REQUIRED","Obligatoire");
define('REQUIRED_INFO',"PerForms ne permettra pas à un formulaire d\'être soumis à moins que ce champ soit rempli.");
define("DISABLED","Désactivé");
define("READONLY","lire uniquement");
define("MULTIPLE","Multiple");
define('MULTIPLE_INFO',"Pour utiliser avec \'Sélectionner\' un élement.");
define("VALUES_TAB","valeurs");
define('VALUES_INFO',"Info valeurs");
define("MISSING_FIELD_TEXT","Le texte de champ manquant:");

// Errors
define("ITEMS_CANT_EDITED","Les champs de ce formulaire ne peuvent pas être édités!");
define("FORM_CURRENTLY_EDITED","Le formulaire %s est en cours d'édition par un autre administrateur actuellement.");
define("NO_FORM_FOUND","Aucun formulaire trouvé.");
define("SELECT_A_RECORD_TO","Sélectionnez un enregistrement à %s");
define("ALREADY_TABLE_EXISTS","La table \'%s\' existe déjà, s'il vous plaît donnez un nom différent.");
define("ERROR_OCCURRED","Une erreur s'est produite!");
define("DB_ERROR_OCCURRED","Erreur d'écriure dans la base de données!");
define("TITLE_EMPTY","Titre est vide!");
define("TABLE_NAME_EMPTY","Vous devez fournir un nom de table.");
define("DELETE_DATA_CONFIRM","Vous voulez-vous vraiment effacer TOUT le DONNÉES?");
define("CAPTION_EMPTY","Etiquette vide.");
define("NAME_EMPTY","Nom est vide");
define("LIST_VALUES","Listes des valeurs");
define("SELECTED_VALUE","Sélectionner valeur initiale");
define('SELECTED_VALUE_INFO',"La valeur initiale sélectionnée de l\'élément.");

define("PF_ERROR_18", "Session non persistante.");
define("PF_ERROR_18_COMMENT", 
       "<br /><ul><li>Peut être résolu en utilisant le bouton retour du navigateur et "
       ."essaier encore. <cite>La session peut devoir être redémarrer.</cite><br /></li>"
       .'<ul><li>Peut aussi ce produire dans la config global de Joomla "Live Site" '
       .'protocole n\'égale pas protocole courant (http / https)<br />'
       .'Voir <a href="http://forge.joomla.org/sf/go/post17630">'
       .'http://forge.joomla.org/sf/go/post17630</a></li><br />'
       .'<br /><li>Autre erreur intermittente quand un utilisateur coupe sa session '
       .'de joomla, et essaie d\'afficher printer-friendly en cliquant le lien '
       .'affiché dans le formulaire (dans "joomla mode") - quelquefois les sessions'
       .'ne sont pas initialisées immédiatement... la zone de travail est fermer la fenêtre '
       .' printer-friendly, et cliquer encore l\'objet du menu (ouvre le formulaire), '
       .'alors cliquez sur bouton printer-friendly,  '
       .'et les popup devraient s\'ouvrir.</li></ul>'
       );       
define("PF_ERROR_22", "Formulaire non-numérique.");
define("PF_ERROR_22_COMMENT",
       'Habituellement causé par une URL du lien mal formé. '
       .'Voir <a href="http://forge.joomla.org/sf/go/post17395">'
       .'http://forge.joomla.org/sf/go/post17395</a>');

define("PF_ERROR_23", "Aucun formulaire trouvé.");
define("PF_ERROR_23_COMMENTA", "Un formulaire avec ID");

//please re-translate!
//define("PF_ERROR_23_COMMENTB",
//       'n`a pu être trouvé.<br>Ce formulaire a pu expirer, dépublié, ou enlevée.'       
//       );
define("PF_ERROR_23_COMMENTB",
       @"cannot be found.<ul>
<li>You may not be authorised to view this resource, or
<li>This form may have expired, been unpublished, or removed.</ul>");

define("FOR_MORE_HELP", 'Pour obtenir plus d aide sur PerForms, voir '
       .'la page d`accueil PerForm, sur <a href="http://www.performs.org.au"> '
       .'http://www.performs.org.au </a>');

define("PF_ERROR_127", "Invalid Parameter List.");
define("PF_ERROR_127_COMMENT",
       'Usually caused by missing parameters for a "Component" menu item. '
       .'<ul><li>Remember to add <strong>formid=1</strong> to the list of '
       .'parameters (or the id corresponding to the form you wish to display).'
       .'</li></ul>');
define("PF_ERROR_71", "Unable to create uploads directory!");
define("PF_ERROR_71_INFO", "The holding directory for this form is invalid, or unable to be created. Please check the upload path in the 'values' tab of performs administrator.");


// MENU

define("DATABASE","Base de donnée");
define("BOUNDDATA","donnée");
define("EXPORTTOEXCEL","Exporter");
define("PREVIEW","Aperçu");
define("CLOSE","Fermer");
define("CANCEL","Annuler");
define("DELETE","Supprimer");
define("COPY_RECORD","Copier");
define("NEW_ITEM","Nouveau champ");
define("DELETE_ITEM_CONFIRM","Êtes-vous sûr de vouloir supprimer ce champ?");
define("SAVE","Sauver");

define("PRINTER_FRIENDLY", "Impression");
define("DOWNLOAD_PDF", "PDF");
define("ACCESSKEY", "CléAccès" );

define('PLEASE_FILL_OUT', 'SVP Compléter!');
define('BINDING', 'Lier');
define('EDIT_ITEMS', 'Éditer élément');
define('UPGRADE_NEWS', 'Nouvelles de mise à niveau');
define('IS_AVAILABLE', 'Est disponible');
define('DOWNLOAD_FROM', 'Télécharger depuis');

define('SEP_COMMA', 'virgule');
define('SEP_COMMASPACE', 'virgule+espace');
define('SEP_HYPHEN', 'trait d\'union');
define('SEP_NEWLINE', 'Nouvelle ligne');
define('SEP_SPACE', 'espace');

define('TY_EMAIL', 'email');
define('TY_FLOAT', 'float');
define('TY_INTEGER', 'nombre entier');
define('TY_NAME', 'nom');
define('TY_STRING', 'string');
define('TY_URL', 'URL');

define('ITEMTYPE_BUTTON', 'bouton');
define('ITEMTYPE_CHECKBOX', 'Case à coché');
define('ITEMTYPE_DATE', 'date');
define('ITEMTYPE_FILE', 'fichier');
define('ITEMTYPE_HIDDEN', 'caché');
define('ITEMTYPE_IMAGE', 'image');
define('ITEMTYPE_PASSWORD', 'Mot de passe');
define('ITEMTYPE_PAGEBREAK', 'Changement de page');
define('ITEMTYPE_RADIO', 'radio');
define('ITEMTYPE_SELECT', 'sélection');
define('ITEMTYPE_TEXT', 'texte');
define('ITEMTYPE_TEXTAREA', 'aire de texte');
define('ITEMTYPE_TEXTUAL', 'textuel');

define('VALUE_UP', "Haut");
define('VALUE_UP_INFO', "Déplace l'élément choisi vers le haut dans la liste.");
define('VALUE_DOWN', "bas");
define('VALUE_DOWN_INFO', "Déplace l'élément choisi vers le bas dans la liste.");
define('SET_AS_SELECTED_INFO', "perForms générera les éléments du formulaire HTML avec ce champ choisi préalablement.");
define('REMOVE_INFO', "Enlever l'option sélectionner de la liste de valeurs.");

define('DISABLED_INFO', "Si oui, perForms ne générera pas cet élément.");
define('READONLY_INFO', "Si oui, perForms généreara cet élément comme élément en lecture seul. Il ne peut pas être modifier.");

define('SUBMIT_LABEL_INFO', "Le texte a apparaître sur le bouton \&apos;<b>envoi</b>\&apos; du formulaire.");
define('INCLUDE_RESET_INFO', "Si oui, perForms incluera le bouton \&apos;<b>annuler</b>\&apos; dans le formulaire.");
define('RESET_LABEL_INFO', "Le texte a apparaître sur le bouton \&apos<b>annuler</b>\&apos; du formulaire.");
define('PUBLISHED_INFO', "Si oui, le formulaire sera disponible aux utilisateurs du site.");
define('ACCESS_INFO', "Définir le niveau d'accès pour le formulaire.");
define('START_PUBLISHING_INFO', "La date de mise a disposition du formulaire pour les utilisateurs du site.");
define('FINISH_PUBLISHING_INFO', "La date fin de mise a disposition du formulaire pour les utilisateurs du site. Si la date est 0000-00-00 00:00:00 le formulaire est toujours disponible.");

define('CAPTION_INFO', "Le texte qui sera affiché comme légende de l'élément.");
define('ACCESSKEY_INFO', "La clé d'accès qui sera associée avec l'élément qui est tracer à une combinaison clé par le navigateur. Donc unu clé d'accès de \&apos;<b>k</b>\&apos tracera à crtl-shift-k pour firefox, alt-shift-k pour internet explorer.");
define('NAME_INFO', "Le nom interne de l'élément. Ne doit pas contenir de caractères non-alpha. Si cet élément est nommé <b>bcc, cc, mailfrom, mailto, replyto </b>or <b>replytoName</b> la valeur sera utilisée automatiquement pour envoyer un email si le formulaire est un envoi de email.");
define('TYPE_INFO', "Sélectionnez un type d'élément de la liste,. Différents types d'élément supporte différentes propriétés. Le <b>".ucfirst(ITEMTYPE_TEXTAREA)."</b> utilise ".SIZE1." et ".SIZE2." pour définir la largeur et la hauteur. les types <b>".ITEMTYPE_SELECT.", ".ITEMTYPE_RADIO." </b>et<b> ".ITEMTYPE_CHECKBOX."</b> oivent avoir au moins une valeur dans l'élément ".VALUES_TAB." list.");
define('CHECK_INFO', "Sélectionnez un validator pour cet élément. Sélectionner le validator vide qui autorisera tous les types de données.");
define('HELP_TEXT_INFO', "Le texte d'aide qui s'affiche avec l'élément.");
define('ERROR_MSG_INFO', "Le message d'erreur qui s'affiche dès qu'il y a un problème avec un élément.");

define('REVERSE_ORDER', "Ordre inverse");
define('SAVE_ORDER', "Sauve Ordre");

define('PF_LICENCE_INFO', 'perForms est logiciel libre d\'utilisation, licence sous <a href="http://www.gnu.org/copyleft/gpl.html">GNU General Public License</a>.');
define('INSTALLATION_MESSAGES', 'Messages d\'installation');
define('THANKS_FOR_CHOOSING', 'Merci d\'avoir choisis PerForms.');
define('WE_NEED_TRANSLATORS', @"
<p>
PerForms est maintenant entièrement localisé, et nous avons besoin de traducteurs! 
<a href=\"http://forge.joomla.org/sf/go/projects.performs/discussion.language_file_translations\">L'aide rend PerForms global!</a>
</p>");
define('FOR_SUPPORT', @"
<p><b>Pour le support, SVP connectez-vous sur le site de support officiel sur <a href=\"http://www.performs.org.au/\">http://www.performs.org.au/</a>.</b></p>
");
define('PERFORMS_FEATURES', @"
<p>Possibilités inclusent:</p>
<ul>
<li>Champs de saisie illimités</li>
<li>Choisissez entre 8 types de champs</li>
<li>Fonction de formulaire e-mail</li>
<li>L'adresse de l'expéditeur (mail-from), champss répondre et sujet</li>
<li>Facultativement créez une table dans la base de données séparée pour chaque formulaire</li>
<li>Champs de validation</li>
<li>Accessibilité des formulaires</li>
<li>Message d'erreur personalisable</li>
<li>Messages d'aide pour chaque champs personalisable</li>
<li>Page de rapport pour afficher les enregistrements de la table</li>
<li>Modèle basic du système</li>
<li>Afficher / Exporter données enregistrées dans Administrator</li>
<li>Vue imprimable depuis le fronend</li>
<li>Télécharger  PDF</li>
<li>Joomla 1.5 prêt</li>
</ul>
");
define('WELCOME_TO_PERFORMS', @"
<p>
PerForms facilite la création de formulair qui peuvent être des courriles ou sauver dans une base de données. Les résultats peuvent être affiché dans le backend ou peuvent être téléchargés comme csv.
</p>
".FOR_SUPPORT.PERFORMS_FEATURES.WE_NEED_TRANSLATORS);
define('NEW_FEATURES', @"
<strong>Nouvelles possibilités: </strong>
<ul>
<li>Accessibilité</li>
<li>Icons d'information dans le backend</li>
<li>Pagination liée aux données</li>
<li>Configuration</li>
<li>Erreurs conviviale</li>
<li>Contrôle de version</li>
</ul>
");
define('UPGRADE_MESSAGE', @"
<p>PerForms a changer! 
Vous pouvez voir vos éléments sont dans ordre invers, inverser l'ordre, simplement en cliquant sur le bouton "
       .REVERSE_ORDER." en haut de ".ORDER.@" colone de la vue des éléments.</p>
".WE_NEED_TRANSLATORS.NEW_FEATURES.FOR_SUPPORT);

define('SUCCESSFUL_UPGRADE', "Mise à jour avec succès depuis PerForms ");
define('INS_WELCOME', "Bienvenu!");
define('INS_SQL_STATEMENTS', "État SQL");
define('INS_SQL_ERRORS', "Ereurs SQL");


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



//define("Delete","Supprimer");
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