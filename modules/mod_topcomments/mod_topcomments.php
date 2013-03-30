<?PHP
/*
 * Top comments module that lists the top commenters.
 * Copyright Azrul Studio
 *    
 */ 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
global $database, $_JC_CONFIG, $mosConfig_absolute_path;

$count  		= intval( $params->get( 'count', 5 ) ); #Get total users to display.
$link   		= $params->get('linktype','disabled');  #Get the link to user profile type
$avatar 		= $params->get('avatar',0);             #Get avatar to show or not to show.
$avatarWidth    = $params->get('aWidth',35);            #Get avatar width.
$avatarHeight   = $params->get('aHeight',35);           #Get avatar height.

#Default name to use name.
$name   = 'b.name';

if($_JC_CONFIG->get('username') == 'name'){
	#Use name field
	$name	= 'b.name';
}
elseif($_JC_CONFIG->get('username') == 'username'){
	#Use username field
	$name   = 'b.username';
}


$strSQL = "SELECT a.user_id, count( a.user_id ) AS totalcomments, $name AS name, "
		 ."b.email AS email, MONTHNAME(date) AS month "
         ."FROM #__jomcomment AS a "
         ."INNER JOIN #__users AS b ON b.id=a.user_id "
         ."WHERE a.user_id !='0' AND a.published !='0' "
         ."GROUP BY a.user_id "
         ."ORDER BY totalcomments DESC "
         ."LIMIT $count";



$database->setQuery($strSQL);
$rows	= $database->loadObjectList();

if(!defined('JCView')){
	// Check if UTF8Helper exists
	if(!class_exists('Utf8Helper'))
	    require_once($mosConfig_absolute_path . '/components/com_jomcomment/class.encoding.php');

    require_once($mosConfig_absolute_path . '/components/com_jomcomment/views.jomcomment.php');
}
$view = new JCView();
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<?PHP
if($rows){
	foreach($rows as $row){
?>
	<tr>
<?PHP
		if($avatar){
?>
	    <td width="30%">
	        <div class="avatarImg">
				<img src="<?PHP echo getAvatar($row->email,$row->user_id);?>" width="<?PHP echo $avatarWidth;?>" height="<?PHP echo $avatarHeight;?>">
			</div>
		</td>
<?PHP
        }
        else{
?>
		<td width="1%">&nbsp;</td>
<?PHP
		}
?>
	    <td width="70%">
			<?PHP echo getLink($link,$row->name,$row->user_id); ?><br />
			(<?PHP echo $row->totalcomments; ?> comments)
		</td>
	</tr>
<?PHP
	}
}
?>
</table>
<?PHP
function getLink($linktype,$username,$uid){
	global $database,$mosConfig_live_site;
	
	$link = '';
	
	switch($linktype){
		case 'cb':
		    $url    = sefRelToAbs('index.php?option=com_comprofiler&task=userProfile&user=' . $uid);
		    $link   = '<a href="' . $url . '">' . $username . '</a>';
		    break;
		default:
		    #disabled
		    $link 	= $username;
		    break;
	}
	return $link;
}


