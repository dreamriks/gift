<div class="fst_moderate_status">
	<ul>
<?php foreach ($this->_moderatecounts as $ident => $count) : ?>
<li><?php echo $this->handlers[$ident]->GetDesc(); ?>: <b><?php echo $count['count']; ?></b> - <a href="<?php echo FSTRoute::_( 'index.php?option=com_fst&view=admin&layout=moderate&ident=' . $ident ); ?>"><?php echo JText::_('VIEW_NOW'); ?></a></li>
<?php endforeach; ?>
	</ul>
</div>

