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

// No direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );
require_once (JPATH_SITE.DS.'components'.DS.'com_fst'.DS.'helper'.DS.'paginationjs.php');

class FstModelAdmin extends JModel
{
	function getPermissions()
	{
		if (empty($this->_permissions)) {
			$mainframe = JFactory::getApplication(); global $option;
			$user = JFactory::getUser();
			
			$userid = $user->id;
			
			$db =& JFactory::getDBO();
			$query = "SELECT * FROM #__fst_user WHERE user_id = '{$db->getEscaped($userid)}'";
			$db->setQuery($query);
			$this->_permissions = $db->loadAssoc();
			
			if ($this->_permissions['allprods'] == 0)
			{
				$query = "SELECT prod_id FROM #__fst_user_prod WHERE user_id = '" . $db->getEscaped($this->_permissions['id']) . "'";
				$db->setQuery($query);
				$this->_perm_prods = $db->loadResultArray();
				if (count($this->_perm_prods) == 0)
					$this->_perm_prods[] = 0;
				$this->_perm_prods = " AND prod_id IN (" . implode(",",$this->_perm_prods) . ") ";
			} else {
				$this->_perm_prods = '';	
			}
			
			if ($this->_permissions['alldepts'] == 0)
			{
				$query = "SELECT ticket_dept_id FROM #__fst_user_dept WHERE user_id = '" . $db->getEscaped($this->_permissions['id']) . "'";
				$db->setQuery($query);
				$this->_perm_depts = $db->loadResultArray();
				if (count($this->_perm_depts) == 0)
					$this->_perm_depts[] = 0;
				$this->_perm_depts = " AND ticket_dept_id IN (" . implode(",",$this->_perm_depts) . ") ";
			} else {
				$this->_perm_depts = '';	
			}
			
			if ($this->_permissions['allcats'] == 0)
			{
				$query = "SELECT ticket_cat_id FROM #__fst_user_cat WHERE user_id = '" . $db->getEscaped($this->_permissions['id']) . "'";
				$db->setQuery($query);
				$this->_perm_cats = $db->loadResultArray();
				if (count($this->_perm_cats) == 0)
					$this->_perm_cats[] = 0;
				$this->_perm_cats = " AND ticket_cat_id IN (" . implode(",",$this->_perm_cats) . ") ";
			} else {
				$this->_perm_cats = '';	
			}
			
			if ($this->_permissions['seeownonly'])
			{
				$this->_perm_only = ' AND (admin_id = 0 OR admin_id = ' . $this->_permissions['id'] .') ';	
			} else {
				$this->_perm_only = '';	
			}
			
			$this->_perm_where = $this->_perm_prods . $this->_perm_depts . $this->_perm_cats . $this->_perm_only;
		}
		return $this->_permissions;			
	}
	
	function getTests()
	{
		$query = "SELECT t.id, t.prod_id, t.title, t.body, t.email, t.name, t.website, t.added, p.title as ptitle FROM #__fst_test as t LEFT JOIN #__fst_prod as p ON t.prod_id = p.id WHERE t.published = 0 ORDER BY added LIMIT 10";
		$db =& JFactory::getDBO();
		$db->setQuery($query);
		$rows = $db->loadAssocList();
		return $rows;
	}	
	
	function getTicketOpen()
	{
		$this->getTicketCount();
		return $this->_counts['open'];
	}
	
	function getTicketFollow()
	{
		$this->getTicketCount();
		return $this->_counts['follow'];
	}
	
	function getTicketUser()
	{
		$this->getTicketCount();
		return $this->_counts['reply'];
	}
	
	function getTestCount()
	{
		$query = "SELECT count(*) as cnt FROM #__fst_test WHERE published = 0";
		$db =& JFactory::getDBO();
		$db->setQuery($query);
		$rows = $db->loadAssoc();
		return $rows['cnt'];
	}
	
	function getKbcomms()
	{
		$query = "SELECT c.id, c.name, c.email, c.website, c.body, c.created, a.title FROM #__fst_kb_comment as c LEFT JOIN #__fst_kb_art as a ON c.kb_art_id = a.id WHERE c.published = 0 ORDER BY created LIMIT 10";
		$db =& JFactory::getDBO();
		$db->setQuery($query);
		$rows = $db->loadAssocList();
		return $rows;
	}
	
	function getKbcommcount()
	{
		/*$query = "SELECT count(*) as cnt FROM #__fst_kb_comment WHERE published = 0";
		$db =& JFactory::getDBO();
		$db->setQuery($query);
		$rows = $db->loadAssoc();
		return $rows['cnt'];*/
		return 0;
	}
	
