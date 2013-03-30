<?php

/**
* yvComment plugin - A User Comments Component, developed for Joomla 1.5
* @version 1.11.0
* @package yvCommentPlugin
* @(c) 2007 yvolk (Yuri Volkov), http://yurivolkov.com. All rights reserved.
* @license GPL
**/

// no direct access
defined('_JEXEC') or die('Restricted access');

define('yvCommentPluginVersion', '1.12.5');
global $mainframe;
global $yvComment;

if (!$yvComment) {
	$path = JPATH_SITE . DS . 'components' . DS . 'com_yvcomment' . DS . 'helpers.php';
	if (file_exists($path)) {
	  require_once ($path);
  	$yvComment = new yvCommentHelper('plugin');
	}
	if ($yvComment) {
		if ($yvComment->JoomlaCoreVersionCheck()) {
			if (strcmp(yvCommentPluginVersion, yvCommentVersion) != 0) {
				$mainframe->enqueueMessage(
					'Versions of "yvComment Plugin" and "yvComment Component" are not the same.<br/>' . '(Plugin version="' . yvCommentPluginVersion . '"; Component version="' . yvCommentVersion . '")<br/>' . 'Please install the same versions from <a href="http://yurivolkov.com/Joomla/yvComment/index_en.html" target="_blank">yvComment home page</a>.',
					'error');
			}
			// Import library dependencies
			jimport('joomla.event.plugin');
		}
		//if (strlen($message) > 0) echo $message;
	} else {
		// No yvComment Component
	  $mainframe->enqueueMessage(
		  'yvComment Plugin is installed, but "<b>yvComment Component</b>" is <b>not</b> installed. Please install it to use <a href="http://yurivolkov.com/Joomla/yvComment/index_en.html" target="_blank">yvComment extension</a>.<br/>' . '(yvComment Plugin version="' . yvCommentPluginVersion . '")',
	  	'error');
	}
}

class plgContentyvcomment extends JPlugin {

  // Normal positions:
  //		'InsideBox', 'AfterContent' 
  // Error conditions:
  //		'DifferentVersions', 'NoComponent'
  var $_PluginPlace = 'NoComponent';
  
	/**
	 * Constructor
	 *
	 * For php4 compatability we must not use the __constructor as a constructor for
	 * plugins because func_get_args ( void ) returns a copy of all passed arguments
	 * NOT references.  This causes problems with cross-referencing necessary for the
	 * observer design pattern.
	 */
	function plgContentyvcomment(& $subject, $config) {
		parent :: __construct($subject, $config);
		global $mainframe;
		// yvCommentHelper
		global $yvComment;

		//echo 'yvcomment Plugin constructor, subject="' . $subject->toString() . '"<br/>';

    if ($yvComment) {
      if ($yvComment->Ok()) {
			  $this->_PluginPlace = $yvComment->getConfigValue('position', 'AfterContent');
      }  
		}
		//echo 'position="' . $this->_PluginPlace . '"<br/>';
	}

	// This is the first stage in preparing content for output and is the most common point
	// for content orientated plugins to do their work.
	// Since the article and related parameters are passed by reference,
	// event handlers can modify them prior to display
	function onPrepareContent(& $article, & $params, $page = 0) {
		$Ok = true;
		//echo 'yvcomment onPrepareContent place="' . $this->_PluginPlace . '"<br/>';
		//$article->text .= '<hr>test line<br/>';
		//echo '<hr>Article text 1 ="' . $article->text . '"<br/>';
			
		switch ($this->_PluginPlace) {
			case 'InsideBox' :
				$Ok = $this->_PluginFunction( $article, $params, $page);
				break;
		}
		return $Ok;
	}

	// Information that should be placed immediately after the generated content
	function onAfterDisplayContent(& $article, & $params, $page = 0) {
		$results = '';	
		//echo 'yvcomment onAfterDisplayContent place="' . $this->_PluginPlace . '"<br/>';
		switch ($this->_PluginPlace) {
			case 'AfterContent' :
				$results = $this->_PluginFunction($article, $params, $page);
				break;
		}
		return $results;
	}

	function _PluginFunction(& $article, & $params, $page = 0) {
  	static $level = 0; 
		global $yvComment;
		global $option;

		$ArticleID = $article->id;
		//$article->text .= '_PluginFunction PluginPlace="' . $this->_PluginPlace . '"; ArticleID=' . $ArticleID;
		if ($ArticleID == 0) {
			return false;
		}
		if ($level > 0) {
			// TODO: make yvComment code reenterable?		
			return false;
		}
		$level += 1;
		
		$strOut = "";
		$task = 'plugindisplay';
		
		//Store current global variables
		$option1 = $option;
		$option = 'com_yvcomment';
		$view1 = JRequest :: getVar('view');
		$layout1 = JRequest::getVar('layout');

		//Layout for plugin may be requested by this variable:		
		$layoutName = JRequest::getVar('yvcomment_layout', 'default');
    JRequest::setVar('layout', $layoutName);
		
		//$strOut .= ', ArticleID=' . $ArticleID;
		$yvComment->setArticle($article);

		$config = array ();
		$config['ArticleID'] = $ArticleID;
		$config['task'] = $task;

		// This is needed only because we can't 'undefine' this:
		//define( 'JPATH_COMPONENT',					JPATH_BASE.DS.'components'.DS.$name);
		$config['base_path'] = JPATH_SITE_YVCOMMENT;

		// Create the controller
		$controller = new yvcommentController($config);

		//$id =  $controller->getArticleID();
		//$strOut .= ', ArticleID=' . $id;

		// Perform the Request task
		$controller->execute($task);

		$strOut .= $controller->getOutput();

		// Restore global values for use by other extensions
		JRequest::setVar('layout', $layout1);
		JRequest::setVar('view', $view1);
		$option = $option1;
		
		$level -= 1;
		switch ($this->_PluginPlace) {
			case 'AfterContent' :
				return $strOut;
				break;
			default :
				$article->text .= $strOut;
				return true;
		}
	}

}
?>