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
/*
			<param name="kb_rate" default="1" />
			<param name="kb_comments" default="1" />
			<param name="kb_comments_captcha" default="0" />
			<param name="kb_comments_moderate" default="0" />
			<param name="test_moderate" default="0" />
			<param name="test_moderate_captcha" default="0" />
*/

define("FST_IT_KB",1);
define("FST_IT_FAQ",2);
define("FST_IT_TEST",3);
define("FST_IT_NEWTICKET",4);
define("FST_IT_VIEWTICKETS",5);
define("FST_IT_ANNOUNCE",6);
define("FST_IT_LINK",7);
define("FST_IT_GLOSSARY",8);
define("FST_IT_ADMIN",9);
define("FST_IT_GROUPS",10);

jimport( 'joomla.version' );
require_once( JPATH_SITE.DS.'components'.DS.'com_fst'.DS.'helper'.DS.'helper.php' );

class FST_Settings 
{
	function _GetSettings()
	{
		global $fst_settings;
		
		if (empty($fst_settings))
		{
			FST_Settings::_GetDefaults();
			
			$db =& JFactory::getDBO();
			$query = 'SELECT * FROM #__fst_settings';
			$db->setQuery($query);
			$row = $db->loadAssocList();
			
			if (count($row) > 0)
			{
				foreach ($row as $data)
				{
					$fst_settings[$data['setting']] = $data['value'];
				}
			}

			$query = 'SELECT * FROM #__fst_settings_big';
			$db->setQuery($query);
			$row = $db->loadAssocList();
			
			if (count($row) > 0)
			{
				foreach ($row as $data)
				{
					$fst_settings[$data['setting']] = $data['value'];
				}
			}
		}	
	}
	