function getAvatar($email, $userid){

global $_JC_CONFIG, $grav_link, $mosConfig_db, $database, $mosConfig_live_site, $mosConfig_absolute_path;

#Default avatar
$grav_url = $mosConfig_live_site . '/components/com_jomcomment/smilies/guest.gif';

	switch ($_JC_CONFIG->get('gravatar')) {
		case "gravatar" :
		    $grav_url   = 'http://www.gravatar.com/avatar.php?gravatar_id='
		                . md5($email)
		                . '&default=' . urlencode($mosConfig_live_site . '/components/com_jomcomment/smilies/guest.gif')
		                . '&size=35';
			break;

		case "fireboard":
			$fb_config_file = $mosConfig_absolute_path .'/administrator/components/com_fireboard/fireboard_config.php';

			if (file_exists($fb_config_file))
				include($fb_config_file);
			else
				break;

			if ($fbConfig['avatar_src']=='fb'){
				// get the fireboard avatar path if fireboard config has avatar source set to fireboard
				$database->setQuery("SELECT avatar from #__fb_users WHERE userid='{$userid}'");
				$avatar_relative_path = $database->loadResult();

				if ($avatar_relative_path){
				    $fb_avatar  = '';
				    
				    if($fbConfig['version'] == '1.0.2' || $fbConfig['version'] == '1.0.3'){
				        $fb_avatar  = '/images/fbfiles/avatars/' . $avatar_relative_path;
					}
					else{
					    $fb_avatar  = '/components/com_fireboard/avatars/' . $avatar_relative_path;
					}
					$avatar_abs_path    = $mosConfig_absolute_path . $fb_avatar;
					
					if(file_exists($avatar_abs_path))
					    $grav_url   = $mosConfig_live_site . $fb_avatar;
				}
			}
			break;

		case "cb" :
			$database->setQuery("SELECT avatar FROM #__comprofiler WHERE user_id='{$userid}' AND avatarapproved='1'");
			$result = $database->loadResult();

			if ($result) {
				// CB might store the images in either of this 2 folder
				if (file_exists($mosConfig_absolute_path . "/components/com_comprofiler/images/".$result))
					$grav_url = $mosConfig_live_site . "/components/com_comprofiler/images/" . $result;
				else
					if (file_exists($mosConfig_absolute_path . '/images/comprofiler/' . $result))
						$grav_url = $mosConfig_live_site . '/images/comprofiler/' . $result;
			}
			break;

		case "smf" :
			$smfPath = $_JC_CONFIG->get('smfPath');
			$smfPath = trim($smfPath);
			$smfPath = rtrim($smfPath, '/');
			if (!$smfPath or $smfPath == "" or !file_exists("$smfPath/Settings.php"))
				$smfPath = $mosConfig_absolute_path . '/forum';
			if (!$smfPath or $smfPath == "" or !file_exists("$smfPath/Settings.php")) {
				$database->setQuery("select id from #__components WHERE `option`='com_smf'");
				if ($database->loadResult()) {
					$database->setQuery("select value1 from #__smf_config WHERE variable='smf_path'");
					$smfPath = $database->loadResult();
					$smfPath = str_replace("\\", "/", $smfPath);
					$smfPath = rtrim($smfPath, "/");
				}
			}
			if (file_exists("$smfPath/Settings.php")) {
				include("$smfPath/Settings.php");

				global $context, $txt, $smfSettings,$database;
				#var_dump($database);
				#exit;
				mysql_select_db($mosConfig_db, $database->_resource);
				mysql_select_db($db_name, $database->_resource);

				// Get SMF Settings
				$smfSettings = jcGetSmfSettings($db_prefix);

				$database->setQuery("SELECT count(*) FROM $db_prefix"."members WHERE emailAddress='{$email}'");
				if($database->loadResult() == 0){
					mysql_select_db($mosConfig_db, $database->_resource);
					return $grav_url = $mosConfig_live_site .'/components/com_jomcomment/smilies/guest.gif';
				}
				$strSQL = 'SELECT * FROM ' . $db_prefix . 'members WHERE `emailAddress`=\'' . $email . '\'';

				$result = mysql_query($strSQL);

				$smfMemberData = array();

				if ($result != FALSE){
					$smfMemberData = mysql_fetch_array($result, MYSQL_ASSOC);

					$strSQL = "SELECT ID_ATTACH FROM {$db_prefix}attachments WHERE "
					        . "ID_MEMBER='{$smfMemberData['ID_MEMBER']}' AND "
					        . "ID_MSG=0 AND attachmentType=0";
					$database->setQuery($strSQL);
					$smfMemberData['ID_ATTACH'] = $database->loadResult();

					$context = array();
					if ($smfMemberData['avatar'] == '' && $smfMemberData['ID_ATTACH'] > 0)
						$context['member']['avatar'] = array(
							'choice' => 'upload',
							'server_pic' => 'blank.gif',
							'external' => 'http://'
						);
					elseif (stristr($smfMemberData['avatar'], 'http://'))
						$context['member']['avatar'] = array(
							'choice' => 'external',
							'server_pic' => 'blank.gif',
							'external' => $smfMemberData['avatar']
						);
					elseif (file_exists($smfSettings['avatar_directory'].'/'.$smfMemberData['avatar']))
						$context['member']['avatar'] = array(
							'choice' => 'server_stored',
							'server_pic' => $smfMemberData['avatar'] == '' ? 'blank.gif' : $smfMemberData['avatar'],
							'external' => 'http://'
						);
					else
						$context['member']['avatar'] = array(
							'choice' => 'server_stored',
							'server_pic' => 'blank.gif',
							'external' => 'http://'
						);

					// Get a list of all the avatars.
					if ($context['member']['avatar']['allow_server_stored'])
					{
						$context['avatar_list'] = array();
						$context['avatars'] = is_dir($smfSettings['avatar_directory']) ? jcGetAvatars('', 0) : array();
					}
					else
						$context['avatars'] = array();

					// Second level selected avatar...
					$context['avatar_selected'] = substr(strrchr($context['member']['avatar']['server_pic'], '/'), 1);

					switch(	$context['member']['avatar']['choice']){
						case 'external':
							$grav_url = $smfMemberData['avatar'];
							break;

						case 'upload':
							$grav_url = "$boardurl/index.php?action=dlattach;attach={$smfMemberData['ID_ATTACH']};type=avatar";
							break;

						case 'server_stored':
							// If custom_avatar_dir is used, need to check db if it is inserted
							if(!empty($smfSettings['custom_avatar_dir'])){
							    $strSQL = "SELECT filename FROM {$db_prefix}attachments WHERE "
							            . "ID_MEMBER='{$smfMemberData['ID_MEMBER']} AND "
							            . "ID_MSG=0 AND attachmentType=1";
								$database->setQuery($strSQL);
								$temp = $database->loadResult();
								if(!empty($temp)){
									if (stristr($smfSettings['custom_avatar_url'], 'http://'))
										$grav_url = $smfSettings['custom_avatar_url'] ."/". $temp;
									else
										$grav_url = rtrim($boardurl, '/')."/". $smfSettings['custom_avatar_url'] ."/". $temp;

								}else
									$grav_url = $smfSettings['avatar_url'] ."/". $smfMemberData['avatar'];
							} else
								$grav_url = $smfSettings['avatar_url'] ."/". $smfMemberData['avatar'];
							break;
						default:
							return $grav_url;
					}
					mysql_select_db($mosConfig_db, $database->_resource);
				} else {
					// Email not found in SMF, load default avatar
					return $grav_url;
				}
			}

			break;
		default :
			break;
	}

	return $grav_url;
}
?>