	function &getTickets()
	{
		$mainframe = JFactory::getApplication();
		$limit = $mainframe->getUserStateFromRequest('global.list.limit_ticket', 'limit', FST_Helper::getUserSetting('per_page'), 'int');
		$limitstart = JRequest::getVar('limitstart', 0, '', 'int');
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

		$db =& JFactory::getDBO();
		if (empty($this->_tickets))
		{
			$query = "SELECT t.*, s.title as status, s.color, u.name, au.name as assigned, u.email as useremail, u.username as username, au.email as handleremail, au.username as handlerusername, ";
			$query .= " dept.title as department, cat.title as category, prod.title as product, pri.title as priority, pri.color as pricolor, ";
			$query .= " grp.groupname as groupname, grp.id as group_id ";
			$query .= " FROM #__fst_ticket_ticket as t ";
			$query .= " LEFT JOIN #__fst_ticket_status as s ON t.ticket_status_id = s.id ";
			$query .= " LEFT JOIN #__users as u ON t.user_id = u.id ";
			$query .= " LEFT JOIN #__fst_user as a ON t.admin_id = a.id ";
			$query .= " LEFT JOIN #__users as au ON a.user_id = au.id ";
			$query .= " LEFT JOIN #__fst_ticket_dept as dept ON t.ticket_dept_id = dept.id ";
			$query .= " LEFT JOIN #__fst_ticket_cat as cat ON t.ticket_cat_id = cat.id ";
			$query .= " LEFT JOIN #__fst_prod as prod ON t.prod_id = prod.id ";
			$query .= " LEFT JOIN #__fst_ticket_pri as pri ON t.ticket_pri_id = pri.id ";
			$query .= " LEFT JOIN (SELECT group_id, user_id FROM #__fst_ticket_group_members GROUP BY user_id) as mem ON t.user_id = mem.user_id ";
			$query .= " LEFT JOIN #__fst_ticket_group as grp ON grp.id = mem.group_id ";
			
			$tickets = JRequest::getVar('tickets','open');
			if ($tickets == 'open')
				$query .= " WHERE (ticket_status_id = 1) ";
			elseif  ($tickets == 'follow')
				$query .= " WHERE (ticket_status_id = 2) ";
			elseif ($tickets == 'closed')
				$query .= " WHERE (ticket_status_id = 3) ";
			elseif ($tickets == 'reply')
				$query .= " WHERE (ticket_status_id = 4) ";
			elseif ($tickets == 'allopen')
				$query .= " WHERE (ticket_status_id = 1 OR ticket_status_id = 2 OR ticket_status_id = 4) ";
			elseif ($tickets == 'all')
				$query .= " WHERE (ticket_status_id = 1 OR ticket_status_id = 2 OR ticket_status_id = 3 OR ticket_status_id = 4) ";
			elseif ($tickets == 'archived')
				$query .= " WHERE (ticket_status_id = 5) ";
			else
				$query .= " WHERE 1 ";
		
			$query .= $this->_perm_where;

			$order = array();
			if (FST_Helper::getUserSetting("group_products"))
				$order[] = "prod.ordering";
				
			if (FST_Helper::getUserSetting("group_departments"))
				$order[] = "dept.title";
				
			if (FST_Helper::getUserSetting("group_cats"))
				$order[] = "cat.title";
				
			if (FST_Helper::getUserSetting("group_pri"))
				$order[] = "pri.ordering DESC";
				
			if (FST_Helper::getUserSetting("group_group"))
			{
				$order[] = "case when grp.groupname is null then 1 else 0 end";
				$order[] = "grp.groupname";
			}
				
			$order[] = "lastupdate DESC";
			$query .= " ORDER BY " . implode(", ", $order);

			$db->setQuery($query);
			$db->query();
			$this->_ticketcount = $db->getNumRows();
					
			$db->setQuery($query, $limitstart, $limit);
			$this->_tickets = $db->loadAssocList('id');
			
		}

		
		$result['pagination'] = new JPaginationEx($this->_ticketcount, $limitstart, $limit );
		$result['count'] = &$this->_ticketcount;
		$result['tickets'] = &$this->_tickets;
		return $result;   		
	}
	
