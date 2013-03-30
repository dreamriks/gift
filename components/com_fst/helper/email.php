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
require_once (JPATH_SITE.DS.'components'.DS.'com_fst'.DS.'helper'.DS.'fields.php');

class FST_EMail
{
	function Get_Sender()
	{
		$config =& JFactory::getConfig();

		$address = 	$config->getValue( 'config.mailfrom' );
		$name = $config->getValue( 'config.fromname' );

		if (FST_Settings::get('support_email_from_name') != "")
			$name = FST_Settings::get('support_email_from_name');

		if (FST_Settings::get('support_email_from_address') != "")
			$address = FST_Settings::get('support_email_from_address');

		return array( $address, $name );
	}

	function Send_Comment($comments)
	{	
		if ($comments->dest_email == "") 
		{
			return;
		}
		
		$mailer =& JFactory::getMailer();
		$config =& JFactory::getConfig();
		$sender = FST_EMail::Get_Sender();
		$mailer->setSender($sender);
		$recipient = array($comments->dest_email);
		$mailer->addRecipient($recipient);
		
		$tpl = $comments->handler->EMail_GetTemplate($comments->moderate);
		$template = FST_EMail::Get_Template($tpl);
		
		$data = $comments->comment;
		$data['moderated'] = $comments->moderate;
		if ($data['moderated'] == 0)
			$data['moderated'] = "";
			
		if (!array_key_exists('customfields',$data))
			$data['customfields'] = "";
		if (!array_key_exists('email',$data))
			$data['email'] = "";
		if (!array_key_exists('website',$data))
			$data['website'] = "";
		if (!array_key_exists('linkmod',$data))
			$data['linkmod'] = "";
		if (!array_key_exists('linkart',$data))
			$data['linkart'] = "";
		
		if ($comments->moderate)
		{
			$data['linkmod'] = $comments->GetModLink();
		}
			
		$links = $comments->handler->EMail_AddFields($data);
		$links['linkart'] = 1;
		$links['linkmod'] = 1;
		
		if ($data['moderated'] == 0)
		{
			$data['moderated'] = "";
			$data['linkmod'] = "";
		}
		if ($template['ishtml'])
		{
			$data['article'] = "<a href='{$data['linkart']}'>{$data['article']}</a>";
			FST_EMail::ProcessLinks($data, $links);
			
			// add custom fields html style
			$customfields = "";
			foreach($comments->customfields as &$field)
				$customfields .= $field['description'] . ": " . $data['custom_' . $field['id']] . "<br />";
			$data['customfields'] = $customfields;
		} else {
			// add custom fields text style
			$customfields = "";
			foreach($comments->customfields as &$field)
				$customfields .= $field['description'] . ": " . $data['custom_' . $field['id']] . "\n";
			$data['customfields'] = $customfields;
		}
		
		file_put_contents("printr.txt",print_r($data,true));

		$email = FST_EMail::ParseGeneralTemplate($template, $data);
		
		/*print_p($comments);
		print_p($data);
		print_p($email);*/
		
		$mailer->isHTML($template['ishtml']);
		$mailer->setSubject($email['subject']);
		$mailer->setBody($email['body']);

		//print_p($email);

		//exit;
		$send =& $mailer->Send();	
	}
	
	function ProcessLinks(&$data, $links)
	{
		foreach ($links as $link => $temp)
		{
			if ($data[$link] == "")
				continue;
			$data[$link] = "<a href='{$data[$link]}'>here</a>";	
		}
	}
	
	function ParseGeneralTemplate($template, $data)
	{
		if ($template['ishtml'])
		{
			$data['body'] = str_replace("\n","<br>\n",$data['body']);	
		}
	
		foreach($data as $var => $value)
			$vars[] = FST_EMail::BuildVar($var,$value);

		$email['subject'] = FST_EMail::ParseText($template['subject'],$vars);
		$email['body'] = FST_EMail::ParseText($template['body'],$vars);
	
		return $email;			
	}
	
