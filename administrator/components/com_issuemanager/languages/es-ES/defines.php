<?php
/*
 * %1$s = Nombre de aplicación
 *
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

define('TO_CUSTOMER_SUBJECT', 'Nuestro equipo de %1$s le ha enviado una respuesta a su ticket de incidencias num. %2$s');
define('TO_CUSTOMER_BODY', 'Estimado %1$s:' . "<br /><br />" . '
                            Esta es una notificaci&oacute;n desde %2$s de que ha recibido una contestaci&oacute;n a su incidencia n&uacute;mero %3$s.' . "<br /><br />" . '
                            Si desea leerla ahora mismo, puede hacerlo haciendo clic en el siguiente enlace a nuestra web:' . "<br />" . '
                            <a href="%4$s">%4$s</a>' . "<br /><br />" . '
                            Atentamente,' . "<br />" . '
                            %2$s');
define('TO_OPS_SUBJECT_NEW', 'Mensaje de %1$s: Nuevo ticket de incidencia n&uacute;mero %2$s recibido');
define('TO_OPS_BODY_NEW', 'Se ha recibido una nueva incidencia: ' . "<br /><br />" . '
                           N&uacute;mero de ticket: %2$s' . "<br /><br />" . '
                           Haga clic en el siguiente enlace si desea acceder directamente:' . "<br />" . '
                           <a href="%3$s">%3$s</a>' . "<br /><br />" . '
                           Un cordial saludo!' . "<br />" . '
                           %1$s');
define('TO_OPS_SUBJECT', 'Mensaje de %1$s: Recibida respuesta a ticket n&uacute;mero %2$s');
define('TO_OPS_BODY',     'Se ha recibido una nueva respuesta del usuario:' . "<br /><br />" . '
                           N&uacute;mero de Ticket: %2$s' . "<br /><br />" . '
                           Haga clic en el siguiente enlace si desea acceder directamente:' . "<br />" . '
                           <a href="%3$s">%3$s</a>' . "<br /><br />" . '
                           Un cordial saludo!' . "<br />" . '
                           %1$s');
?>