	function &getTicketSearch()
	{
		$mainframe = JFactory::getApplication();
		$limit = $mainframe->getUserStateFromRequest('global.list.limit_ticket', 'limit', 10, 'int');
		$limitstart = JRequest::getVar('limitstart', 0, '', 'int');
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

		$db =& JFactory::getDBO();
		
		if (empty($this->_tickets))
		{
			$query = "SELECT t.*, s.title as status, s.color, u.name, au.name as assigned, u.email as useremail, u.username as username, au.email as handleremail, au.username as handlerusername, ";
			$query .= " dept.title as department, cat.title as category, prod.title as product, pri.title as priority, pri.color as pricolor, ";
			$query .= " grp.groupname as groupname, grp.id as group_id ";
			$query .= " FROM #__fst_ticket_ticket as t ";
			$query .= " LEFT JOIN #__fst_ticket_status as s ON t.ticket_status_id = s.id ";
			$query .= " LEFT JOIN #__users as u ON t.user_id = u.id ";
			$query .= " LEFT JOIN #__fst_user as a ON t.admin_id = a.id ";
			$query .= " LEFT JOIN #__users as au ON a.user_id = au.id ";
			$query .= " LEFT JOIN #__fst_ticket_dept as dept ON t.ticket_dept_id = dept.id ";
			$query .= " LEFT JOIN #__fst_ticket_cat as cat ON t.ticket_cat_id = cat.id ";
			$query .= " LEFT JOIN #__fst_prod as prod ON t.prod_id = prod.id ";
			$query .= " LEFT JOIN #__fst_ticket_pri as pri ON t.ticket_pri_id = pri.id ";
			$query .= " LEFT JOIN (SELECT group_id, user_id FROM #__fst_ticket_group_members GROUP BY user_id) as mem ON t.user_id = mem.user_id ";
			$query .= " LEFT JOIN #__fst_ticket_group as grp ON grp.id = mem.group_id ";

			$searchtype = JRequest::getVar('searchtype','basic');
			$ticketids = array();
			$ticketids[0] = 0;
			$ticketid_matchall = 0;

			$tags = JRequest::getVar('tags','');
			$tags = trim($tags,';');
			if ($tags)
			{
				$tags_ = explode(";",$tags);
				$tags = array();
				foreach($tags_ as $tag)
				{
					if ($tag)
						$tags[$tag] = $tag;
				}

				if (count($tags) > 0)
				{
					foreach($tags as $tag)
					{
						$ticketid_matchall++;
						$qry = "SELECT ticket_id FROM #__fst_ticket_tags WHERE tag = '{$db->getEscaped($tag)}'";
						$db->setQuery($qry);
						//echo $qry."<br>";
						$rows = $db->loadAssocList("ticket_id");
						foreach($rows as $row)
						{
							$ticketid =	$row['ticket_id'];
							if (array_key_exists($ticketid,$ticketids))
							{
								$ticketids[$ticketid]++;
							} else {
								$ticketids[$ticketid] = 1;
							}
						}
						
					}	
				}
			}

			if ($searchtype == "basic")
			{
				$search = JRequest::getVar('search','');
				$wherebits = array();
				
				// store tag match ids in separate array, as we want to AND them, not OR
				$tagids = $ticketids;
				$ticketids = array();
				$ticketids[0] = 0;

				if ($search != "")
				{
					$wherebits[] = " t.title LIKE '%{$db->getEscaped($search)}%' ";
					$wherebits[] = " t.reference = '{$db->getEscaped($search)}' ";
			
					// search custom fields that are set to be searched
					$fields = FSTCF::GetAllCustomFields(true);
					/*echo "<pre>";
					print_r($fields);
					echo "</pre>";*/
					foreach ($fields as $field)
					{
						if (!$field['basicsearch']) continue;

						$ticketid_matchall++;
						
						$fieldid = $field['id'];
						$qry = "SELECT ticket_id FROM #__fst_ticket_field WHERE field_id = '" . $db->getEscaped($fieldid) . "' AND value LIKE '%" . $db->getEscaped($search) . "%'";
						$db->setQuery($qry);	
						//echo $qry."<br>";
						$moreids = $db->loadAssoclist();
						//print_r($moreids);
						foreach($moreids as $row)
						{
							if (array_key_exists($row['ticket_id'],$ticketids))
							{
								$ticketids[$row['ticket_id']]++;
							} else {
								$ticketids[$row['ticket_id']] = 1;
							}
						}				
					}

					// basic search optional fields
					if (FST_Settings::get('support_basic_name'))
					{
						$wherebits[] = " u.name LIKE '%{$db->getEscaped($search)}%' ";
						$wherebits[] = " unregname LIKE '%{$db->getEscaped($search)}%' ";
					}

					if (FST_Settings::get('support_basic_username'))
					{
						$wherebits[] = " u.username LIKE '%{$db->getEscaped($search)}%' ";
					}

					if (FST_Settings::get('support_basic_email'))
					{
						$wherebits[] = " u.email LIKE '%{$db->getEscaped($search)}%' ";
						$wherebits[] = " t.email LIKE '%{$db->getEscaped($search)}%' ";
					}

					if (FST_Settings::get('support_basic_messages'))
					{
						$ticketid_matchall++;
						
						$fieldid = $field['id'];
						$qry = "SELECT ticket_ticket_id as ticket_id FROM #__fst_ticket_messages WHERE subject LIKE '%" . $db->getEscaped($search) . "%' OR body LIKE '%" . $db->getEscaped($search) . "%'";
						$db->setQuery($qry);	
						//echo $qry."<br>";
						$moreids = $db->loadAssoclist();
						//print_r($moreids);
						foreach($moreids as $row)
						{
							if (array_key_exists($row['ticket_id'],$ticketids))
							{
								$ticketids[$row['ticket_id']]++;
							} else {
								$ticketids[$row['ticket_id']] = 1;
							}
						}				
					}
				}


				if (count($ticketids) > 1)
				{
					$tids = array();
					foreach($ticketids as $id => $rec)
					{
						$tids[] = $id;
					}	
					$ticketids = $tids;
					unset($tids);
				}

				if (count($ticketids) > 1)
					$wherebits[] = "t.id IN (".implode(",",$ticketids).")";
				
				if (count($wherebits) == 0)
					$wherebits[] = "1";

				$query .= " WHERE (" . implode(" OR ", $wherebits) . ")";

				// add ticket tag ids
				if (count($tagids) > 1)
				{
					$tids = array();
					foreach($tagids as $id => $rec)
					{
						$tids[] = $id;
					}	
					$tagids = $tids;
					unset($tids);
					$query .= " AND t.id IN (".implode(",",$tagids).")";
				}

				//echo $query . "<br>";
			} else if ($searchtype == "advanced")
			{
				$search = JRequest::getVar('search','');
				$wherebits = array();
			
				$subject = JRequest::getVar('subject','');
				if ($subject)
					$wherebits[] = " t.title LIKE '%{$db->getEscaped($subject)}%' ";
			
				$reference = JRequest::getVar('reference','');
				if ($reference)
					$wherebits[] = " t.reference = '{$db->getEscaped($reference)}' ";
			
				$username = JRequest::getVar('username','');
				if ($username)
					$wherebits[] = " u.username LIKE '%{$db->getEscaped($username)}%' ";
			
				$useremail = JRequest::getVar('useremail','');
				if ($useremail)
					$wherebits[] = " ( u.email LIKE '%{$db->getEscaped($useremail)}%' OR t.email LIKE '%{$db->getEscaped($useremail)}%' ) ";
			
				$userfullname = JRequest::getVar('userfullname','');
				if ($userfullname)
					$wherebits[] = " ( u.name LIKE '%{$db->getEscaped($userfullname)}%' OR unregname LIKE '%{$db->getEscaped($userfullname)}%' ) ";
			
				$content = JRequest::getVar('content','');
				if ($content)
				{
					$q = " t.id IN ";
					$q .= "( SELECT ticket_ticket_id FROM #__fst_ticket_messages WHERE body LIKE '%{$db->getEscaped($content)}%' )";
					$wherebits[] = $q;
				}
			
				$handler = JRequest::getVar('handler','');
				if ($handler)
					$wherebits[] = " t.admin_id = '{$db->getEscaped($handler)}' ";
			
				$status = JRequest::getVar('status','');
				if ($status)
					$wherebits[] = " t.ticket_status_id = '{$db->getEscaped($status)}' ";
			
				$product = JRequest::getVar('product','');
				if ($product)
					$wherebits[] = " t.prod_id = '{$db->getEscaped($product)}' ";
			
				$department = JRequest::getVar('department','');
				if ($department)
					$wherebits[] = " t.ticket_dept_id = '{$db->getEscaped($department)}' ";
			
				$cat = JRequest::getVar('cat','');
				if ($cat)
					$wherebits[] = " t.ticket_cat_id = '{$db->getEscaped($cat)}' ";
			
				$pri = JRequest::getVar('priority','');
				if ($pri)
					$wherebits[] = " t.ticket_pri_id = '{$db->getEscaped($pri)}' ";
				
				$group = JRequest::getVar('group','');
				if ($group > 0)
				{
					$wherebits[] = " t.user_id IN (SELECT user_id FROM #__fst_ticket_group_members WHERE group_id = '{$db->getEscaped($group)}' GROUP BY user_id)";
				}
		
				$date_from = $this->DateValidate(JRequest::getVar('date_from',''));
				$date_to = $this->DateValidate(JRequest::getVar('date_to',''));
				
				/*if ($date_from && $date_to)
				{
					// got both date, need a ticket with 
				} else*/if ($date_from)
				{
					$wherebits[] = " t.lastupdate > DATE_SUB('{$db->getEscaped($date_from)}',INTERVAL 1 DAY) ";
				} /*else*/if ($date_to)
				{
					$wherebits[] = " t.opened < DATE_ADD('{$db->getEscaped($date_to)}',INTERVAL 1 DAY) ";
				}

				// search custom fields that are set to be searched
				$fields = FSTCF::GetAllCustomFields(true);
				/*echo "<pre>";
				print_r($fields);
				echo "</pre>";*/
				foreach ($fields as $field)
				{
					if (!$field['advancedsearch']) continue;

					$search = JRequest::getVar('custom_' . $field['id'],"");
					//echo "Field : {$field['id']} = $search<br>";
					if ($search != "")
					{
						$ticketid_matchall++;
						
						$fieldid = $field['id'];
						if ($field['type'] == "checkbox")
						{
							if ($search == "1")
								$qry = "SELECT ticket_id FROM #__fst_ticket_field WHERE field_id = '" . $db->getEscaped($fieldid) . "' AND value = 'on'";
							else
								$qry = "SELECT ticket_id FROM #__fst_ticket_field WHERE field_id = '" . $db->getEscaped($fieldid) . "' AND value = ''";
						} elseif ($field['type'] == "radio" || $field['type'] == "combo")
						{
							$qry = "SELECT ticket_id FROM #__fst_ticket_field WHERE field_id = '" . $db->getEscaped($fieldid) . "' AND value = '" . $db->getEscaped($search) . "'";
						} else {
							$qry = "SELECT ticket_id FROM #__fst_ticket_field WHERE field_id = '" . $db->getEscaped($fieldid) . "' AND value LIKE '%" . $db->getEscaped($search) . "%'";
						}
						$db->setQuery($qry);	
						//echo $qry."<br>";
						$moreids = $db->loadAssoclist();
						//print_r($moreids);
						foreach($moreids as $row)
						{
							if (array_key_exists($row['ticket_id'],$ticketids))
							{
								$ticketids[$row['ticket_id']]++;
							} else {
								$ticketids[$row['ticket_id']] = 1;
							}
						}	
					}			
				}	
				
				if ($ticketid_matchall > 0)
				{
					unset($ticketids[0]);
					$tids = array();
					if (count($ticketids) > 0)
					{
						foreach($ticketids as $id => $rec)
						{
							if ($id == 0)
								continue;
							if ($rec == $ticketid_matchall)
								$tids[] = $id;
						}	
						$ticketids = $tids;
						unset($tids);
					}

					if (count($ticketids) > 0)
						$wherebits[] = "t.id IN (".implode(",",$ticketids).")";
					else
						$wherebits[] = "0";
				}


				if (count($wherebits) == 0)
					$wherebits[] = "1";
			
				$query .= " WHERE " . implode(" AND ", $wherebits);
			} else {
				$query .= " WHERE 1 ";
			}
			
			$query .= $this->_perm_where;


			$order = array();
			if (FST_Helper::getUserSetting("group_products"))
				$order[] = "prod.ordering";
				
			if (FST_Helper::getUserSetting("group_departments"))
				$order[] = "dept.title";
				
			if (FST_Helper::getUserSetting("group_cats"))
				$order[] = "cat.title";
				
			if (FST_Helper::getUserSetting("group_pri"))
				$order[] = "pri.ordering DESC";
				
			if (FST_Helper::getUserSetting("group_group"))
			{
				$order[] = "case when grp.groupname is null then 1 else 0 end";
				$order[] = "grp.groupname";
			}
				
			$order[] = "lastupdate DESC";
			$query .= " ORDER BY " . implode(", ", $order);
		
			//echo "<br>$query<br>";
			$db->setQuery($query);
			$db->query();
			$this->_ticketcount = $db->getNumRows();
					
			$db->setQuery($query, $limitstart, $limit);
			$this->_tickets = $db->loadAssocList('id');
		}
		/*echo "<pre>";
		print_r($result['tickets']);
		echo "</pre>";*/

		$result['pagination'] = new JPaginationJs($this->_ticketcount, $limitstart, $limit );
		$result['count'] = &$this->_ticketcount;
		$result['tickets'] = &$this->_tickets;
		return $result;   		
	}
	