	function Admin_Reply(&$ticket, $subject, $body)
	{
		// ticket replyd to
		if (FST_Settings::get('support_email_on_reply') == 1)
		{		
			$db =& JFactory::getDBO();

			$custid = $ticket['user_id'];
			$qry = "SELECT * FROM #__users WHERE id = '{$db->getEscaped($custid)}'";
			$db->setQuery($qry);
			$custrec = $db->loadAssoc();
		
			$email = $custrec['email'];
		
			$mailer =& JFactory::getMailer();

			$config =& JFactory::getConfig();
			$sender = FST_EMail::Get_Sender();
		
			$mailer->setSender($sender);
		
			FST_EMail::AddTicketRecpts($mailer, $ticket, $custrec);
		
			$template = FST_EMail::Get_Template('email_on_reply');
			$email = FST_EMail::ParseTemplate($template,$ticket,$subject,$body,$template['ishtml']);
		
			$mailer->isHTML($template['ishtml']);
			$mailer->setSubject($email['subject']);
			$mailer->setBody($email['body']);
		
			/*print_p($mailer);
			exit;*/
			$send =& $mailer->Send();
			/*
			print_p($send);
			print_p($mailer);
			exit;*/
		}
	}
	
	function AddTicketRecpts(&$mailer, &$ticket, &$custrec)
	{
		// add ticket user as recipient
		if ($ticket['user_id'] == 0)
		{
			$recipient = array($ticket['email']/*, $ticket['unregname']*/);
		} else {
			$recipient = array($custrec['email']/*, $custrec['name']*/);
		}
		
		$mailer->addRecipient($recipient);
		
		// check for any ticket cc users
		FST_EMail::GetTicketCC($ticket);
		
		if (count($ticket['cc'] > 0))
		{
			foreach ($ticket['cc'] as $cc)
			{
				$mailer->addCC(array($cc['email']/*, $cc['name']*/));	
			}
		}		
		
		// if user_id on ticket is set, then check for any group recipients
		if ($ticket['user_id'] > 0)
		{
			$db =& JFactory::getDBO();
			
			// get groups that the user belongs to
			$qry = "SELECT * FROM #__fst_ticket_group WHERE id IN (SELECT group_id FROM #__fst_ticket_group_members WHERE user_id = '{$db->getEscaped($ticket['user_id'])}')";
			$db->setQuery($qry);
			//echo $qry."<br>";
			$groups = $db->loadObjectList('id');
			
			if (count($groups) > 0)
			{
				//print_p($groups);
			
				$gids = array();
			
				foreach ($groups as $id => &$group)
				{
					$gids[$id] = $id;	
				}
			
				// get list of users in the groups
				$qry = "SELECT m.*, u.email, u.name FROM #__fst_ticket_group_members as m LEFT JOIN #__users as u ON m.user_id = u.id WHERE group_id IN (" . implode(", ",$gids) . ")";
				$db->setQuery($qry);
				//echo $qry."<br>";
				$users = $db->loadObjectList();
				//print_p($users);
				
				$toemail = array();
				
				// for all users, if group has cc or user has cc then add to cc list			
				foreach($users as &$user)
				{
					if ($user->allemail || $groups[$user->group_id]->allemail)
					{
						$toemail[$user->email] = $user->name;

					}
				}	
				
				foreach ($toemail as $email => $name)
					$mailer->addCC(array($email/*, $name*/));	
			}
			
			
			
		}
	}
	
	function GetTicketCC(&$ticket)
	{
		$db =& JFactory::getDBO();
		$qry = "SELECT u.name, u.id, u.email FROM #__fst_ticket_cc as c LEFT JOIN #__users as u ON c.user_id = u.id WHERE c.ticket_id = {$ticket['id']} ORDER BY name";
		$db->setQuery($qry);
		$ticket['cc'] = $db->loadAssocList();
	}

	function Admin_Forward(&$ticket, $subject, $body)
	{
		// ticket replyd to
		if (FST_Settings::get('support_email_handler_on_forward') == 1)
		{		
			$db =& JFactory::getDBO();

			$admin_id = $ticket['admin_id'];
			$query = " SELECT a.*, au.name, au.username, au.email FROM #__fst_user as a ";
			$query .= " LEFT JOIN #__users as au ON a.user_id = au.id ";
			$query .= " WHERE a.id = '{$db->getEscaped($admin_id)}'";
			$db->setQuery($query);
			$admin_rec = $db->loadAssoc();
		
			$email = $admin_rec['email'];
		
			$mailer =& JFactory::getMailer();

			$config =& JFactory::getConfig();
			$sender = FST_EMail::Get_Sender();
	
			$mailer->setSender($sender);
		
			$recipient = array($admin_rec['email']);
			//print_r($recipient);
			$mailer->addRecipient($recipient);
		
			$template = FST_EMail::Get_Template('email_handler_on_forward');
			$email = FST_EMail::ParseTemplate($template,$ticket,$subject,$body,$template['ishtml']);

			$mailer->isHTML($template['ishtml']);
			$mailer->setSubject($email['subject']);
			$mailer->setBody($email['body']);
		
			$send =& $mailer->Send();
		}
	}

