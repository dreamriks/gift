<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<div class="bannergroup<?php echo $params->get( 'moduleclass_sfx' ) ?>">

<?php if ($headerText) : ?>
	<div class="eny_bannerheader"><?php echo $headerText ?></div>
<?php endif;

foreach($list as $item) :

	?><div class="eny_banneritem<?php echo $params->get( 'moduleclass_sfx' ) ?>"><?php
	echo modBannersHelper::renderBanner($params, $item);
	?><div class="clear"></div>
	</div>
<?php endforeach; ?>

<?php if ($footerText) : ?>
	<div class="eny_bannerfooter<?php echo $params->get( 'moduleclass_sfx' ) ?>">
		 <?php echo $footerText ?>
	</div>
<?php endif; ?>
</div>