	function DateValidate($in_date)
	{
		//echo "Checking $in_date<br>";
		$time = strtotime($in_date);
		//echo "Time : $time<br>";
		
		if ($time > 0)
		{
			return date("Y-m-d",$time);	
		}
		return "";	
	}
	
	function &getTicket($ticketid)
	{
		$db =& JFactory::getDBO();
		
		
		$query = "SELECT t.*, u.name, u.username, p.title as product, d.title as dept, c.title as cat, s.title as status, ";
		$query .= "s.color as scolor, s.id as sid, pr.title as pri, pr.color as pcolor, pr.id as pid FROM #__fst_ticket_ticket as t ";
		$query .= " LEFT JOIN #__users as u ON t.user_id = u.id ";
		$query .= " LEFT JOIN #__fst_prod as p ON t.prod_id = p.id ";
		$query .= " LEFT JOIN #__fst_ticket_dept as d ON t.ticket_dept_id = d.id ";
		$query .= " LEFT JOIN #__fst_ticket_cat as c ON t.ticket_cat_id = c.id ";
		$query .= " LEFT JOIN #__fst_ticket_status as s ON t.ticket_status_id = s.id ";
		$query .= " LEFT JOIN #__fst_ticket_pri as pr ON t.ticket_pri_id = pr.id ";
		$query .= " WHERE t.id = '{$db->getEscaped($ticketid)}' ";

		$db->setQuery($query);
		$rows = $db->loadAssoc();
		return $rows;   		
	}
	