	function User_Create(&$ticket, $subject, $body)
	{
		// ticket replyd to
		if (FST_Settings::get('support_email_on_create') == 1)
		{		
			$db =& JFactory::getDBO();

			$custid = $ticket['user_id'];
			$qry = "SELECT * FROM #__users WHERE id = '{$db->getEscaped($custid)}'";
			$db->setQuery($qry);
			$custrec = $db->loadAssoc();
		
			$email = $custrec['email'];
		
			$mailer =& JFactory::getMailer();

			$config =& JFactory::getConfig();
			$sender = FST_EMail::Get_Sender();
		
			$mailer->setSender($sender);
		
			$recipient = array($custrec['email']);
		
			$mailer->addRecipient($recipient);
		
			$template = FST_EMail::Get_Template('email_on_create');
			$email = FST_EMail::ParseTemplate($template,$ticket,$subject,$body,$template['ishtml']);

			$mailer->isHTML($template['ishtml']);
			$mailer->setSubject($email['subject']);
			$mailer->setBody($email['body']);
		
			$send =& $mailer->Send();
		}
	}

	function User_Create_Unreg(&$ticket, $subject, $body)
	{
		// ticket replyd to
		if (FST_Settings::get('support_email_on_create') == 1)
		{		
			$db =& JFactory::getDBO();

			$custid = $ticket['user_id'];
			$qry = "SELECT * FROM #__users WHERE id = '{$db->getEscaped($custid)}'";
			$db->setQuery($qry);
			$custrec = $db->loadAssoc();
		
			$email = $custrec['email'];
		
			$mailer =& JFactory::getMailer();

			$config =& JFactory::getConfig();
			$sender = FST_EMail::Get_Sender();
		
			$mailer->setSender($sender);
		
			$recipient = array($ticket['email']);
		
			$mailer->addRecipient($recipient);
		
			$template = FST_EMail::Get_Template('email_on_create_unreg');
			$email = FST_EMail::ParseTemplate($template,$ticket,$subject,$body,$template['ishtml']);

			$mailer->isHTML($template['ishtml']);
			$mailer->setSubject($email['subject']);
			$mailer->setBody($email['body']);
		
			$send =& $mailer->Send();
		}
	}

	function Admin_Create(&$ticket, $subject, $body)
	{
		// ticket replyd to
		if (FST_Settings::get('support_email_handler_on_create') == 1)
		{		
			$db =& JFactory::getDBO();

			$admin_id = $ticket['admin_id'];
			if ($admin_id < 1)
			{
				$admin_rec['email'] = trim(FST_Settings::get('support_email_unassigned'));
				
				if ($admin_rec['email'] == "")
					return;
			} else {
		
				$query = " SELECT a.*, au.name, au.username, au.email FROM #__fst_user as a ";
				$query .= " LEFT JOIN #__users as au ON a.user_id = au.id ";
				$query .= " WHERE a.id = '{$db->getEscaped($admin_id)}'";
				$db->setQuery($query);
				$admin_rec = $db->loadAssoc();
			} 
		
			$custid = $ticket['user_id'];
			$qry = "SELECT * FROM #__users WHERE id = '{$db->getEscaped($custid)}'";
			$db->setQuery($qry);
			$custrec = $db->loadAssoc();

			$email = $custrec['email'];
		
			$mailer =& JFactory::getMailer();

			$config =& JFactory::getConfig();
			$sender = FST_EMail::Get_Sender();
		
			$mailer->setSender($sender);
		
			$recipient = array($admin_rec['email']);
			//print_r($recipient);
			$mailer->addRecipient($recipient);
		
			$template = FST_EMail::Get_Template('email_handler_on_create');
			$email = FST_EMail::ParseTemplate($template,$ticket,$subject,$body,$template['ishtml']);

			$mailer->isHTML($template['ishtml']);
			$mailer->setSubject($email['subject']);
			$mailer->setBody($email['body']);

			$send =& $mailer->Send();
		}
	}

