<?php
/**
* @package   ENYtheme Template
* @version   1.0.00 2009-11-05 15:43:26
* @author    ENYtheme http://www.enytheme.com
* @copyright Copyright (C) 2009 ENYtheme e.K.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.mootools');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >

<head>

<!-- Loading CSS Files -->
<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/template.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/layout.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/menu.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/overrides.css" rel="stylesheet" type="text/css" />
</head>

<body>

	<!-- Logo & Banner Position -->
	<?php 
		if (($this->countModules('logo')) && ($this->countModules('banner'))) 
		{
			$logobannersuffix = "";
		} 
		else if ($this->countModules('banner')) 
		{
			$logobannersuffix="-onlybanner";
		}  
		else if ($this->countModules('logo')) 
		{
			$logobannersuffix="-onlylogo";
		} 
	?>
	
	<!-- User 1-4 -->
	<?php $count = 0;
    	if ($this->countModules('user1')) :
        	$count++;
    	endif;
    	if ($this->countModules('user2')) :
        	$count++;
    	endif;
    	if ($this->countModules('user3')) :
        	$count++;
    	endif;
    	if ($count != 0) {
    		$findmargin = $count-1;				
    		$eny_useronetofour_margin = 0;
    		$eny_useronetofour_fullwidth = 978;
    		$eny_useronetofour_newwidth = $eny_useronetofour_fullwidth-$eny_useronetofour_margin;
    		$eny_useronetofourwidth = $eny_useronetofour_newwidth/$count;
    		}
		elseif ($count == 0) {
			$eny_useronetofourwidth = 978;
		}
	?>
	
	<!-- User 5-8 -->
	<?php $count = 0;
	    if ($this->countModules('user4')) :
        $count++;
    	endif;
    	if ($this->countModules('user5')) :
        	$count++;
    	endif;
    	if ($this->countModules('user6')) :
        	$count++;
    	endif;
    	if ($count != 0) {
    		$findmargin = $count-1;				
    		$eny_userfivetoeight_margin = 0;
    		$eny_userfivetoeight_fullwidth = 978;
    		$eny_userfivetoeight_newwidth = $eny_userfivetoeight_fullwidth-$eny_userfivetoeight_margin;
    		$eny_userfivetoeightwidth = $eny_userfivetoeight_newwidth/$count;
    		}
		elseif ($count == 0) {
			$eny_userfivetoeightwidth = 978;
		}
	?>
	
	<!-- Mainbody -->
	<?php 
		if(($this->countModules('right')) && ($this->countModules('left'))) 
		{
			$suffix = "-rightandleftcount";
		} 
		else if($this->countModules('right')) 
		{
			$suffix = "-rightcount";
		}
		else if($this->countModules('left')) 
		{
			$suffix = "-leftcount";
		} 
		else
		{
			$suffix = "-onlymaincontent";
		}
		
	?>

	<!-- User 9-12 -->
	<?php $count = 0;
    	if ($this->countModules('user7')) :
        	$count++;
    	endif;
    	if ($this->countModules('user8')) :
        	$count++;
    	endif;
    	if ($this->countModules('user9')) :
        	$count++;
    	endif;
    	if ($count != 0) {
    		$findmargin = $count-1;				
    		$eny_userninetotwelve_margin = 0;
    		$eny_userninetotwelve_fullwidth = 978;
    		$eny_userninetotwelve_newwidth = $eny_userninetotwelve_fullwidth-$eny_userninetotwelve_margin;
    		$eny_userninetotwelvewidth = $eny_userninetotwelve_newwidth/$count;
    		}
		elseif ($count == 0) {
			$eny_userninetotwelvewidth = 978;
		}
	?>


	<!-- User Info -->
	<?php $count = 0;
    	if ($this->countModules('user10')) :
        	$count++;
    	endif;
    	if ($this->countModules('user11')) :
        	$count++;
    	endif;
    	if ($this->countModules('user12')) :
        	$count++;
    	endif;
    	if ($count != 0) {
    		$findmargin = $count-1;				
    		$eny_thirthteentosixteen_margin = 0;
    		$eny_thirthteentosixteen_fullwidth = 978;
    		$eny_thirthteentosixteen_newwidth = $eny_thirthteentosixteen_fullwidth-$eny_thirthteentosixteen_margin;
    		$eny_thirthteentosixteenwidth = $eny_thirthteentosixteen_newwidth/$count;
    		}
		elseif ($count == 0) {
			$eny_thirthteentosixteenwidth = 978;
		}
	?>
	


</body>
</html>