	function &getMessages($ticketid)
	{
		$db =& JFactory::getDBO();
		
		$query = "SELECT m.*, u.name FROM #__fst_ticket_messages as m LEFT JOIN #__users as u ON m.user_id = u.id WHERE ticket_ticket_id = '{$db->getEscaped($ticketid)}' ORDER BY posted DESC";

		$db->setQuery($query);
		$rows = $db->loadAssocList();
		return $rows;   		
	}
	
	function &getMessage($messageid)
	{
		$db =& JFactory::getDBO();
		
		$query = "SELECT m.* FROM #__fst_ticket_messages as m WHERE m.id = '{$db->getEscaped($messageid)}' ORDER BY posted DESC";

		$db->setQuery($query);
		$rows = $db->loadAssoc();
		return $rows;   		
	}
	
	function &getAttach($ticketid)
	{
		$db =& JFactory::getDBO();
		
		$query = "SELECT a.*, u.name FROM #__fst_ticket_attach as a LEFT JOIN #__users as u ON a.user_id = u.id WHERE ticket_ticket_id = '{$db->getEscaped($ticketid)}' ORDER BY added DESC";

		$db->setQuery($query);
		$rows = $db->loadAssocList();
		return $rows;   		
	}
	
	function &getUsersGroups($user_id)
	{
		$db =& JFactory::getDBO();
		
		$query = "SELECT g.* FROM #__fst_ticket_group_members as m LEFT JOIN #__fst_ticket_group as g ON m.group_id = g.id WHERE m.user_id = '{$db->getEscaped($user_id)}'";

		$db->setQuery($query);
		$rows = $db->loadAssocList();
		return $rows;   		
	}
	
