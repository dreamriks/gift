<?php
defined('_JEXEC') or die('Restricted access');
$url = clone(JURI::getInstance());
?>
<?php echo '<?xml version="1.0" encoding="utf-8"?' .'>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-18137357-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
 
<link rel="shortcut icon" href="<?php echo $this->baseurl ?>/images/favicon.ico" />
<head>
<?php 
include('adsbanner_config.php');
?>
<jdoc:include type="head" />

<?php 
$template_color 	= $this->params->get('template_color');
$menu_name        	= $this->params->get("menuName", "mainmenu");
$slidefilm1_speed	= $this->params->get('slidefilm1_speed');
$slidefilm1_title	= $this->params->get('slidefilm1_title');
$slidefilm2_title	= $this->params->get('slidefilm2_title');
$slidefilm3_title	= $this->params->get('slidefilm3_title');
$slidefilm4_title	= $this->params->get('slidefilm4_title');
$tabmodule1_name 	= $this->params->get('tabmodule1_name');
$tabmodule2_name 	= $this->params->get('tabmodule2_name');
$tabmodule3_name 	= $this->params->get('tabmodule3_name');
$tabmodule4_name 	= $this->params->get('tabmodule4_name');
$tabmodule5_name 	= $this->params->get('tabmodule5_name');
$let_me_in			= $this->params->get('let_me_in');
$let_me_in_title	= $this->params->get('let_me_in_title');
$let_me_in_url		= $this->params->get('let_me_in_url');
$on_let_me_in		= $this->params->get('on_let_me_in');
$on_let_me_in_title	= $this->params->get('on_let_me_in_title');
$on_let_me_in_url	= $this->params->get('on_let_me_in_url');
$sponsorship_area	= $this->params->get('sponsorship_area');
$path_images_adsbanner		= $this->params->get('path_images_adsbanner');
$adsbanner_default_link		= $this->params->get('adsbanner_default_link');
$adsbanner_default_title1	= $this->params->get('adsbanner_default_title1');
$adsbanner_default_title2	= $this->params->get('adsbanner_default_title2');
$adsbanner_default_text		= $this->params->get('adsbanner_default_text');
$hoverbanner_img_hover		= $this->params->get('hoverbanner_img_hover');
$hoverbanner_img_top		= $this->params->get('hoverbanner_img_top');
$hoverbanner_link	= $this->params->get('hoverbanner_link');
$hoverbanner_alt	= $this->params->get('hoverbanner_alt');
$hoverbanner_target	= $this->params->get('hoverbanner_target');
$baseurl 			= JURI::base();

/*//Camp26 Template Calculation for Camp26 E-Buy Template*/
/*formod calculation*/
$total = ( $this->countModules( 'user7' ) ? 1:0 )+( $this->countModules( 'user8' ) ? 1:0 )+( $this->countModules( 'user9' ) ? 1:0 )+( $this->countModules( 'user10' ) ? 1:0 );
if ($total == 4) { $formod_width=24; }
if ($total == 3) { $formod_width=32; }
if ($total == 2) { $formod_width=48; }
if ($total == 1) { $formod_width=100; }
/*end formod calculation*/


/*Body Calculation*/
$total_width = ( $this->countModules( 'right' ) ? 1:0 )+( $this->countModules( 'user5' ) ? 1:0 )+( $this->countModules( 'user6' ) ? 1:0 )+( $this->countModules( 'advert3' ) ? 1:0 );
if ($total_width > 0) { 
	if  (($page != 'account.order_details') + ($option != 'com_virtuemart')) {
	$middle_width=430 + $mainwidth_tpl_cal;  
	$right_width=300 + $mainwidth_tpl_cal;
	} else {
	$middle_width=730 + $mainwidth_tpl_cal;  
	$right_width=0 + $mainwidth_tpl_cal;
	}

	
}
if ($total_width == 0) { $middle_width=730 + $mainwidth_tpl_cal;  $right_width=0 + $mainwidth_tpl_cal;}

