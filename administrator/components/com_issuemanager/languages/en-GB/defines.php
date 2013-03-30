<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

define('TO_CUSTOMER_SUBJECT', 'Our staff from %1$s has sent you a reply to your trouble ticket num. %2$s');
define('TO_CUSTOMER_BODY', 'Dear %1$s: ' . "<br /><br />" . '
                            You have received a reply to your incidence num. %3$s in the issue manager of %2$s.' . "<br />" . '
                            If you want to read it now, you can directly access our web by clicking on the link provided below:' . "<br />" . '
                            <a href="%4$s">%4$s</a>' . "<br /><br />" . '
                            Best regards,' . "<br />" . '
                            %2$s');
define('TO_OPS_SUBJECT_NEW', 'Message from %1$s: New Ticket number %2$s received');
define('TO_OPS_BODY_NEW', 'A new incidence has been reported: ' . "<br /><br />" . '
                           Ticket Number: %2$s' . "<br /><br />" . '
                           Click on the following link if you want to check it now:' . "<br />" . '
                           <a href="%3$s">%3$s</a>' . "<br /><br />" . '
                           Cheers!
                           %1$s');
define('TO_OPS_SUBJECT', 'Message from %1$s: reply to ticket number %2$s received');
define('TO_OPS_BODY',     'A new post has been added by the user: ' . "<br /><br />" . '
                           Ticket Number: %2$s' . "<br /><br />" . '
                           Click on the following link if you want to check it now:' . "<br />" . '
                           <a href="%3$s">%3$s</a>' . "<br /><br />" . '
                           Cheers!' . "<br />" . '
                           %1$s');
?>