	/*function &getPriority($priid)
	{
	       $db =& JFactory::getDBO();
	       
	       $query = "SELECT * FROM #__fst_ticket_pri WHERE id = '$priid'";

	       $db->setQuery($query);
	       $rows = $db->loadAssoc();
	       return $rows;   		
		
	}*/
	
	/*function &getCategory($catid)
	{
	       $db =& JFactory::getDBO();
	       
	       $query = "SELECT * FROM #__fst_ticket_cat WHERE id = '$catid'";

	       $db->setQuery($query);
	       $rows = $db->loadAssoc();
	       return $rows;   		
		
	}*/
	
	/*function &getProduct()
	{
	    $db =& JFactory::getDBO();
	    $prodid = JRequest::getVar('prodid','');
	    $query = "SELECT * FROM #__fst_prod WHERE id = '$prodid'";

	    $db->setQuery($query);
	    $rows = $db->loadAssoc();
	    return $rows;        
	} */
	
	function &getPriorities()
	{
		if (empty($this->_priorities))
		{
			$db =& JFactory::getDBO();
		
			$query = "SELECT * FROM #__fst_ticket_pri ORDER BY id ASC";

			$db->setQuery($query);
			$this->_priorities = $db->loadAssocList('id');
		}
		return $this->_priorities;   			
	}
	
	
	function &getPriority($priid)
	{
		if (empty($this->_priorities))
		{
			$this->getPriorities();
		}

		return $this->_priorities[$priid];
	}
	
	function &getStatuss()
	{
		if (empty($this->_statuss))
		{
			$db =& JFactory::getDBO();
		
			$query = "SELECT * FROM #__fst_ticket_status WHERE id < 5 ORDER BY id ASC";

			$db->setQuery($query);
			$this->_statuss = $db->loadAssocList('id');
		}
		return $this->_statuss;   		
	}	
	
	function &getStatus($statusid)
	{
		if (empty($this->_statuss))
		{
			$this->getStatuss();
		}

		return $this->_statuss[$statusid];
	}
	
	function &getTicketCount()
	{
		if (empty($this->_permissions))
			$this->getPermissions();
			
		if (empty($this->_counts))
		{
			$db =& JFactory::getDBO();
			$query = "SELECT count( * ) AS count, ticket_status_id FROM #__fst_ticket_ticket WHERE 1 ";
			$query .= $this->_perm_where;
			$query .= " GROUP BY ticket_status_id";
			
			$db->setQuery($query);
			$rows = $db->loadAssocList();
			
			$out["open"] = 0;
			$out["reply"] = 0;
			$out["follow"] = 0;
			$out["closed"] = 0;
			
			if (count($rows) > 0)
			{
				foreach ($rows as $row)
				{
					if ($row['ticket_status_id'] == 1)
					{
						$out["open"] = $row['count'];
					} else if ($row['ticket_status_id'] == 2)
					{
						$out["follow"] = $row['count'];
					} else if ($row['ticket_status_id'] == 3)
					{
						$out["closed"] = $row['count'];
					} else if ($row['ticket_status_id'] == 4)
					{
						$out["reply"] = $row['count'];
					}	
				}
			}
			
			$out['all'] = $out["open"] + $out["follow"] + $out["closed"] + $out["reply"];
			
			$this->_counts = $out;
		}
		return $this->_counts;
	}
	
	/*function &getDepartment()
	{
	    $db =& JFactory::getDBO();
	    $deptid = JRequest::getVar('deptid','');
	    $query = "SELECT * FROM #__fst_ticket_dept WHERE id = '$deptid'";

	    $db->setQuery($query);
	    $rows = $db->loadAssoc();
	    return $rows;        
	}*/ 
	
	function &getAdminUser($adminid)
	{
		$db =& JFactory::getDBO();
		
		$query = " SELECT a.*, au.name, au.username FROM #__fst_user as a ";
		$query .= " LEFT JOIN #__users as au ON a.user_id = au.id ";
		$query .= " WHERE a.id = '{$db->getEscaped($adminid)}'";
		
		$db->setQuery($query);
		$rows = $db->loadAssoc();
		return $rows;   		
	}
	