	function User_Reply(&$ticket, $subject, $body)
	{
		if (FST_Settings::get('support_email_handler_on_reply') == 1)
		{		
			$db =& JFactory::getDBO();

			$admin_id = $ticket['admin_id'];
			if ($admin_id < 1)
				return;
		
			$query = " SELECT a.*, au.name, au.username, au.email FROM #__fst_user as a ";
			$query .= " LEFT JOIN #__users as au ON a.user_id = au.id ";
			$query .= " WHERE a.id = '{$db->getEscaped($admin_id)}'";
			$db->setQuery($query);
			$admin_rec = $db->loadAssoc();
		
			//print_r($admin_rec);
		
			$email = $admin_rec['email'];
		
			$mailer =& JFactory::getMailer();

			$config =& JFactory::getConfig();
			$sender = FST_EMail::Get_Sender();
		
			$mailer->setSender($sender);
		
			$recipient = array($admin_rec['email']);
			//print_r($recipient);
			$mailer->addRecipient($recipient);
		
			$template = FST_EMail::Get_Template('email_handler_on_reply');
			$email = FST_EMail::ParseTemplate($template,$ticket,$subject,$body,$template['ishtml']);

			$mailer->isHTML($template['ishtml']);
			$mailer->setSubject($email['subject']);
			$mailer->setBody($email['body']);
		
			$send =& $mailer->Send();
		}
	}

	function &GetHandler($admin_id)
	{
		if ($admin_id == 0)
		{
			$res = array("name" => JText::_("UNASSIGNED"),"username" => JText::_("UNASSIGNED"),"email" => "");
			return $res;	
		}
		$db =& JFactory::getDBO();
		$query = " SELECT a.*, au.name, au.username, au.email FROM #__fst_user as a ";
		$query .= " LEFT JOIN #__users as au ON a.user_id = au.id ";
		$query .= " WHERE a.id = '{$db->getEscaped($admin_id)}'";
		$db->setQuery($query);
		$handler = $db->loadAssoc();
		return $handler;
	} 

	function &GetUser($user_id)
	{
		$db =& JFactory::getDBO();
		$qry = "SELECT * FROM #__users WHERE id = '{$db->getEscaped($user_id)}'";
		$db->setQuery($qry);
		$row = $db->loadAssoc();
		return $row;
	}

	function GetStatus($status_id)
	{
		$db =& JFactory::getDBO();
		$qry = "SELECT title FROM #__fst_ticket_status WHERE id = '{$db->getEscaped($status_id)}'";	
		$db->setQuery($qry);
		$row = $db->loadAssoc();
		return $row['title'];
	}

	function GetArticle($artid)
	{
		$db =& JFactory::getDBO();
		$qry = "SELECT title FROM #__fst_kb_art WHERE id = '{$db->getEscaped($artid)}'";	
		$db->setQuery($qry);
		$row = $db->loadAssoc();
		return $row['title'];
	}

	function GetPriority($pri_id)
	{
		$db =& JFactory::getDBO();
		$qry = "SELECT title FROM #__fst_ticket_pri WHERE id = '{$db->getEscaped($pri_id)}'";	
		$db->setQuery($qry);
		$row = $db->loadAssoc();
		return $row['title'];
	}

	function GetCategory($cat_id)
	{
		$db =& JFactory::getDBO();
		$qry = "SELECT title FROM #__fst_ticket_cat WHERE id = '{$db->getEscaped($cat_id)}'";	
		$db->setQuery($qry);
		$row = $db->loadAssoc();
		return $row['title'];
	}

	function GetDepartment($dept_id)
	{
		$db =& JFactory::getDBO();
		$qry = "SELECT title FROM #__fst_ticket_dept WHERE id = '{$db->getEscaped($dept_id)}'";	
		$db->setQuery($qry);
		$row = $db->loadAssoc();
		return $row['title'];
	}

	function GetProduct($prod_id)
	{
		$db =& JFactory::getDBO();
		$qry = "SELECT title FROM #__fst_prod WHERE id = '{$db->getEscaped($prod_id)}'";	
		$db->setQuery($qry);
		$row = $db->loadAssoc();
		return $row['title'];
	}

