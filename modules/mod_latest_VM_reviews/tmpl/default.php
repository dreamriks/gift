<?php
/**
* @Enterprise:	S&S Media Solutions
* @author:	 Yannick Spang
* @url:	 http://www.yagendoo.com
* @copyright:	Copyright (C) 2008 - 2009 S&S Media Solutions
* @license GNU/GPL, see on http://www.gnu.org/licenses/gpl-2.0.html
* @product:	Yagendoo - Latest Virtuemart Reviews
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// Load the virtuemart main parse code
require(JPATH_BASE.DS.'components'.DS.'com_virtuemart'.DS.'virtuemart_parser.php');
?>

<div id="ssmed_latest_vm_reviews<?php echo $params->get('moduleclass_sfx'); ?>">
		<?php foreach ($rows as $row) { 	
		if ($params->get('nameorusername') == 0) 
			{
			$getname = $row->name;	
			}
		elseif ($params->get('nameorusername') == 1) 
			{
			$getname = $row->username;	
			}	
		$flypage = vmGet($_REQUEST, "flypage", FLYPAGE);
		$category_id = vmGet($_REQUEST, "category_id", 1);
		$Itemid = intval(vmGet($_REQUEST, "Itemid"));
		$product_name 	= $row->product_name;
		$userrang=$params->get('userrang');
		$user =& JFactory::getUser();
		if ($user->get('gid') >=$userrang ) {
		$user_link 	= JRoute::_('/administrator/index.php?page=admin.user_form&user_id='. $row->userid .'&option=com_virtuemart');
		$user_name 	= '<a target="_blank" href="'. $user_link .'">'. $getname .'</a>';
		}
		else 
		{
		$user_name 	= $getname;
		}
		?>
		<div class="ssmed_latest_vm_reviews_main">		
			<?php if ($params->get('showusername') == 1) :?>
				<div class="ssmed_latest_vm_reviews_username">
					<?php echo JText::_('MEAN_FROM'); ?> <?php echo $user_name; ?> <?php echo JText::_('TO'); ?>
				</div>
			<?php endif; ?>
			<?php if ($params->get('showtitle') == 1) :?>	
				<div class="ssmed_latest_vm_reviews_product">
					<a href="<?php  $sess->purl(URL .'index.php?page=shop.product_details&flypage='.$flypage.'&product_id='. $row->product_id .'&category_id='.$category_id.'&Itemid='.$Itemid.'&option=com_virtuemart') ?>">
						<?php echo $product_name; ?>
					</a>
				</div>
			<?php endif; ?>
			<?php if ($params->get('showrating') == 1) :?>
				<div class="ssmed_latest_vm_reviews_rating">
					<img src="<?php echo JURI::root();?>modules/mod_latest_VM_reviews/tmpl/images/<?php echo $params->get('ratingstarcolor', 'yellow');?>/<?php echo $row->user_rating;?>.png" alt="<?php echo $row->user_rating.JText::_(' STARS');?>"/>
				</div>
			<?php endif; ?>
			<?php if ($params->get('showreview') == 1) :?>
			<div class="ssmed_latest_vm_reviews_comment">
				<?php echo $row->comment; ?>
			</div>
			<?php endif; ?>
			<?php $user =& JFactory::getUser(); if ($user->get('gid') >=$userrang) :?>
				<div class="ssmed_latest_vm_reviews_reviewlink">				
					<img src="<?php echo JURI::root(); ?>images/M_images/arrow.png" style="margin-right: 5px; "/>
					<a target="_blank" href="/administrator/index.php?pshop_mode=admin&page=product.review_list&option=com_virtuemart">
						<?php echo JText::_('Go To Review'); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>
	<?php }	?>
	<div class="ssmed_latest_vm_reviews_support">
		<a target="_blank" href="http://www.yagendoo.com" title="Module by Yagendoo.com">
			<img src="<?php echo JURI::Base();?>modules/mod_latest_VM_reviews/tmpl/images/black/yag_cr.png" alt="Yagendoo Copyright"/>
		</a>
	</div>
</div>