$total_body_width = ( $this->countModules( 'left' ) ? 1:0 )+( $this->countModules( 'user3' ) ? 1:0 )+( $this->countModules( 'user4' ) ? 1:0 )+( $this->countModules( 'advert1' ) ? 1:0 );
if ($total_body_width > 0) {$left_width=180 + $mainwidth_tpl_cal; $rightwrapper_width=740 + $mainwidth_tpl_cal;}
if ($total_body_width == 0) {$left_width=0 + $mainwidth_tpl_cal; $rightwrapper_width=920 + $mainwidth_tpl_cal;}
/*end Body Calculation*/


// Dropline Menu
	$document	= &JFactory::getDocument();
	$renderer	= $document->loadRenderer( 'module' );
	$options	 = array( 'style' => "raw" );
	$module	 = JModuleHelper::getModule( 'mod_mainmenu' );
	$mainnav = false; $subnav = false;
		$module->params	= "menutype=$menu_name\nstartLevel=0\nendLevel=2\nmenu_style=list\nshowAllChildren=1\nexpand_menu=1";
		$mainnav = $renderer->render( $module, $options );
		$options	 = array( 'style' => "submenu" );
		$module	 = JModuleHelper::getModule( 'mod_mainmenu' );
		$module->params	= "menutype=$menu_name\nstartLevel=2\n";
		$subnav = $renderer->render( $module, $options );
		
		// make sure subnav is empty
	if (strlen($subnav) < 10) $subnav = false;
		
?>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />

<link href="<?php echo $baseurl ?>templates/camp26_e_buy/css/<?php echo $template_color; ?>/importer.css" title="default" media="screen" rel="stylesheet" type="text/css" />

<?php if ($option != 'com_virtuemart') { ?>
<script src="<?php echo $baseurl ?>templates/camp26_e_buy/js/jquery-1.2.3.pack.js" type="text/javascript"></script>
<script src="<?php echo $baseurl ?>templates/camp26_e_buy/js/jquery.film.js" type="text/javascript"></script>
<script>
	jQuery.noConflict(); 
	jQuery(document).ready(function($){
	var newsoption = {
	  firstname: "mynews",
	  secondname: "showhere",
	  
	  fourthname:"news_button",
	  playingtitle:"Showing ",
	  nexttitle:" ",
	  prevtitle:" Prev Slide: ",
	  imagedir:"<?php echo $baseurl ?>templates/camp26_e_buy/images/<?php echo $template_color; ?>/",
	  newsspeed:'<?php echo $slidefilm1_speed;?>'
	}
	 $.init_news(newsoption);

	var myoffset=$('#news_button').offset();
	var mytop=myoffset.top-1;

	$('#news_button').css({top:mytop});

	});
</script>
<?php } ?>

<link href="<?php echo $baseurl ?>templates/camp26_e_buy/css/<?php echo $template_color; ?>/ui.tabs.css" title="default" rel="stylesheet" type="text/css" media="print, projection, screen" />

<script src="<?php echo $baseurl ?>templates/camp26_e_buy/js/ui.tabs.pack.js" type="text/javascript"></script>
<script src="<?php echo $baseurl ?>templates/camp26_e_buy/js/ui.tabs.ext.pack.js" type="text/javascript"></script>
<script type="text/javascript"> 
	jQuery.noConflict(); jQuery(document).ready(function($) { ; 
	$('#camptabs > ul').tabs();
	}); 
</script>
<script src="<?php echo $baseurl ?>templates/camp26_e_buy/js/qTip.js" type="text/javascript"></script>	

<!--[if lte IE 6]>
	<link rel="stylesheet" href="<?php echo $baseurl ?>templates/camp26_e_buy/css/ie6.css" title="default" media="screen" type="text/css" />

	<link rel="stylesheet" href="<?php echo $baseurl ?>templates/camp26_e_buy/css/<?php echo $template_color; ?>/ie6.css" title="default" media="screen" type="text/css" />
	
	<?php $middle_width = $middle_width-5 ?>
<![endif]-->
<!--[if IE 7]>
	<link rel="stylesheet" href="<?php echo $baseurl ?>templates/camp26_e_buy/css/ie7.css" title="default" media="screen" type="text/css" />