	function _GetDefaults()
	{
		global $fst_settings;
		
		if (empty($fst_settings))
		{
			$fst_settings = array();
			
			$fst_settings['version'] = 0;
			$fst_settings['fsj_username'] = '';
			$fst_settings['fsj_apikey'] = '';
	
			$fst_settings['perm_mod_joomla'] = 0;
			$fst_settings['perm_article_joomla'] = 0;
			
			$fst_settings['captcha_type'] = 'none';

			$fst_settings['recaptcha_public'] = '';
			$fst_settings['recaptcha_private'] = '';
			$fst_settings['recaptcha_theme'] = 'red';
			$fst_settings['comments_moderate'] = 'none';
			$fst_settings['comments_hide_add'] = 1;
			$fst_settings['email_on_comment'] = '';
			$fst_settings['comments_who_can_add'] = 'anyone';
			
			$fst_settings['test_use_email'] = 1;
			$fst_settings['test_use_website'] = 1;
			$fst_settings['commnents_use_email'] = 1;
			$fst_settings['commnents_use_website'] = 1;
		
			$fst_settings['hide_powered'] = 0;
			$fst_settings['announce_use_content_plugins'] = 0;
			$fst_settings['announce_use_content_plugins_list'] = 0;
			$fst_settings['announce_comments_allow'] = 1;

			$fst_settings['kb_rate'] = 1;
			$fst_settings['kb_comments'] = 1;
			$fst_settings['kb_view_top'] = 0;
			
			$fst_settings['kb_show_views'] = 1;
			$fst_settings['kb_show_recent'] = 1;
			$fst_settings['kb_show_recent_stats'] = 1;
			$fst_settings['kb_show_viewed'] = 1;
			$fst_settings['kb_show_viewed_stats'] = 1;
			$fst_settings['kb_show_rated'] = 1;
			$fst_settings['kb_show_rated_stats'] = 1;
			$fst_settings['kb_show_dates'] = 1;
			$fst_settings['kb_use_content_plugins'] = 0;
			$fst_settings['kb_show_art_related'] = 1;
			$fst_settings['kb_show_art_products'] = 1;
			$fst_settings['kb_show_art_attach'] = 1;
			$fst_settings['kb_contents'] = 1;
			$fst_settings['kb_smaller_subcat_images'] = 0;
			
			$fst_settings['test_moderate'] = 'none';
			$fst_settings['test_email_on_submit'] = '';
			$fst_settings['test_allow_no_product'] = 1;
			$fst_settings['test_who_can_add'] = 'anyone';
			$fst_settings['test_hide_empty_prod'] = 1;

			$fst_settings['skin_style'] = 0;
			$fst_settings['support_entire_row'] = 0;
			$fst_settings['support_autoassign'] = 0;
			$fst_settings['support_assign_open'] = 0;
			$fst_settings['support_assign_reply'] = 0;
			$fst_settings['support_user_attach'] = 1;
			$fst_settings['support_lock_time'] = 30;
			$fst_settings['support_show_msg_counts'] = 1;
			$fst_settings['support_reference'] = "4L-4L-4L";
			$fst_settings['support_list_template'] = "classic";
			$fst_settings['support_custom_register'] = "";
			$fst_settings['support_no_logon'] = 0;
			$fst_settings['support_no_register'] = 0;
			$fst_settings['support_info_cols'] = 1;
			$fst_settings['support_actions_as_buttons'] = 0;
			
			$fst_settings['support_user_reply_width'] = 56;
			$fst_settings['support_user_reply_height'] = 10;
			$fst_settings['support_admin_reply_width'] = 56;
			$fst_settings['support_admin_reply_height'] = 10;
			$fst_settings['support_next_prod_click'] = 1;			
			$fst_settings['support_subject_size'] = 35;			
			
			$fst_settings['support_restrict_prod'] = 0;
			
			$fst_settings['css_hl'] = '#f0f0f0';
			$fst_settings['css_tb'] = '#ffffff';
			$fst_settings['css_bo'] = '#e0e0e0';
			
			$fst_settings['display_head'] = '';
			$fst_settings['display_foot'] = '';
			$fst_settings['use_joomla_page_title_setting'] = 0;
			
			$fst_settings['content_unpublished_color'] = '#FFF0F0';

			if (FST_Helper::Is16())
			{
				$fst_settings['display_h1'] = '<h1>$1</h1>';
				$fst_settings['display_h2'] = '<h2>$1</h2>';
				$fst_settings['display_h3'] = '<h3>$1</h3>';
				$fst_settings['display_popup'] = '<h2>$1</h2>';
				$fst_settings['display_style'] = '.fst_main tr, td 
{
	border: none;
	padding: 1px;
}';
				$fst_settings['display_popup_style'] = '.fst_popup tr, td 
{
	border: none;
	padding: 1px;
}';
			} else {
				$fst_settings['display_h1'] = '<div class="component-header"><div class="componentheading">$1</div></div>';
				$fst_settings['display_h2'] = '<div class="fst_spacer contentheading">$1</div>';
				$fst_settings['display_h3'] = '<div class="fst_admin_create">$1</div>';
				$fst_settings['display_popup'] = '<div class="component-header"><div class="componentheading">$1</div></div>';
				$fst_settings['display_style'] = '';
				$fst_settings['display_popup_style'] = '';
			}

			$fst_settings['support_email_on_create'] = 0;
			$fst_settings['support_email_handler_on_create'] = 0;
			$fst_settings['support_email_on_reply'] = 0;
			$fst_settings['support_email_handler_on_reply'] = 0;
			$fst_settings['support_email_handler_on_forward'] = 0;
			$fst_settings['support_user_can_close'] = 1;
			$fst_settings['support_user_can_reopen'] = 1;
			$fst_settings['support_advanced'] = 1;
			$fst_settings['support_allow_unreg'] = 0;
			$fst_settings['support_delete'] = 1;
			$fst_settings['support_advanced_default'] = 0;

			$fst_settings['support_cronlog_keep'] = 5;

			$fst_settings['support_hide_priority'] = 0;
			$fst_settings['support_hide_handler'] = 0;
			$fst_settings['support_hide_users_tickets'] = 0;
			$fst_settings['support_hide_tags'] = 0;
			$fst_settings['support_email_unassigned'] = '';

			$fst_settings['support_email_from_name'] = '';
			$fst_settings['support_email_from_address'] = '';
			$fst_settings['support_email_site_name'] = '';
			
			$fst_settings['support_ea_check'] = 0;
			$fst_settings['support_ea_all'] = 0;
			$fst_settings['support_ea_reply'] = 0;
			$fst_settings['support_ea_type'] = 0;
			$fst_settings['support_ea_host'] = '';
			$fst_settings['support_ea_port'] = '';
			$fst_settings['support_ea_username'] = '';
			$fst_settings['support_ea_password'] = '';
			$fst_settings['support_ea_mailbox'] = '';

			$fst_settings['support_user_message'] = '#c0c0ff';
			$fst_settings['support_admin_message'] = '#c0ffc0';
			$fst_settings['support_private_message'] = '#ffc0c0';
			
			$fst_settings['support_basic_name'] = '';
			$fst_settings['support_basic_username'] = '';
			$fst_settings['support_basic_email'] = '';
			$fst_settings['support_basic_messages'] = '';

			$fst_settings['glossary_faqs'] = 1;
			$fst_settings['glossary_kb'] = 1;
			$fst_settings['glossary_link'] = 1;
			$fst_settings['glossary_title'] = 0;
			$fst_settings['glossary_use_content_plugins'] = 0;

			$fst_settings['faq_popup_width'] = 650;
			$fst_settings['faq_popup_height'] = 375;
			$fst_settings['faq_popup_inner_width'] = 0;
			$fst_settings['faq_use_content_plugins'] = 0;
			$fst_settings['faq_use_content_plugins_list'] = 0;
			
			
			// 1.9 comments stuff
			$fst_settings['comments_announce_use_custom'] = 0;
			$fst_settings['comments_kb_use_custom'] = 0;
			$fst_settings['comments_test_use_custom'] = 0;	
			$fst_settings['comments_general_use_custom'] = 0;		
			$fst_settings['comments_testmod_use_custom'] = 0;		
		}	
	}

