<?php
/**
* @package		Joomla
* @subpackage	mod_vergefacebooklike
* @copyright	Copyright (C) 2010 Verge Studios. All rights reserved.
* @license		GNU/GPL.
* @author 		Max Neuvians [vergegraphics.com]
* @version 		1.0
* Joomla! and mod_vergefacebooklike are free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed they include or
* are derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*/
// no direct access
defined('_JEXEC') or die('Restricted access');

function CurrentPageURL()
{
$pageURL = $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://';
$pageURL .= $_SERVER['SERVER_PORT'] != '80' ? $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"] : $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
return $pageURL;
}

//Get url
//($params->get('autourl') == 'yes' ? $url = JURI::current() : $url = $params->get('url'));
($params->get('autourl') == 'yes' ? $url = CurrentPageURL() : $url = $params->get('url'));

?>
<div class="vergefacebooklike<?php echo $params->get('moduleclass_sfx'); ?>">

<?php if($params->get('output') == 'iframe'): ?>

<iframe src="http://www.facebook.com/plugins/like.php?href=<?= urlencode($url);?>
&amp;layout=<?= $params->get('layout');?>
&amp;show_faces=<?= ($params->get('show_faces') == 'yes' ? 'true' : 'false');?>
&amp;width=<?= $params->get('width');?>
&amp;action=<?= $params->get('verb');?>
&amp;font=<?= urlencode($params->get('font'));?>
&amp;colorscheme=<?= $params->get('color_scheme');?>
&amp;locale=<?= ($params->get('locale') == '' ? 'en_GB' : $params->get('locale'));?>"
scrolling="no"
frameborder="0"
allowTransparency="true"
style="border:none;
overflow:hidden;
width:<?= $params->get('width');?>px;
height:<?= $params->get('height');?>px">
</iframe>

<?php else: ?>

<fb:like href="<?= $url;?>"
         layout="<?= $params->get('layout');?>"
         show_faces="<?= ($params->get('show_faces') == 'yes' ? 'true' : 'false');?>"
         width="<?= $params->get('width');?>"
         action="<?= $params->get('verb');?>"
         font="<?= urlencode($params->get('font'));?>"
         colorscheme="<?= $params->get('color_scheme');?>"
/>

<?php endif; ?>

</div>