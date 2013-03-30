<?php
/*
# ------------------------------------------------------------------------
# JA T3v2 Plugin - Template framework for Joomla 1.5
# ------------------------------------------------------------------------
# Copyright (C) 2004-2010 JoomlArt.com. All Rights Reserved.
# @license - GNU/GPL V2, http://www.gnu.org/licenses/gpl2.html. For details 
# on licensing, Please Read Terms of Use at http://www.joomlart.com/terms_of_use.html.
# Author: JoomlArt.com
# Websites: http://www.joomlart.com - http://www.joomlancers.com.
# ------------------------------------------------------------------------
*/

defined ( '_JEXEC' ) or die ();
jimport ( 'joomla.plugin.plugin' );
jimport ( 'joomla.application.module.helper' );

require_once (dirname ( __FILE__ ) . DS . 'jat3' . DS . 'core' . DS . 'common.php');

class plgSystemJAT3 extends JPlugin {
	
	var $plugin = null;
	var $plgParams = null;
	var $time = 0;
	
	
	function __construct(&$subject, $config) {
		parent::__construct ( $subject, $config );
		$this->plugin = &JPluginHelper::getPlugin ( 'system', 'jat3' );
		jimport ('joomla.html.parameter');
		$this->plgParams = new JParameter ( $this->plugin->params );
		$this->loadLanguage ( null, JPATH_ADMINISTRATOR);
	}
	
	function onAfterRender() {
		$app = JFactory::getApplication();

		t3import ('core.admin.util');
		
		$util = new JAT3_AdminUtil();
		
		if ($util->checkPermission()) {
			
			if (JAT3_AdminUtil::checkCondition_for_Menu()) {				
				// HTML= Parser lib			
				require_once T3Path::path (T3_CORE) .DS . 'libs' . DS ."html_parser.php";
						
				$_body = JResponse::getBody();
				
				require_once T3Path::path (T3_CORE) .DS . 'admin' . DS ."util.php";
				
				// Replace content
				$jat3core = new JAT3_AdminUtil();
				$_body = $jat3core->replaceContent($_body);
				
				if ( $_body ) {
					JResponse::setBody( $_body );
				}			
			}
		}
		
		if (! T3Common::detect ())
			return;					
		
		if ($util->checkPermission()) {						
			
			if ($util->checkCondition()) {
				
				$params = T3Path::path (T3_CORE) . DS . 'admin' . DS . 'index.php';
				if (file_exists ( $params )) {
					ob_start ();
					include $params;
					$content = ob_get_clean ();
					$buffer = JResponse::getBody ();
					
					$buffer = preg_replace ( '/<\/body>/', $content . "\n</body>", $buffer );
					JResponse::setBody ( $buffer );
				}
			}
			return;
		}
		
		if (!$app->isAdmin()){
			//Expires date set to very long
			//JResponse::setHeader( 'Expires', gmdate( 'D, d M Y H:i:s', time() + 3600000 ) . ' GMT', true );
			//JResponse::setHeader( 'Last-Modified', gmdate( 'D, d M Y H:i:s', time()) . ' GMT', true );
			JResponse::setHeader( 'Expires', '', true );
			JResponse::setHeader( 'Cache-Control', 'private', true );
			
			//Update cache in case of the whole page is cached
			$key = T3Cache::getPageKey ();			
			if (($data = T3Cache::get ( $key )) && !preg_match('#<jdoc:include\ type="([^"]+)" (.*)\/>#iU', $data)) {
				$buffer = JResponse::getBody ();
				T3Cache::store ( $buffer, $key );
			}
		}
	}
	
	function onAfterInitialise() {
		t3import ( 'core.framework' );

		$app = JFactory::getApplication('administrator');
		
		if ($app->isAdmin()) {
			//Clean cache if there's something changed backend
			if (JRequest::getCmd ('jat3action') || in_array(JRequest::getCmd ('task'), array('save', 'delete', 'remove', 'apply', 'publish', 'unpublish'))) {
				t3_import('core/cache');
				T3Cache::clean();		
			}
		}
		
		if (!$app->isAdmin()) {
			$action = JRequest::getCmd ( 'jat3action' );
			//process request ajax like action - public
			if ($action) {
				t3import ('core.ajaxsite');
				if (method_exists ('T3AjaxSite', $action)) {
					T3AjaxSite::$action ();
					$app->close(); //exit after finish action
				}
			}
		}
		t3import ('core.admin.util');
		if (JAT3_AdminUtil::checkPermission()) {
			
			if (JAT3_AdminUtil::checkCondition_for_Menu()) {
				JHTML::stylesheet ('', JURI::root().T3_CORE.'/element/assets/css/japaramhelper.css' );
				JHTML::script 	  ('', JURI::root().T3_CORE.'/element/assets/js/japaramhelper.js', true);
			}
		}
		if (! T3Common::detect ())	return;
		
		
		
		if (JAT3_AdminUtil::checkPermission()) {
						
			if (JRequest::getCmd ( 'jat3type' ) == 'plugin') {
				$action = JRequest::getCmd ( 'jat3action' );
				
				t3import ('core.ajax');
				$obj = new JAT3_Ajax ( );
				
				if ($action && method_exists ( $obj, $action )) {
					$obj->$action ();
				}
				return;
			} 
			
			JAT3_AdminUtil::loadStyle();
			JAT3_AdminUtil::loadScipt();
			
			return;
		}
		elseif (JRequest::getCmd ( 'jat3type' ) == 'plugin') {
			$result['error'] = 'Session has expired. Please login before continuing.';
			echo json_encode($result);
			exit;		
		}
	}
	
	function onAfterRoute() {
		$app = JFactory::getApplication('administrator');
		if (! $app->isAdmin () && T3Common::detect ()) {
			//load core library
			T3Framework::t3_init ( $this->plgParams );
			//Init T3Engine
			//get list templates			
			$themes = T3Common::get_active_themes ();
			$path = T3Path::getInstance ();
			//path in t3 engine
			//active themes path
			if ($themes && count ( $themes )) {
				foreach ( $themes as $theme ) {
					$path->addPath ( $theme [0] . '.' . $theme [1], T3Path::path (T3_TEMPLATE) . DS . $theme [0] . DS . 'themes' . DS . $theme [1], T3Path::url (T3_TEMPLATE) . "/{$theme[0]}/themes/{$theme[1]}" );
				}
			}
			//add default & base theme path
			$path->addPath ( 'template.default', T3Path::path (T3_TEMPLATE), T3Path::url (T3_TEMPLATE) );
			$path->addPath ( 'engine.default', T3Path::path (T3_BASETHEME), T3Path::url (T3_BASETHEME) );
			
			T3Framework::init_layout ();
		}
	}

	function onContentPrepareForm($form, $data)
	{
		if ($form->getName()=='com_menus.item')
		{
			JForm::addFormPath(T3_ROOT.DS.'core'.DS.'params');
			$form->loadFile('params', false);
		}
	}	
}