<![endif]-->
<?php 
include_once( "templates/". $this->template . "/js/ie.js" );
?>

	<script type="text/javascript" src="templates/camp26_e_buy/js/styleswitch.js"></script>
	<script>
		jQuery.noConflict();
		jQuery(document).ready(function($) {
		$('.styleswitch').click(function()
		{
			switchStylestyle(this.getAttribute("rel"));
			return false;
		});
		var c = readCookie('style');
		if (c) switchStylestyle(c);
		});
	</script>

	
</head>

<body id="pagebody">
	<div id="bodywrapper">
		<div id="header_wrapper">
			<div id="header_left">
				<!--<span id="letmein">
					<?php 	$user = & JFactory::getUser();
							$type = (!$user->get('guest')) ? 'logout' : 'login';
					if($type == 'logout') { ?>
						<a href="<?php echo $on_let_me_in_url;?>" title="<?php echo $on_let_me_in_title;?>"><?php echo $on_let_me_in;?></a>
					<?php } else { ?>
						<a href="<?php echo $let_me_in_url;?>" title="<?php echo $let_me_in_title;?>"><?php echo $let_me_in;?></a>
					<?php } ?>
				</span> -->
			</div>
			<div id="header_right">
				<div id="header_right_wrapper">
					<div id="header_right_wrapper_inner">
						<div id="header_top">
							<div id="headertopleft">
								<jdoc:include type="modules" name="top" style="xhtml" />
							</div>
							<div id="headertopright">
								<jdoc:include type="modules" name="cpanel" style="xhtml" />
							</div>
						</div>
						<div id="header_bottom">
							<div id="topnav_wrapper">
								<div id="topnav">
									<?php echo $mainnav; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="mainbodywrapper">
		<p style="color: #0000FF; font-size: 20pt">