	function getUser($user_id)
	{
		$db =& JFactory::getDBO();

		$query = " SELECT * FROM #__users ";
		$query .= " WHERE id = '{$db->getEscaped($user_id)}'";
		
		$db->setQuery($query);
		$rows = $db->loadAssoc();
		return $rows;   		
	}

	function getAdminUsers()
	{
		if (empty( $this->_adminusers )) 
		{
			$query = "SELECT u.id as admin_id, m.id, CONCAT(m.username,' (',m.name,')') as name, m.email FROM #__users as m ";
			$query .= " LEFT JOIN #__fst_user as u ON m.id = u.user_id ";
			$query .= " WHERE u.id > 0 AND u.support = 1 ";
			$query .= " ORDER BY m.username";
			
			$db =& JFactory::getDBO();
			$db->setQuery($query);
			$this->_adminusers = $db->loadAssocList();
		}
		return $this->_adminusers;
	}
	
	function getDepartments()
	{
		if (empty( $this->_depts )) 
		{
			$query = "SELECT * FROM #__fst_ticket_dept ORDER BY title";
			$db =& JFactory::getDBO();
			$db->setQuery($query);
			$this->_depts = $db->loadAssocList();
		}
		return $this->_depts;
	}
		
	function GetDepartment($dept_id)
	{
		$db =& JFactory::getDBO();
		$qry = "SELECT * FROM #__fst_ticket_dept WHERE id = '{$db->getEscaped($dept_id)}'";
        $db->setQuery($qry);
		$rec = $db->loadObject();
		return $rec->title;	
	}
		
	function GetProduct($prod_id)
	{
		$db =& JFactory::getDBO();
		$qry = "SELECT * FROM #__fst_prod WHERE id = '{$db->getEscaped($prod_id)}'";
        $db->setQuery($qry);
		$rec = $db->loadObject();
		return $rec->title;	
	}

	function getProducts()
	{
		if (empty( $this->_prods )) 
		{
			$query = "SELECT * FROM #__fst_prod ORDER BY title";
			$db =& JFactory::getDBO();
			$db->setQuery($query);
			$this->_prods = $db->loadAssocList();
		}
		return $this->_prods;
	}

	function getGroups()
	{
		if (empty( $this->_groups )) 
		{
			$query = "SELECT * FROM #__fst_ticket_group ORDER BY groupname";
			$db =& JFactory::getDBO();
			$db->setQuery($query);
			$this->_groups = $db->loadAssocList();
		}
		return $this->_groups;
	}
	
	function getCats()
	{
		if (empty( $this->_cats )) 
		{
			$query = "SELECT * FROM #__fst_ticket_cat ORDER BY title";
			$db =& JFactory::getDBO();
			$db->setQuery($query);
			$this->_cats = $db->loadAssocList();
		}
		return $this->_cats;
	}
	
	function getHandlers()
	{
		if (empty( $this->_handlers )) 
		{
			$query = "SELECT au.id, u.name, u.id as user_id, u.username, u.email FROM #__fst_user as au LEFT JOIN #__users as u ON au.user_id = u.id WHERE support = 1";
			$db =& JFactory::getDBO();
			$db->setQuery($query);
			$this->_handlers = $db->loadAssocList();
		}
		return $this->_handlers;
	}

	function getTags($ticketid)
	{
		if (empty( $this->_tags )) 
		{
			$db =& JFactory::getDBO();
			$query = "SELECT tag FROM #__fst_ticket_tags WHERE ticket_id = '{$db->getEscaped($ticketid)}'";
			$db->setQuery($query);
			$this->_tags = $db->loadAssocList();
		}
		return $this->_tags;	
	}

	function getAllTags()
	{
		if (empty( $this->_alltags )) 
		{ 
			$db =& JFactory::getDBO();
			$query = "SELECT count(*) as cnt, tag FROM #__fst_ticket_tags GROUP BY tag ORDER BY cnt DESC LIMIT 10";
			$db->setQuery($query);
			$this->_alltags = $db->loadAssocList();
		}
		return $this->_alltags;	
	}

	function getTagsPerTicket()
	{
		$ticketids = array();

		if (empty($this->_tickets) || count($this->_tickets) == 0)
			return;

		foreach($this->_tickets as &$ticket)
		{
			$ticketids[] = $ticket['id'];
		}

		$qry = "SELECT * FROM #__fst_ticket_tags WHERE ticket_id IN (" . implode(",",$ticketids) . ")";
		$db =& JFactory::getDBO();
		$db->setQuery($qry);
		$tags = $db->loadAssocList();

		if (count($tags) > 0)
		{
			foreach($tags as $tag)
			{
				$this->_tickets[$tag['ticket_id']]['tags'][] = $tag;	
			}
		}
	}

