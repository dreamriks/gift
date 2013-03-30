<div class="fst_spacer"></div>
<?php echo FST_Helper::PageSubTitle('MODERATE'); ?>

<div class="fst_spacer"></div>
<?php echo JText::_('Comments:'); ?> <?php echo $this->whatcomm; ?> &nbsp; &nbsp; &nbsp;
<?php // ?>
<button onclick='fst_moderate_refresh(); return false;'><?php echo JText::_('REFRESH'); ?></button>

<div id="fst_moderate">
	<?php include $this->tmplpath . DS .'modadmin_inner.php' ?>	
</div>
 
<?php $this->IncludeJS() ?>
