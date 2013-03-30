<?php
/**
* @Copyright Freestyle Joomla (C) 2010
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
*     
* This file is part of Freestyle Testimonials
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
**/
?>
<?php

/**
 * The reCAPTCHA server URL's
 */
define("fst_RECAPTCHA_API_SERVER", "http://api.recaptcha.net");
define("fst_RECAPTCHA_API_SECURE_SERVER", "https://api-secure.recaptcha.net");
define("fst_RECAPTCHA_VERIFY_SERVER", "api-verify.recaptcha.net");

// Captcha stuff
global $fst_publickey,$fst_privatekey;
$fst_publickey = FST_Settings::get('recaptcha_public');
$fst_privatekey = FST_Settings::get('recaptcha_private');

if (!$fst_publickey) $fst_publickey = "6LcQbAcAAAAAAHuqZjftCSvv67KiptVfDztrZDIL";
if (!$fst_privatekey) $fst_privatekey = "6LcQbAcAAAAAAMBL5-rp10P3UQ31kpRYLhUFTsqK ";


if (!function_exists ("fst__recaptcha_qsencode"))
	require_once (JPATH_SITE.DS.'components'.DS.'com_fst'.DS.'helper'.DS.'recaptcha_api.php');

?>
