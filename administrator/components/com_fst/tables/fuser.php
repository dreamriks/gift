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


class TableFuser extends JTable
{
	
	var $id = null;

	var $mod_kb = 0;
	var $mod_test = 0;
	var $support = 0;
	var $user_id = 0;
	var $group_id = 0;
	var $seeownonly = 0;
	var $autoassignexc = 0;
	var $allprods = 0;
	var $allcats = 0;
	var $alldepts = 0;
	var $artperm = 0;
	var $groups = 0;

	function TableFuser(& $db) {
		parent::__construct('#__fst_user', 'id', $db);
	}
}


