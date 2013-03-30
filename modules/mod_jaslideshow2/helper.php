<?php
/*------------------------------------------------------------------------
# JA Cooper for Joomla 1.5 - Version 1.0 - Licence Owner JA108425
# ------------------------------------------------------------------------
# Copyright (C) 2004-2008 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
# @license - Copyrighted Commercial Software
# Author: J.O.O.M Solutions Co., Ltd
# Websites:  http://www.joomlart.com -  http://www.joomlancers.com
# This file may not be redistributed in whole or significant part.
-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die('Restricted access');
if(!defined('_JA_SLIDESHOW_HELPER_')){
	define ('_JA_SLIDESHOW_HELPER_', 1);

	class modJaSlideshowHelper
	{
		function processImage ( &$img, $width, $height, $crop=1) {
			if(!$img) return;
			
			$img = str_replace(JURI::base(),'',$img);
			$img = str_replace("'",'',$img);
			$img = rawurldecode($img);
			$imagesurl = (file_exists(JPATH_SITE .'/'.$img)) ? modJaSlideshowHelper::jaResize($img,$width,$height, $crop) :  '' ;
			return $imagesurl;
		}
    
		function jaResize($image,$max_width,$max_height, $crop=1){
			$path =JPATH_SITE; 
			$imgInfo = getimagesize($path.'/'.$image);
			$width = $imgInfo[0];
			$height = $imgInfo[1];
			if(!$max_width && !$max_height) {
        $max_width = $width;
        $max_height = $height;
      }else{
        if(!$max_width) $max_width = 1000;
        if(!$max_height) $max_height = 1000;
      }
			$x_ratio = $max_width / $width;
			$y_ratio = $max_height / $height;
			$dst = new stdClass();
			$src = new stdClass();
			$src->y = $src->x = 0;
			$dst->y = $dst->x = 0;
			if ($crop) {
				$dst->w = $max_width;
				$dst->h = $max_height;
				if (($width <= $max_width) && ($height <= $max_height) ) {
					$src->w = $max_width;
					$src->h = $max_height;
				}else{
					if ($x_ratio < $y_ratio) {
						$src->w = ceil($max_width/$y_ratio);
						$src->h = $height;
					} else {
						$src->w = $width;
						$src->h = ceil($x_ratio*$height);
					}
				}
				$src->x = floor(($width-$src->w)/2);
				$src->y = floor(($height-$src->h)/2);
			} else {
				$src->w = $width;
				$src->h = $height;
				if (($width <= $max_width) && ($height <= $max_height) ) {
					$dst->w = $width;
					$dst->h = $height;
				} else if (($x_ratio * $height) < $max_height) {
					$dst->h = ceil($x_ratio * $height);
					$dst->w = $max_width;
				} else {
					$dst->w = ceil($y_ratio * $width);
					$dst->h = $max_height;
				}
			}

			$ext = strtolower(substr(strrchr($image, '.'), 1)); // get the file extension
			$rzname = strtolower(substr($image, 0, strpos($image,'.')))."_{$dst->w}_{$dst->h}.{$ext}"; // get the file extension
			//
			$resized = $path.'/images/resized/'.$rzname; 
			if(file_exists($resized)){
				$smallImg = getimagesize($resized);
				if (($smallImg[0] <= $dst->w && $smallImg[1] == $dst->h) ||
					($smallImg[1] <= $dst->h && $smallImg[0] == $dst->w)) {
						return "images/resized/".$rzname;
				}
			}
			if(!file_exists($path.'/images/resized/') && !mkdir($path.'/images/resized/',0755)) return '';
			$folders = explode('/',strtolower($image));
			$tmppath = $path.'/images/resized/';
			for($i=0;$i < count($folders)-1; $i++){
				if(!file_exists($tmppath.$folders[$i]) && !mkdir($tmppath.$folders[$i],0755)) return '';
				$tmppath = $tmppath.$folders[$i].'/';
			}	

					
		 switch ($imgInfo[2]) {
		  case 1: $im = imagecreatefromgif($path.'/'.$image); break;
		  case 2: $im = imagecreatefromjpeg($path.'/'.$image);  break;
		  case 3: $im = imagecreatefrompng($path.'/'.$image); break;
		  default: return '';  break;
		 }
					
		 $newImg = imagecreatetruecolor($dst->w, $dst->h);
		 
		 /* Check if this image is PNG or GIF, then set if Transparent*/  
		 if(($imgInfo[2] == 1) OR ($imgInfo[2]==3)){
		  imagealphablending($newImg, false);
		  imagesavealpha($newImg,true);
		  $transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
		  imagefilledrectangle($newImg, 0, 0, $dst->w, $dst->h, $transparent);
		 }
		 imagecopyresampled($newImg, $im, $dst->x, $dst->y, $src->x, $src->y, $dst->w, $dst->h, $src->w, $src->h);

			//Generate the file, and rename it to $newfilename
		 switch ($imgInfo[2]) {
		  case 1: imagegif($newImg,$resized); break;
		  case 2: imagejpeg($newImg,$resized, 90);  break;
		  case 3: imagepng($newImg,$resized); break;
		  default: return '';  break;
		 }
		 
		 return "images/resized/".$rzname;

		}

		function unhtmlentities($string) 
		{
			$trans_tbl = array("&lt;" => "<", "&gt;" => ">", "&amp;" => "&");
			return strtr($string, $trans_tbl);
		}

		function getFile($name, $modPath, $tmplPath = '') {
      if (!$tmplPath) {
        global $mainframe;
        $tmplPath = 'templates'.DS.$mainframe->getTemplate().DS.'css'.DS;
      }
			if (file_exists(JPATH_SITE.DS.$tmplPath.$name)) {
				return $tmplPath.$name;
			}
			return $modPath.$name;
		}

		function getModuleParameters($modid) {
			$db 	=& JFactory::getDBO();
			$query = "SELECT params FROM #__modules WHERE id = $modid;";
			$db->setQuery($query);
			return $db->loadResult();
    }
		
		function getFileInDir($folder, $orderby, $sort){
			$imagePath 	= JPATH_SITE ."/".$folder;
			$imgFiles 	= JFolder::files( $imagePath );
			$folderPath = $folder .'/';
			$imageFile = array();
			$i = 0;
			foreach ($imgFiles as $file){
				$i_f 	= $imagePath .'/'. $file;
				if ( eregi( "bmp|gif|jpg|png|jpeg", $file ) && is_file( $i_f ) ) {
					$imageFile[$i][0] = $file;
					$imageFile[$i][1] = filemtime($i_f)	;
					$i++;
				}
			}
			$images = modJaSlideshowHelper::sortImage($imageFile, $orderby , $sort);
			return $images;
		}
    
		function sortImage($image, $orderby , $sort){
			$sortObj = array();
			$imageName = array();
			if($orderby == 1){
				for($i=0;$i<count($image);$i++){
					$sortObj[$i] = $image[$i][1];
					$imageName[$i] = $image[$i][0];
				}
			}
			else{
				for($i=0;$i<count($image);$i++){
					$sortObj[$i] = $image[$i][0];
				}
				$imageName = $sortObj;
			}
			if($sort == 1) array_multisort($sortObj, SORT_ASC, $imageName);
			elseif($sort == 2)	array_multisort($sortObj, SORT_DESC, $imageName);
			else shuffle($imageName);
			return $imageName;
		}
    
		function checkURL($url){
			if(is_dir($url)){ 
				global $mainframe;
				$tname = $mainframe->getTemplate();
				$cname = "_ja_color";
				$cvalue = (isset($_REQUEST[$cname]))?trim($_REQUEST[$cname]):(isset($_COOKIE[$tname.'_'.$cname]))?trim($_COOKIE[$tname.'_'.$cname]):'';
				$url = (substr($url,-1,1) == "/") ? $url : $url."/";	
				if ($cvalue && is_dir ($url.$cvalue)) $url = $url.$cvalue.'/';
				return $url; 
			}
			else { return false; }	
		}
    
		function buildThumbnail ($imageArray, $twidth, $theight) {
			$thumbs = array();
			foreach ($imageArray as $image) {
				if ($image1 = modJaSlideshowHelper::processImage ( $image, $twidth, $theight, 1 )) {
					$thumbs[] = "$image1";
				}
			}
			return $thumbs;
		}
    
    function parseDescOld ($description) {
      $description = str_replace("<br />", "\n", $description);
      $description = explode("\n",$description);
      $descriptionArray = array();
      foreach($description as $desc){
        if ($desc) {
          $list = split(":", $desc, 2);
          $list[1] = (count($list) > 1) ? split("&", $list[1]) : array();
          $temp = array();
          for ($i = 0; $i < count($list[1]); ++$i) {
            $l = split("=", $list[1][$i]);
            $temp[trim($l[0])] = trim($l[1]);
          }
          $descriptionArray[$list[0]] = $temp;
        }
      }
      return $descriptionArray;
    }
    
    function parseDescNew($description) {
      $regex = '#\[desc ([^\]]*)\]([^\[]*)\[/desc\]#m';
  
      preg_match_all ($regex, $description, $matches, PREG_SET_ORDER);
  
      $descriptionArray = array();
      foreach ($matches as $match) {
        $params = modJaSlideshowHelper::parseParams($match[1]);
        if (is_array($params)) {
          $img = isset($params['img'])?trim($params['img']):'';
          if (!$img) continue;
          $url = isset($params['url'])?trim($params['url']):'';
          $descriptionArray[$img] = array('url'=>$url,'caption'=>str_replace("\n","<br />",trim($match[2])));
        }
      }
      return $descriptionArray;
    }
  
    function parseParams($params) {
      $params = html_entity_decode($params, ENT_QUOTES);
      $regex = "/\s*([^=\s]+)\s*=\s*('([^']*)'|\"([^\"]*)\"|([^\s]*))/";
      preg_match_all($regex, $params, $matches);
      
       $paramarray = null;
       if(count($matches)){
        $paramarray = array();
          for ($i=0;$i<count($matches[1]);$i++){ 
            $key = $matches[1][$i];
            $val = $matches[3][$i]?$matches[3][$i]:($matches[4][$i]?$matches[4][$i]:$matches[5][$i]);
            $paramarray[$key] = $val;
          }
        }
        return $paramarray;
    }    
	}
}
