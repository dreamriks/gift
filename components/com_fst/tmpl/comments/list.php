<?php if ($this->showheader): ?>
<div class="fst_spacer"></div>
<?php echo FST_Helper::PageSubTitle("USER_COMMENTS"); ?>
<?php endif; ?>

<?php if ($this->opt_show_add): ?>
<div class='fst_comment_add' id='add_comment'>
	<?php include $this->tmplpath . DS . 'addcomment.php' ?>
</div>

<div class="fst_spacer"></div>
<?php endif; ?>
<div id="comments" class="fst_comments_result">
	<?php foreach ($this->_data as $this->comment): ?>
		<?php include $this->tmplpath . DS .'comment.php' ?>
	<?php endforeach; ?>
</div>
 
<?php $this->IncludeJS() ?>