	function getMessageCounts()
	{
		$ticketids = array();

		if (empty($this->_tickets) || count($this->_tickets) == 0)
			return;

		$db =& JFactory::getDBO();
		
		foreach($this->_tickets as &$ticket)
		{
			$ticketids[] = $db->getEscaped($ticket['id']);
			$ticket['msgcount'] = array();
			$ticket['msgcount'][0] = 0;
			$ticket['msgcount'][1] = 0;
			$ticket['msgcount']['total'] = 0;
			
		}

		$qry = "SELECT ticket_ticket_id, admin, count(*) as msgcnt FROM #__fst_ticket_messages WHERE ticket_ticket_id IN (" . implode(",",$ticketids) . ") GROUP BY ticket_ticket_id, admin";
		$db->setQuery($qry);
		//echo $qry."<br>";
		$tags = $db->loadAssocList();
		if (count($tags) > 0)
		{
			foreach($tags as $tag)
			{
				$this->_tickets[$tag['ticket_ticket_id']]['msgcount'][$tag['admin']] = $tag['msgcnt'];
				if ($tag['admin'] < 2)
				{
					if (array_key_exists('total',$this->_tickets[$tag['ticket_ticket_id']]['msgcount']))
					{
						$this->_tickets[$tag['ticket_ticket_id']]['msgcount']['total'] += $tag['msgcnt'];	
					} else {
						$this->_tickets[$tag['ticket_ticket_id']]['msgcount']['total'] = 1;	
					}
				}
			}	
		}	
	}

	function getAttachPerTicket()
	{
		$ticketids = array();
		
		if (empty($this->_tickets) || count($this->_tickets) == 0)
			return;

		$db =& JFactory::getDBO();
		
		foreach($this->_tickets as &$ticket)
		{
			$ticketids[] = $db->getEscaped($ticket['id']);
		}

		$qry = "SELECT * FROM #__fst_ticket_attach WHERE ticket_ticket_id IN (" . implode(",",$ticketids) . ")";
		$db->setQuery($qry);
		$tags = $db->loadAssocList();
		if (count($tags) > 0)
		{
			foreach($tags as $tag)
			{
				$this->_tickets[$tag['ticket_ticket_id']]['attach'][] = $tag;	
			}	
		}	
	}

	function getGroupsPerTicket()
	{
		$user_ids = array();
		
		if (empty($this->_tickets) || count($this->_tickets) == 0)
			return;

		$db =& JFactory::getDBO();
		
		foreach($this->_tickets as &$ticket)
		{
			$ticket['groups'] = array();
			if ($ticket['user_id'] > 0)
				$user_ids[] = $db->getEscaped($ticket['user_id']);
		}

		if (count($user_ids) == 0)
			return;

		$qry = "SELECT m.user_id, g.groupname FROM #__fst_ticket_group_members as m LEFT JOIN #__fst_ticket_group as g ON m.group_id = g.id WHERE m.user_id IN (" . implode(",",$user_ids) . ")";
		$db->setQuery($qry);
		$tags = $db->loadAssocList();
		
		foreach($this->_tickets as &$ticket)
		{
			$user_id = $ticket['user_id'];
			if ($user_id == 0) continue;
			
			foreach ($tags as $tag)
			{
				if ($tag['user_id'] == $user_id)
					$ticket['groups'][] = $tag['groupname'];		
			}	
		}
	}

	function GetUserNameFromFSTUID($user_id)
	{
		$db =& JFactory::getDBO();
		$qry = "SELECT * FROM #__fst_user WHERE id = '{$db->getEscaped($user_id)}'";
        $db->setQuery($qry);
		$rec = $db->loadObject();
		$user = JFactory::getUser($rec->user_id);
		return $user->name . " (" . $user->username . ")";
	}

	function getAnnouncements()
	{
		// get a list of announcements, including pagination and filter
			
		$db =& JFactory::getDBO();
		$qry = "SELECT a.id, a.title, a.subtitle, a.published, a.added, u.name, u.username FROM #__fst_announce as a LEFT JOIN #__users as u ON a.author = u.id ";
		
		$qry .= " ORDER BY added DESC";
		$db->setQuery($qry);
		return $db->loadObjectList();
	}

	function getAnnouncement()
	{
		// get a list of announcements, including pagination and filter
		$id = JRequest::getVar('id',0);
		
		$db =& JFactory::getDBO();
		$qry = "SELECT a.*, u.name, u.username FROM #__fst_announce as a LEFT JOIN #__users as u ON a.author = u.id ";
		
		$qry .= "WHERE a.id = '{$db->getEscaped($id)}'";
		
		$db->setQuery($qry);
		return $db->loadObject();
	}
	
	function getArticleCounts()
	{
		if (empty($this->artcounts))
		{
			$this->artcounts = array();
		
			$types = array();
			$types[] = "announce";
			$types[] = "faqs";
			$types[] = "kb";
		
			foreach($types as $type)
			{
				require_once (JPATH_SITE.DS.'components'.DS.'com_fst'.DS.'helper'.DS.'content'.DS.$type.'.php');
				$class = "FST_ContentEdit_$type";
				$content = new $class();
				$this->artcounts[$type] = array();	
				$this->artcounts[$type]['desc'] = $content->descs;
				$this->artcounts[$type]['id'] = $content->id;
				$this->artcounts[$type]['counts'] = $content->GetCounts();
			}
		}
		
		return $this->artcounts;
	}
}

