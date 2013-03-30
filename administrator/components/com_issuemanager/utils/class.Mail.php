<?php
/*
    Document   : class.Mail.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        File that defines the class MailUtils, intended to send the e-mail notifications, if activated
*/
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.mail.mail');
jimport('joomla.error.error');
require_once( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_issuemanager'.DS.'utils'.DS.'class.Language.php' );

/**
 *  class intended to send the e-mail notifications, if activated
 */
class MailUtils {

    private static $langUtils;
    private static $userData;
    private static $operatorsData;

    /**
     * Builds and stores an instance of class LanguageUtils in a static property
     */
    public function __construct() {
        // Get instance of class LanguageIM
        self::$langUtils = new LanguageUtils();
    }

    /**
     *  Sets up the required info to send the notification to the customer
     *
     * @param int $ticketid
     */
    public function send_to_user($ticketid) {
        // Get data from user (name and email)
        $this->getUserData($ticketid);
        // Get name of application
        $config =& JFactory::getConfig();
        $appName = $config->getValue('config.fromname');
        // Create subject and body of the notification
        $subject = sprintf(self::$langUtils->getSubject('to_customer'), $appName, self::$userData->ticket_number);
        $requestURI = str_replace('/administrator', '', $_SERVER['REQUEST_URI']);
        $body = sprintf(self::$langUtils->getBody('to_customer'), self::$userData->name, $appName, self::$userData->ticket_number, 'http://' . $_SERVER['HTTP_HOST'] . $requestURI . '?option=com_issuemanager&view=customer');
        // Create destination, sender and reply-to
        $to = self::$userData->email;
        $from = array($config->getValue( 'config.mailfrom' ), $config->getValue( 'config.fromname' ) );
        $replyTo = array();        // MLR - Added to provide correct ReplyTo parameter to mail function
        $replyTo[] = 'NoReply';       // MLR -
        $replyTo[] = 'no-reply' . strstr($from, '@'); // MLR -
        $this->sendNotice($subject, $body, $from, $to, null, null, $replyTo);
    }

    /**
     *  Sets up the required info to send the notification to the operators
     *
     * @param string $ticketNumber  String with the identifying number of the ticket (not the BC id, but the number which helps identify tickets)
     * @param boolean $is_new       Specifies whether the notification deals about a new ticket, or about a new post for an existent ticket
     */
    public function send_to_operators($ticketNumber, $is_new) {
        $operator = null;
        // Get data from operators
        $this->getOperatorsData();
        // Get name of application
        $config =& JFactory::getConfig();
        $appName = $config->getValue('config.fromname');
        // Get subject and body of the e-mail
        $toStr = ($is_new) ? 'to_ops_new' : 'to_ops';
        $subject = sprintf(self::$langUtils->getSubject($toStr), $appName, $ticketNumber);
        $body = sprintf(self::$langUtils->getBody($toStr), $appName, $ticketNumber, 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '?option=com_issuemanager&view=operator');
        // Create destination, sender and reply-to
        $to = '';
        foreach (self::$operatorsData as $operator) {
            $to .= ($to == '') ? '"' . $operator->name . '"<' . $operator->email . '>' : ', "' . $operator->name . '"<' . $operator->email . '>';
        }
        $from = array($config->getValue( 'config.mailfrom' ), $config->getValue( 'config.fromname' ) );
        $replyTo = array();        // MLR - Added to provide correct ReplyTo parameter to mail function
        $replyTo[] = 'NoReply';       // MLR -
        $replyTo[] = 'no-reply' . strstr($from, '@'); // MLR -
        $this->sendNotice($subject, $body, $from, $to, null, null, $replyTo);
    }

    /**
     * Send e-mail with necessary data
     *
     * @param string $subject
     * @param string $body
     * @param string $from
     * @param string $to
     * @param string $bcc
     * @param string $cc
     * @param string $replyTo
     */
    private function sendNotice($subject, $body, $from, $to, $bcc, $cc, $replyTo) {
        $mail =& JMail::getInstance();
		$mail->IsHTML(true);
        $mail->setSender($from);
        $mail->addRecipient($to);
        $mail->setSubject($subject);
        $mail->setBody($body);
        if ($bcc) $mail->addBCC($bcc);
        if ($cc) $mail->addCC($cc);
        if ($replyTo) $mail->addReplyTo($replyTo);
        $result = null;
        $result = &$mail->Send();
    }

    /**
     * Gets and stores the data of the user who built the specified ticket in a static property
     *
     * @param int $ticketid
     * @return boolean
     */
    private function getUserData($ticketid) {
        $db =& JFactory::getDBO();
        $query = "SELECT u.name, u.email, t.ticket_number FROM #__users u
                  INNER JOIN #__im_tickets t ON t.author_id=u.id
                  WHERE t.ticket_id=" . $ticketid;
        $db->setQuery($query);
        $userdata = $db->loadObject();
        if ($db->getErrorNum())
        {
            echo  $db->stderr();
            return false;
        }
        self::$userData = $userdata;
    }

    /**
     * Gets and stores in a static property the data of the enabled operators who are not blocked users either
     *
     * @return boolean
     */
    private function getOperatorsData() {
        $db =& JFactory::getDBO();
        $query = "SELECT u.name, u.username, u.email
                  FROM #__users u
                  INNER JOIN #__im_operators o
                  ON o.user_id=u.id
                  WHERE o.status=1 AND u.block=0";
        $db->setQuery($query);
        $operators = $db->loadObjectList();
        if ($db->getErrorNum())
        {
            echo  $db->stderr();
            return false;
        }
        self::$operatorsData = $operators;
    }
}
?>
