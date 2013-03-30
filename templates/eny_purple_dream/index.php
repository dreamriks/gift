<?php
/**
* @package   ENY Purple Dream
* @version   1.0.00 2009-11-17 15:43:26
* @author    ENYtheme http://www.enytheme.com
* @copyright Copyright (C) 2009 ENYtheme e.K.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
define( 'YOURBASEPATH', dirname(__FILE__) );

require(YOURBASEPATH.DS."includes".DS."settings.php");
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>">

<head>
	<jdoc:include type="head" />
</head>

<!-- General -->
<body id="pagearea">
	<div id="wrapper">
		<div id="wrapper_content">
		
			<!-- Top Menu -->
			<div class="eny_top_menu">
			<jdoc:include type="modules" name="topmenu" style="xhtml" />
			</div>
			
			<!-- Header -->
			<?php if($this->countModules('logo') || $this->countModules('banner')):?>
			<div class="eny_header">
				
				<!-- Logo -->
				<div id="eny_logo<?php echo $logobannersuffix; ?>">
				<jdoc:include type="modules" name="logo" style="xhtml" />
				</div>
				
				<!-- Banner -->
				<div id="eny_banner<?php echo $logobannersuffix; ?>">
				<jdoc:include type="modules" name="banner" style="xhtml" />
				</div>
				
			<div class="clear"></div>
			</div>
			<?php endif;?>
			
			<!-- Main Menu -->
			<div id="eny_mainnavi">
			<jdoc:include type="modules" name="menu" style="xhtml" />
			</div>
			
			<!-- User 1-4 -->
			<div class="eny_useronetofour_area">
			
				<?php if($this->countModules('user1')):?>
				<div class="eny_useronetofour" style="width:<?php echo $eny_useronetofourwidth; ?>px;">
				<jdoc:include type="modules" name="user1" style="eny_promo" />
				</div>
				<?php endif;?>
	
				<?php if($this->countModules('user2')):?>
				<div class="eny_useronetofour" style="width:<?php echo $eny_useronetofourwidth; ?>px;">
				<jdoc:include type="modules" name="user2" style="eny_promo" />
				</div>
				<?php endif;?>
	
				<?php if($this->countModules('user3')):?>
				<div class="eny_useronetofour" style="width:<?php echo $eny_useronetofourwidth; ?>px;">
				<jdoc:include type="modules" name="user3" style="eny_promo" />
				</div>
				<?php endif;?>
			
			<div class="clear"></div>
			</div>
			
			
			<!-- User 5-8 -->
			<div class="eny_userfivetoeight_area">
			
				<?php if($this->countModules('user4')):?>
				<div class="eny_userfivetoeight" style="width:<?php echo $eny_userfivetoeightwidth; ?>px;">
				<jdoc:include type="modules" name="user4" style="eny_default" />
				</div>
				<?php endif;?>
	
				<?php if($this->countModules('user5')):?>
				<div class="eny_userfivetoeight" style="width:<?php echo $eny_userfivetoeightwidth; ?>px;">
				<jdoc:include type="modules" name="user5" style="eny_default" />
				</div>
				<?php endif;?>
	
				<?php if($this->countModules('user6')):?>
				<div class="eny_userfivetoeight" style="width:<?php echo $eny_userfivetoeightwidth; ?>px;">
				<jdoc:include type="modules" name="user6" style="eny_default" />
				</div>
				<?php endif;?>
			
			<div class="clear"></div>
			</div>
			
			<!-- Breadcrumb -->
			<?php if($this->countModules('breadcrumb')):?>
			<div class="eny_breadcrumb">
			<jdoc:include type="modules" name="breadcrumb" style="xhtml" />
			</div>
			<?php endif;?>
			
			<!-- Main Area -->
			<div class="eny_main_area">
		
				<!-- Left -->
				<div id="eny_left<?php echo $suffix; ?>">
				<jdoc:include type="modules" name="left" style="eny_default" />	
				</div>	
				
				<!-- Main -->
				<div id="eny_main<?php echo $suffix; ?>">
				<jdoc:include type="message" />		
				<jdoc:include type="component" />
				</div>
				
				<!-- Right -->
				<div id="eny_right<?php echo $suffix; ?>">
				<jdoc:include type="modules" name="right" style="eny_default" />	
				</div>
		
			<div class="clear"></div>
			</div>
			
			
			<!-- User 9-12 -->
			<div class="eny_userninetotwelve_area">
			
				<?php if($this->countModules('user7')):?>
				<div class="eny_userninetotwelve" style="width:<?php echo $eny_userninetotwelvewidth; ?>px;">
				<jdoc:include type="modules" name="user7" style="eny_default" />
				</div>
				<?php endif;?>
	
				<?php if($this->countModules('user8')):?>
				<div class="eny_userninetotwelve" style="width:<?php echo $eny_userninetotwelvewidth; ?>px;">
				<jdoc:include type="modules" name="user8" style="eny_default" />
				</div>
				<?php endif;?>
	
				<?php if($this->countModules('user9')):?>
				<div class="eny_userninetotwelve" style="width:<?php echo $eny_userninetotwelvewidth; ?>px;">
				<jdoc:include type="modules" name="user9" style="eny_default" />
				</div>
				<?php endif;?>

			
			<div class="clear"></div>
			</div>
			
			<div class="clear"></div>
			
			<!-- Info -->
			<div class="eny_thirthteentosixteen_area">
			
				<?php if($this->countModules('user10')):?>
				<div class="eny_thirthteentosixteen" style="width:<?php echo $eny_thirthteentosixteenwidth; ?>px;">
				<jdoc:include type="modules" name="user10" style="eny_info" />
				</div>
				<?php endif;?>
	
				<?php if($this->countModules('user11')):?>
				<div class="eny_thirthteentosixteen" style="width:<?php echo $eny_thirthteentosixteenwidth; ?>px;">
				<jdoc:include type="modules" name="user11" style="eny_info" />
				</div>
				<?php endif;?>
	
				<?php if($this->countModules('user12')):?>
				<div class="eny_thirthteentosixteen" style="width:<?php echo $eny_thirthteentosixteenwidth; ?>px;">
				<jdoc:include type="modules" name="user12" style="eny_info" />
				</div>
				<?php endif;?>
			
			<div class="clear"></div>
			</div>
			
			<!-- Footer & Copyright Info -->
			<div class="eny_footer_area">
			
				<div class="eny_copyright">
				<a href="http://www.enytheme.com" title="ENYtheme Joomla Template Design and Development">Joomla Templates by ENYtheme.com</a>
				</div>
				
				<div class="eny_footer">
				<jdoc:include type="modules" name="footer" style="xhtml" />
				</div>
			
			<div class="clear"></div>
			</div>
			
			
			
		</div>
	</div>
			
			<!-- Debug Position -->
			<div>
			<jdoc:include type="modules" name="debug" style="xhtml" />	
			</div>	
	
</body>
</html>