<span id="currentdate">
				<?php/* echo JHTML::_('date', 'now' ) */?>
			</span>
		<?php if ($option != 'com_virtuemart') { ?>
			<?php if (($this->countModules( 'tabs1' )) || ($this->countModules( 'tabs2' )) || ($this->countModules( 'tabs3' )) || ($this->countModules( 'tabs4' )) || ($this->countModules( 'tabs5' )) || ($this->countModules( 'film1' )) || ($this->countModules( 'film2' )) || ($this->countModules( 'film3' )) || ($this->countModules( 'film4' ))) { ?>
			<div id="mainbodytop">
			<?php if (($this->countModules( 'film1' )) || ($this->countModules( 'film2' )) || ($this->countModules( 'film3' )) || ($this->countModules( 'film4' ))) { ?>
				<div id="mainbodytop_left1">
					<div id="mainbodytop_left2">
						<div id="framecontent">
							<div align="left" id="mynewsdis">
								<div class="news_border">
									<div id="showhere" class="news_show"> </div>
								</div>
								<div class="buttondiv" id="news_button">
									<img src="<?php echo $baseurl ?>templates/camp26_e_buy/images/<?php echo $template_color; ?>/prev.png" align="absmiddle" id="news_prev"><img src="<?php echo $baseurl ?>templates/camp26_e_buy/images/<?php echo $template_color; ?>/pause.png" align="absmiddle" id="news_pause"><img src="<?php echo $baseurl ?>templates/camp26_e_buy/images/<?php echo $template_color; ?>/next.png" align="absmiddle" id="news_next">
								</div>
								<div class="news_mark">
									<div id="news_display" class="news_title"></div>
								</div>
							</div>
							
							<div id="mynews">
								<?php if ($this->countModules( 'film1' )) { ?>
								<div id="news1"	class="news_style" rel="<?php echo $slidefilm1_title;?>">
									<div class="filmframe">
										<jdoc:include type="modules" name="film1" style="xhtml" />
									</div>
								</div>
								<?php } ?>
								<?php if ($this->countModules( 'film2' )) { ?>
								<div id="news2" class="news_style" rel="<?php echo $slidefilm2_title;?>">				
									<div class="filmframe">
										<jdoc:include type="modules" name="film2" style="xhtml" />
									</div>
								</div>
								<?php } ?>
								<?php if ($this->countModules( 'film3' )) { ?>
								<div id="news3" class="news_style" rel="<?php echo $slidefilm3_title;?>">
									<div class="filmframe">
										<jdoc:include type="modules" name="film3" style="xhtml" />
									</div>
								</div>
								<?php } ?>
								<?php if ($this->countModules( 'film4' )) { ?>
								<div id="news4" class="news_style" rel="<?php echo $slidefilm4_title;?>">
									<div class="filmframe">
										<jdoc:include type="modules" name="film4" style="xhtml" />
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
				<div id="mainbodytop_right">
					<div id="mbr_wrapper">
						<div id="mbr_inner">
							<?php if (($this->countModules( 'tabs1' )) || ($this->countModules( 'tabs2' )) || ($this->countModules( 'tabs3' )) || ($this->countModules( 'tabs4' )) || ($this->countModules( 'tabs5' ))) { ?>	
								<div id="camptabs">
									<ul><?php if ($this->countModules( 'tabs1' )) { ?>
											<li><a href="#tabs1"><span><?php echo $tabmodule1_name;?></span></a></li>
										<?php } ?>
										<?php if ($this->countModules( 'tabs2' )) { ?>
											<li><a href="#tabs2"><span><?php echo $tabmodule2_name;?></span></a></li>
										<?php } ?>
										<?php if ($this->countModules( 'tabs3' )) { ?>
											<li><a href="#tabs3"><span><?php echo $tabmodule3_name;?></span></a></li>
										<?php } ?>
										<?php if ($this->countModules( 'tabs4' )) { ?>
											<li><a href="#tabs4"><span><?php echo $tabmodule4_name;?></span></a></li>
										<?php } ?>	
										<?php if ($this->countModules( 'tabs5' )) { ?>
											<li><a href="#tabs5"><span><?php echo $tabmodule5_name;?></span></a></li>
										<?php } ?>									
									</ul>
									<?php if ($this->countModules( 'tabs1' )) { ?>
										<div id="tabs1">
											<jdoc:include type="modules" name="tabs1" style="xhtml" />
										</div>
									<?php } ?>
									<?php if ($this->countModules( 'tabs2' )) { ?>
										<div id="tabs2">
											<jdoc:include type="modules" name="tabs2" style="xhtml" />
										</div>
									<?php } ?>
									<?php if ($this->countModules( 'tabs3' )) { ?>
										<div id="tabs3">
											<jdoc:include type="modules" name="tabs3" style="xhtml" />
										</div>
									<?php } ?>
									<?php if ($this->countModules( 'tabs4' )) { ?>
										<div id="tabs4">
											<jdoc:include type="modules" name="tabs4" style="xhtml" />
										</div>
									<?php } ?>
									<?php if ($this->countModules( 'tabs5' )) { ?>
										<div id="tabs5">
											<jdoc:include type="modules" name="tabs5" style="xhtml" />
										</div>
									<?php } ?>
								</div> 
							<?php } ?>
						</div>
						<div class="clr"></div>
						<?php if($this->countModules( 'banner' )) { ?>
							<div id="aftertabs">
								<jdoc:include type="modules" name="banner" style="xhtml" />
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php } ?><!--End Tabs & Film-->
			<?php } ?><!--End VirtueMart-->
			<?php if($this->countModules( 'user2' )) { ?>
			<div id="fullwidth">
				<jdoc:include type="modules" name="user2" style="xhtml" />
			</div>
			<?php } ?>
			
			<div class="clr"></div>
			<div id="maincontent_wrapper">
			<?php if(($this->countModules( 'left' )) || ($this->countModules( 'user3' )) || ($this->countModules( 'user4' )) || ($this->countModules( 'advert1' ))) { ?>
				<div id="mc_left" style="width: <?php echo $left_width; ?>px;">
					<jdoc:include type="modules" name="left" style="xhtml" />
                	<jdoc:include type="modules" name="user3" style="xhtml" />
					<jdoc:include type="modules" name="user4" style="xhtml" />
					<jdoc:include type="modules" name="advert1" style="xhtml" />
				</div>
			<?php } ?>
			
				<div id="mc_rightwrapper" style="width: <?php echo $rightwrapper_width; ?>px;">								
					<div id="mc_middle" style="width: <?php echo $middle_width; ?>px; ">
					<?php if(($this->countModules( 'bodytop' )) || ($this->countModules( 'legals' ))) { ?>
						<div id="before_body">
							<jdoc:include type="modules" name="bodytop" style="xhtml" />
							
							<jdoc:include type="modules" name="legals" style="xhtml" />
						</div>
					<?php } ?>
						<div id="mainbody">
							<?php if($this->params->get('showComponent')) : ?>
									<jdoc:include type="component" />
							<?php endif; ?>
						</div>
					<?php if($this->countModules( 'advert2' )) { ?>
						<div id="after_mainbody">
							<jdoc:include type="modules" name="advert2" style="xhtml" />
						</div>
					<?php } ?>
					</div>
					<?php if  (($task != 'edit') + ($option != 'com_content')) { ?>
					<?php if  (($page != 'account.order_details') + ($option != 'com_virtuemart')) { ?>
					<?php if(($this->countModules( 'right' )) || ($this->countModules( 'user5' )) || ($this->countModules( 'user6' )) || ($this->countModules( 'advert3' ))) { ?>
					<div id="mc_right" style="width: <?php echo $right_width; ?>px;">
						<jdoc:include type="modules" name="right" style="xhtml" />
						<jdoc:include type="modules" name="user5" style="xhtml" />
						<jdoc:include type="modules" name="user6" style="xhtml" />
						<!-- <script type="text/javascript">
						function mouseOver()
						{
							document.b1.src ="<?php echo $hoverbanner_img_hover; ?>";
						}
						function mouseOut()
						{
							document.b1.src ="<?php echo $hoverbanner_img_top; ?>";
						}
						</script>						
						<div id="hoveradd">							
							<a href="<?php echo $hoverbanner_link; ?>" target="<?php echo $hoverbanner_target; ?>"
							onmouseover="mouseOver()"
							onmouseout="mouseOut()">
							<img border="0" alt="<?php echo $hoverbanner_alt; ?>"
							src="<?php echo $hoverbanner_img_top; ?>" name="b1" /></a>						
						 </div> -->
						<?php	
						?>
						<jdoc:include type="modules" name="advert3" style="xhtml" />
					</div>
					<?php } ?>
					<?php } ?>
					<?php } ?>
				</div>
			
			</div>
			<div class="clr"></div>
			<div id="bottom_wrapper">
				<div id="inner_wrapper">
<div id="iklan">
								
							</div>		
					<table border="0" cellspacing="0" cellpadding="0" valign="top">
						
						<tr class="col_content">
							<?php if($this->countModules( 'user7' )) { ?>
								<td class="formod col1" style="width: <?php echo "23";?>%" valign="top">
									<jdoc:include type="modules" name="user7" style="xhtml" />
	
					</td>
							<?php } ?>	
							<?php if($this->countModules( 'user8' )) { ?>
								<td class="formod col2" style="width: <?php echo "34";?>%" valign="top">
									<jdoc:include type="modules" name="user8" style="xhtml" />
								</td>
							<?php } ?>
							<?php //if($this->countModules( 'user9' )) { ?>
								<!--<td class="formod col3" valign="top">
									<jdoc:include type="modules" name="user9" style="xhtml" />
								</td>-->
							<?php //} ?>
							<?php if($this->countModules( 'user10' )) { ?>
								<td id="lastcol" class="formod col4" style="width: <?php echo "33";?>%" valign="top">
									<jdoc:include type="modules" name="user10" style="xhtml" />
								</td>
							<?php } ?>
						</tr>
						
					</table>				
				</div>
			</div>		
			<div id="footer">
				<div id="footer_left">
<?php
$str = "© 2010 Gift Delivery Across Jaipur";
echo $str;
echo "<br />";
echo "Designed and Developed by Golygon.com";
?>
								</div>
				<div id="footer_right">
					<?php if($this->countModules( 'footer' )) { ?>
									<jdoc:include type="modules" name="footer" style="xhtml" />
	
							<?php } ?>	
				</div>
			</div>
		</div>
	</div>
</body>
</html>

<body>
</body>
</html>