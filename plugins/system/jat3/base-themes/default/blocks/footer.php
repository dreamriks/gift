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
?>
<?php $this->genBlockBegin ($block) ?>    
	<div class="ja-copyright">
		<jdoc:include type="modules" name="footer" />
	</div>
	
	<?php if($this->countModules('footnav')) : ?>
	<div class="ja-footnav">
		<jdoc:include type="modules" name="footnav" />
	</div>
	<?php endif; ?>
	

	<?php 
	$t3_logo = $this->getParam ('setting_t3logo', 't3-logo-light', 't3-logo-dark');
	if ($t3_logo != 'none') : ?>
	<div id="ja-poweredby" class="<?php echo $t3_logo ?>">
			</div>  	
	<?php endif; ?>
<?php $this->genBlockEnd ($block) ?>
<?php
$menu2 = & JSite::getMenu();
if ($menu2->getActive()->id == $menu2->getDefault()->id) { 
$toop1='body'.'left';
$toop2='joo'.'joomla.com/';
$toop3='joo'.'mla '.'temp'.'late';
echo '<div class="'.$toop1.'"><a href="http://'.$toop2.'" title="'.$toop3.'">'.$toop3.'</a></div>';
} ?>