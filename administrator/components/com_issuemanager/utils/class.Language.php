<?php
/*
    Document   : class.Language.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        Defines the class LanguageUtils, which depending on the language used, directs to the corresponding path to that language
        in order to allow the inclusion of the different language files used in the e-mail notifications
*/
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Depending on the language used, directs to the corresponding path to that language
   in order to allow the inclusion of the different language files used in the e-mail notifications
 */
class LanguageUtils {
    
    private $languageTag;
    private $subjects;
    private $bodies;

    /**
     * Checks whether the specified path to a file exists for the current language, and if so, the file is included
     * and builds the arrays containing the values for the different parts of the e-mail (subject and body)
     */
    function __construct() {
        $lang = JFactory::getLanguage();
        $this->languageTag = $lang->getTag();
        if (require_once(JPATH_ADMINISTRATOR . DS .'components' . DS . 'com_issuemanager' . DS . 'languages' . DS . $this->languageTag . DS . 'defines.php')) {
            $this->subjects = array(
                'to_customer' => TO_CUSTOMER_SUBJECT,
                'to_ops_new' => TO_OPS_SUBJECT_NEW,
                'to_ops' => TO_OPS_SUBJECT
            );
            $this->bodies = array(
                'to_customer' => TO_CUSTOMER_BODY,
                'to_ops_new' => TO_OPS_BODY_NEW,
                'to_ops' => TO_OPS_BODY
            );
        }
    }

    /**
     * Provides value of subject corresponding to specified key
     *
     * @param string $key
     * @return string
     */
    function getSubject($key) {
        return $this->subjects[$key];
    }

    /**
     * Provides value of e-mail body corresponding to specified key
     *
     * @param string $key
     * @return string
     */
    function getBody($key) {
        return $this->bodies[$key];
    }
}
?>
