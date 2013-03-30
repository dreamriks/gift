<div class='fst_comment' id="fst_comment_<?php echo $this->comment['id'];?>">
	<?php if ($this->handler->short_thanks): ?>
		<?php echo JText::_("THANKS_FOR_YOUR_COMMENT_SHORT"); ?>
	<?php else: ?>
		<?php echo JText::sprintf("THANKS_FOR_YOUR_COMMENT",$this->handler->descriptions); ?>
	<?php endif; ?>
</div>
<div class='fst_clear'></div>