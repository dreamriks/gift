<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once (dirname(__FILE__).DS.'helper.php');

//global $mosConfig_absolute_path,$database,$mosConfig_live_site;
$folder 			= 	$params->get('folder','');
$startItem 			= 	$params->get('startItem',0);
//Main image
$mainWidth 		= 	$params->get('mainWidth',360);
$mainHeight 		= 	$params->get('mainHeight',240);

//Thumbnail info
$showItem 			= 	$params->get('showItem',0);
$thumbWidth 		= 	$params->get('thumbWidth',60);
$thumbHeight 		= 	$params->get('thumbHeight',60);
$thumbSpace 		= 	$params->get('thumbSpace','3:3');
$thumbSpaces = split(':', $thumbSpace);
$thumbSpaces[0] = isset ($thumbSpaces[0])?intval ($thumbSpaces[0]):3;
$thumbSpaces[1] = isset ($thumbSpaces[1])?intval ($thumbSpaces[1]):3;

$thumbOpacity 		=	$params->get('thumbOpacity','0.8');

//Animation
$duration 		= 	$params->get('duration',400);
$autoplay 		= 	$params->get('autoplay',false);
$interval 		= 	$params->get('interval',5000);
$effect 			= 	$params->get( 'effect', 'bounceOut');
$animation		= 	$params->get( 'animation', 'move');

//Description
$showDescription	= 	$params->get('showdesc', '');
$showdescwhen	= 	$params->get('showdescwhen', 'always');
$readmoretext	= 	$params->get('readmoretext', 'Readmore');
$descriptions 		= 	$params->get('description',"");
$descOpacity			= 	$params->get('descOpacity',0.8);

//Overlapping items
$container	= 	$params->get('container', 0);
$overlapOpacity	= 	$params->get('overlapOpacity', 0.4);

//Control buttons
$control	= 	$params->get('control', 0);

//Navigation
$navigation	= 	$params->get('navigation', '');

if (!defined ('_MODE_JASLIDESHOW_ASSETS_')) {
	define ('_MODE_JASLIDESHOW_ASSETS_', 1);
$css_path = modJaSlideshowHelper::getFile ('ja.slideshow2.css', 'modules/mod_jaslideshow2/assets/', '');
JHTML::stylesheet('', JURI::base().str_replace('\\','/',$css_path));
JHTML::_('behavior.mootools');	
?>
<script src="<?php echo JURI::base();?>modules/mod_jaslideshow2/assets/ja.slideshow2.js" type="text/javascript"></script>
<script src="<?php echo JURI::base();?>modules/mod_jaslideshow2/assets/ja.slideshow.js" type="text/javascript"></script>
<?php
}
if($showDescription){
	global $iso_client_lang;
	$descriptionArr = preg_split('/<lang=([^>]*)>/', $descriptions , -1 , PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
	$description = '';
	
	if(count($descriptionArr) > 1){
		for($i=0;$i<count($descriptionArr);$i=$i+2){
			if($descriptionArr[$i] == $iso_client_lang){
				$description = $descriptionArr[($i+1)];
				break;
			}
		}
		if(!$description){
			$description = $descriptionArr[1];
		}
	}
	else{
		$description = $descriptionArr[0];
	}
	
	//Parse description. Description in format: [desc img="imagename" url="link"]Description goes here[/desc]
	$descriptionArray = modJaSlideshowHelper::parseDescNew ($description);
	if (!count($descriptionArray)) $descriptionArray = modJaSlideshowHelper::parseDescOld ($description);	
}

$folder = modJaSlideshowHelper::checkURL($folder);
if(!$folder){ echo "This folder doesn't exsits."; }
else{
	if (trim($setimagearray) != "")	$images = explode(",", $setimagearray);
	else $images = modJaSlideshowHelper::getFileInDir($folder, $orderby, $sort );
	if (!$showItem || $showItem > count($images)) $showItem = count($images);
	if (count($images) > 0) {
		$listDescription = "";
		$items = array();
		$captionsArray = array();
		$urls = array();
		foreach($images as $k=>$img) {
			$imageArray[] = $folder.$img;
			$items[] = $k;
			if($showDescription) {
				$captionsArray[] = (isset($descriptionArray[$img]) && isset($descriptionArray[$img]['caption'])) ? str_replace("'", "\'", $descriptionArray[$img]['caption']) :'';
			}
			$url = JRoute::_((isset($descriptionArray[$img]) && isset($descriptionArray[$img]['url'])) ? $descriptionArray[$img]['url'] :'');
			$id = (isset($descriptionArray[$img]) && isset($descriptionArray[$img]['id'])) ? $descriptionArray[$img]['id'] :'';
			if ($id) $url = JRoute::_(ContentHelperRoute::getArticleRoute($id));
			$urls[] = $url;
		}
			
		//Build thumbnail
		if ($navigation=='thumbs') {
			if (function_exists('imagecreatetruecolor')) {
				$thumbArray = modJaSlideshowHelper::buildThumbnail ($imageArray, $thumbWidth, $thumbHeight);			
			} else {
				$thumbArray = $imageArray;
			}
		}
		$items = implode(',', $items);
		
		include(JModuleHelper::getLayoutPath('mod_jaslideshow2'));
	}
}