	function &ParseTemplate($template,&$ticket,$subject,$body,$ishtml)
	{
		$handler = FST_EMail::GetHandler($ticket['admin_id']);
		$custrec = FST_EMail::GetUser($ticket['user_id']);
	
		$subject = trim(str_ireplace("re:","",$subject));
		$vars[] = FST_EMail::BuildVar('subject',$subject);
		if ($ishtml)
		{
			$body = str_replace("\n","<br>\n",$body);	
		}
		$vars[] = FST_EMail::BuildVar('body',$body);
		$vars[] = FST_EMail::BuildVar('reference',$ticket['reference']);
		$vars[] = FST_EMail::BuildVar('password',$ticket['password']);
		
		if ($ticket['user_id'] == 0)
		{
			$vars[] = FST_EMail::BuildVar('user_name',$ticket['unregname']);
			$vars[] = FST_EMail::BuildVar('user_username',JText::_("UNREGISTERED"));
			$vars[] = FST_EMail::BuildVar('user_email',$ticket['email']);
		} else {
			$vars[] = FST_EMail::BuildVar('user_name',$custrec['name']);
			$vars[] = FST_EMail::BuildVar('user_username',$custrec['username']);
			$vars[] = FST_EMail::BuildVar('user_email',$custrec['email']);
		}
		$vars[] = FST_EMail::BuildVar('handler_name',$handler['name']);
		$vars[] = FST_EMail::BuildVar('handler_username',$handler['username']);
		$vars[] = FST_EMail::BuildVar('handler_email',$handler['email']);
		
		$vars[] = FST_EMail::BuildVar('ticket_id',$ticket['id']);
		$vars[] = FST_EMail::BuildVar('status',FST_EMail::GetStatus($ticket['ticket_status_id']));
		$vars[] = FST_EMail::BuildVar('priority',FST_EMail::GetPriority($ticket['ticket_pri_id']));
		$vars[] = FST_EMail::BuildVar('category',FST_EMail::GetCategory($ticket['ticket_cat_id']));
		$vars[] = FST_EMail::BuildVar('department',FST_EMail::GetDepartment($ticket['ticket_dept_id']));
		$vars[] = FST_EMail::BuildVar('product',FST_EMail::GetProduct($ticket['prod_id']));
		
		$uri =& JURI::getInstance();
		$baseUrl = $uri->toString( array('scheme', 'host', 'port'));
		
		$vars[] = FST_EMail::BuildVar('ticket_link',$baseUrl . FSTRoute::_('index.php?option=com_fst&view=ticket&ticketid=' . $ticket['id']));

		$config = JFactory::getConfig();
		$sitename = $config->getValue('sitename');
		if (FST_Settings::get('support_email_site_name') != "")
			$sitename = FST_Settings::get('support_email_site_name');

		$vars[] = FST_EMail::BuildVar('websitetitle',$sitename);
	
		// need to add the tickets custom fields to the output here
		
		$fields = FSTCF::GetAllCustomFields(true);
		$values = FSTCF::GetTicketValues($ticket['id'],$ticket);
		
		foreach ($fields as $fid => &$field)
		{
			$name = "custom_" . $fid;
			$value = "";
			if (array_key_exists($fid, $values))
				$value = $values[$fid]['value'];
			//echo "$name -> $value<br>";
			$vars[] = FST_EMail::BuildVar($name, $value);
		}
		
		$email['subject'] = FST_EMail::ParseText($template['subject'],$vars);
		$email['body'] = FST_EMail::ParseText($template['body'],$vars);
	
		if ($template['ishtml'])
			$email['subject'] = str_replace("\n","<br \>\n",$email['subject']);

		//print_p($vars);
		//print_p($email);
		//exit;
		return $email;	
	}

	function BuildVar($name,$value)
	{
		$data['name'] = $name;
		$data['value'] = $value;
		return $data;
	}

	function ParseText($text,&$vars)
	{
		foreach ($vars as $var)
		{
			//echo "Proc : {$var['name']}<br>";
			$value = $var['value'];
			$block = "{".$var['name']."}";
			$start = "{".$var['name']."_start}";
			$end = "{".$var['name']."_end}";
		
			if ($value != "")
			{
				$text = str_replace($block, $value, $text);	
				$text = str_replace($start, "", $text);	
				$text = str_replace($end, "", $text);	
			} else {
				$text = str_replace($block, "", $text);	
				$pos_end = strpos($text, $end);
				$pos_beg = strpos($text, $start);
				//echo "$start = $pos_beg, $end = $pos_end<br>";
				if ($pos_end && $pos_beg){
					$text = substr_replace($text, '', $pos_beg, ($pos_end - $pos_beg) + strlen($end));
				}
			}
		}
		return $text;
	}

	function Get_Template($tmpl)
	{
		$db =& JFactory::getDBO();
		$qry = 	"SELECT body, subject, ishtml FROM #__fst_emails WHERE tmpl = '{$db->getEscaped($tmpl)}'";
		$db->setQuery($qry);
		return $db->loadAssoc();
	}
}