	// return a list of settings that are used on the templates section
	function GetTemplateList()
	{
		$template = array();
		$template[] = "display_style";
		$template[] = "display_popup_style";
		$template[] = "display_h1";
		$template[] = "display_h2";
		$template[] = "display_h3";
		$template[] = "display_head";
		$template[] = "display_foot";
		$template[] = "display_popup";
		$template[] = "support_list_template";
		
		$template[] = "comments_announce_use_custom";
		$template[] = "comments_test_use_custom";
		$template[] = "comments_kb_use_custom";
		$template[] = "comments_general_use_custom";
		$template[] = "comments_testmod_use_custom";
		
		$res = array();
		foreach($template as $setting)
		{
			$res[$setting] = $setting;
		}
		return $res;	
	}
	
	function StoreInTemplateTable()
	{
		$intpl = array();
		$intpl[] = "comments_general";	
		$intpl[] = "comments_announce";	
		$intpl[] = "comments_kb";	
		$intpl[] = "comments_test";	
		$intpl[] = "comments_testmod";	
		
		$res = array();
		foreach($intpl as $setting)
		{
			$res[$setting] = $setting;
		}
		return $res;	
	}
		
	function GetLargeList()
	{
		$large = array();
		$large[] = "display_style";
		$large[] = "display_popup_style";
		$large[] = "display_h1";
		$large[] = "display_h2";
		$large[] = "display_h3";
		$large[] = "display_head";
		$large[] = "display_foot";
		$large[] = "display_popup";
		
		$res = array();
		foreach($large as $setting)
		{
			$res[$setting] = $setting;
		}
		return $res;	
	}
	
	function get($setting)
	{
		global $fst_settings;
		FST_Settings::_GetSettings();
		return $fst_settings[$setting];	
	}
	
	function &GetAllSettings()
	{
		global $fst_settings;
		FST_Settings::_GetSettings();
		return $fst_settings;	
	}
}

function FST_GetAllMenus()
{
	static $getmenus;
	
	if (empty($getmenus))
	{
		$where = array();
		$where[] = 'menutype != "main"';
		$where[] = 'type = "component"';
		$where[] = 'link LIKE "%option=com_fst%"';
		$where[] = 'published = 1';
		
		if (FST_Helper::Is16())
		{
			$query = 'SELECT title, id, link FROM #__menu';
		} else {
			$query = 'SELECT name as title, id, link FROM #__menu';
		}
		$query .= ' WHERE ' . implode(" AND ", $where);
		
		$db    = & JFactory::getDBO();
		$db->setQuery($query);
		$getmenus = $db->loadObjectList();
	}
	//print_p($getmenus);
	
	return $getmenus;
}

function FST_GetMenus($menutype)
{
	$getmenus = FST_GetAllMenus();
	
	//echo "<br>Menu Type : $menutype<br>-<br>";
	$have = array();
	$not = array();
	
	switch ($menutype)
	{
	case FST_IT_KB:
		$have['view'] = "kb";
		$not['layout'] = "";
		break;						
	case FST_IT_FAQ:
		$have['view'] = "faq";
		$not['layout'] = "";
		break;						
	case FST_IT_TEST:
		$have['view'] = "test";
		$not['layout'] = "";
		break;						
	case FST_IT_NEWTICKET:
		$have['view'] = "ticket";
		$have['layout'] = "open";
		break;
	case FST_IT_VIEWTICKETS:
		$have['view'] = "ticket";
		$not['layout'] = "";
		break;						
	case FST_IT_ANNOUNCE:
		$have['view'] = "announce";
		$not['layout'] = "";
		break;						
	case FST_IT_GLOSSARY:
		$have['view'] = "glossary";
		$not['layout'] = "";
		break;						
	case FST_IT_ADMIN:
		$have['view'] = "admin";
		$not['layout'] = "";
		break;						
	default:
		return array();							
	}
	
	$results = array();
	
	if (count($getmenus) > 0)
	{
		foreach ($getmenus as $object)
		{ 
			$linkok = 1;
		
			$link = strtolower(substr($object->link,strpos($object->link,"?")+1));
			//echo $link."<br>";
			$parts = explode("&",$link);
		
			$inlink = array();
		
			foreach($parts as $part)
			{
				list($key,$value) = explode("=",$part);
				$inlink[$key] = $value;
			
				if (array_key_exists($key,$not))
				{
					//echo "Has ".$key."<br>";
					$linkok = 0;
				}
			}
				
			foreach ($have as $key => $value)
			{		
				if (!array_key_exists($key,$inlink))
				{
					//echo "Doesnt have ".$key."<br>";
					$linkok = 0;	
				} else {
					if ($inlink[$key] != $value)
					{
						//echo "Value mismatch for ".$key." - " . $value . " should be " . $inlink[$key] . "<br>";
						$linkok = 0;
					}
				}				
			}
		
			if ($linkok)
			{
				$results[] = $object;
				//echo "VALID : " . $link . "<br>";	
			}	
		}
	}
	
	return $results;
}
