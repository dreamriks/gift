<?php
/**
 * @version $Id: plgContentTBFSocial 1.3
 * @copyright http://www.joomlatags.org
 * @license GNU/GPLv2,
 * @author Joe- http://www.joomlatags.org
 */
defined( '_JEXEC' ) or  die('Restricted access');
jimport( 'joomla.event.plugin' );
require_once JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php';

class plgContentTBFSocial extends JPlugin
{
	function plgContentTBFSocial( &$subject, $params )
	{
		parent::__construct( $subject, $params );
	}

	function onPrepareContent( &$article, &$params )
	{
		if($this->ignore($article->id,$article->catid,$article->sectionid)){
			return true;
		}
		$onlyArticles=$this->param('OnlyArticles');

		$margin=$this->param('Margin');
		$show =true;
		$uri =& JURI::getInstance();
		$current=JURI::current();
		if($onlyArticles){
			if ((JRequest :: getVar('view')) <> 'article'){
				$show=false;
			}
		}
		if ($show){
			$enableDigg=$this->param('EnableDigg');
			$enableBuzz=$this->param('EnableBuzz');
			$enableTwitter=$this->param('EnableTwitter');
			$enableFacebook=$this->param('EnableFacebook');
			if(isset($article->slug)){
				$current =$uri->toString(array('scheme', 'host', 'port')).JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catslug, $article->sectionid),true);
			}
			$buttons='<div style="margin-top:'.$margin.'px;margin-bottom:'.$margin.'px;display: inline;">';
			if($enableTwitter){
				$buttons.=$this->retweet($current,$article->title);
			}
			if($enableBuzz){
				$buttons.= $this->buzz();
			}
			if($enableDigg){
				$buttons.=$this->digg($current);
			}
			if($enableFacebook){
				$buttons.=$this->facebook($article,$current);
			}
			$buttons.='</div>';
			$position=$this->param('Position');
			if($position==1){
				$article->text=$buttons.$article->text;
			}else if($position==2){
				$article->text=$buttons.$article->text.$buttons;
			}else{
				$article->text.=$buttons;
			}
		}
		return true;
	}

	function buzz(){
		$buzzTitle=$this->param('BuzzTitle');
		$buzzStyle='small-count';
		$buzz='<div style="float: left; margin-right: 0.75em;"><a title="'.$buzzTitle.'" class="google-buzz-button" href="http://www.google.com/buzz/post" data-button-style="'.$buzzStyle.'"></a></div>';
		//$buzz.='<script type="text/javascript" src="http://www.google.com/buzz/api/button.js"></script>';
		$document	= & JFactory::getDocument();
		$document->addScript('http://www.google.com/buzz/api/button.js');
		return $buzz;
	}
	function retweet($url,$title){
		$twitterUser=$this->param('TwitterUsername');
		$nick='';
		if($twitterUser){
			$nick=', "nick":"'.$twitterUser.'"';
		}
		$retweet='<div class="topsy_widget_data" style="float: left; margin-right: 0.75em;"><script type="text/javascript">topsyWidgetPreload({ "url":"'.$url.'","title":"'.$title.'","theme": "blue"'.$nick.' });</script></div>';
		$document	= & JFactory::getDocument();
		$document->addScript('http://cdn.topsy.com/topsy.js?init=topsyWidgetCreator');
		return $retweet;
	}

	//iframe mode
	function facebook(&$article,$current){


		$document	= & JFactory::getDocument();
		$config =& JFactory::getConfig();
		$document->setMetaData('og:title',$article->title);
		$document->setMetaData('og:site_name',$config->getValue('sitename'));

		$faceBookImage=$this->param('FacebookImage');
		if($faceBookImage){
			$pattern = "/<img[^>]*src\=['\"]?(([^>]*)(jpg|gif|png|jpeg))['\"]?/";
			preg_match($pattern, $article->text, $matches);
			if(!empty($matches)){
				$document->setMetaData('og:image',JURI::root() . $matches[1]);
			}
		}

		$url=$current;

		$autoUrl=$this->param('FacebookAutoURL');
		if(!$autoUrl){
			$facebookUrl=$this->param('FacebookURL');
			if($facebookUrl){
				$url=$facebookUrl;
			}
		}

		return '<iframe src="http://www.facebook.com/plugins/like.php?href='.$url.'&amp;layout='.$this->param('FacebookLayout').'&amp;show_faces='.($this->param('FacebookShowFaces')?'true':'false').'&amp;width='.$this->param('FacebookWidth').'&amp;action='.$this->param('FacebookVerb').'&amp;colorscheme='.$this->param('FacebookColorScheme').'&amp;height='.$this->param('FacebookHeight').'" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$this->param('FacebookWidth').'px; height:'.$this->param('FacebookHeight').'px;" allowTransparency="true"></iframe>';
	}

	function digg($url){
		$document	= & JFactory::getDocument();
		$document->addScript('http://widgets.digg.com/buttons.js');
		return '<div style="vertical-align:text-top;float: left; margin-right: 0.75em;"><a class="DiggThisButton DiggCompact" href="http://digg.com/submit?url='.$url.'"></a></div>';
	}



	function param($name){
		static $plugin,$pluginParams;
		if (!isset( $plugin )){
			$plugin =& JPluginHelper::getPlugin('content', 'TBFSocial');
			$pluginParams = new JParameter( $plugin->params );
		}
		return $pluginParams->get($name);
	}
	function exclude($paramName,$value){
		$excludeArticlesIds=$this->param($paramName);
		$excludeArticlesIdsArray=explode(',',$excludeArticlesIds);
		if(empty($excludeArticlesIdsArray)){
			return 0;
		}
		if(!$value){
			return 0;
		}
		if(in_array($value,$excludeArticlesIdsArray,false)){
			return 1;
		}
		return 0;
	}
	function ignore($id,$catId,$sectionId){
		$ignore=$this->exclude('Exclude_Section_Ids',$sectionId);
		if($ignore){ return $ignore; }
		$ignore=$this->exclude('Exclude_Category_Ids',$catId);
		if($ignore){return $ignore;	}
		$ignore =$this->exclude('Exclude_Article_Ids',$id);
		return  $ignore;
	}

}
?>
